<?php

namespace app\models;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $phone;
    public $authKey;
    public $accessToken;

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $users = \Yii::$app->params["users"];
        return isset($users[$id]) ? new static($users[$id]) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (\Yii::$app->params["users"] as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by phone
     *
     * @param  string $phone
     * @return static|null
     */
    public static function findByPhone($phone)
    {
        foreach (\Yii::$app->params["users"] as $user) {
            if (strcasecmp($user['phone'], $phone) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

}
