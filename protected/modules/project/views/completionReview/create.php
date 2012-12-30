<?php
$this->breadcrumbs=array(
	'Completion Reviews'=>array('index', 'pid' => $model->completionDocument->id),
	'Create',
);

$this->menu=array(
	array('label'=>'List CompletionReview', 'url'=>array('index', 'pid' => $model->completionDocument->id)),
	array('label'=>'Manage CompletionReview', 'url'=>array('admin', 'pid' => $model->completionDocument->id)),
);
?>

<h1>Create CompletionReview</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>