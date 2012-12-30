<?php
/* @var $this NotificationTemplateController */
/* @var $model NotificationTemplate */

$this->breadcrumbs=array(
	'Notification Templates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List NotificationTemplate', 'url'=>array('index')),
	array('label'=>'Manage NotificationTemplate', 'url'=>array('admin')),
);
?>

<h1>Create NotificationTemplate</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>