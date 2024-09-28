<?php

namespace backend\controllers;

use Yii; // Asegúrate de que esta línea esté presente
use backend\models\Dictamen;
use backend\models\search\DictamenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\PermisosHelpers; //agregar esta linea siempre y cuando se use el comportamiento(behaviors) de la pagina.

/**
 * DictamenController implements the CRUD actions for Dictamen model.
 */
class DictamenController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => \yii\filters\AccessControl::className(),
                    'only' => ['index', 'view','create', 'update', 'delete'], //Solo cuando este iniciado sesion solo esta parte se puede hacer
                    'rules' => [
                        [
                            'actions' => ['index', 'create', 'view',],
                            'allow' => true,
                            'roles' => ['@'],
                            'matchCallback' => function ($rule, $action) {
                             return PermisosHelpers::requerirMinimoRol('Admin') 
                             && PermisosHelpers::requerirEstado('Activo');
                            }
                        ],
                        [
                            'actions' => [ 'update', 'delete'],
                            'allow' => true,
                            'roles' => ['@'],
                            'matchCallback' => function ($rule, $action) {
                             return PermisosHelpers::requerirMinimoRol('SuperUsuario') 
                             && PermisosHelpers::requerirEstado('Activo');
                            }
                        ],

                        [
                            'actions' => ['validate'],
                            'allow' => true,
                            'roles' => ['@'],
                            'matchCallback' => function ($rule, $action) {
                                return PermisosHelpers::requerirMinimoRol('SuperUsuario') 
                                && PermisosHelpers::requerirEstado('Activo');
                            }
                        ],
                        
                             
                    ],
                         
                ],

                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Dictamen models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DictamenSearch();
    
        // Verifica el rol del usuario
        $rol_id = Yii::$app->user->identity->rol_id;
    
        // Si el rol es SuperUsuario (ID 7), mostrar todos los dictámenes
        if ($rol_id == 7) {
            $dataProvider = $searchModel->search($this->request->queryParams);
        } else {
            // Si el usuario no es SuperUsuario, mostrar solo los dictámenes creados por él
            $dataProvider = $searchModel->search($this->request->queryParams);
            $dataProvider->query->andWhere(['created_by' => Yii::$app->user->id]); // Filtra por el usuario actual
        }
    
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    

    /**
     * Displays a single Dictamen model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Dictamen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Dictamen();

        // Generar el folio automáticamente antes de mostrar el formulario
        $model->folio = $this->generateFolio();

         // Asignar el estado "pendiente" por defecto
        $model->validez_id = 3;  // Cambia '3' al ID correspondiente para "pendiente"

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Dictamen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                // Evita que se sobrescriba 'created_at'
                unset($model->created_at);
    
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Dictamen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Dictamen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Dictamen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dictamen::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Genera el folio en el formato "1db1b807d7-XXX"
     */
    protected function generateFolio()
    {
        // La parte constante del folio
        $prefix = '1db1b807d7';

        // Obtener el último folio generado
        $lastFolio = Dictamen::find()->orderBy(['id' => SORT_DESC])->one();

        // Extraer el número del folio (últimos tres caracteres después del guion)
        $lastNumber = $lastFolio ? (int)substr($lastFolio->folio, -3) : 0;

        // Incrementar el número en uno y formatearlo a 3 dígitos
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        // Retornar el nuevo folio completo
        return $prefix . '-' . $newNumber;
    }

    /**
     * Validates an existing Dictamen model.
     * If validation is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionValidate($id)
    {
        $model = $this->findModel($id);

        // Cambiar el estado a "Validado"
        $model->validez_id = 1; // Cambia '1' al ID correspondiente para "Validado"

        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'El dictamen ha sido validado exitosamente.');
            return $this->redirect(['index']);
        }

        Yii::$app->session->setFlash('error', 'Error al validar el dictamen.');
        return $this->redirect(['index']);
    }

}
