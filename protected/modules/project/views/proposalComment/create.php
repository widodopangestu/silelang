<?php
$this->breadcrumbs=array(
	'Proposal Comments'=>array('index', 'pid' => $model->proposal->id),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProposalComment', 'url'=>array('index', 'pid' => $model->proposal->id)),
	array('label'=>'Manage ProposalComment', 'url'=>array('admin', 'pid' => $model->proposal->id)),
);
?>

<h1>Create ProposalComment</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>