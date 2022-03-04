<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $id ID
 * @property string $name Name
 * @property string $color color
 * @property string $color_text text color
 * @property string $icon icon url
 *
 * @property User[] $users
 */
class Company extends \yii\db\ActiveRecord
{
    const DEFAULT_COLOR = '#c3d500';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 200],
            [['color', 'color_text'], 'string', 'max' => 20],
            [['icon'], 'string', 'max' => 2000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'color' => 'Banner color',
            'color_text' => 'Text banner color',
            'icon' => 'Icon URL'
        ];
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['company_id' => 'id']);
    }
    
    public static function getList(): array {
        $models = self::find()->orderBy('name')->all();
        $list = [];
        foreach($models as $model) {
            $list[$model->id] = $model->name;
        }
        return $list;
    }
    
    public function getColor(): string {
        if($this->color) {
            return $this->color;
        }
        return '#c3d500';
    }
}
