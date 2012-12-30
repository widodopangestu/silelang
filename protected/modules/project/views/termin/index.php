<?php
$this->breadcrumbs=array(
	'Termins',
);

$this->menu=array(
	array('label'=>'Create Termin', 'url'=>array('create', 'pid' => $project->id)),
	array('label'=>'Manage Termin', 'url'=>array('admin', 'pid' => $project->id)),
);
?>

<h1>Termins</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
