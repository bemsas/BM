<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id ID
 * @property string $email Email
 * @property string $name Name
 * @property string $password_hash Password hash
 * @property int $type Access type
 * @property int $company_id company ID
 *
 * @property Company $company
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'name', 'password_hash', 'company_id'], 'required'],
            [['type', 'company_id'], 'default', 'value' => null],
            [['type', 'company_id'], 'integer'],
            [['email', 'name', 'password_hash'], 'string', 'max' => 200],
            [['email'], 'unique'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'name' => 'Name',
            'password_hash' => 'Password hash',
            'type' => 'Access type',
            'company_id' => 'company ID',
        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }
}
