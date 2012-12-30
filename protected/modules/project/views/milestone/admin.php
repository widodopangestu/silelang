<?php
$this->breadcrumbs = array(
    'Milestones' => array('index', 'pid' => $model->project->id),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Milestone', 'url' => array('index', 'pid' => $model->project->id)),
    array('label' => 'Create Milestone', 'url' => array('create', 'pid' => $model->project->id)),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('milestone-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Milestones</h1>

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
    'id' => 'milestone-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
//        'id',
//        'created',
//        'updated',
//        'project_id',
        'name',
        'document',
        'start_date',
        'end_date',
        'actual_start_date',
        'actual_end_date',
        'percentage',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
