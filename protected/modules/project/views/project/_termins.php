<div id="termins">
    <h2>List Termin</h2>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'termin-grid',
        'dataProvider' => new CArrayDataProvider($termins, array(
            'pagination' => array(
                'pageSize' => 5,
            ),
            'sort' => array(
                'attributes' => array(
//                    'id',
                    'name',
                    'percentage',
                    'cost',
//                    'summary',
//                    'created',
//                    'updated',
//                    'project_id',
                ),
                'defaultOrder' => 'percentage ASC',
            ),
        )),
        'columns' => array(
            array(
                'name' => 'name',
                'type' => 'raw',
                'value' => 'CHtml::link(CHtml::encode($data->name), array(\'termin/view\', \'id\' => $data->id))',
            ),
//            'summary',
            'percentage',
            'cost',
//            'id',
//            'created',
//            'updated',
//            'project_id',
//            array(
//                'class' => 'CButtonColumn',
//            ),
        ),
    ));
    ?>
</div>