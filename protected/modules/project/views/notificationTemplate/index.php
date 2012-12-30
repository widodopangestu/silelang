<?php
/* @var $this NotificationTemplateController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Notification Templates',
);

$this->menu=array(
	array('label'=>'Create NotificationTemplate', 'url'=>array('create')),
	array('label'=>'Manage NotificationTemplate', 'url'=>array('admin')),
);
?>

<h1>Notification Templates</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
