<?php
$this->breadcrumbs=array(
	'Proposal Comments'=>array('index', 'pid' => $model->proposal->id),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProposalComment', 'url'=>array('index', 'pid' => $model->proposal->id)),
	array('label'=>'Create ProposalComment', 'url'=>array('create', 'pid' => $model->proposal->id)),
	array('label'=>'View ProposalComment', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ProposalComment', 'url'=>array('admin', 'pid' => $model->proposal->id)),
);
?>

<h1>Update ProposalComment <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>