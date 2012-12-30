<?php
$this->breadcrumbs=array(
	'Majors',
);

$this->menu=array(
	array('label'=>'Create Major', 'url'=>array('create')),
	array('label'=>'Manage Major', 'url'=>array('admin')),
);
?>

<h1>Majors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
