<?php
/* @var $this NotificationTemplateController */
/* @var $model NotificationTemplate */

$this->breadcrumbs=array(
	'Notification Templates'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List NotificationTemplate', 'url'=>array('index')),
	array('label'=>'Create NotificationTemplate', 'url'=>array('create')),
	array('label'=>'Update NotificationTemplate', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete NotificationTemplate', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage NotificationTemplate', 'url'=>array('admin')),
);
?>

<h1>View NotificationTemplate #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'template',
		'is_email',
		'created',
		'updated',
	),
)); ?>
