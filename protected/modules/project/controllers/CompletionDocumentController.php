<?php

class CompletionDocumentController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'rights',
            'milestoneContext + create index admin', //check to ensure valid milestone context
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $completionDocument = $this->loadModel($id);
        $completionReview = $this->createCompletionReview($completionDocument);
        $this->changeStatus($id);
        $this->render('view', array(
            'model' => $completionDocument,
            'completionReview' => $completionReview,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $dir = Yii::getPathOfAlias('webroot') . Yii::app()->params['uploads'];
        $model = new CompletionDocument;
        $model->milestone_id = $this->_milestone->id;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['CompletionDocument'])) {
            $model->attributes = $_POST['CompletionDocument'];
            $model->file = CUploadedFile::getInstance($model, 'file');
            $fileName = sha1($model->file->getName() . rand(1, 9999999999)) . '.' . $model->file->getExtensionName();
            $model->document = $model->file->getName();
            $model->file_name = $fileName;
            $dir = Yii::getPathOfAlias('webroot') . Yii::app()->params['uploads'];
            if ($model->file->saveAs($dir . '/' . $fileName)) {
                shell_exec(Yii::app()->params['pdf2swf'] . ' ' . $dir . $model->file_name . ' -o ' . $dir . $model->file_name . '.swf -f -T 9 -t -s storeallcharacters');
            }
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['CompletionDocument'])) {
            $model->attributes = $_POST['CompletionDocument'];
            $model->file = CUploadedFile::getInstance($model, 'file');
            if ($model->file !== null) {
                $fileName = sha1($model->file->getName() . rand(1, 9999999999)) . '.' . $model->file->getExtensionName();
                $model->document = $model->file->getName();
                $model->file_name = $fileName;
                $dir = Yii::getPathOfAlias('webroot') . Yii::app()->params['uploads'];
                if ($model->file->saveAs($dir . '/' . $fileName)) {
                    shell_exec(Yii::app()->params['pdf2swf'] . ' ' . $dir . $model->file_name . ' -o ' . $dir . $model->file_name . '.swf -f -T 9 -t -s storeallcharacters');
                }
            }
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('CompletionDocument', array(
                    'criteria' => array(
                        'condition' => 'milestone_id=:milestoneId',
                        'params' => array(':milestoneId' => $this->_milestone->id)
                    ),
                ));
        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'milestone' => $this->_milestone,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new CompletionDocument('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['CompletionDocument']))
            $model->attributes = $_GET['CompletionDocument'];

        $model->milestone_id = $this->_milestone->id;
        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = CompletionDocument::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'completion-document-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * @var private property containing the associated Milestone model
      instance.
     */
    private $_milestone = null;

    /**
     * Protected method to load the associated milestone model class
     * @milestone_id the primary identifier of the associated milestone
     * @return object the milestone data model based on the primary key
     */
    protected function loadMilestone($milestone_id) {
        //if the milestone property is null, create it based on input id
        if ($this->_milestone === null) {
            $this->_milestone = Milestone::model()->findbyPk($milestone_id);
            if ($this->_milestone === null) {
                throw new CHttpException(404, 'The requested Kabuaten does not exist.');
            }
        }
        return $this->_milestone;
    }

    /**
     * In-class defined filter method, configured for use in the above
      filters() method
     * It is called before the actionCreate() action method is run in
      order to ensure a proper milestone context
     */
    public function filterMilestoneContext($filterChain) {
        //set the milestone identifier based on either the GET or POST input
        //request variables, since we allow both types for our actions
        $milestoneId = null;
        if (isset($_GET['pid']))
            $milestoneId = $_GET['pid'];
        else if (isset($_POST['pid']))
            $milestoneId = $_POST['pid'];
        $this->loadMilestone($milestoneId);
        //complete the running of other filters and execute the requested action
        $filterChain->run();
    }

    protected function createCompletionReview($completionDocument) {
        $completionReview = new CompletionReview;
        if (isset($_POST['CompletionReview'])) {
            $completionReview->attributes = $_POST['CompletionReview'];
            $completionReview->user_id = Yii::app()->user->id;
            if ($completionDocument->addCompletionReview($completionReview)) {
                Yii::app()->user->setFlash('completionReviewSubmitted', "Your completionReview has been added.");
                $this->refresh();
            }
        }
        return $completionReview;
    }

    protected function changeStatus($id) {
        if (isset($_POST['status'])) {
            $model = $this->loadModel($id);
            $status = $model->getStatusValue($_POST['status']);
            if ($model->changeStatus($status)) {
                Yii::app()->user->setFlash('completionDocumentChangeStatus', "Proposal Status has been changed.");
                $this->refresh();
            }
        }
    }

}
