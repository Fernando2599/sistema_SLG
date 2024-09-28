<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Dictamen $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dictamens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="dictamen-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- Condición para mostrar los botones de editar/eliminar solo a SuperUsuario -->
    <?php if (Yii::$app->user->identity->rol_id == 7): ?>
        <p>
            <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => '¿Estás seguro que deseas eliminar este ítem?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php endif; ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'sede_id',
                'label' => 'Sede:',
                'value' => function ($model) {
                    return $model->sede ? $model->sede->nombre : 'Desconocido'; // Asume que 'nombre' es la columna que tiene el nombre de la sede
                },
            ],
            'rfc',
            'razon_social',
            'nombre_comercial',
            'giro_comercial',
            'representante_legal',
            'direccion',
            'created_at',
            'updated_at',
            [
                'attribute' => 'created_by',
                'label' => 'Creado por:',
                'value' => function ($model) {
                    return $model->createdBy ? $model->createdBy->username : 'Desconocido'; // Asume que 'username' es el nombre del usuario
                },
            ],
            [
                'attribute' => 'updated_by',
                'label' => 'Actualizado por:',
                'value' => function ($model) {
                    return $model->updatedBy ? $model->updatedBy->username : 'Desconocido';
                },
            ],
            'folio',
            [
                'attribute' => 'validez_id',
                'label' => 'Estado de Validez:',
                'value' => function ($model) {
                    return $model->getEstadoNombre(); // Asegúrate de que se llame al método aquí
                },
            ],
        ],
    ]) ?>

</div>
