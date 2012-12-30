<?php
$this->breadcrumbs = array(
    'Proposals' => array('index', 'pid' => $model->project->id),
    $model->name,
);

$this->menu = array(
    array('label' => 'List Proposal', 'url' => array('index', 'pid' => $model->project->id)),
    array('label' => 'Create Proposal', 'url' => array('create', 'pid' => $model->project->id)),
    array('label' => 'Update Proposal', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Proposal', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Proposal', 'url' => array('admin', 'pid' => $model->project->id)),
);
?>

<h1>
    View Proposal 
    <?php echo $model->name; ?>
</h1>
<?php
/**
  $this->widget('ext.FlexPapper.FlexPaper', array(
  'path'=>Yii::app()->baseUrl . Yii::app()->params['uploads'],
  'sourceFile'=> $model->document,
  'viewerHeight'=>'500px',
  'viewerWidth'=>'100%'
  ));
 * */
?>
<br />
<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'status',
            'type' => 'raw',
            'value' => $model->getStatusText()
        ),
        array(
            'name' => 'project_id',
            'type' => 'raw',
            'value' => CHtml::link(CHtml::encode($model->project->name), array('project/view', 'id' => $model->project->id))
        ),
//        'id',
//        'status',
        'name',
        array(
            'name' => 'document',
            'type' => 'raw',
            'value' => CHtml::link(CHtml::encode($model->document), Yii::app()->baseUrl . Yii::app()->params['uploads'] . $model->file_name)
        ),
        'summary',
        'cost',
//        'document',
//        'file_name',
//        'created',
//        'updated
//        'project_id',
//        'user_id',
        array(
            'name' => 'user_id',
            'type' => 'raw',
            'value' => CHtml::link(CHtml::encode($model->user->username), array('/user/user/view', 'id' => $model->user->id))
        ),
    ),
));
?>
<div id="changeStatus">
    <?php if (Yii::app()->user->hasFlash('proposalChangeStatus')): ?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('proposalChangeStatus'); ?>
        </div>
    <?php endif; ?>
    <?php $this->renderPartial('_changeStatus', array('model' => $model)); ?>
</div>
<div id="proposalComments">
    <?php
    $this->renderPartial('_proposalComments', array(
        'proposalComments' => $model->proposalComments,
    ));
    ?>
    <h3>Leave a Comment</h3>
    <?php if (Yii::app()->user->hasFlash('proposalCommentSubmitted')): ?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('proposalCommentSubmitted'); ?>
        </div>
    <?php endif; ?>
    <?php
    $this->renderPartial('/proposalComment/_form', array(
        'model' => $proposalComment,
    ));
    ?>
</div>
