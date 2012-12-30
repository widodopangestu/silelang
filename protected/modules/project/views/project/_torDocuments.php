<div id="torDocuments">
    <h2>List TOR Documents</h2>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'torDocuments-grid',
        'dataProvider' => new CArrayDataProvider($torDocuments, array(
            'pagination' => array(
                'pageSize' => 5,
            ),
            'sort' => array(
                'attributes' => array(
//                    'id',
//                    'created',
//                    'updated',
//                    'project_id',
//                    'summary',
                    'status',
                    'document',
                    'cost',
                ),
                'defaultOrder' => 'cost DESC',
            ),
        )),
        'columns' => array(
//        'status',
            array(
//            'header' => 'Status',
                'name' => 'status',
//            'filter' => $model->getStatusOptions(),
                'value' => '$data->getStatusText()',
                'type' => 'raw',
            ),
            array(
                'name' => 'document',
                'type' => 'raw',
                'value' => 'CHtml::link(CHtml::encode($data->document), array(\'torDocument/view\', \'id\' => $data->id))',
            ),
//        'id',
//        'document',
//            'summary',
            'cost',
//        'created',
//        'updated',
//        'project_id',
//        array(
//            'class' => 'CButtonColumn',
//        ),
        ),
    ));
    ?>
</div>