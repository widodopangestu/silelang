<?php
$this->breadcrumbs=array(
	'Completion Documents'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CompletionDocument', 'url'=>array('index', 'pid' => $model->milestone->id)),
	array('label'=>'Create CompletionDocument', 'url'=>array('create', 'pid' => $model->milestone->id)),
	array('label'=>'View CompletionDocument', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CompletionDocument', 'url'=>array('admin', 'pid' => $model->milestone->id)),
);
?>

<h1>Update CompletionDocument <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>