<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "map_company".
 *
 * @property int $id
 * @property int $map_id map ID
 * @property int $company_id company ID
 *
 * @property Company $company
 * @property Map $map
 */
class MapCompany extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'map_company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['map_id', 'company_id'], 'required'],
            [['map_id', 'company_id'], 'default', 'value' => null],
            [['map_id', 'company_id'], 'integer'],
            [['map_id', 'company_id'], 'unique', 'targetAttribute' => ['map_id', 'company_id']],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['company_id' => 'id']],
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
            'map_id' => 'map ID',
            'company_id' => 'company ID',
        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::class, ['id' => 'company_id']);
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
