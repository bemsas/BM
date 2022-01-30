<?php

namespace app\models;
use app\models\User;

class UserIdentity extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;
    
    public $user;
    
    private static function generate(User $user): UserIdentity {
        $identity = new self();
        $identity->id = $user->id;
        $identity->username = $user->email;
        $identity->password = $user->password_hash;
        $identity->user = $user;
        return $identity;
    }


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return ($user = User::findOne($id)) ? self::generate($user) : null;        
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return ($user = User::findOne(['password_hash' => $token])) ? self::generate($user) : null; //@todo need token field later        
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return ($user = User::findOne(['email' => $username])) ? self::generate($user) : null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->user->password_hash);        
    }
}
