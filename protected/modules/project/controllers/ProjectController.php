<?php

class ProjectController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    public $defaultAction = 'Chart';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'rights',
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->changeStatus($id);
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Project;


        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Project'])) {
            $model->attributes = $_POST['Project'];
            $model->user_id = Yii::app()->user->id;
            $user = User::model()->findByPk(Yii::app()->user->id);
            $model->departement_id = $user->departement_id;
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

        if (isset($_POST['Project'])) {
            $model->attributes = $_POST['Project'];
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
        $dataProvider = new CActiveDataProvider('Project');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Project('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Project']))
            $model->attributes = $_GET['Project'];

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
        $model = Project::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'project-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    protected function changeStatus($id) {
        if (isset($_POST['status'])) {
            $model = $this->loadModel($id);
            $status = $model->getStatusValue($_POST['status']);
            if ($model->changeStatus($status)) {
                Yii::app()->user->setFlash('projectChangeStatus', "Project Status has been changed.");
                $this->refresh();
            }
        }
    }

    /**
     * Lists all models.
     */
    public function actionChart() {
        $tahun = date('Y');
        $dataProvider = new CActiveDataProvider('Project');
        if (isset($_POST['tahun'])) {
            $tahun = $_POST['tahun'];
        }
        $this->render('chart', array(
            'dataProvider' => $dataProvider,
            'tahun' => $tahun,
        ));
    }

    public function getTahun() {
        $tahun = date('Y');
        $data = array();
        for ($i = 0; $i < 10; $i++) {
            $data[$tahun - $i] = $tahun - $i;
        }
        return $data;
    }

    public function getStartProjectByMonth($month, $year) {
        $sql = "SELECT (SELECT COUNT(id) FROM project AS p
WHERE MONTH(p.start_date) = $month AND YEAR(p.start_date) = $year) AS start_date_count, (SELECT COUNT(id) FROM project AS p
WHERE MONTH(p.actual_start_date) = $month AND YEAR(p.actual_start_date) = $year) AS actual_start_date_count FROM project";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $results = $command->queryAll();
        return $results[0];
    }

    public function getEndProjectByMonth($month, $year) {
        $sql = "SELECT (SELECT COUNT(id) FROM project AS p
WHERE MONTH(p.end_date) = $month AND YEAR(p.end_date) = $year) AS end_date_count, (SELECT COUNT(id) FROM project AS p
WHERE MONTH(p.actual_end_date) = $month AND YEAR(p.actual_end_date) = $year) AS actual_end_date_count FROM project";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $results = $command->queryAll();
        return $results[0];
    }
    
}
