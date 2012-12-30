<?php

class DefaultController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to 'column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('User', array(
                    'criteria' => array(
                        'condition' => 'status>' . User::STATUS_BANNED,
                    ),
                    'pagination' => array(
                        'pageSize' => Yii::app()->controller->module->user_page_size,
                    ),
                ));

        $this->render('/user/index', array(
            'dataProvider' => $dataProvider,
        ));
    }

}