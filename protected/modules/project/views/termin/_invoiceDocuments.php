<div id="invoiceDocuments">
    <h2>List Invoice Documents</h2>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'invoiceDocument-grid',
        'dataProvider' => new CArrayDataProvider($invoiceDocuments, array(
            'pagination' => array(
                'pageSize' => 5,
            ),
            'sort' => array(
                'attributes' => array(
//                'id',
                    'status',
                    'document',
//                'file_name',
//                'created',
//                'updated',
//                'termin_id',
                    'organization_id',
                ),
            ),
        )),
        'columns' => array(
//        'id',
//        'status',
//        'document',
//        'file_name',
//        'organization_id',
//        'created',
//        'updated',
//        'termin_id',
            array(
//            'header' => 'Status',
                'name' => 'status',
                'value' => '$data->getStatusText()',
                'type' => 'raw',
            ),
            array(
                'name' => 'document',
                'type' => 'raw',
                'value' => 'CHtml::link(CHtml::encode($data->document), array(\'invoiceDocument/view\', \'id\' => $data->id))',
            ),
            array(
                'name' => 'organization_id',
                'type' => 'raw',
                'value' => 'CHtml::link(CHtml::encode($data->organization->name), array(\'organization/view/\', \'id\' => $data->organization->id))',
            ),
//        array(
//            'class' => 'CButtonColumn',
//        ),
        ),
    ));
    ?>
</div>