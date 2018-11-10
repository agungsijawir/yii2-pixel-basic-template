<?php
/**
 * Inisialisasi untuk RBAC
 */
namespace app\commands;
use app\models\User;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

/**
 * Initialize RBAC for first use!
 *
 * @package app\commands
 */
class InitRbacController extends Controller
{
    /**
     * Install RBAC Data to Database
     * @throws \yii\base\Exception
     */
    public function actionInstall()
    {
        $confirmInstallRbac = Console::confirm(\Yii::t('app', 'Ini akan memasang inisialisasi RBAC. Lanjutkan? '));

        if (!$confirmInstallRbac) {
            Console::output(\Yii::t('app', 'Proses dibatalkan!'));
            exit(ExitCode::OK);
        }

        $authManager = \Yii::$app->authManager;
        $authManager->removeAll();

        // Add AccessHomeDashboard
        $pAccessHomeDashboard = $authManager->createPermission('AccessHomeDashboard');
        $pAccessHomeDashboard->description = 'Access Home Dashboard - All level user may access Home Dashboard';
        $authManager->add($pAccessHomeDashboard);

        // Add Access Role Manager
        $pAccessRoleManager = $authManager->createPermission('AccessRoleManager');
        $pAccessRoleManager->description = 'Access Role Manager User Interface - Only Admin role can access this permission.';
        $authManager->add($pAccessRoleManager);

        // Create Url for Application Configurations
        $urlAppConfigurations = $authManager->createPermission('/app-configuration/*');
        $urlAppConfigurations->description = 'End Point for Application Configurations';
        $authManager->add($urlAppConfigurations);
        $authManager->addChild($pAccessRoleManager, $urlAppConfigurations);

        // Create Url for Role Manager
        $urlRoleManager = $authManager->createPermission('/role-manager/*');
        $urlRoleManager->description = 'End Point for Role Manager';
        $authManager->add($urlRoleManager);
        $authManager->addChild($pAccessRoleManager, $urlRoleManager);

        // Create Url for Site Access
        $urlSite = $authManager->createPermission('/site/*');
        $urlSite->description = 'End Point for Site Controller';
        $authManager->add($urlSite);
        $authManager->addChild($pAccessHomeDashboard, $urlSite);

        $roleUser = $authManager->createRole('RoleUser');
        $roleUser->description = 'Role User - Basic User for daily use';
        $authManager->add($roleUser);
        $authManager->addChild($roleUser, $pAccessHomeDashboard);

        // Create Admin role, and give Admin role access to AccessRoleManager
        // Also, as highest Role, Admin can access what User can access.
        $roleAdmin = $authManager->createRole('RoleAdmin');
        $roleAdmin->description = 'Role Administrator - Highest Role';
        $authManager->add($roleAdmin);
        $authManager->addChild($roleAdmin, $pAccessRoleManager);
        $authManager->addChild($roleAdmin, $roleUser);

        // assign user to defined role
        $userAdmin = User::find()->where(['username' => 'admin'])->one();
        if ($userAdmin !== null) {
            $authManager->assign($roleAdmin, $userAdmin->getId());
        }

        $userUser = User::find()->where(['username' => 'user'])->one();
        if ($userUser !== null) {
            $authManager->assign($roleUser, $userUser->getId());
        }
        Console::output(\Yii::t('app', 'RBAC Sudah Terinstall'));
    }
}