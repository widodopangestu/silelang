<?php
$this->breadcrumbs=array(
	'Departements',
);

$this->menu=array(
	array('label'=>'Create Departement', 'url'=>array('create')),
	array('label'=>'Manage Departement', 'url'=>array('admin')),
);
?>

<h1>Departements</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
