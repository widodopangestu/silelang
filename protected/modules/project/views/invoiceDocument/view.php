<?php
$this->breadcrumbs = array(
    'Invoice Documents' => array('index', 'pid' => $model->termin->id),
    $model->id,
);

$this->menu = array(
    array('label' => 'List InvoiceDocument', 'url' => array('index', 'pid' => $model->termin->id)),
    array('label' => 'Create InvoiceDocument', 'url' => array('create', 'pid' => $model->termin->id)),
    array('label' => 'Update InvoiceDocument', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete InvoiceDocument', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage InvoiceDocument', 'url' => array('admin', 'pid' => $model->termin->id)),
);
?>

<h1>View InvoiceDocument #<?php echo $model->id; ?></h1>
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
//        'document',
//        'created',
//        'updated',
//        'termin_id',
//        'status',
//        'organization_id',
        array(
            'name' => 'status',
            'type' => 'raw',
            'value' => $model->getStatusText()
        ),
        array(
            'name' => 'termin_id',
            'type' => 'raw',
            'value' => CHtml::link(CHtml::encode($model->termin->name), array('termin/view', 'id' => $model->termin->id))
        ),
        array(
            'name' => 'document',
            'type' => 'raw',
            'value' => CHtml::link(CHtml::encode($model->document), Yii::app()->baseUrl . Yii::app()->params['uploads'] . $model->file_name)
        ),
        array(
            'name' => 'organization_id',
            'type' => 'raw',
            'value' => CHtml::link(CHtml::encode($model->organization->name), array('organization/view', 'id' => $model->organization->id))
        ),
    ),
));
?>

<div id="changeStatus">

    <?php if (Yii::app()->user->hasFlash('invoiceDocumentChangeStatus')): ?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('invoiceDocumentChangeStatus'); ?>
        </div>
    <?php endif; ?>
    <?php $this->renderPartial('_changeStatus', array('model' => $model)); ?>
</div>

<div id="invoiceReviews">
    <?php
    $this->renderPartial('_invoiceReviews', array(
        'invoiceReviews' => $model->invoiceReviews,
    ));
    ?>
    <h3>Leave a Comment</h3>
    <?php if (Yii::app()->user->hasFlash('invoiceReviewSubmitted')): ?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('invoiceReviewSubmitted'); ?>
        </div>
    <?php endif; ?>
    <?php
    $this->renderPartial('/invoiceReview/_form', array(
        'model' => $invoiceReview,
    ));
    ?>

</div>