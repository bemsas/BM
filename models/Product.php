<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name product name
 * @property string|null $description product description
 * @property string|null $full
 * @property string|null $introduction
 * @property string|null $resources
 * @property int $map_id map id 
 *
 * @property Map $map
 * @property CompanyMap[] $companyMaps
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
            [['description', 'full', 'introduction', 'resources'], 'string'],
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
            'full' => 'Full description',
            'map_id' => 'map id',
            'add_link' => 'link to addition resources',
            'introduction' => 'Introduction and Guidance content',
            'resources' => 'Additional Resources content',
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

    public function getCompanyProducts()
    {
        return $this->hasMany(CompanyProduct::class, ['company_id' => 'id']);
    }

    public static function getList() {
        $models = self::find()->orderBy('name')->all();
        $list = [];
        foreach($models as $model) {
            $list[$model->id] = $model->name;
        }
        return $list;
    }
}
