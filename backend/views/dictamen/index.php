<?php

use backend\models\Dictamen;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\search\DictamenSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Dictamens';
$this->params['breadcrumbs'][] = $this->title;

// Registrar el archivo CSS
$this->registerCssFile("@web/css/validacion.css");

?>
<div class="dictamen-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Dictamen', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
                'format' => 'raw',  // Esto permite usar HTML
                'value' => function ($model) {
                    $estado = $model->estado->estado ?? 'Desconocido';  // Aquí obtienes el estado por nombre
                    $class = '';  // Inicializamos la clase CSS
    
                    // Aplicamos la clase CSS según el estado
                    if ($estado === 'Validado') {
                        $class = 'validado';
                    } elseif ($estado === 'No validado') {
                        $class = 'no-validado';
                    } elseif ($estado === 'Pendiente') {
                        $class = 'pendiente';
                    }
    
                    // Retorna el estado con la clase aplicada
                    return Html::tag('span', $estado, ['class' => $class]);
                },
                'label' => 'Estado',  // Cambia el título de la columna si es necesario
            ],

            //'sede_id',
            //'giro_comercial',
            //'representante_legal',
            //'direccion',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
            //'folio',
            //'validez_id',
            
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Dictamen $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
