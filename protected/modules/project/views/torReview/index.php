<?php
$this->breadcrumbs=array(
	'Tor Reviews',
);

$this->menu=array(
	array('label'=>'Create TorReview', 'url'=>array('create', 'pid' => $torDocument->id)),
	array('label'=>'Manage TorReview', 'url'=>array('admin', 'pid' => $torDocument->id)),
);
?>

<h1>Tor Reviews</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
