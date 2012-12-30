<?php
$this->breadcrumbs = array(
    'Majors' => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => 'List Major', 'url' => array('index')),
    array('label' => 'Create Major', 'url' => array('create')),
    array('label' => 'Update Major', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Major', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Major', 'url' => array('admin')),
);
?>

<h1>View Major #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
//        'id',
        'name',
//        'created',
//        'updated',
    ),
));
?>
