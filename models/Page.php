<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "page".
 *
 * @property int $id
 * @property string $name Page name
 * @property string|null $content Page content
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['content'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Page name',
            'content' => 'Page content',
        ];
    }
}
