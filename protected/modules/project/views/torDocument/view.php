<?php
$this->breadcrumbs = array(
    'Tor Documents' => array('index', 'pid' => $model->project->id),
    $model->id,
);

$this->menu = array(
    array('label' => 'List TorDocument', 'url' => array('index', 'pid' => $model->project->id)),
    array('label' => 'Create TorDocument', 'url' => array('create', 'pid' => $model->project->id)),
    array('label' => 'Update TorDocument', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete TorDocument', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage TorDocument', 'url' => array('admin', 'pid' => $model->project->id)),
);
?>

<h1>View TorDocument #<?php echo $model->id; ?></h1>
<?php
$this->widget('ext.FlexPapper.FlexPaper', array(
    'path' => Yii::app()->baseUrl . Yii::app()->params['uploads'],
    'sourceFile' => $model->file_name,
    'viewerHeight' => '500px',
    'viewerWidth' => '100%'
));
?>

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
//        'status',
        array(
            'name' => 'document',
            'type' => 'raw',
            'value' => CHtml::link(CHtml::encode($model->document), Yii::app()->baseUrl . Yii::app()->params['uploads'] . $model->file_name)
        ),
        'summary',
        'cost',
//        'id',
//        'document',
//        'created',
//        'updated',
//        'project_id',
    ),
));
?>

<div id="changeStatus">

    <?php if (Yii::app()->user->hasFlash('torDocumentChangeStatus')): ?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('torDocumentChangeStatus'); ?>
        </div>
    <?php endif; ?>
    <?php $this->renderPartial('_changeStatus', array('model' => $model)); ?>
</div>

<div id="torReviews">
    <?php
    $this->renderPartial('_torReviews', array(
        'torReviews' => $model->torReviews,
    ));
    ?>
    <h3>Leave a Comment</h3>
    <?php if (Yii::app()->user->hasFlash('torReviewSubmitted')): ?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('torReviewSubmitted'); ?>
        </div>
    <?php endif; ?>
    <?php
    $this->renderPartial('/torReview/_form', array(
        'model' => $torReview,
    ));
    ?>

</div>