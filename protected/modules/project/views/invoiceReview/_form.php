<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'invoice-review-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'review'); ?>
        <?php echo $form->textArea($model, 'review', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'review'); ?>
    </div>

<!--    <div class="row">
        <?php // echo $form->labelEx($model, 'invoice_document_id'); ?>
        <?php // echo $form->textField($model, 'invoice_document_id'); ?>
        <?php // echo $form->error($model, 'invoice_document_id'); ?>
    </div>

    <div class="row">
        <?php // echo $form->labelEx($model, 'user_id'); ?>
        <?php // echo $form->textField($model, 'user_id'); ?>
        <?php // echo $form->error($model, 'user_id'); ?>
    </div>-->

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->