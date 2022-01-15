<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shift".
 *
 * @property int $id
 * @property int $cell_start_id start cell ID
 * @property int $cell_end_id end cell ID
 * @property string $question1_content Question 1 content
 * @property string $question2_content Question 2 content
 *
 * @property Cell $cellEnd
 * @property Cell $cellStart
 */
class Shift extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shift';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cell_start_id', 'cell_end_id', 'question1_content', 'question2_content'], 'required'],
            [['cell_start_id', 'cell_end_id'], 'default', 'value' => null],
            [['cell_start_id', 'cell_end_id'], 'integer'],
            [['question1_content', 'question2_content'], 'string', 'max' => 2000],
            [['cell_start_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cell::class, 'targetAttribute' => ['cell_start_id' => 'id']],
            [['cell_end_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cell::class, 'targetAttribute' => ['cell_end_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cell_start_id' => 'Start cell',
            'cell_end_id' => 'End cell',
            'question1_content' => 'Question 1 content',
            'question2_content' => 'Question 2 content',
        ];
    }

    /**
     * Gets query for [[CellEnd]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCellEnd()
    {
        return $this->hasOne(Cell::class, ['id' => 'cell_end_id']);
    }

    /**
     * Gets query for [[CellStart]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCellStart()
    {
        return $this->hasOne(Cell::class, ['id' => 'cell_start_id']);
    }
}
