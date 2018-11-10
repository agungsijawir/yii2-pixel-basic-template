<?php
namespace app\models;
use yii\base\Model;

/**
 * Class ForgotPassword
 *
 * @package app\models
 */
class ForgotPassword extends Model
{
    public $userEmail;
    public $verifyCode;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // userEmail & verifyCode are required
            [['userEmail', 'verifyCode'], 'required'],
            // userEmail has to be a valid email address
            ['userEmail', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => \Yii::t('app', 'Kode Verifikasi'),
        ];
    }
    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function sendForgotEmailLink()
    {
        if ($this->validate()) {
            $userData = User::findOne(['email' => $this->userEmail]);

            if ($userData === null) return false;

            \Yii::$app->mailer->compose()
                ->setTo($this->userEmail)
                ->setFrom([$this->userEmail => $userData->getFullName()])
                ->setSubject(\Yii::t('app', 'Permintaan Ubah Password: ') . $this->userEmail)
                ->setTextBody('') // TODO: Body Email
                ->send();

            return true;
        }
        return false;
    }
}