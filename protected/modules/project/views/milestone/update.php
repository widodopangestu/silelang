<?php
$this->breadcrumbs=array(
	'Milestones'=>array('index', 'pid' => $model->project->id),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Milestone', 'url'=>array('index', 'pid' => $model->project->id)),
	array('label'=>'Create Milestone', 'url'=>array('create', 'pid' => $model->project->id)),
	array('label'=>'View Milestone', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Milestone', 'url'=>array('admin', 'pid' => $model->project->id)),
);
?>

<h1>Update Milestone <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>