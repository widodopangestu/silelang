<?php
$this->breadcrumbs = array(
    'Milestones' => array('index', 'pid' => $model->project->id),
    $model->name,
);

$this->menu = array(
    array('label' => 'List Milestone', 'url' => array('index', 'pid' => $model->project->id)),
    array('label' => 'Create Milestone', 'url' => array('create', 'pid' => $model->project->id)),
    array('label' => 'Update Milestone', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Milestone', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Milestone', 'url' => array('admin', 'pid' => $model->project->id)),
    array('label' => 'Create Completion Document', 'url' => array('completionDocument/create', 'pid' => $model->id)),
);
?>

<h1>View Milestone #<?php echo $model->id; ?></h1>
<?php
$this->widget('ext.FlexPapper.FlexPaper', array(
		'path'=>Yii::app()->baseUrl . Yii::app()->params['uploads'],
		'sourceFile'=> $model->file_name,
		'viewerHeight'=>'500px',
		'viewerWidth'=>'100%'
));
?>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'project_id',
            'type' => 'raw',
            'value' => CHtml::link(CHtml::encode($model->project->name), array('project/view', 'id' => $model->project->id))
        ),
//        'id',
        'name',
        array(
            'name' => 'document',
            'type' => 'raw',
            'value' => CHtml::link(CHtml::encode($model->document), Yii::app()->baseUrl . Yii::app()->params['uploads'] . $model->file_name)
        ),
//        'document',
        'start_date',
        'end_date',
        'actual_start_date',
        'actual_end_date',
        'percentage',
//        'created',
//        'updated',
//        'project_id',
    ),
));
?>


<div id="completionDocuments">
    <?php
    $this->renderPartial('_completionDocuments', array(
        'completionDocuments' => $model->completionDocuments,
    ));
    ?>
</div>