<div id="completionDocuments">
    <h2>List Completion Documents</h2>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'completionDocument-grid',
        'dataProvider' => new CArrayDataProvider($completionDocuments, array(
            'pagination' => array(
                'pageSize' => 5,
            ),
            'sort' => array(
                'attributes' => array(
//                'id',
//                'summary',
//                'created',
//                'updated',
//                'milestone_id',
                    'status',
                    'document',
                ),
            ),
        )),
        'columns' => array(
//        'id',
//        'summary',
//        'status',
//        'document',
//        'created',
//        'updated',
//        'milestone_id',
            array(
//            'header' => 'Status',
                'name' => 'status',
                'value' => '$data->getStatusText()',
                'type' => 'raw',
            ),
            array(
                'name' => 'document',
                'type' => 'raw',
                'value' => 'CHtml::link(CHtml::encode($data->document), array(\'completionDocument/view\', \'id\' => $data->id))',
            ),
//        array(
//            'class' => 'CButtonColumn',
//        ),
        ),
    ));
    ?>
</div>