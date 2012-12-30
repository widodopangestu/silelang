<?php
$this->breadcrumbs = array(
    'Projects' => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => 'List Project', 'url' => array('index')),
    array('label' => 'Create Project', 'url' => array('create')),
    array('label' => 'Update Project', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Project', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Project', 'url' => array('admin')),
    array('label' => 'Create Proposal', 'url' => array('proposal/create', 'pid' => $model->id)),
    array('label' => 'Create Tor Document', 'url' => array('torDocument/create', 'pid' => $model->id)),
    array('label' => 'Create Milestone', 'url' => array('milestone/create', 'pid' => $model->id)),
    array('label' => 'Create Termin', 'url' => array('termin/create', 'pid' => $model->id)),
);
?>

<h1>View Project <?php echo $model->name; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
//        'id',
//        'status',
//        'created',
//        'updated',
//        'major_id',
//        'user_id',
//        'departement_id',
//        'organization_id',
        array(
            'name' => 'status',
            'type' => 'raw',
            'value' => $model->getStatusText()
        ),
        array(
            'label' => 'Winner',
            'name' => 'organization_id',
            'type' => 'raw',
            'value' => ($model->organization === null) ? 'N/A' : CHtml::link(CHtml::encode($model->organization->name), array('organization/view', 'id' => $model->organization->id))
        ),
        array(
            'label' => 'Project Cost',
            'type' => 'raw',
            'value' => $model->getProjectCost()
        ),
        array(
            'label' => 'Total Cost',
            'type' => 'raw',
            'value' => $model->getTotalCost()
        ),
        'name',
        'start_date',
        'end_date',
        'actual_start_date',
        'actual_end_date',
        'contracts',
        array(
            'name' => 'major_id',
            'type' => 'raw',
            'value' => CHtml::link(CHtml::encode($model->major->name), array('major/view', 'id' => $model->major->id))
        ),
        array(
            'name' => 'departement_id',
            'type' => 'raw',
            'value' => CHtml::link(CHtml::encode($model->departement->name), array('departement/view', 'id' => $model->departement->id))
        ),
        array(
            'name' => 'user_id',
            'type' => 'raw',
            'value' => CHtml::link(CHtml::encode($model->user->username), array('/user/user/view', 'id' => $model->user->id))
        ),
//        array(
//            'name' => 'organization_id',
//            'type' => 'raw',
//            'value' => CHtml::link(CHtml::encode($model->organization->name), array('organization/view', 'id' => $model->organization->id))
//        ),
    ),
));
?>
<div id="changeStatus">

    <?php if (Yii::app()->user->hasFlash('projectChangeStatus')): ?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('projectChangeStatus'); ?>
        </div>
    <?php endif; ?>
    <?php $this->renderPartial('_changeStatus', array('model' => $model)); ?>
</div>

<?php
$this->widget('zii.widgets.jui.CJuiTabs', array(
    'tabs' => array(
        'Proposal' => $this->renderPartial('_proposals', array(
            'proposals' => $model->proposals,
                ), $this),
        'TOR Documents' => $this->renderPartial('_torDocuments', array(
            'torDocuments' => $model->torDocuments,
                ), $this),
        // panel 3 contains the content rendered by a partial view
        'Milestone' =>
        $this->renderPartial('_milestones', array(
            'milestones' => $model->milestones,
                ), $this),
        'Termin' =>
        $this->renderPartial('_termins', array(
            'termins' => $model->termins,
                ), $this),
    ),
    // additional javascript options for the tabs plugin
    'options' => array(
        'collapsible' => true,
    ),
    'htmlOptions' => array('class' => 'shadowtabs'),
));
?>

