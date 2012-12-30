<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'proposal-comment-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'comment'); ?>
        <?php echo $form->textArea($model, 'comment', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'comment'); ?>
    </div>

<!--    <div class="row">
        <?php // echo $form->labelEx($model, 'proposal_id'); ?>
        <?php // echo $form->textField($model, 'proposal_id'); ?>
        <?php // echo $form->error($model, 'proposal_id'); ?>
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