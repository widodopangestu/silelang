<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'organization-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'major_id'); ?>
        <?php // echo $form->textField($model, 'major_id'); ?>
        <?php echo $form->dropDownList($model, 'major_id', $model->getMajorOptions()); ?>
        <?php echo $form->error($model, 'major_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'is_vendor'); ?>
        <?php // echo $form->textField($model, 'is_vendor'); ?>
        <?php // echo $form->radioButtonList($model, 'is_vendor', array('0' => 'No', '1' => 'Yes')); ?>
        <?php echo $form->radioButton($model, 'is_vendor', array('value' => '1', 'uncheckValue' => null)); ?> Yes
        <?php echo $form->radioButton($model, 'is_vendor', array('value' => '0', 'uncheckValue' => null)); ?> No
        <?php echo $form->error($model, 'is_vendor'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->