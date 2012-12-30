<?php
$this->breadcrumbs=array(
	'Proposal Comments'=>array('index', 'pid' => $model->proposal->id),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ProposalComment', 'url'=>array('index', 'pid' => $model->proposal->id)),
	array('label'=>'Create ProposalComment', 'url'=>array('create', 'pid' => $model->proposal->id)),
	array('label'=>'Update ProposalComment', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ProposalComment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProposalComment', 'url'=>array('admin', 'pid' => $model->proposal->id)),
);
?>

<h1>View ProposalComment #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'comment',
		'created',
		'updated',
		'proposal_id',
		'user_id',
	),
)); ?>
