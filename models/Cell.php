<?php

namespace app\models;

use Yii;
use app\models\Answer;

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
    /**
     * Получить все переходы по цепочке из ячейки в a1
     * @return Shift[]
     */
    public function getAllShifts(): array {
        $result = [];
        $shifts = $this->shifts;
        while($shifts) {
            $newShifts = [];
            foreach($shifts as $shift) {
                $result[] = $shift;
                $newShifts = array_merge($newShifts, $shift->cellEnd->shifts);
            }
            $shifts = $newShifts;
        }
        return $result;
    }
    /**
     * Get all cell Codes by mapId
     * @param int $mapId map id
     * @return array
     */
    public static function getCodeList(int $mapId): array {
        $positions1 = Answer::getAnswerPositions1($mapId);
        $positions2 = Answer::getAnswerPositions2($mapId);
        
        $list = [];
        $models = self::find()->joinWith(['answer1 a1'])->andWhere(['a1.map_id' => $mapId])->orderBy('answer1_id, answer2_id')->all();        
        foreach($models as $model) {
            $code = $positions1[$model->answer1_id].$positions2[$model->answer2_id];
            $list[$model->id] = $code;
        }
        return $list;
    }
    
    public static function add(Answer $answer1, Answer $answer2): Cell {
        $cell = new Cell();
        $cell->answer1_id = $answer1->id;
        $cell->answer2_id = $answer2->id;
        $cell->save();
        return $cell;
    }
}
