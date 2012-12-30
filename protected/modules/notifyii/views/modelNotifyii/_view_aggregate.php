<?php
/* @var $this NotifyiiController */
/* @var $data Notifyii */
?>

<?php if (!(trim($data->role) === "")) : ?>
    <div class="view">
        <b><?php echo CHtml::encode($data->getAttributeLabel('role')); ?>:</b>
        <?php echo CHtml::encode($data->role); ?>
        <br />
        <hr />
        <?php
        $items = ModelNotifyii::model()->findAll(new CDbCriteria(array(
                    'condition' => 'role=:role',
                    'params' => array(
                        ':role' => $data->role
                    )
                )));
        ?>
        <?php if (count($items)) : ?>
            <?php foreach ($items as $item) : ?>
                <div class="view_notif">                    
                    <?php echo CHtml::link($item->content, $item->link); ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
<?php endif; ?>

