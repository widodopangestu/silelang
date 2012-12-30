<?php
$this->breadcrumbs = array(
    'Projects' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Project', 'url' => array('index')),
    array('label' => 'Create Project', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('project-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Projects</h1>

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
    'id' => 'project-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
//        'id',
//        'status',
        array(
//            'header' => 'Status',
            'name' => 'status',
            'filter' => $model->getStatusOptions(),
            'value' => '$data->getStatusText()',
            'type' => 'raw',
        ),
        'name',
        'start_date',
        'end_date',
        'actual_start_date',
        'actual_end_date',
//        'contracts',
//        'created',
//        'updated',
//        'major_id',
//        'user_id',
//        'departement_id',
//        'organization_id',
        array(
            'name' => 'major_id',
            'filter' => $model->getMajorOptions(),
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->major->name), array(\'major/view/\', \'id\' => $data->major->id))',
        ),
        array(
            'name' => 'departement_id',
            'filter' => $model->getDepartementOptions(),
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->departement->name), array(\'departement/view/\', \'id\' => $data->major->id))',
        ),
//        array(
//            'name' => 'organization_id',
//            'filter' => $model->getOrganizationOptions(),
//            'type' => 'raw',
//            'value' => 'CHtml::link(CHtml::encode($data->organization->name), array(\'organization/view/\', \'id\' => $data->major->id))',
//        ),
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
