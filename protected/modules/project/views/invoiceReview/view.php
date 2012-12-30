<?php
$this->breadcrumbs=array(
	'Invoice Reviews'=>array('index', 'pid' => $model->invoiceDocument->id),
	$model->id,
);

$this->menu=array(
	array('label'=>'List InvoiceReview', 'url'=>array('index', 'pid' => $model->invoiceDocument->id)),
	array('label'=>'Create InvoiceReview', 'url'=>array('create', 'pid' => $model->invoiceDocument->id)),
	array('label'=>'Update InvoiceReview', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete InvoiceReview', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage InvoiceReview', 'url'=>array('admin', 'pid' => $model->invoiceDocument->id)),
);
?>

<h1>View InvoiceReview #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'review',
		'created',
		'updated',
		'invoice_document_id',
		'user_id',
	),
)); ?>
