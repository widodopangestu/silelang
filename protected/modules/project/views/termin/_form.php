<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'termin-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <!--    <div class="row">
    <?php // echo $form->labelEx($model, 'project_id'); ?>
    <?php // echo $form->textField($model, 'project_id'); ?>
    <?php // echo $form->error($model, 'project_id'); ?>
        </div>-->

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'percentage'); ?>
        <?php echo $form->textField($model, 'percentage'); ?>
        <?php echo $form->error($model, 'percentage'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'cost'); ?>
        <?php echo $form->textField($model, 'cost'); ?>
        <?php echo $form->error($model, 'cost'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'summary'); ?>
        <?php echo $form->textArea($model, 'summary', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'summary'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->