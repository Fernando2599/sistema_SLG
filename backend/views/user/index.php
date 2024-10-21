<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\bootstrap5\Accordion;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;

// Registrar el archivo CSS para la validación
$this->registerCssFile("@web/css/validacion.css");

?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

     <?php  // echo Collapse::widget(['items' => [
                                            // equivalente a lo de arriba
                                           //  [
                                           //     'label' => 'Search',
                                            //    'content' => $this->render('_search', ['model' => $searchModel]) ,
                                                // open its content by default
                                                //'contentOptions' => ['class' => 'in']
                                           // ],
                                            
                                    //] 
                                   // ]);  
    ?> 


<!--     <?php  echo Accordion::widget([
                            'items' => [
                                // equivalent to the above
                                [
                                    'label' => 'Usuario a Buscar ',
                                    'content' => $this->render('_search', ['model' => $searchModel]) ,
                                    // open its content by default
                                    'contentOptions' => ['class' => 'in']
                                ],
                                   // if you want to swap out .card-block with .list-group, you may use the following
                            ]
                        ]);
    ?>  -->
    
    <p> </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            ['attribute'=>'userIdLink', 'format'=>'raw'],
            ['attribute'=>'userLink', 'format'=>'raw'],
            ['attribute'=>'perfilLink', 'format'=>'raw'],

            'email:email',
            'rolNombre',
            'tipoUsuarioNombre',
            'estadoNombre',

            [
                'attribute' => 'estadoNombre',
                'format' => 'raw',
                'value' => function($model) {
                    $class = '';
                    switch ($model->estadoNombre) {
                        case 'Activo':
                            $class = 'validado'; // Clase para estado validado
                            break;
                        case 'Inactivo':
                            $class = 'no-validado'; // Clase para estado no validado
                            break;
                        case 'Pendiente':
                            $class = 'pendiente'; // Clase para estado pendiente
                            break;
                        // Agrega más casos según sea necesario
                    }
                    return Html::tag('span', Html::encode($model->estadoNombre), ['class' => $class]);
                },
            ],
            
            'created_at',

            ['class' => 'yii\grid\ActionColumn'],
            
            // 'updated_at',
            
        ],
    ]); ?>

</div>