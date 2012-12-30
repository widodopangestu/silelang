<div id="milestones">
    <h2>List Milestone</h2>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'milestones-grid',
        'dataProvider' => new CArrayDataProvider($milestones, array(
            'pagination' => array(
                'pageSize' => 5,
            ),
            'sort' => array(
                'attributes' => array(
//                    'id',
//                    'document',
//                    'created',
//                    'updated',
//                    'project_id',
                    'name',
                    'start_date',
                    'end_date',
                    'actual_start_date',
                    'actual_end_date',
                    'percentage',
                ),
                'defaultOrder' => 'percentage ASC'
            ),
        )),
        'columns' => array(
//        'id',
//        'name',
//        'document',
//        'created',
//        'updated',
//        'project_id',
            array(
                'name' => 'name',
                'type' => 'raw',
                'value' => 'CHtml::link(CHtml::encode($data->name), array(\'milestone/view\', \'id\' => $data->id))',
            ),
            'start_date',
            'end_date',
            'actual_start_date',
            'actual_end_date',
            'percentage',
//        array(
//            'class' => 'CButtonColumn',
//        ),
        ),
    ));
    ?>
</div>