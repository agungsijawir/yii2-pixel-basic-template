<?php

namespace app\controllers;
use app\models\Configurations;
use Yii;
use yii\web\Controller;

/**
 * Class AppConfigurationController
 *
 * @package app\controllers
 */
class AppConfigurationController extends Controller
{
    /**
     * Performs batch updated of application configuration records.
     *
     * @return string|\yii\web\Response
     * @throws \yii\base\InvalidConfigException
     */
    public function actionIndex()
    {
        /* @var $configManager \yii2tech\config\Manager */
        $configManager = Yii::$app->get('configManager');

        $models = $configManager->getItems();

        if (Configurations::loadMultiple($models, Yii::$app->request->post()) && Configurations::validateMultiple($models)) {
            $configManager->saveValues();
            Yii::$app->session->setFlash('success', 'Perubahan konfigurasi aplikasi disimpan.');
            return $this->refresh();
        }

        return $this->render('index', [
            'models' => $models,
        ]);
    }

    /**
     * Restores default values for the application configuration.
     *
     * @return \yii\web\Response
     * @throws \yii\base\InvalidConfigException
     */
    public function actionDefault()
    {
        /* @var $configManager \yii2tech\config\Manager */
        $configManager = Yii::$app->get('configManager');
        $configManager->clearValues();
        Yii::$app->session->setFlash('success', Yii::t('app', 'Setelan aplikasi dikembalikan ke setelan awal.'));
        return $this->redirect(['index']);
    }
}