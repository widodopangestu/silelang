<?php
$this->breadcrumbs = array(
    'Payment Documents' => array('index', 'pid' => $model->termin->id),
    'Manage',
);

$this->menu = array(
    array('label' => 'List PaymentDocument', 'url' => array('index', 'pid' => $model->termin->id)),
    array('label' => 'Create PaymentDocument', 'url' => array('create', 'pid' => $model->termin->id)),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('payment-document-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Payment Documents</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'payment-document-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
//        'id',
//        'file_name',
//        'created',
//        'updated',
//        'user_id',
//        'termin_id',
        'document',
        'timestamp',
        array(
            'name' => 'user_id',
            'filter' => $model->getUserOptions(),
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->user->username), array(\'/user/user/view/\', \'id\' => $data->user->id))',
        ),
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
