<?php

namespace app\models;
use Yii;

/**
 * Class UserPassword
 *
 * @package app\models
 */
class UserPassword extends User
{
    /**
     * @var string
     */
    public $newPassword;
    /**
     * @var string
     */
    public $retypeNewPassword;
    /**
     * @var string
     */
    public $currentPassword;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['newPassword', 'retypeNewPassword', 'currentPassword'], 'required'],
            [['retypeNewPassword'], 'compare', 'compareAttribute' => 'newPassword', 'operator' => '=='],
            // an inline validator defined as the model method validateCountry()
            ['currentPassword', 'validateCurrentPassword'],
        ];
    }
    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'newPassword' => Yii::t('app', 'Password Baru'),
            'retypeNewPassword' => Yii::t('app', 'Ketik Ulang Password Baru'),
            'currentPassword' => Yii::t('app', 'Password Saat Ini'),
        ];
    }
    /**
     * @param $attribute
     * @param $params
     * @param $validator
     */
    public function validateCurrentPassword($attribute, $params, $validator)
    {
        if (!$this->validatePassword($this->$attribute)) {
            $this->addError($attribute, \Yii::t('app', 'Password saat ini tidak valid.'));
        }
    }
    /**
     * @return bool
     * @throws \Throwable
     */
    public function simpanPassword()
    {
        // $modelUser = static::findOne(['username' => $username]);
        $this->setPassword($this->newPassword);
        $this->generateAuthKey();
        return $this->update(false);
    }
}