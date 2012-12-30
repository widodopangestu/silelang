<?php
$this->breadcrumbs=array(
	'Invoice Documents'=>array('index', 'pid' => $model->termin->id),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List InvoiceDocument', 'url'=>array('index', 'pid' => $model->termin->id)),
	array('label'=>'Create InvoiceDocument', 'url'=>array('create', 'pid' => $model->termin->id)),
	array('label'=>'View InvoiceDocument', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage InvoiceDocument', 'url'=>array('admin', 'pid' => $model->termin->id)),
);
?>

<h1>Update InvoiceDocument <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>