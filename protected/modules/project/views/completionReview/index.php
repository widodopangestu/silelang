<?php
$this->breadcrumbs=array(
	'Completion Reviews',
);

$this->menu=array(
	array('label'=>'Create CompletionReview', 'url'=>array('create', 'pid' => $completionDocument->id)),
	array('label'=>'Manage CompletionReview', 'url'=>array('admin', 'pid' => $completionDocument->id)),
);
?>

<h1>Completion Reviews</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
