<?php

namespace app\controllers;

use app\models\ForgotPassword;
use app\models\User;
use app\models\UserPassword;
use Yii;
use yii\bootstrap\ActiveForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'layout' => 'error'
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        // hanya untuk action ini, dipakai layout `login`
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        $modelForgotPassword = new ForgotPassword();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->login()) {
                return $this->goBack();
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app-login', 'Username atau Password tidak valid.'));
                return $this->refresh();
            }
        }

        if ($modelForgotPassword->load(Yii::$app->request->post())) {
            if ($modelForgotPassword->sendForgotEmailLink()) {
                Yii::$app->session->setFlash('success', Yii::t('app-login', 'Email petunjuk setel ulang password sudah dikirim.'));
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app-login', 'Email tidak terdaftar'));
                return $this->refresh();
            }
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
            'modelForgotPassword' => $modelForgotPassword
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Display User Profile page
     */
    public function actionUserProfile()
    {
        $model = User::find()->where(['id' => Yii::$app->user->identity->getId()])->one();
        /**
         * @var $modelUserPassword UserPassword
         */
        $modelUserPassword = UserPassword::find()->where(['id' => Yii::$app->user->identity->getId()])->one();

        if ($model === null) {
            throw new NotFoundHttpException(Yii::t('app', 'Halaman yang diminta tidak ditemukan.'));
        }

        // Ajax Validation Handler
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if (Yii::$app->request->isAjax && $modelUserPassword->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($modelUserPassword);
        }

        // Saving Form
        if ($model->load(Yii::$app->request->post()) && $model->update()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Perubahan Data Disimpan'));

            return $this->refresh();
        }

        if ($modelUserPassword->load(Yii::$app->request->post()) && $modelUserPassword->simpanPassword()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Password sukses diubah'));

            return $this->refresh();
        }

        return $this->render('user-profile', ['model' => $model, 'modelUserPassword' => $modelUserPassword]);
    }
}
