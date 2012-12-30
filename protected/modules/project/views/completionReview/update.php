<?php
$this->breadcrumbs=array(
	'Completion Reviews'=>array('index', 'pid' => $model->completionDocument->id),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CompletionReview', 'url'=>array('index', 'pid' => $model->completionDocument->id)),
	array('label'=>'Create CompletionReview', 'url'=>array('create', 'pid' => $model->completionDocument->id)),
	array('label'=>'View CompletionReview', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CompletionReview', 'url'=>array('admin', 'pid' => $model->completionDocument->id)),
);
?>

<h1>Update CompletionReview <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>