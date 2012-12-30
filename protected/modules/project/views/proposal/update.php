<?php
$this->breadcrumbs = array(
    'Proposals' => array('index', 'pid' => $model->project->id),
    $model->name => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'List Proposal', 'url' => array('index', 'pid' => $model->project->id)),
    array('label' => 'Create Proposal', 'url' => array('create', 'pid' => $model->project->id)),
    array('label' => 'View Proposal', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Manage Proposal', 'url' => array('admin', 'pid' => $model->project->id)),
);
?>

<h1>Update Proposal <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>