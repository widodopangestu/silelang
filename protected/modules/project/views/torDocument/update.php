<?php
$this->breadcrumbs=array(
	'Tor Documents'=>array('index', 'pid' => $model->project->id),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TorDocument', 'url'=>array('index', 'pid' => $model->project->id)),
	array('label'=>'Create TorDocument', 'url'=>array('create', 'pid' => $model->project->id)),
	array('label'=>'View TorDocument', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TorDocument', 'url'=>array('admin', 'pid' => $model->project->id)),
);
?>

<h1>Update TorDocument <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>