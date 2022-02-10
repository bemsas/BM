<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shift".
 *
 * @property int $id
 * @property int $cell_start_id start cell ID
 * @property int $cell_end_id end cell ID 
 
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
            [['cell_start_id', 'cell_end_id'], 'required'],
            [['cell_start_id', 'cell_end_id'], 'default', 'value' => null],
            [['cell_start_id', 'cell_end_id'], 'integer'],            
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
    
    public static function add(Cell $start, Cell $end): Shift {
        $shift = new self();
        $shift->cell_start_id = $start->id;
        $shift->cell_end_id = $end->id;
        $shift->save();
        return $shift;
    }
    
    public function isDiagonal() {
        return $this->cellStart->answer1_id != $this->cellEnd->answer1_id 
            && $this->cellStart->answer2_id != $this->cellEnd->answer2_id;
    }
}
