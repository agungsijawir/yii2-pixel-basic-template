<?php
/**
 * User Profile View page
 * @var $this \yii\web\View
 * @var $model \app\models\User
 * @var $modelUserPassword \app\models\UserPassword
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'User Profile');
?>

<ul class="nav nav-tabs page-block m-t-4 tab-resize-nav" id="account-tabs">
    <li class="dropdown tab-resize">
        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="tab-resize-icon"></span></a>
        <ul class="dropdown-menu"></ul>
    </li>
    <li class="active">
        <a href="#account-profile" data-toggle="tab" aria-expanded="true">
            <?= Yii::t('app', 'Profile'); ?>
        </a>
    </li>
    <li class="">
        <a href="#account-password" data-toggle="tab" aria-expanded="false">
            <?= Yii::t('app', 'Password'); ?>
        </a>
    </li>
    <li class="">
        <a href="#account-notifications" data-toggle="tab" aria-expanded="false">
            <?= Yii::t('app', 'Pemberitahuan'); ?>
        </a>
    </li>
</ul>

<div class="tab-content p-y-4">

    <!-- Profile tab -->

    <div class="tab-pane fade active in" id="account-profile">
        <div class="row">
            <?php $formUserProfile = ActiveForm::begin([
                'id' => 'form-user-profile',
                'layout' => 'default',
                'options' => ['class' => 'col-md-8 col-lg-9'],
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{hint}\n{error}",
                    'options' => ['class' => 'form-group form-group-lg', 'tag' => 'fieldset']
                ]
            ]); ?>
                <div class="p-x-1">
                    <?= $formUserProfile->field($model, 'username')
                        ->textInput(['class' => 'form-control'])
                        ->label(null, ['class' => 'control-label required'])
                        ->hint(Yii::t('app', 'Username yang digunakan saat login.')); ?>
                    <?= $formUserProfile->field($model, 'first_name')
                        ->textInput(['class' => 'form-control'])
                        ->label(null, ['class' => 'control-label required']); ?>
                    <?= $formUserProfile->field($model, 'last_name')
                        ->textInput(['class' => 'form-control'])
                        ->label(null, ['class' => 'control-label required']); ?>
                    <?= $formUserProfile->field($model, 'email')
                        ->textInput(['class' => 'form-control', 'type' => 'email'])
                        ->label(null, ['class' => 'control-label required']); ?>
                    <?= $formUserProfile->field($model, 'language')
                        ->dropDownList(['id' => 'Indonesia', 'en' => 'English'], ['class' => 'form-control', 'type' => 'email'])->hint(Yii::t('app', 'Bahasa antar muka aplikasi. Tersedia bahasa Indonesia / English.')); ?>
                    <?= $formUserProfile->field($model, 'bio')
                        ->textarea(['rows' => 5])->hint(Yii::t('app', Yii::t('app' , 'Biodata Anda'))); ?>

                    <?= Html::submitButton(Yii::t('app', 'Simpan Perubahan'), ['class' => 'btn btn-lg btn-primary m-t-3']); ?>
                    <?= Html::a(Yii::t('app', 'Batal'), ['/'], ['class' => 'btn btn-lg btn-default m-t-3']); ?>
                </div>
            <?php ActiveForm::end(); ?>

            <!-- Spacer -->
            <div class="m-t-4 visible-xs visible-sm"></div>

            <!-- Avatar -->
            <div class="col-md-4 col-lg-3">
                <div class="panel bg-transparent">
                    <div class="panel-body text-xs-center">
                        <?= Html::img(Yii::$app->user->identity->getAvatar(300), ['class' => 'user-profile user-avatar']); ?>
                    </div>
                    <hr class="m-y-0">
                    <div class="panel-body text-xs-center">
                        <div class="text-muted font-size-12"><?= Yii::t('app', 'Foto Avatar Anda dibuat dengan layanan Gravatar dengan menggunakan alamat e-mail Anda.'); ?></div>
                    </div>
                    <div class="panel-body text-xs-center hidden">
                        <button type="button" class="btn btn-primary">Change</button>&nbsp;
                        <button type="button" class="btn"><i class="fa fa-trash"></i></button>
                        <div class="m-t-2 text-muted font-size-12">JPG, GIF or PNG. Max size of 1MB</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- / Profile tab -->

    <!-- Password tab -->

    <div class="tab-pane fade" id="account-password">
        <?php $formUserPassword = ActiveForm::begin([
            'id' => 'form-user-password',
            'layout' => 'default',
            'enableAjaxValidation' => true,
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{hint}\n{error}",
                'options' => ['class' => 'form-group form-group-lg', 'tag' => 'fieldset']
            ]
        ]); ?>
        <div class="p-x-1">
            <?= $formUserPassword->field($modelUserPassword, 'currentPassword')
                ->passwordInput(['class' => 'form-control', 'required' => true])
                ->label(null, ['class' => 'control-label required'])
                ->hint(Yii::t('app', 'Password Anda saat ini.')); ?>

            <?= $formUserPassword->field($modelUserPassword, 'newPassword')
                ->passwordInput(['class' => 'form-control', 'required' => true])
                ->label(null, ['class' => 'control-label required'])
                ->hint(Yii::t('app', 'Password Baru')); ?>

            <?= $formUserPassword->field($modelUserPassword, 'retypeNewPassword')
                ->passwordInput(['class' => 'form-control', 'required' => true])
                ->label(null, ['class' => 'control-label required'])
                ->hint(Yii::t('app', 'Ketik Ulang Password Baru')); ?>

            <?= Html::submitButton(Yii::t('app', 'Ubah Password'), ['class' => 'btn btn-lg btn-primary m-t-3']); ?>
            <?= Html::a(Yii::t('app', 'Batal'), ['/'], ['class' => 'btn btn-lg btn-default m-t-3']); ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

    <!-- / Password tab -->

    <!-- Notifications tab -->

    <div class="tab-pane fade" id="account-notifications">
        <form action="" class="row">
            <div class="col-md-6">
                <div class="panel bg-transparent">
                    <div class="panel-title"><strong>Activity Notifications</strong></div>
                    <hr class="m-y-0">
                    <div class="panel-body">
                        <p>Email me when:</p>

                        <label class="custom-control custom-checkbox m-t-2">
                            <input type="checkbox" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            Someone comments on my article
                        </label>

                        <label class="custom-control custom-checkbox m-t-2">
                            <input type="checkbox" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            Someone answers on my forum thread
                        </label>

                        <label class="custom-control custom-checkbox m-t-2">
                            <input type="checkbox" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            Someone follows me
                        </label>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel bg-transparent">
                    <div class="panel-title"><strong>PixelAdmin Emails</strong></div>
                    <hr class="m-y-0">
                    <div class="panel-body">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            News
                        </label>
                        <small class="text-muted">Periodic news and announcements</small>

                        <label class="custom-control custom-checkbox m-t-2">
                            <input type="checkbox" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            Weekly product updates
                        </label>

                        <label class="custom-control custom-checkbox m-t-2">
                            <input type="checkbox" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            Blog digest
                        </label>
                        <small class="text-muted">Get weekly blog digest emails</small>
                    </div>
                </div>
            </div>

            <div class="col-xs-12"><button type="submit" class="btn btn-lg btn-primary m-t-3">Update notifications</button></div>
        </form>
    </div>

    <!-- / Notifications tab -->

</div>
