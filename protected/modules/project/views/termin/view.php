<?php
$this->breadcrumbs = array(
    'Termins' => array('index', 'pid' => $model->project->id),
    $model->id,
);

$this->menu = array(
    array('label' => 'List Termin', 'url' => array('index', 'pid' => $model->project->id)),
    array('label' => 'Create Termin', 'url' => array('create', 'pid' => $model->project->id)),
    array('label' => 'Update Termin', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Termin', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Termin', 'url' => array('admin', 'pid' => $model->project->id)),
    array('label' => 'Create Invoice Document', 'url' => array('invoiceDocument/create', 'pid' => $model->id)),
    array('label' => 'Create Payment Document', 'url' => array('paymentDocument/create', 'pid' => $model->id)),
);
?>

<h1>View Termin #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'project_id',
            'type' => 'raw',
            'value' => CHtml::link(CHtml::encode($model->project->name), array('project/view', 'id' => $model->project->id))
        ),
//        'id',
        'name',
        'percentage',
        'cost',
        'summary',
//        'created',
//        'updated',
//        'project_id',
    ),
));
?>

<?php
$this->widget('zii.widgets.jui.CJuiTabs', array(
    'tabs' => array(
        'Invoice Documents' => $this->renderPartial('_invoiceDocuments', array(
            'invoiceDocuments' => $model->invoiceDocuments,
                ), $this),
        'Payment Documents' => $this->renderPartial('_paymentDocuments', array(
            'paymentDocuments' => $model->paymentDocuments,
                ), $this),
    ),
    // additional javascript options for the tabs plugin
    'options' => array(
        'collapsible' => true,
    ),
    'htmlOptions' => array('class' => 'shadowtabs'),
));
?>