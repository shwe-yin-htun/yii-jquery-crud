<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'required'],
            [['username', 'email', 'password'], 'string', 'max' => 255],
            ['email','email'],
            ['email', 'unique']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
        ];
    }
}
