<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "logbook".
 *
 * @property int $id
 * @property int $user_id user ID
 * @property int $contact_id contact ID
 * @property string $date_in Time at
 * @property string $content Content
 *
 * @property Contact $contact
 * @property User $user
 */
class Logbook extends \yii\db\ActiveRecord
{
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
            [['user_id', 'contact_id'], 'integer'],
            [['date_in'], 'safe'],
            [['content'], 'string', 'max' => 2000],
            [['contact_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contact::class, 'targetAttribute' => ['contact_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
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
}
