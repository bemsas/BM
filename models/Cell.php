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
 * @property string $color color
 * @property string $question1_compact compact content for question 1
 * @property string $question2_compact compact content for question 2
 * @property string $content full content
 * @property string $links links
 *
 * @property Answer $answer1
 * @property Answer $answer2
 * @property Shift[] $shifts 
 * @property Shift[] $prevShifts 
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
            [['answer1_id', 'answer2_id', 'question1_compact', 'question2_compact', 'content'], 'required'],
            [['answer1_id', 'answer2_id'], 'default', 'value' => null],
            [['answer1_id', 'answer2_id'], 'integer'],
            [['answer1_id', 'answer2_id'], 'unique', 'targetAttribute' => ['answer1_id', 'answer2_id']],
            [['answer1_id'], 'exist', 'skipOnError' => true, 'targetClass' => Answer::class, 'targetAttribute' => ['answer1_id' => 'id']],
            [['answer2_id'], 'exist', 'skipOnError' => true, 'targetClass' => Answer::class, 'targetAttribute' => ['answer2_id' => 'id']],
            [['color'], 'string', 'max' => 20],
            [['question1_compact', 'question2_compact'], 'string', 'max' => 200],
            [['content', 'links'], 'string', 'max' => 4000],
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
            'color' => 'background color',
            'question1_compact' => 'Question 1 compact text',
            'question2_compact' => 'Question 2 compact text',
            'content' => 'Content',
            'links' => 'links'
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
     * Gets query for [[Shifts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrevShifts() {
        return $this->hasMany(Shift::class, ['cell_end_id' => 'id']);
    }
    /**
     * Получить все переходы по цепочке из ячейки в a1
     * @return Shift[]
     */
    public function getAllShifts(): array {
        $result = [];
        $cellCodes = self::getCodeList($this->answer1->map_id);
        
        $shifts = $this->prevShifts;
        while($shifts) {
            $newShifts = [];
            foreach($shifts as $shift) {
                if($shift->isDiagonal()) {
                    $result = array_merge([$shift], $result);
                    $newShifts = array_merge($newShifts, $shift->cellStart->prevShifts);
                }                
            }
            $shifts = $newShifts;
        }
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
    public static function findAllByMapId(int $mapId): array {
        return self::find()->joinWith(['answer1 a1'])
            ->andWhere(['a1.map_id' => $mapId])
            ->orderBy('cell.id')->all();
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
        $cell->question1_compact = 'question 1 compact content';
        $cell->question2_compact = 'question 2 compact content';
        $cell->content = 'shift full content';
        $cell->color = null;        
        $cell->save();
        return $cell;
    }
    
    public static function defaultColors(): array {
        return [
            'A1' => '#EFEECC',
            'A2' => '#E7E5AA',
            'A3' => '#DEDB7D',
            'A4' => '#D5D10E',
            'A5' => '#E1DD01',
            'B1' => '#E0E8E9',
            'B2' => '#CEDBDD',
            'B3' => '#BACCCF',
            'B4' => '#A2BDC1',
            'B5' => '#89A8AC',
            'C1' => '#DEE0E0',
            'C2' => '#CACDCD',
            'C3' => '#B4B9B9',
            'C4' => '#9AA1A1',
            'C5' => '#888E8E',
            'D1' => '#CDCFD2',
            'D2' => '#ADB1B6',
            'D3' => '#898A92',
            'D4' => '#7E8088',
            'D5' => '#717277',
            'E1' => '#C8C5D2',
            'E2' => '#BDB9C8',
            'E3' => '#A7A4B0',
            'E4' => '#8F8C99',
            'E5' => '#64616C',
        ];
    }
    
    public function getColor(string $code): string {
        if($this->color) {
            return $this->color;
        }
        $defaultColors = self::defaultColors();
        return $defaultColors[$code];
    }
}
