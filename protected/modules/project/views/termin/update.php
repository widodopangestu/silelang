<?php
$this->breadcrumbs=array(
	'Termins'=>array('index', 'pid' => $model->project->id),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Termin', 'url'=>array('index', 'pid' => $model->project->id)),
	array('label'=>'Create Termin', 'url'=>array('create', 'pid' => $model->project->id)),
	array('label'=>'View Termin', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Termin', 'url'=>array('admin', 'pid' => $model->project->id)),
);
?>

<h1>Update Termin <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>