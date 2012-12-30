<?php
$this->breadcrumbs = array(
    'Proposals' => array('index', 'pid' => $model->project->id),
    'Create',
);

$this->menu = array(
    array('label' => 'List Proposal', 'url' => array('index', 'pid' => $model->project->id)),
    array('label' => 'Manage Proposal', 'url' => array('admin', 'pid' => $model->project->id)),
);
?>

<h1>Create Proposal</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>