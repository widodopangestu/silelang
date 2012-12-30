<div id="paymentDocuments">
    <h2>List Payment Documents</h2>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'paymentDocument-grid',
        'dataProvider' => new CArrayDataProvider($paymentDocuments, array(
            'pagination' => array(
                'pageSize' => 5,
            ),
            'sort' => array(
                'attributes' => array(
//                'id',
                    'document',
                    'timestamp',
//		'created',
//		'updated',
                    'user_id',
//                'termin_id',
                ),
            ),
        )),
        'columns' => array(
            array(
                'name' => 'document',
                'type' => 'raw',
                'value' => 'CHtml::link(CHtml::encode($data->document), array(\'paymentDocument/view\', \'id\' => $data->id))',
            ),
            'timestamp',
            array(
                'header' => 'User',
                'name' => 'user_id',
                'type' => 'raw',
                'value' => 'CHtml::link(CHtml::encode($data->user->username), array(\'/user/user/view/\', \'id\' => $data->user->id))',
            ),
//        'id',
//        'document',
//        'created',
//        'updated',
//        'termin_id',
//        'user_id',    
//        array(
//            'class' => 'CButtonColumn',
//        ),
        ),
    ));
    ?>
</div>