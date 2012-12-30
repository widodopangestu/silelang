<?php

$status = $model->statusFlow();
$status = $status[$model->status];
?>
<?php echo CHtml::beginForm(); ?>
<?php foreach ($status as $value) : ?>
    <?php echo CHtml::submitButton($model->getStatusText($value), array('name' => 'status')); ?>
<?php endforeach; ?>
<?php echo CHtml::endForm(); ?>