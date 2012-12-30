<?php
$this->breadcrumbs=array(
	'Tor Documents',
);

$this->menu=array(
	array('label'=>'Create TorDocument', 'url'=>array('create', 'pid' => $project->id)),
	array('label'=>'Manage TorDocument', 'url'=>array('admin', 'pid' => $project->id)),
);
?>

<h1>Tor Documents</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
