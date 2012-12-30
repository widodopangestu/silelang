<?php
$this->breadcrumbs=array(
	'Tor Reviews'=>array('index', 'pid' => $model->torDocument->id),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TorReview', 'url'=>array('index', 'pid' => $model->torDocument->id)),
	array('label'=>'Create TorReview', 'url'=>array('create', 'pid' => $model->torDocument->id)),
	array('label'=>'Update TorReview', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TorReview', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TorReview', 'url'=>array('admin', 'pid' => $model->torDocument->id)),
);
?>

<h1>View TorReview #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'review',
		'created',
		'updated',
		'tor_document_id',
	),
)); ?>
