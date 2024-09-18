<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Dictamen $model */

$this->title = 'Update Dictamen: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dictamens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dictamen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
