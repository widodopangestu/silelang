<?php
$this->breadcrumbs=array(
	'Payment Documents'=>array('index', 'pid' => $model->termin->id),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PaymentDocument', 'url'=>array('index', 'pid' => $model->termin->id)),
	array('label'=>'Create PaymentDocument', 'url'=>array('create', 'pid' => $model->termin->id)),
	array('label'=>'View PaymentDocument', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PaymentDocument', 'url'=>array('admin', 'pid' => $model->termin->id)),
);
?>

<h1>Update PaymentDocument <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>