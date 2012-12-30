<?php
$this->breadcrumbs=array(
	'Completion Documents'=>array('index', 'pid' => $model->milestone->id),
	'Create',
);

$this->menu=array(
	array('label'=>'List CompletionDocument', 'url'=>array('index', 'pid' => $model->milestone->id)),
	array('label'=>'Manage CompletionDocument', 'url'=>array('admin', 'pid' => $model->milestone->id)),
);
?>

<h1>Create CompletionDocument</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>