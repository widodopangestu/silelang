<?php
$this->breadcrumbs=array(
	'Completion Reviews'=>array('index', 'pid' => $model->completionDocument->id),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CompletionReview', 'url'=>array('index', 'pid' => $model->completionDocument->id)),
	array('label'=>'Create CompletionReview', 'url'=>array('create', 'pid' => $model->completionDocument->id)),
	array('label'=>'Update CompletionReview', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CompletionReview', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CompletionReview', 'url'=>array('admin', 'pid' => $model->completionDocument->id)),
);
?>

<h1>View CompletionReview #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'review',
		'created',
		'updated',
		'completion_document_id',
	),
)); ?>
