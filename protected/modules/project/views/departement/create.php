<?php
$this->breadcrumbs=array(
	'Departements'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Departement', 'url'=>array('index')),
	array('label'=>'Manage Departement', 'url'=>array('admin')),
);
?>

<h1>Create Departement</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>