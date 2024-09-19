<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Validacion $model */

$this->title = 'Create Validacion';
$this->params['breadcrumbs'][] = ['label' => 'Validacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="validacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
