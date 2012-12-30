<?php
$this->breadcrumbs=array(
	'Tor Reviews'=>array('index', 'pid' => $model->torDocument->id),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TorReview', 'url'=>array('index', 'pid' => $model->torDocument->id)),
	array('label'=>'Create TorReview', 'url'=>array('create', 'pid' => $model->torDocument->id)),
	array('label'=>'View TorReview', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TorReview', 'url'=>array('admin', 'pid' => $model->torDocument->id)),
);
?>

<h1>Update TorReview <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>