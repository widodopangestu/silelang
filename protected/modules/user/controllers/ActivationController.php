<?php

class ActivationController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to 'column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';
    public $defaultAction = 'activation';

    /**
     * Activation user account
     */
    public function actionActivation() {
        $email = $_GET['email'];
        $activkey = $_GET['activkey'];
        if ($email && $activkey) {
            $find = User::model()->notsafe()->findByAttributes(array('email' => $email));
            if (isset($find) && $find->status) {
                $this->render('/user/message', array('title' => UserModule::t("User activation"), 'content' => UserModule::t("You account is active.")));
            } elseif (isset($find->activkey) && ($find->activkey == $activkey)) {
                $find->activkey = UserModule::encrypting(microtime());
                $find->status = 1;
                $find->save();
                $this->render('/user/message', array('title' => UserModule::t("User activation"), 'content' => UserModule::t("You account is activated.")));
            } else {
                $this->render('/user/message', array('title' => UserModule::t("User activation"), 'content' => UserModule::t("Incorrect activation URL.")));
            }
        } else {
            $this->render('/user/message', array('title' => UserModule::t("User activation"), 'content' => UserModule::t("Incorrect activation URL.")));
        }
    }

}