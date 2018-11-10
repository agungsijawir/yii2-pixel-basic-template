<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\LoginForm */
/* @var $modelForgotPassword app\models\ForgotPassword */

use app\components\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-signin-modal modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="box m-a-0">
                <div class="box-row">
                    <div class="box-cell col-md-5 bg-primary p-a-4">
                        <div class="text-xs-center text-md-left">
                            <a class="px-demo-brand px-demo-brand-lg text-center " href="/">
                                <?= Html::img(['/favicon.ico'], ['style' => 'max-width: 100%', 'class' => 'm-b-1']); ?>
                                <br/>
                                <span class="font-size-20 line-height-1"><?= Yii::$app->params['general.appName']; ?></span>
                            </a>
                            <div class="font-size-15 m-t-1 line-height-1 text-center"><?= Yii::$app->params['general.subAppName']; ?></div>
                        </div>
                    </div>

                    <div class="box-cell col-md-7">
                        <?= Alert::widget() ?>
                        <!-- Sign In form -->
                        <?php $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'layout' => 'horizontal',
                            'options' => ['id' => 'page-signin-form', 'class' => 'p-a-4'],
                        ]); ?>
                        <h4 class="m-t-0 m-b-4 text-xs-center font-weight-semibold"><?= Yii::t('app-login', 'Masuk ke Akun Anda'); ?></h4>

                        <fieldset class="page-signin-form-group form-group form-group-lg">
                            <div class="page-signin-icon text-muted"><i class="ion-person"></i></div>
                            <input type="text" class="page-signin-form-control form-control" id="loginform-username" name="LoginForm[username]" placeholder="<?= Yii::t('app-login', 'Username atau Email'); ?>">
                        </fieldset>

                        <fieldset class="page-signin-form-group form-group form-group-lg">
                            <div class="page-signin-icon text-muted"><i class="ion-asterisk"></i></div>
                            <input type="password" class="page-signin-form-control form-control" id="loginform-password" name="LoginForm[password]" placeholder="<?= Yii::t('app-login', 'Password'); ?>">
                        </fieldset>

                        <div class="clearfix">
                            <label class="custom-control custom-checkbox pull-xs-left">
                                <input type="checkbox" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                Remember me
                            </label>

                        </div>

                        <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3"><?= Yii::t('app-login', 'Masuk'); ?></button>

                        <?php ActiveForm::end(); ?>


                        <div class="p-y-3 p-x-4 b-t-1 bg-white darken" id="page-signin-social">
                            <p>
                                <a href="#" class="font-size-12 text-muted pull-xs-left" id="px-demo-signup-link"><?= Yii::t('app-login', 'Daftar Sekarang'); ?></a>
                                <a href="#" class="font-size-12 text-muted pull-xs-right" id="page-signin-forgot-link"><?= Yii::t('app-login', 'Lupa Password Anda?'); ?></a>
                            </p>
                        </div>
                        <!-- / Sign In form -->

                        <!-- Reset form -->

                        <?php $formResetPassword = ActiveForm::begin([
                            'id' => 'login-form',
                            'layout' => 'horizontal',
                            'options' => ['id' => 'page-signin-forgot-form', 'class' => 'p-a-4'],
                            'fieldConfig' => [
                                'template' => "{label}\n{input}\n{hint}\n{error}",
                                'options' => ['class' => 'form-group form-group-lg', 'tag' => 'fieldset']
                            ]
                        ]); ?>

                            <h4 class="m-t-0 m-b-4 text-xs-center font-weight-semibold"><?= Yii::t('app', 'Setel Ulang Password'); ?></h4>

                            <?= $formResetPassword->field($modelForgotPassword, 'userEmail')->input('email', ['class' => 'form-control', 'placeholder' => 'Email'])->label(false) ?>

                            <?= $formResetPassword->field($modelForgotPassword, 'verifyCode')->widget(\yii\captcha\Captcha::class, [
                                'template' => '<div class="row"><div class="col-lg-12 reset-captcha">{image}</div><div class="col-lg-12">' .
                                    '<div class="input-group">{input} <div class="input-group-addon"><a href="#" class="btn btn-sm btn-default reload-captcha" id="btn-reload-captcha" title="' . Yii::t('app', 'Perbarui Captcha') . '"><i class="glyphicon glyphicon-refresh"></i> ' . Yii::t('app', 'Perbarui Captcha') . '</a></div></div>' .
                                    '</div></div>',
                            ])->label(false) ?>

                            <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3"><?= Yii::t('app-login', 'Kirim Tautan Reset Password'); ?></button>

                        <?php ActiveForm::end(); ?>
                        <div class="p-y-3 p-x-4 b-t-1 bg-white darken hidden" id="page-back-to-login">
                            <p>
                                <a href="#" class="font-size-12 text-muted pull-xs-left" id="page-signin-forgot-back">← <?= Yii::t('app', 'Kembali ke Form Login'); ?></a>
                            </p>
                        </div>
                        <!-- / Reset form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>