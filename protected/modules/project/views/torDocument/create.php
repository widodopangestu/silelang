<?php
$this->breadcrumbs=array(
	'Tor Documents'=>array('index', 'pid' => $model->project->id),
	'Create',
);

$this->menu=array(
	array('label'=>'List TorDocument', 'url'=>array('index', 'pid' => $model->project->id)),
	array('label'=>'Manage TorDocument', 'url'=>array('admin', 'pid' => $model->project->id)),
);
?>

<h1>Create TorDocument</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>