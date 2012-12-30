<?php
$this->breadcrumbs=array(
	'Completion Documents',
);

$this->menu=array(
	array('label'=>'Create CompletionDocument', 'url'=>array('create', 'pid' => $milestone->id)),
	array('label'=>'Manage CompletionDocument', 'url'=>array('admin', 'pid' => $milestone->id)),
);
?>

<h1>Completion Documents</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
