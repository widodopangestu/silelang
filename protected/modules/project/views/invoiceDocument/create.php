<?php
$this->breadcrumbs=array(
	'Invoice Documents'=>array('index', 'pid' => $model->termin->id),
	'Create',
);

$this->menu=array(
	array('label'=>'List InvoiceDocument', 'url'=>array('index', 'pid' => $model->termin->id)),
	array('label'=>'Manage InvoiceDocument', 'url'=>array('admin', 'pid' => $model->termin->id)),
);
?>

<h1>Create InvoiceDocument</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>