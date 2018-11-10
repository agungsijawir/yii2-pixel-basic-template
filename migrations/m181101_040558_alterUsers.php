<?php

use app\models\User;
use yii\db\Migration;

/**
 * Class m181101_040558_alterUsers
 */
class m181101_040558_alterUsers extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableName = "user";
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'COLLATE utf8mb4_general_ci ENGINE=InnoDB';
        }

        if (Yii::$app->db->schema->getTableSchema($tableName) === null) {
            $this->createTable($tableName, [
                'id' => $this->primaryKey(),
                'username' => $this->string()->notNull()->unique(),
                'auth_key' => $this->string(32)->notNull(),
                'password_hash' => $this->string()->notNull(),
                'password_reset_token' => $this->string()->unique(),
                'first_name' => $this->string()->notNull(),
                'last_name' => $this->string()->notNull(),
                'email' => $this->string()->notNull()->unique(),
                'status' => $this->smallInteger()->notNull()->defaultValue(10),
                'bio' => $this->text()->null(),
                'language' => $this->string(4)->notNull()->defaultValue('id'),
                'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP()'),
                'updated_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP()')->append(' ON UPDATE CURRENT_TIMESTAMP')
            ], $tableOptions);

            $this->createIndex('user_idx', $tableName, ['id', 'username'], true);

            // let's create initial users
            $this->initUsers();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181101_040558_alterUsers cannot be reverted.\n";

        return false;
    }

    private function initUsers()
    {
        // generate dummy user
        $userAdmin = new User();
        $userAdmin->username = 'admin';
        $userAdmin->first_name = 'Admin';
        $userAdmin->last_name = 'User';
        $userAdmin->email = 'admin@basic-template.io';
        $userAdmin->setPassword('admin');
        $userAdmin->generateAuthKey();
        $userAdmin->save();

        $basicUser = new User();
        $basicUser->username = 'user';
        $basicUser->first_name = 'Basic';
        $basicUser->last_name = 'User';
        $basicUser->email = 'user@basic-template.io';
        $basicUser->setPassword('user');
        $basicUser->generateAuthKey();
        $basicUser->save();
    }
}
