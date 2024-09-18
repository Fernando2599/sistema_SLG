<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\PermisosHelpers;
use common\models\RegistrosHelpers;
use frontend\models\Perfil;

class UpgradeController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
        'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return PermisosHelpers::requerirEstado('Activo');
                        }
                    ],
                        
                ],
        ],
            
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $nombre  =  Yii::$app->user->identity->username;
        return  $this->render('index',['nombre'  =>  $nombre]);
    }

}
