<?php
$this->breadcrumbs=array(
	'Termins'=>array('index', 'pid' => $model->project->id),
	'Create',
);

$this->menu=array(
	array('label'=>'List Termin', 'url'=>array('index', 'pid' => $model->project->id)),
	array('label'=>'Manage Termin', 'url'=>array('admin', 'pid' => $model->project->id)),
);
?>

<h1>Create Termin</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>