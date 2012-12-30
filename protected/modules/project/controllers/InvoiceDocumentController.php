<?php

class InvoiceDocumentController extends Controller {

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
            'terminContext + create index admin', //check to ensure valid termin context
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $invoiceDocument = $this->loadModel($id);
        $invoiceReview = $this->createInvoiceReview($invoiceDocument);
        $this->changeStatus($id);
        $this->render('view', array(
            'model' => $invoiceDocument,
            'invoiceReview' => $invoiceReview,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new InvoiceDocument;
        $model->termin_id = $this->_termin->id;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['InvoiceDocument'])) {
            $model->attributes = $_POST['InvoiceDocument'];
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

        if (isset($_POST['InvoiceDocument'])) {
            $model->attributes = $_POST['InvoiceDocument'];
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
        $dataProvider = new CActiveDataProvider('InvoiceDocument', array(
                    'criteria' => array(
                        'condition' => 'termin_id=:terminId',
                        'params' => array(':terminId' => $this->_termin->id)
                    ),
                ));
        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'termin' => $this->_termin,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new InvoiceDocument('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['InvoiceDocument']))
            $model->attributes = $_GET['InvoiceDocument'];

        $model->termin_id = $this->_termin->id;
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
        $model = InvoiceDocument::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'invoice-document-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * @var private property containing the associated Termin model
      instance.
     */
    private $_termin = null;

    /**
     * Protected method to load the associated termin model class
     * @termin_id the primary identifier of the associated termin
     * @return object the termin data model based on the primary key
     */
    protected function loadTermin($termin_id) {
        //if the termin property is null, create it based on input id
        if ($this->_termin === null) {
            $this->_termin = Termin::model()->findbyPk($termin_id);
            if ($this->_termin === null) {
                throw new CHttpException(404, 'The requested Kabuaten does not exist.');
            }
        }
        return $this->_termin;
    }

    /**
     * In-class defined filter method, configured for use in the above
      filters() method
     * It is called before the actionCreate() action method is run in
      order to ensure a proper termin context
     */
    public function filterTerminContext($filterChain) {
        //set the termin identifier based on either the GET or POST input
        //request variables, since we allow both types for our actions
        $terminId = null;
        if (isset($_GET['pid']))
            $terminId = $_GET['pid'];
        else if (isset($_POST['pid']))
            $terminId = $_POST['pid'];
        $this->loadTermin($terminId);
        //complete the running of other filters and execute the requested action
        $filterChain->run();
    }

    protected function createInvoiceReview($invoiceDocument) {
        $invoiceReview = new InvoiceReview;
        if (isset($_POST['InvoiceReview'])) {
            $invoiceReview->attributes = $_POST['InvoiceReview'];
            $invoiceReview->user_id = Yii::app()->user->id;
            if ($invoiceDocument->addInvoiceReview($invoiceReview)) {
                Yii::app()->user->setFlash('invoiceReviewSubmitted', "Your invoiceReview has been added.");
                $this->refresh();
            }
        }
        return $invoiceReview;
    }

    protected function changeStatus($id) {
        if (isset($_POST['status'])) {
            $model = $this->loadModel($id);
            $status = $model->getStatusValue($_POST['status']);
            if ($model->changeStatus($status)) {
                Yii::app()->user->setFlash('invoiceDocumentChangeStatus', "Proposal Status has been changed.");
                $this->refresh();
            }
        }
    }

}
