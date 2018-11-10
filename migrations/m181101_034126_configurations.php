<?php

use yii\db\Migration;

/**
 * Class m181101_034126_configurations
 */
class m181101_034126_configurations extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'COLLATE utf8mb4_general_ci ENGINE=InnoDB';
        }

        $tableName = "configurations";

        if (Yii::$app->db->schema->getTableSchema($tableName) === null) {
            $this->createTable($tableName, [
                'id' => $this->string(),
                'value' => $this->text(),
                'group' => $this->string(),
                'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP()')->append(' ON UPDATE CURRENT_TIMESTAMP')
            ], $tableOptions);
            $this->createIndex('configurations_idx', $tableName, ['id'], true);

            // insert initial default configs
            $this->initDefaultConfigs();
            return true;
        } else {
            echo "m181101_034126_configurations cannot be applied because table `{$tableName}` already exists!`.\n";

            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181101_034126_configurations cannot be reverted.\n";

        return false;
    }

    /**
     * Following was initial default application configuration
     */
    private function initDefaultConfigs()
    {
        $this->insert('configurations', ['id' => 'general.appName', 'value' => 'Basic Template']);
        $this->insert('configurations', ['id' => 'general.nullDisplay', 'value' => '<span class="label label-default">Belum Diset</span>']);
    }
}
