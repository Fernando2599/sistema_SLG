<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Dictamen $model */

$this->title = 'Crear Dictamen';
$this->params['breadcrumbs'][] = ['label' => 'Dictamens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dictamen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
