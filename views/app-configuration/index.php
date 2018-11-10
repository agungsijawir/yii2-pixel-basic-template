<?php
/**
 * Application Configuration Index View File
 * @var $this \yii\web\View
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $models yii2tech\config\Item[] */
$this->title = Yii::t('app', 'Konfigurasi Aplikasi');
$this->params['breadcrumbs'][] = $this->title;

// register js file khusus untuk app-config, depends ke AssetBundle theme
$this->registerJsFile('/js/libs/app-config.js', ['depends' => 'app\assets\PixelAdminAssets']);

$form = ActiveForm::begin([
    'layout' => 'horizontal',
    'options' => [
        'id' => 'form-app-config',
        'data' => [
            'error-fields-message' => Yii::t('app', 'Mohon cek kembali isian form.')
        ]
    ],
    'fieldConfig' => [
        'template' => "<div class='col-md-0'>{label}</div><div class='col-md-6'>{input} {hint} {error}</div>",
    ]
]);

// populate group name
$listGroups = [];
foreach ($models as $key => $model) {
    $groupName = explode('.', $model->id)[0];
    if (!in_array($groupName, $listGroups)) { $listGroups[] = $groupName; }
}
?>

    <ul class="nav nav-tabs page-block m-t-4 tab-resize-nav" id="configuration-tabs">
        <li class="dropdown tab-resize">
            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="tab-resize-icon"></span></a>
            <ul class="dropdown-menu"></ul>
        </li>
        <?php foreach ($listGroups as $index_list_group => $group_name): ?>
        <li class="<?= ($index_list_group === 0) ? 'active' : ''; ?>">
            <a href="#config-<?= $group_name; ?>" data-toggle="tab" aria-expanded="true">
                <?= Yii::t('app', ucwords($group_name)); ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>

    <div class="tab-content p-y-4">
        <?php foreach ($listGroups as $index_list_group => $group_name): ?>
        <div class="tab-pane fade <?= ($index_list_group === 0) ? 'active in' : ''; ?> " id="config-<?= $group_name; ?>">
            <?php foreach ($models as $key => $model): ?>
                <?php
                $groupName = explode('.', $model->id)[0];
                if ($groupName != $group_name) continue;

                $field = $form->field($model, "[{$key}]value")->textInput(['class' => 'form-control'])->hint(null, ['class' => 'help-block text-muted']);
                $inputType = ArrayHelper::remove($model->inputOptions, 'type');
                switch($inputType) {
                    case 'checkbox':
                        $field->checkbox()->hint(null, ['class' => 'help-block text-muted']);
                        break;
                    case 'textarea':
                        $field->textarea(['class' => 'form-control'])->hint(null, ['class' => 'help-block text-muted']);
                        break;
                    case 'dropDown':
                        $field->dropDownList($model->inputOptions['items'], ['class' => 'form-control'])->hint(null, ['class' => 'help-block text-muted']);
                        break;
                    case 'password':
                        $field->passwordInput()->hint(null, ['class' => 'help-block text-muted']);
                        break;
                }
                echo $field;
                ?>
            <?php endforeach;?>
        </div>
        <?php endforeach; ?>
    </div>

    <hr/>

    <div class="form-group">
        <div class="col-sm-offset-0 col-sm-12">
            <?= Html::submitButton(Yii::t('app', 'Simpan'), ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Batal'), ['/'], ['class' => 'btn btn-default']) ?>
            &nbsp;
            <?= Html::a(
                Yii::t('app', 'Kembali ke Setelan Awal'),
                ['default'],
                [
                    'id' => 'btn-back-to-default',
                    'class' => 'btn btn-danger pull-right',
                    'data' => [
                        'confirm-title' => Yii::t('app', 'Konfirmasi Kembali ke Setelan Awal'),
                        'confirm-message' => Yii::t('app', 'Anda yakin akan mengembalikan setelan aplikasi ke setelan awal?')
                    ]
                ]); ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>