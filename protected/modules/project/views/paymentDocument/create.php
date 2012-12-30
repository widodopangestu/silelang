<?php
$this->breadcrumbs=array(
	'Payment Documents'=>array('index', 'pid' => $model->termin->id),
	'Create',
);

$this->menu=array(
	array('label'=>'List PaymentDocument', 'url'=>array('index', 'pid' => $model->termin->id)),
	array('label'=>'Manage PaymentDocument', 'url'=>array('admin', 'pid' => $model->termin->id)),
);
?>

<h1>Create PaymentDocument</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>