<?php
$this->breadcrumbs=array(
	'Milestones',
);

$this->menu=array(
	array('label'=>'Create Milestone', 'url'=>array('create', 'pid' => $project->id)),
	array('label'=>'Manage Milestone', 'url'=>array('admin', 'pid' => $project->id)),
);
?>

<h1>Milestones</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
