<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "answer".
 *
 * @property int $id ID
 * @property int $map_id map ID
 * @property string $content Content
 * @property int $question Question 1/2
 *
 * @property Cell[] $cells
 * @property Cell[] $cells0
 * @property Map $map
 */
class Answer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'answer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $questions = self::getQuestionList();
        return [
            [['map_id', 'content'], 'required'],
            [['map_id', 'question'], 'default', 'value' => null],
            [['map_id', 'question'], 'integer'],
            [['question'], 'in', 'range' => array_keys($questions)],
            [['content'], 'string', 'max' => 500],
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
            'content' => 'Content',
            'question' => 'Question 1/2',
        ];
    }

    /**
     * Gets query for [[Cells]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCells()
    {
        return $this->hasMany(Cell::class, ['answer1_id' => 'id']);
    }

    /**
     * Gets query for [[Cells0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCells0()
    {
        return $this->hasMany(Cell::class, ['answer2_id' => 'id']);
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
    
    public static function getQuestionList(): array {
        return [
            1 => 'first',
            2 => 'second'
        ];
    }
}
