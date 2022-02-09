<?php

namespace app\models;

use app\models\Answer;
use app\models\Cell;
use app\models\Shift;
use Yii;

/**
 * This is the model class for table "map".
 *
 * @property int $id ID
 * @property string $name Name
 * @property string $question1_text Question 1
 * @property string $question2_text Question 2
 * @property int $size
 * @property string $intro
 *
 * @property Answer[] $answers1 question 1 answers
 * @property Answer[] $answers2 question 2 answers
 * @property MapCompany[] $mapCompanies
 */
class Map extends \yii\db\ActiveRecord
{
    public $contactName;
    public $question1, $question2;    
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
        $sizes = self::getSizeList();
        return [
            [['name', 'question1_text', 'question2_text', 'size'], 'required'],
            [['size'], 'integer'],
            [['size'], 'in', 'range' =>array_keys($sizes)],
            [['name', 'question1_text', 'question2_text', 'contactName'], 'string', 'max' => 200],
            [['intro'], 'string', 'max' => 2000],
            [['question1', 'question2'], 'safe']
        ];
    }       
    
    public function afterSave($insert, $changedAttributes) {
        if($insert) {
            $answers1 = [];
            $answers2 = [];
            for($i = 1; $i <= $this->size; $i++) {
                $answers1[$i] = Answer::add($this, 1, "Answer $i for question 1");
                $answers2[$i] = Answer::add($this, 2, "Answer $i for question 2");                
            }
            $cells = [];
            foreach($answers1 as $i => $answer1) {
                foreach($answers2 as $j => $answer2) {
                    if(in_array($j, [$i, $i+1, $i-1])) {
                        $cell = Cell::add($answer1, $answer2);                        
                        $cells[$i][$j] = $cell;
                        if($j == $i && $j > 1) {
                            Shift::add($cell, $cells[$i-1][$j-1]);                            
                        } elseif($j == $i + 1) {
                            Shift::add($cell, $cells[$i][$j-1]);                            
                        } elseif($j == $i - 1 && $j > 1) {
                            Shift::add($cell, $cells[$i-1][$j]);                            
                        }
                    }
                }
            }
        }
        parent::afterSave($insert, $changedAttributes);
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
            'size' => 'Size',
            'intro' => 'Intro content'
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
    
    /**
     * Gets query for [[MapCompanies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMapCompanies()
    {
        return $this->hasMany(MapCompany::class, ['map_id' => 'id']);
    }
    
    public static function getSizeList(): array {
        return [
            3 => '3x3',
            4 => '4x4',
            5 => '5x5',
        ];
    }
}
