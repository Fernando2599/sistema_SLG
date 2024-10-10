<?php

namespace backend\models;

use Yii;

//Librerias colocadas por mi
use yii\behaviors\BlameableBehavior;


/**
 * This is the model class for table "sede".
 *
 * @property int $id
 * @property string $nombre
 * @property string $direccion
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string $numero_registro
 */
class Sede extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sede';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'direccion', 'numero_registro'], 'required'],
            [['created_by', 'updated_by'], 'integer'],
            [['nombre', 'direccion'], 'string', 'max' => 255],
            [['numero_registro'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'direccion' => 'Direccion',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'numero_registro' => 'Numero Registro',
        ];
    }

    
    /*------------------------------------------------------------------------------------- */
    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }
}
