<?php

class InvoiceReviewController extends Controller {

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
            'invoiceDocumentContext + create index admin', //check to ensure valid invoiceDocument context
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
        $model = new InvoiceReview;
        $model->invoiceDocument_id = $this->_invoiceDocument->id;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['InvoiceReview'])) {
            $model->attributes = $_POST['InvoiceReview'];
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

        if (isset($_POST['InvoiceReview'])) {
            $model->attributes = $_POST['InvoiceReview'];
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
        $dataProvider = new CActiveDataProvider('InvoiceReview', array(
                    'criteria' => array(
                        'condition' => 'invoiceDocument_id=:invoiceDocumentId',
                        'params' => array(':invoiceDocumentId' => $this->_invoiceDocument->id)
                    ),
                ));
        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'invoiceDocument' => $this->_invoiceDocument,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new InvoiceReview('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['InvoiceReview']))
            $model->attributes = $_GET['InvoiceReview'];

        $model->invoiceDocument_id = $this->_invoiceDocument->id;
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
        $model = InvoiceReview::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'invoice-review-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * @var private property containing the associated InvoiceDocument model
      instance.
     */
    private $_invoiceDocument = null;

    /**
     * Protected method to load the associated invoiceDocument model class
     * @invoiceDocument_id the primary identifier of the associated invoiceDocument
     * @return object the invoiceDocument data model based on the primary key
     */
    protected function loadInvoiceDocument($invoiceDocument_id) {
        //if the invoiceDocument property is null, create it based on input id
        if ($this->_invoiceDocument === null) {
            $this->_invoiceDocument = InvoiceDocument::model()->findbyPk($invoiceDocument_id);
            if ($this->_invoiceDocument === null) {
                throw new CHttpException(404, 'The requested InvoiceDocument does not exist.');
            }
        }
        return $this->_invoiceDocument;
    }

    /**
     * In-class defined filter method, configured for use in the above
      filters() method
     * It is called before the actionCreate() action method is run in
      order to ensure a proper invoiceDocument context
     */
    public function filterInvoiceDocumentContext($filterChain) {
        //set the invoiceDocument identifier based on either the GET or POST input
        //request variables, since we allow both types for our actions
        $invoiceDocumentId = null;
        if (isset($_GET['pid']))
            $invoiceDocumentId = $_GET['pid'];
        else if (isset($_POST['pid']))
            $invoiceDocumentId = $_POST['pid'];
        $this->loadInvoiceDocument($invoiceDocumentId);
        //complete the running of other filters and execute the requested action
        $filterChain->run();
    }

}
