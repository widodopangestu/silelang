<?php
$this->breadcrumbs=array(
	'Invoice Documents',
);

$this->menu=array(
	array('label'=>'Create InvoiceDocument', 'url'=>array('create', 'pid' => $termin->id)),
	array('label'=>'Manage InvoiceDocument', 'url'=>array('admin', 'pid' => $termin->id)),
);
?>

<h1>Invoice Documents</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
