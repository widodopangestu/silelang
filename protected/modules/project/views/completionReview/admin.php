<?php
$this->breadcrumbs=array(
	'Completion Reviews'=>array('index', 'pid' => $model->completionDocument->id),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CompletionReview', 'url'=>array('index', 'pid' => $model->completionDocument->id)),
	array('label'=>'Create CompletionReview', 'url'=>array('create', 'pid' => $model->completionDocument->id)),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('completion-review-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Completion Reviews</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'completion-review-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'review',
		'created',
		'updated',
		'completion_document_id',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
