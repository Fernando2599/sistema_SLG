<?php

use backend\models\Dictamen;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use Yii;

/** @var yii\web\View $this */
/** @var backend\models\search\DictamenSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'DICTAMENES';
$this->params['breadcrumbs'][] = $this->title;

// Registrar el archivo CSS para la validación
$this->registerCssFile("@web/css/validacion.css");

?>
<div class="dictamen-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <!-- Mostrar el botón de "Crear" solo si el usuario es Admin o SuperUsuario -->
        <?php if (Yii::$app->user->identity->rol_id == 2 || Yii::$app->user->identity->rol_id == 7): ?>
            <?= Html::a('Crear Dictamen', ['create'], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'created_at',
            'razon_social',
            'nombre_comercial',
            'rfc',
            'folio',
            [
                'attribute' => 'validez_id',
                'format' => 'raw',
                'value' => function ($model) {
                    // Asignamos el estado y su clase CSS
                    $estado = $model->estado->estado ?? 'Desconocido';
                    $class = '';

                    if ($estado === 'Validado') {
                        $class = 'validado';
                    } elseif ($estado === 'No validado') {
                        $class = 'no-validado';
                    } elseif ($estado === 'Pendiente') {
                        $class = 'pendiente';
                    }

                    // Retornamos el estado con la clase CSS correspondiente
                    return Html::tag('span', $estado, ['class' => $class]);
                },
                'label' => 'Estado',
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete} {validate_btn} {pdf_btn}',  // Agregamos el botón de validar
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('Ver', $url, ['class' => 'btn btn-primary']);
                    },
                    'update' => function ($url, $model) {
                        // Solo mostrar el botón "Editar" si el rol es SuperUsuario
                        if (Yii::$app->user->identity->rol_id == 7) {
                            return Html::a('Editar', $url, ['class' => 'btn btn-warning']);
                        }
                        return '';
                    },
                    'delete' => function ($url, $model) {
                        // Solo mostrar el botón "Eliminar" si el rol es SuperUsuario
                        if (Yii::$app->user->identity->rol_id == 7) {
                            return Html::a('Eliminar', $url, [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => '¿Estás seguro de eliminar este ítem?',
                                    'method' => 'post',
                                ],
                            ]);
                        }
                        return '';
                    },
                    'validate_btn' => function ($url, $model) {
                        // Mostrar el botón "Validar" solo si el rol es SuperUsuario y el estado es "Pendiente"
                        if (Yii::$app->user->identity->rol_id == 7 && $model->validez_id == 3) { // 3 es el ID para "Pendiente"
                            return Html::a('Validar', ['dictamen/validate', 'id' => $model->id], [
                                'class' => 'btn btn-success',
                                'data' => [
                                    'confirm' => '¿Estás seguro de validar este dictamen?',
                                    'method' => 'post',
                                ],
                            ]);
                        }
                        return '';
                    },
                    'pdf_btn' => function ($url, $model) {
                        // Mostrar el botón PDF solo si el dictamen está "Validado"
                        if ($model->validez_id == 1) { // 1 es el ID para "Validado"
                            return Html::a('<i class="fa fa-file-pdf-o" style="font-size:30px;color:red"></i>', ['pdfcontroller/pdf/generate-pdf', 'id' => $model->id], [
                                'title' => 'Generar Dictamen',
                                'data-pjax' => '0',
                                'class' => 'btn btn-light' // Cambiado a rojo
                            ]);
                        } else {
                            // Si no está validado, mostrar el botón deshabilitado
                            return Html::tag('span', '<i class="fa fa-file-pdf-o" style="font-size:30px;color:grey"></i>', [
                                'title' => 'No disponible hasta que sea validado',
                                'class' => 'btn btn-light disabled' // Botón deshabilitado en gris
                            ]);
                        }
                    },

                ],
                'urlCreator' => function ($action, Dictamen $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

</div>
