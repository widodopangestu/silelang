<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'project-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

<!--    <div class="row">
        <?php // echo $form->labelEx($model, 'departement_id'); ?>
        <?php // echo $form->textField($model, 'departement_id'); ?>
        <?php // echo $form->dropDownList($model, 'departement_id', $model->getDepartementOptions()); ?>
        <?php // echo $form->error($model, 'departement_id'); ?>
    </div>-->

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
        <?php echo $form->labelEx($model, 'start_date'); ?>
        <?php // echo $form->textField($model, 'start_date'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'start_date',
            'value' => $model->start_date,
            // additional javascript options for the date picker plugin
            'options' => array(
                'rows' => 1,
                'cols' => 10,
                'showAnim' => 'fold',
                'showButtonPanel' => true,
                'autoSize' => true,
                'dateFormat' => 'yy-mm-dd',
                'defaultDate' => $model->start_date,
            ),
        ));
        ?> (yyyy-mm-dd)
        <?php echo $form->error($model, 'start_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'end_date'); ?>
        <?php // echo $form->textField($model, 'end_date'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'end_date',
            'value' => $model->end_date,
            // additional javascript options for the date picker plugin
            'options' => array(
                'rows' => 1,
                'cols' => 10,
                'showAnim' => 'fold',
                'showButtonPanel' => true,
                'autoSize' => true,
                'dateFormat' => 'yy-mm-dd',
                'defaultDate' => $model->end_date,
            ),
        ));
        ?> (yyyy-mm-dd)
        <?php echo $form->error($model, 'end_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'contracts'); ?>
        <?php echo $form->textField($model, 'contracts', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'contracts'); ?>
    </div>

    <!--	<div class="row">
    <?php // echo $form->labelEx($model,'organization_id'); ?>
    <?php // echo $form->textField($model,'organization_id');  ?>
    <?php // echo $form->error($model,'organization_id');  ?>
            </div>-->

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->