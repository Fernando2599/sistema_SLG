<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dictamen backend\models\Dictamen */

$this->title = 'Dictamen Oficial - ' . Html::encode($dictamen->razon_social);
$this->params['breadcrumbs'][] = ['label' => 'Dictámenes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="dictamen-oficial">
    <h1><?= Html::encode($this->title) ?></h1>

    <h2>Información del Dictamen</h2>
    <table class="table">
        <tr>
            <th>Razón Social</th>
            <td><?= Html::encode($dictamen->razon_social) ?></td>
        </tr>
        <tr>
            <th>Nombre Comercial</th>
            <td><?= Html::encode($dictamen->nombre_comercial) ?></td>
        </tr>
        <tr>
            <th>Giro Comercial</th>
            <td><?= Html::encode($dictamen->giro_comercial) ?></td>
        </tr>
        <tr>
            <th>Dirección</th>
            <td><?= Html::encode($dictamen->direccion) ?></td>
        </tr>
        <tr>
            <th>RFC</th>
            <td><?= Html::encode($dictamen->rfc) ?></td>
        </tr>
        <tr>
            <th>Representante Legal</th>
            <td><?= Html::encode($dictamen->representante_legal) ?></td>
        </tr>
    </table>

    <p style="font-size: 14px; color: gray; font-weight: bold;">
        Este documento es un dictamen oficial.
    </p>
</div>
