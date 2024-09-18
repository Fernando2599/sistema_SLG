<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sede".
 *
 * @property int $id
 * @property string $nombre
 * @property string $direccion
 * @property int|null $created_by
 * @property int|null $updated_by
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
            [['nombre', 'direccion'], 'required'],
            [['created_by', 'updated_by'], 'integer'],
            [['nombre', 'direccion'], 'string', 'max' => 255],
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
        ];
    }
}
