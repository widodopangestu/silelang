<?php
/* @var $this NotificationTemplateController */
/* @var $model NotificationTemplate */

$this->breadcrumbs=array(
	'Notification Templates'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List NotificationTemplate', 'url'=>array('index')),
	array('label'=>'Create NotificationTemplate', 'url'=>array('create')),
	array('label'=>'View NotificationTemplate', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage NotificationTemplate', 'url'=>array('admin')),
);
?>

<h1>Update NotificationTemplate <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>