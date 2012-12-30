<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'proposalComment-grid',
    'dataProvider' => new CArrayDataProvider($proposalComments, array(
        'pagination' => array(
            'pageSize' => 5,
        ),
        'sort' => array(
            'attributes' => array(
//                'id',
                'comment',
//                'created',
//                'updated',
//                'proposal_id',
                'user_id',
            ),
        ),
    )),
    'columns' => array(
//        'id',
        'comment',
        array(
            'header' => 'User',
            'name' => 'user_id',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->user->username), array(\'/user/user/view/\', \'id\' => $data->user->id))',
        ),
//        'created',
//        'updated',
//        'proposal_id',
//        'user_id',
//        array(
//            'class' => 'CButtonColumn',
//        ),
    ),
));
?>