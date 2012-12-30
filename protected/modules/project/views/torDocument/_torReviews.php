<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'torReview-grid',
    'dataProvider' => new CArrayDataProvider($torReviews, array(
        'pagination' => array(
            'pageSize' => 5,
        ),
        'sort' => array(
            'attributes' => array(
//                'id',
                'review',
//                'created',
//                'updated',
//                'tor_document_id',
            ),
        ),
    )),
    'columns' => array(
//        'id',
        'review',
//        'created',
//        'updated',
//        'tor_document_id',
//        array(
//            'class' => 'CButtonColumn',
//        ),
    ),
));
?>