<?php
$this->breadcrumbs=array(
	'Payment Documents',
);

$this->menu=array(
	array('label'=>'Create PaymentDocument', 'url'=>array('create', 'pid' => $termin->id)),
	array('label'=>'Manage PaymentDocument', 'url'=>array('admin', 'pid' => $termin->id)),
);
?>

<h1>Payment Documents</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
