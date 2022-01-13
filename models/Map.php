<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "map".
 *
 * @property int $id ID
 * @property string $name Name
 * @property string $question1_text Question 1
 * @property string $question2_text Question 2
 *
 * @property Answer[] $answers1 question 1 answers
 * @property Answer[] $answers2 question 2 answers
 */
class Map extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'map';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'question1_text', 'question2_text'], 'required'],
            [['name', 'question1_text', 'question2_text'], 'string', 'max' => 200],
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
            'question1_text' => 'Question 1',
            'question2_text' => 'Question 2',
        ];
    }

    /**
     * Gets query for [[Answers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers1()
    {
        return $this->hasMany(Answer::class, ['map_id' => 'id'])->onCondition('question = 1')->orderBy('id');
    }
    
    /**
     * Gets query for [[Answers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers2()
    {
        return $this->hasMany(Answer::class, ['map_id' => 'id'])->onCondition('question = 2')->orderBy('id');
    }
}
