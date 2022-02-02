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
    public $password;
    public const TYPE_ADMIN = 1;
    public const TYPE_COMPANY_MANAGER = 2;
    public const TYPE_USER = 3;
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
        $types = self::getTypeList();
        return [
            [['email', 'name', 'password_hash', 'company_id'], 'required'],
            [['type', 'company_id'], 'default', 'value' => null],
            [['type', 'company_id'], 'integer'],
            [['type'], 'in', 'range' => array_keys($types)],
            [['email', 'name', 'password_hash', 'password'], 'string', 'max' => 200],
            [['email'], 'unique'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['company_id' => 'id']],
        ];
    }
    
    public function beforeValidate() {
        if($this->password) {
            $this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
            $this->password = '';
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
            'email' => 'Email',
            'name' => 'Name',
            'password_hash' => 'Password hash',
            'password' => 'Password',
            'type' => 'Access type',
            'company_id' => 'Company',
        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::class, ['id' => 'company_id']);
    }
    
    public static function getTypeList(): array {
        return [
            self::TYPE_ADMIN => 'Administrator',
            self::TYPE_COMPANY_MANAGER => 'Company manager',
            self::TYPE_USER => 'Regular user',
        ];
    }
    
    public static function getListByCompanyId($companyId): array {
        $models = self::find()->andWhere(['company_id' => $companyId])->orderBy('name')->all();
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
}
