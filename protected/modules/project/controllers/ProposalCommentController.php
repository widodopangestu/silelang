<?php

class ProposalCommentController extends Controller {

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
            'proposalContext + create index admin', //check to ensure valid proposal context
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
        $model = new ProposalComment;
        $model->proposal_id = $this->_proposal->id;

        // UnproposalComment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['ProposalComment'])) {
            $model->attributes = $_POST['ProposalComment'];
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

        // UnproposalComment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['ProposalComment'])) {
            $model->attributes = $_POST['ProposalComment'];
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
        $dataProvider = new CActiveDataProvider('ProposalComment', array(
                    'criteria' => array(
                        'condition' => 'proposal_id=:proposalId',
                        'params' => array(':proposalId' => $this->_proposal->id)
                    ),
                ));
        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'proposal' => $this->_proposal,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new ProposalComment('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ProposalComment']))
            $model->attributes = $_GET['ProposalComment'];

        $model->proposal_id = $this->_proposal->id;
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
        $model = ProposalComment::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'proposal-proposalComment-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * @var private property containing the associated Proposal model
      instance.
     */
    private $_proposal = null;

    /**
     * Protected method to load the associated proposal model class
     * @proposal_id the primary identifier of the associated proposal
     * @return object the proposal data model based on the primary key
     */
    protected function loadProposal($proposal_id) {
        //if the proposal property is null, create it based on input id
        if ($this->_proposal === null) {
            $this->_proposal = Proposal::model()->findbyPk($proposal_id);
            if ($this->_proposal === null) {
                throw new CHttpException(404, 'The requested Proposal does not exist.');
            }
        }
        return $this->_proposal;
    }

    /**
     * In-class defined filter method, configured for use in the above
      filters() method
     * It is called before the actionCreate() action method is run in
      order to ensure a proper proposal context
     */
    public function filterProposalContext($filterChain) {
        //set the proposal identifier based on either the GET or POST input
        //request variables, since we allow both types for our actions
        $proposalId = null;
        if (isset($_GET['pid']))
            $proposalId = $_GET['pid'];
        else if (isset($_POST['pid']))
            $proposalId = $_POST['pid'];
        $this->loadProposal($proposalId);
        //complete the running of other filters and execute the requested action
        $filterChain->run();
    }

}
