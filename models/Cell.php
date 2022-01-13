<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cell".
 *
 * @property int $id
 * @property int $answer1_id first answer ID
 * @property int $answer2_id second answer ID
 *
 * @property Answer $answer1
 * @property Answer $answer2
 * @property Shift[] $shifts 
 */
class Cell extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cell';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['answer1_id', 'answer2_id'], 'required'],
            [['answer1_id', 'answer2_id'], 'default', 'value' => null],
            [['answer1_id', 'answer2_id'], 'integer'],
            [['answer1_id', 'answer2_id'], 'unique', 'targetAttribute' => ['answer1_id', 'answer2_id']],
            [['answer1_id'], 'exist', 'skipOnError' => true, 'targetClass' => Answer::class, 'targetAttribute' => ['answer1_id' => 'id']],
            [['answer2_id'], 'exist', 'skipOnError' => true, 'targetClass' => Answer::class, 'targetAttribute' => ['answer2_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'answer1_id' => 'first answer',
            'answer2_id' => 'second answer',
        ];
    }

    /**
     * Gets query for [[Answer1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnswer1()
    {
        return $this->hasOne(Answer::class, ['id' => 'answer1_id']);
    }

    /**
     * Gets query for [[Answer2]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnswer2()
    {
        return $this->hasOne(Answer::class, ['id' => 'answer2_id']);
    }

    /**
     * Gets query for [[Shifts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShifts()
    {
        return $this->hasMany(Shift::class, ['cell_start_id' => 'id']);
    }    
}
