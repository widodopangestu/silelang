<?php
$this->breadcrumbs=array(
	'Tor Reviews'=>array('index', 'pid' => $model->torDocument->id),
	'Create',
);

$this->menu=array(
	array('label'=>'List TorReview', 'url'=>array('index', 'pid' => $model->torDocument->id)),
	array('label'=>'Manage TorReview', 'url'=>array('admin', 'pid' => $model->torDocument->id)),
);
?>

<h1>Create TorReview</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>