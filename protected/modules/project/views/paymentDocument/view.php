<?php
$this->breadcrumbs = array(
    'Payment Documents' => array('index', 'pid' => $model->termin->id),
    $model->id,
);

$this->menu = array(
    array('label' => 'List PaymentDocument', 'url' => array('index', 'pid' => $model->termin->id)),
    array('label' => 'Create PaymentDocument', 'url' => array('create', 'pid' => $model->termin->id)),
    array('label' => 'Update PaymentDocument', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete PaymentDocument', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage PaymentDocument', 'url' => array('admin', 'pid' => $model->termin->id)),
);
?>

<h1>View PaymentDocument #<?php echo $model->id; ?></h1>
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
            'name' => 'termin_id',
            'type' => 'raw',
            'value' => CHtml::link(CHtml::encode($model->termin->name), array('termin/view', 'id' => $model->termin->id))
        ),
        array(
            'name' => 'document',
            'type' => 'raw',
            'value' => CHtml::link(CHtml::encode($model->document), Yii::app()->baseUrl . Yii::app()->params['uploads'] . $model->file_name)
        ),
//        'id',
//        'document',
        'timestamp',
//        'created',
//        'updated',
//        'user_id',
//        'termin_id',
        array(
            'name' => 'user_id',
            'type' => 'raw',
            'value' => CHtml::link(CHtml::encode($model->user->username), array('/user/user/view', 'id' => $model->user->id))
        ),
    ),
));
?>
