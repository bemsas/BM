<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "logbook".
 *
 * @property int $id
 * @property int $user_id user ID
 * @property int $contact_id contact ID
 * @property int $cell_id cell ID
 * @property string $date_in Time at
 * @property string $content Content
 *
 * @property Contact $contact
 * @property User $user
 * @property Cell $cell
 */
class Logbook extends \yii\db\ActiveRecord
{
    public $fromCell = false;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'logbook';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'contact_id', 'date_in', 'content'], 'required'],
            [['user_id', 'contact_id'], 'default', 'value' => null],
            [['user_id', 'contact_id', 'cell_id'], 'integer'],
            [['date_in', 'fromCell'], 'safe'],
            [['content'], 'string', 'max' => 2000],
            [['contact_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contact::class, 'targetAttribute' => ['contact_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['cell_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cell::class, 'targetAttribute' => ['cell_id' => 'id']],
        ];
    }
    
    public function beforeValidate() {
        if(get_class($this) == 'app\models\Logbook') {
            $this->date_in = date('Y-m-d H:i:s');
        }
        return parent::beforeValidate();
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User',
            'contact_id' => 'Contact',
            'cell_id' => 'Cell',
            'date_in' => 'Time at',
            'content' => 'Content',
        ];
    }

    /**
     * Gets query for [[Contact]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContact()
    {
        return $this->hasOne(Contact::class, ['id' => 'contact_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
    /**
     * Gets query for [[Cell]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCell()
    {
        return $this->hasOne(Cell::class, ['id' => 'cell_id']);
    }
    
    
    public static function addChooseCell(User $user, Contact $contact, Cell $cell, string $cellCode): Logbook {
        $model = new Logbook();
        $model->user_id = $user->id;
        $model->contact_id = $contact->id;
        $model->cell_id = $cell->id;
        $model->content = "Customer landed on cell '$cellCode'!";
        $model->save();
        return $model;
    }

    public static function findLastByCellIds($cellIds): ?Logbook {
        return self::find()->andWhere(['cell_id' => $cellIds])->orderBy('date_in desc')->one();
    }
    public static function getCountsByCellIds($cellIds): array {
        $rows = self::find()
            ->andWhere(['cell_id' => $cellIds])
            ->groupBy(new \yii\db\Expression("date_trunc('day', date_in), contact_id"))
            ->select(new \yii\db\Expression("date_trunc('day', date_in)::date AS date_in, contact_id, max(cell_id) AS cell_id"))->asArray(true)->orderBy('date_in')->all();

        $contactPositions = [];
        $oldDate = null;
        $lastPosition = [];
        foreach($rows as $row) {
            if($oldDate != $row['date_in']) {                
                $oldDate = $row['date_in'];
                if($lastPosition) {
                    $contactPositions[$oldDate] = $lastPosition;
                }
            }
            $lastPosition[$row['contact_id']] = $row['cell_id'];
        }
        $contactPositions[$oldDate] = $lastPosition;
        $contactPositions[date('Y-m-d')] = $lastPosition; //add current date

        $cells = [];
        foreach($contactPositions as $date => $position) {
            foreach($position as $contact_id => $cell_id) {
                if(!isset($cells[$cell_id][$date])) {
                    $cells[$cell_id][$date] = 0;
                }
                $cells[$cell_id][$date]++;
            }            
        }
        return $cells;
    }
}
