<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Dictamen $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="dictamen-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--<?= $form->field($model, 'sede_id')->textInput() ?> -->
    <?= $form->field($model, 'sede_id')->dropDownList($model->getSedesList(), ['prompt'=>'Selecciona una sede...']) ?>

    <?= $form->field($model, 'rfc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'razon_social')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre_comercial')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'giro_comercial')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'representante_legal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput(['value' => date('Y-m-d'), 'readonly' => true]) ?>


    <!-- Remueve o comenta los siguientes campos -->
    <!--
    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>
    -->

    <?= $form->field($model, 'folio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'validez_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
