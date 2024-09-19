<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\search\DictamenSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="dictamen-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sede_id') ?>

    <?= $form->field($model, 'rfc') ?>

    <?= $form->field($model, 'razon_social') ?>

    <?= $form->field($model, 'nombre_comercial') ?>

    <?php // echo $form->field($model, 'giro_comercial') ?>

    <?php // echo $form->field($model, 'representante_legal') ?>

    <?php // echo $form->field($model, 'direccion') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'folio') ?>

    <?php // echo $form->field($model, 'validez_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
