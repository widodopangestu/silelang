<?php
$this->breadcrumbs=array(
	'Milestones'=>array('index', 'pid' => $model->project->id),
	'Create',
);

$this->menu=array(
	array('label'=>'List Milestone', 'url'=>array('index', 'pid' => $model->project->id)),
	array('label'=>'Manage Milestone', 'url'=>array('admin', 'pid' => $model->project->id)),
);
?>

<h1>Create Milestone</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>