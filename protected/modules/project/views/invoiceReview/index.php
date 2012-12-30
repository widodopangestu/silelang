<?php
$this->breadcrumbs=array(
	'Invoice Reviews',
);

$this->menu=array(
	array('label'=>'Create InvoiceReview', 'url'=>array('create', 'pid' => $invoiceDocument->id)),
	array('label'=>'Manage InvoiceReview', 'url'=>array('admin', 'pid' => $invoiceDocument->id)),
);
?>

<h1>Invoice Reviews</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
