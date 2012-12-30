<?php
$this->breadcrumbs = array(
    'Proposals',
);

$this->menu = array(
    array('label' => 'Create Proposal', 'url' => array('create', 'pid' => $project->id)),
    array('label' => 'Manage Proposal', 'url' => array('admin', 'pid' => $project->id)),
);
?>

<h1>Proposals</h1>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
