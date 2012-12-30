<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css"
              href="<?php echo Yii::app()->baseUrl; ?>/css/screen.css"
              media="screen, projection" />
        <link rel="stylesheet" type="text/css"
              href="<?php echo Yii::app()->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
                <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/ie.css" media="screen, projection" />
                <![endif]-->

        <link rel="stylesheet" type="text/css"
              href="<?php echo Yii::app()->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css"
              href="<?php echo Yii::app()->baseUrl; ?>/css/form.css" />
        <link rel="stylesheet" type="text/css"
              href="<?php echo Yii::app()->baseUrl; ?>/css/buttons.css" />
        <link rel="stylesheet" type="text/css"
              href="<?php echo Yii::app()->baseUrl; ?>/css/icons.css" />
        <link rel="stylesheet" type="text/css"
              href="<?php echo Yii::app()->baseUrl; ?>/css/tables.css" />
        <link rel="stylesheet" type="text/css"
              href="<?php echo Yii::app()->baseUrl; ?>/css/jquery.css" />

        <link rel="stylesheet" type="text/css"
              href="<?php echo Yii::app()->baseUrl; ?>/css/mbmenu.css" />
        <link rel="stylesheet" type="text/css"
              href="<?php echo Yii::app()->baseUrl; ?>/css/mbmenu_iestyles.css" />


        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <script type="text/javascript">
 
            $(document).ready(function(){
 
                $(".notif_content").hide();
                $(".show_hide").show();
 
                $('.show_hide').click(function(){
                    $(".notif_content").slideToggle();
                });
 
            });
 
        </script>
    </head>

    <body>

        <div class="container" id="page">
            <div id="topnav">
                <div class="topnav_text">
                    <?php
                    echo CHtml::link('Home', array('/site/index'));
                    echo ' | ';
                    echo CHtml::link('About', array('/site/page', 'view' => 'about'));
                    echo ' | ';
                    echo CHtml::link('Contact', array('/site/contact'));
                    echo ' | ';
                    if (Yii::app()->user->isGuest) {
                        echo CHtml::link(Yii::app()->getModule('user')->t("Login"), Yii::app()->getModule('user')->loginUrl);
                        echo ' | ';
                        echo CHtml::link(Yii::app()->getModule('user')->t("Register"), Yii::app()->getModule('user')->registrationUrl);
                    } else {
                        echo CHtml::link(Yii::app()->getModule('user')->t("Profile"), Yii::app()->getModule('user')->profileUrl);
                        echo ' | ';
                        echo CHtml::link(Yii::app()->getModule('user')->t("Logout") . ' (' . Yii::app()->user->name . ')', Yii::app()->getModule('user')->logoutUrl);
                        echo ' | ';
                        echo CHtml::link('Notification(3)', '#', array('class' => 'show_hide'));
                    }
                    ?>
                    <?php
                    $notifiche = ModelNotifyii::getAllNotifications();
                    ?>
                    <div class="notif_content">                        
                        <?php foreach ($notifiche as $notifica) : ?>
                            <?php if ($notifica->isNotReaded()) : ?>
                                <div class="notif_item">
                                    <a href="<?php echo $notifica->link; ?>"><?php echo $notifica->content; ?></a> - 
                                    <a href="<?php echo $this->createUrl('/notifyii/default/read', array('id' => $notifica->id)); ?>">read</a>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <div class="notif_item">
                            <?php echo CHtml::link('See All Notification', array('/notifyii/modelNotifyii/aggregate'), array('class' => 'show_hide')); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div id="header">
                <div id="logo">
                    <?php echo CHtml::encode(Yii::app()->name); ?>
                </div>
            </div>
            <!-- header -->
            <div id="mainMbMenu">
                <?php
                $this->widget('ext.mbmenu.MbMenu', array(
                    'items' => array(
                        array(
                            'label' => 'Project',
                            'url' => array('/project/project/admin'),
                            'visible' => !Yii::app()->user->isGuest,
                            'itemOptions' => array('class' => 'first'),
                        //                            'image' => Yii::app()->request->baseUrl . '/images/icon-asset.png'
                        ),
                        array(
                            'label' => 'Master',
                            'visible' => !Yii::app()->user->isGuest,
                            //                            'image' => Yii::app()->request->baseUrl . '/images/icon-administration.png',
                            'items' => array(
                                array(
                                    'label' => 'Organization',
                                    'url' => array('/project/organization/admin'),
                                    //                                    'image' => Yii::app()->request->baseUrl . '/images/icon-administration.png',
                                    'visible' => !Yii::app()->user->isGuest,
                                ),
                                array(
                                    'label' => 'Department',
                                    'url' => array('/project/departement/admin'),
//                                    'image' => Yii::app()->request->baseUrl . '/images/icon-administration.png',
                                    'visible' => !Yii::app()->user->isGuest,
                                ),
                                array(
                                    'label' => 'Major',
                                    'url' => array('/project/major/admin'),
//                                    'image' => Yii::app()->request->baseUrl . '/images/icon-administration.png',
                                    'visible' => !Yii::app()->user->isGuest,
                                ),
                                array(
                                    'label' => 'Notification Template',
                                    'url' => array('/project/notificationTemplate/admin'),
                                    'visible' => !Yii::app()->user->isGuest,
                                ),
                            ),
                        ),
                        array(
                            'label' => 'Admin',
                            'visible' => !Yii::app()->user->isGuest,
                            'items' => array(
                                array(
                                    'label' => 'Rights',
                                    'url' => array('/rights'),
                                    'visible' => Yii::app()->user->checkAccess(Rights::module()->superuserName)
                                ),
                                array(
                                    'label' => 'User',
                                    'url' => array('/user/admin'),
                                    'visible' => !Yii::app()->user->isGuest,
                                ),
                            ),
                        ),
                    ),
                ));
                ?>
            </div>
            <!--mainmenu -->
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?>
                <!-- breadcrumbs -->
            <?php endif ?>

            <?php echo $content; ?>

            <div id="footer">
                <?php echo Yii::app()->params['copyrightInfo']; ?>
                <br /> All Rights Reserved.<br />
                <?php echo Yii::powered(); ?>
            </div>
            <!-- footer -->

        </div>
        <!-- page -->

    </body>
</html>
