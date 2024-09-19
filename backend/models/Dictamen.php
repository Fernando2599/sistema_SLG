<?php

namespace backend\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "dictamen".
 *
 * @property int $id
 * @property int $sede_id
 * @property string $rfc
 * @property string $razon_social
 * @property string $nombre_comercial
 * @property string $giro_comercial
 * @property string $representante_legal
 * @property string $direccion
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property string $folio
 * @property int $validez_id
 */
class Dictamen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dictamen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sede_id', 'rfc', 'razon_social', 'nombre_comercial', 'giro_comercial', 'representante_legal', 'direccion', 'folio', 'validez_id'], 'required'],
            [['sede_id', 'created_by', 'updated_by', 'validez_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['rfc', 'folio'], 'string', 'max' => 20],
            [['razon_social', 'nombre_comercial', 'giro_comercial', 'representante_legal', 'direccion'], 'string', 'max' => 255],
        ];
    }


    public function behaviors()
    {
        return [
            // Auto-fill created_at and updated_at with current timestamp
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => function() {
                    return date('Y-m-d H:i:s'); // Use MySQL compatible datetime format
                },
            ],
            // Auto-fill created_by and updated_by with current user ID
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }
    



    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sede_id' => 'Sede ID',
            'rfc' => 'Rfc',
            'razon_social' => 'Razon Social',
            'nombre_comercial' => 'Nombre Comercial',
            'giro_comercial' => 'Giro Comercial',
            'representante_legal' => 'Representante Legal',
            'direccion' => 'Direccion',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'folio' => 'Folio',
            'validez_id' => 'Validez ID',
        ];
    }

    public function getEstado()
    {
        return $this->hasOne(Validacion::class, ['id' => 'validez_id']);
    }

    /**
     * Método para obtener el nombre del estado
     */
    public function getEstadoNombre()
    {
        return $this->estado ? $this->estado->estado : 'Desconocido'; // Asegúrate de que 'estado' es el nombre de la columna en 'validacion'
    }
    
}


