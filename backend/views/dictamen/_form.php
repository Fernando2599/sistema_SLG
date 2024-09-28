<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Dictamen $model */
/** @var yii\widgets\ActiveForm $form */

// Incluye el archivo CSS
$this->registerCssFile('@web/css/form_style.css'); // Ajusta la ruta según la ubicación de tu archivo

?>

<div class="dictamen-form container mt-4">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'row g-3']]); ?>

    <div class="col-md-6">
        <?= $form->field($model, 'sede_id')->dropDownList($model->getSedesList(), ['prompt'=>'Selecciona una sede...', 'class' => 'form-select']) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'rfc')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'razon_social')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'nombre_comercial')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'giro_comercial')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'representante_legal')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'direccion')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'created_at')->textInput(['value' => date('Y-m-d'), 'readonly' => true, 'class' => 'form-control']) ?>
    </div>

    <!-- Remueve o comenta los siguientes campos
    <?= $form->field($model, 'created_at')->textInput() ?>
    <?= $form->field($model, 'updated_at')->textInput() ?>
    <?= $form->field($model, 'created_by')->textInput() ?>
    <?= $form->field($model, 'updated_by')->textInput() ?>
    -->

    <div class="col-md-6">
        <?= $form->field($model, 'folio')->textInput(['maxlength' => true, 'readonly' => true, 'class' => 'form-control']) ?>
    </div>

    <!-- <?= $form->field($model, 'validez_id')->textInput() ?> -->
     
    <!-- Campo para editar el estado de validez solo visible para SuperUsuario -->
    <?php if (Yii::$app->user->identity->rol_id == 7): ?>
        <div class="col-md-6">
            <?= $form->field($model, 'validez_id')->dropDownList([
                1 => 'Válido',
                2 => 'No Válido',
                3 => 'Pendiente',
            ], [
                'prompt' => 'Seleccione el estado de validez', 
                'class' => 'form-select'
            ]) ?>
        </div>
    <?php endif; ?>

    <div class="col-12 mt-4">
        <div class="d-flex justify-content-between">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success w-100 me-2 guardar-btn']) ?>
            <?= Html::a('Cancelar', ['dictamen/index'], ['class' => 'btn btn-danger w-100 cancelar-btn']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
