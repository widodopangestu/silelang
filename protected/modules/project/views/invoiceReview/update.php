<?php
$this->breadcrumbs=array(
	'Invoice Reviews'=>array('index', 'pid' => $model->invoiceDocument->id),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List InvoiceReview', 'url'=>array('index', 'pid' => $model->invoiceDocument->id)),
	array('label'=>'Create InvoiceReview', 'url'=>array('create', 'pid' => $model->invoiceDocument->id)),
	array('label'=>'View InvoiceReview', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage InvoiceReview', 'url'=>array('admin', 'pid' => $model->invoiceDocument->id)),
);
?>

<h1>Update InvoiceReview <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>