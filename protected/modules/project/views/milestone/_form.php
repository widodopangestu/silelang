<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'milestone-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <!--    <div class="row">
    <?php // echo $form->labelEx($model, 'project_id'); ?>
    <?php // echo $form->textField($model, 'project_id'); ?>
    <?php // echo $form->error($model, 'project_id'); ?>
        </div>
    
        <div class="row">
    <?php // echo $form->labelEx($model, 'document'); ?>
    <?php // echo $form->textField($model, 'document', array('size' => 45, 'maxlength' => 45)); ?>
    <?php // echo $form->error($model, 'document'); ?>
        </div>-->

    <div class="row">
        <?php echo $form->labelEx($model, 'file'); ?>
        <?php echo $form->fileField($model, 'file', array()); ?>
        <?php echo $form->error($model, 'file'); ?>
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
            'htmlOptions' => array(
                'class' => 'shadowdatepicker'
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
            'htmlOptions' => array(
                'class' => 'shadowdatepicker'
            ),
        ));
        ?> (yyyy-mm-dd)
        <?php echo $form->error($model, 'end_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'actual_start_date'); ?>
        <?php // echo $form->textField($model, 'actual_start_date'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'actual_start_date',
            'value' => $model->actual_start_date,
            // additional javascript options for the date picker plugin
            'options' => array(
                'rows' => 1,
                'cols' => 10,
                'showAnim' => 'fold',
                'showButtonPanel' => true,
                'autoSize' => true,
                'dateFormat' => 'yy-mm-dd',
                'defaultDate' => $model->actual_start_date,
            ),
            'htmlOptions' => array(
                'class' => 'shadowdatepicker'
            ),
        ));
        ?> (yyyy-mm-dd)
        <?php echo $form->error($model, 'actual_start_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'actual_end_date'); ?>
        <?php // echo $form->textField($model, 'actual_end_date'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'actual_end_date',
            'value' => $model->actual_end_date,
            // additional javascript options for the date picker plugin
            'options' => array(
                'rows' => 1,
                'cols' => 10,
                'showAnim' => 'fold',
                'showButtonPanel' => true,
                'autoSize' => true,
                'dateFormat' => 'yy-mm-dd',
                'defaultDate' => $model->actual_end_date,
            ),
            'htmlOptions' => array(
                'class' => 'shadowdatepicker'
            ),
        ));
        ?> (yyyy-mm-dd)
        <?php echo $form->error($model, 'actual_end_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'percentage'); ?>
        <?php echo $form->textField($model, 'percentage'); ?>
        <?php echo $form->error($model, 'percentage'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->