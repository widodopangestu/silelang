<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'tor-review-form',
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
        <?php // echo $form->labelEx($model, 'tor_document_id'); ?>
        <?php // echo $form->textField($model, 'tor_document_id'); ?>
        <?php // echo $form->error($model, 'tor_document_id'); ?>
    </div>-->

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->