<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Validacion $model */

$this->title = 'Update Validacion: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Validacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="validacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
