<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name product name
 * @property string|null $description product description
 * @property int $map_id map id
 *
 * @property Map $map
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'map_id'], 'required'],
            [['description'], 'string'],
            [['map_id'], 'default', 'value' => null],
            [['map_id'], 'integer'],
            [['name'], 'string', 'max' => 200],
            [['map_id'], 'exist', 'skipOnError' => true, 'targetClass' => Map::class, 'targetAttribute' => ['map_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'product name',
            'description' => 'product description',
            'map_id' => 'map id',
        ];
    }

    /**
     * Gets query for [[Map]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMap()
    {
        return $this->hasOne(Map::class, ['id' => 'map_id']);
    }
}
