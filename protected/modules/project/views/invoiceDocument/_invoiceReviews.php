<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'invoiceReview-grid',
    'dataProvider' => new CArrayDataProvider($invoiceReviews, array(
        'pagination' => array(
            'pageSize' => 5,
        ),
        'sort' => array(
            'attributes' => array(
//                'id',
                'review',
//                'created',
//                'updated',
//                'invoice_document_id',
            ),
        ),
    )),
    'columns' => array(
//        'id',
        'review',
//        'created',
//        'updated',
//        'invoice_document_id',
//        array(
//            'class' => 'CButtonColumn',
//        ),
    ),
));
?>