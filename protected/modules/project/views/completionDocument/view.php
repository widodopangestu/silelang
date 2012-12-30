<?php
$this->breadcrumbs = array(
    'Completion Documents' => array('index', 'pid' => $model->milestone->id),
    $model->id,
);

$this->menu = array(
    array('label' => 'List CompletionDocument', 'url' => array('index', 'pid' => $model->milestone->id)),
    array('label' => 'Create CompletionDocument', 'url' => array('create', 'pid' => $model->milestone->id)),
    array('label' => 'Update CompletionDocument', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete CompletionDocument', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage CompletionDocument', 'url' => array('admin', 'pid' => $model->milestone->id)),
);
?>

<h1>View CompletionDocument #<?php echo $model->id; ?></h1>
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
//        'id',
//        'status',
//        'document',
//        'created',
//        'updated',
//        'milestone_id',
        array(
            'name' => 'status',
            'type' => 'raw',
            'value' => $model->getStatusText()
        ),
        array(
            'name' => 'document',
            'type' => 'raw',
            'value' => CHtml::link(CHtml::encode($model->document), Yii::app()->baseUrl . Yii::app()->params['uploads'] . $model->file_name)
        ),
        array(
            'name' => 'milestone_id',
            'type' => 'raw',
            'value' => CHtml::link(CHtml::encode($model->milestone->name), array('milestone/view', 'id' => $model->milestone->id))
        ),
        'summary',
    ),
));
?>

<div id="changeStatus">

    <?php if (Yii::app()->user->hasFlash('completionDocumentChangeStatus')): ?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('completionDocumentChangeStatus'); ?>
        </div>
    <?php endif; ?>
    <?php $this->renderPartial('_changeStatus', array('model' => $model)); ?>
</div>

<div id="completionReviews">
    <?php
    $this->renderPartial('_completionReviews', array(
        'completionReviews' => $model->completionReviews,
    ));
    ?>
    <h3>Leave a Comment</h3>
    <?php if (Yii::app()->user->hasFlash('completionReviewSubmitted')): ?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('completionReviewSubmitted'); ?>
        </div>
    <?php endif; ?>
    <?php
    $this->renderPartial('/completionReview/_form', array(
        'model' => $completionReview,
    ));
    ?>

</div>