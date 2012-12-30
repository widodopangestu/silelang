<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'completion-document-form',
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

    <div class="row">
        <?php echo $form->labelEx($model, 'summary'); ?>
        <?php echo $form->textArea($model, 'summary', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'summary'); ?>
    </div>

<!--    <div class="row">
        <?php // echo $form->labelEx($model, 'status'); ?>
        <?php // echo $form->textField($model, 'status'); ?>
        <?php // echo $form->error($model, 'status'); ?>
    </div>

    <div class="row">
        <?php // echo $form->labelEx($model, 'document'); ?>
        <?php // echo $form->textField($model, 'document', array('size' => 45, 'maxlength' => 45)); ?>
        <?php // echo $form->error($model, 'document'); ?>
    </div>

    <div class="row">
        <?php // echo $form->labelEx($model, 'milestone_id'); ?>
        <?php // echo $form->textField($model, 'milestone_id'); ?>
        <?php // echo $form->error($model, 'milestone_id'); ?>
    </div>-->

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->