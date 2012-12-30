<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'completionReview-grid',
    'dataProvider' => new CArrayDataProvider($completionReviews, array(
        'pagination' => array(
            'pageSize' => 5,
        ),
        'sort' => array(
            'attributes' => array(
//                'id',
                'review',
//                'created',
//                'updated',
//                'completion_document_id',
            ),
        ),
    )),
    'columns' => array(
//        'id',
        'review',
//        'created',
//        'updated',
//        'completion_document_id',
//        array(
//            'class' => 'CButtonColumn',
//        ),
    ),
));
?>