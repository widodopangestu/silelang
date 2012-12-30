<?php
$this->breadcrumbs=array(
	'Invoice Reviews'=>array('index', 'pid' => $model->invoiceDocument->id),
	'Create',
);

$this->menu=array(
	array('label'=>'List InvoiceReview', 'url'=>array('index', 'pid' => $model->invoiceDocument->id)),
	array('label'=>'Manage InvoiceReview', 'url'=>array('admin', 'pid' => $model->invoiceDocument->id)),
);
?>

<h1>Create InvoiceReview</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>