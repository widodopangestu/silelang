<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'tor-document-form',
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

    <div class="row">
        <?php echo $form->labelEx($model, 'cost'); ?>
        <?php echo $form->textField($model, 'cost'); ?>
        <?php echo $form->error($model, 'cost'); ?>
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
        <?php // echo $form->labelEx($model,'project_id'); ?>
        <?php // echo $form->textField($model,'project_id');  ?>
        <?php // echo $form->error($model,'project_id');  ?>
    </div>-->

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->