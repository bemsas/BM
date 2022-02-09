<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property int $user_id user ID
 * @property string $name Name
 * @property string|null $comment Comment
 *
 * @property User $user
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'name'], 'required'],
            [['user_id'], 'default', 'value' => null],
            [['user_id'], 'integer'],
            [['name'], 'string', 'max' => 200], 
            [['comment'], 'string', 'max' => 2000],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User',
            'name' => 'Name',
            'comment' => 'Comment',
        ];
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
    
    public static function getListByCompanyId($companyId): array {
        $models = self::find()->joinWith('user u', false)->andWhere(['u.company_id' => $companyId])->orderBy('contact.name')->all();
        $list = [];
        foreach($models as $model) {
            $list[$model->id] = $model->name;
        }
        return $list;
    } 
    
    public static function getListByUserId($userId): array {
        $models = self::find()->andWhere(['user_id' => $userId])->orderBy('name')->all();
        $list = [];
        foreach($models as $model) {
            $list[$model->id] = $model->name;
        }
        return $list;
    } 
    
    public static function getList(): array {
        $models = self::find()->orderBy('name')->all();
        $list = [];
        foreach($models as $model) {
            $list[$model->id] = $model->name;
        }
        return $list;
    }
    public static function addOrFind(User $user, string $name): Contact {
        $model = self::findOne(['user_id' => $user->id, 'name' => $name]);
        if(!$model) {
            $model = new Contact();
            $model->name = $name;
            $model->user_id = $user->id;
            $model->save();
        }
        return $model;
    }
}
