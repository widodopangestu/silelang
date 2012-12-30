<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'payment-document-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'file'); ?>
        <?php echo $form->fileField($model, 'file', array()); ?>
        <?php echo $form->error($model, 'file'); ?>
    </div>

<!--    <div class="row">
        <?php // echo $form->labelEx($model, 'timestamp'); ?>
        <?php // echo $form->textField($model, 'timestamp'); ?>
        <?php // echo $form->error($model, 'timestamp'); ?>
    </div>

    <div class="row">
        <?php // echo $form->labelEx($model, 'document'); ?>
        <?php // echo $form->textField($model, 'document', array('size' => 45, 'maxlength' => 45)); ?>
        <?php // echo $form->error($model, 'document'); ?>
    </div>

    <div class="row">
        <?php // echo $form->labelEx($model, 'user_id'); ?>
        <?php // echo $form->textField($model, 'user_id'); ?>
        <?php // echo $form->error($model, 'user_id'); ?>
    </div>

    <div class="row">
        <?php // echo $form->labelEx($model, 'termin_id'); ?>
        <?php // echo $form->textField($model, 'termin_id'); ?>
        <?php // echo $form->error($model, 'termin_id'); ?>
    </div>-->

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->