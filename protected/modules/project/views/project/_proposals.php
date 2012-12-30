<div id="proposals">
    <h2>List Proposals</h2>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'proposals-grid',
        'dataProvider' => new CArrayDataProvider($proposals, array(
            'pagination' => array(
                'pageSize' => 5,
            ),
            'sort' => array(
                'attributes' => array(
//                'id',
                    'status',
                    'name',
                    'document',
//                    'summary',
                    'cost',
//                'created',
//                'updated',
//                'project_id',
                    'user_id',
                ),
                'defaultOrder' => 'cost ASC',
            ),
        )),
        'columns' => array(
//        'id',
//        'status',
//        'name',

            array(
//            'header' => 'Status',
                'name' => 'status',
//            'filter' => $model->getStatusOptions(),
                'value' => '$data->getStatusText()',
                'type' => 'raw',
            ),
            'name',
//            array(
//                'name' => 'name',
//                'type' => 'raw',
//                'value' => 'CHtml::link(CHtml::encode($data->name), array(\'proposal/view\', \'id\' => $data->id))',
//            ),
            array(
                'name' => 'document',
                'type' => 'raw',
                'value' => 'CHtml::link(CHtml::encode($data->document), array(\'proposal/view\', \'id\' => $data->id))',
            ),
//            'summary',
            'cost',
//            'document',
//        'created',
//        'updated',
//        'project_id',
//        'user_id',
            array(
                'header' => 'User',
                'name' => 'user_id',
                'type' => 'raw',
                'value' => 'CHtml::link(CHtml::encode($data->user->username), array(\'/user/user/view/\', \'id\' => $data->user->id))',
            ),
//        array(
//            'class' => 'CButtonColumn',
//        ),
        ),
    ));
    ?>
</div>