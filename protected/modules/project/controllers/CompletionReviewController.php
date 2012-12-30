<?php

class CompletionReviewController extends Controller {

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
            'completionDocumentContext + create index admin', //check to ensure valid completionDocument context
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new CompletionReview;
        $model->completionDocument_id = $this->_completionDocument->id;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['CompletionReview'])) {
            $model->attributes = $_POST['CompletionReview'];
            $model->user_id = Yii::app()->user->id;
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

        if (isset($_POST['CompletionReview'])) {
            $model->attributes = $_POST['CompletionReview'];
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
        $dataProvider = new CActiveDataProvider('CompletionReview', array(
                    'criteria' => array(
                        'condition' => 'completionDocument_id=:completionDocumentId',
                        'params' => array(':completionDocumentId' => $this->_completionDocument->id)
                    ),
                ));
        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'completionDocument' => $this->_completionDocument,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new CompletionReview('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['CompletionReview']))
            $model->attributes = $_GET['CompletionReview'];

        $model->completionDocument_id = $this->_completionDocument->id;
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
        $model = CompletionReview::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'completion-review-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * @var private property containing the associated CompletionDocument model
      instance.
     */
    private $_completionDocument = null;

    /**
     * Protected method to load the associated completionDocument model class
     * @completionDocument_id the primary identifier of the associated completionDocument
     * @return object the completionDocument data model based on the primary key
     */
    protected function loadCompletionDocument($completionDocument_id) {
        //if the completionDocument property is null, create it based on input id
        if ($this->_completionDocument === null) {
            $this->_completionDocument = CompletionDocument::model()->findbyPk($completionDocument_id);
            if ($this->_completionDocument === null) {
                throw new CHttpException(404, 'The requested CompletionDocument does not exist.');
            }
        }
        return $this->_completionDocument;
    }

    /**
     * In-class defined filter method, configured for use in the above
      filters() method
     * It is called before the actionCreate() action method is run in
      order to ensure a proper completionDocument context
     */
    public function filterCompletionDocumentContext($filterChain) {
        //set the completionDocument identifier based on either the GET or POST input
        //request variables, since we allow both types for our actions
        $completionDocumentId = null;
        if (isset($_GET['pid']))
            $completionDocumentId = $_GET['pid'];
        else if (isset($_POST['pid']))
            $completionDocumentId = $_POST['pid'];
        $this->loadCompletionDocument($completionDocumentId);
        //complete the running of other filters and execute the requested action
        $filterChain->run();
    }

}
