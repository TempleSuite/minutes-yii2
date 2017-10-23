<?php

use yii\db\Migration;
use yii\db\Schema;

class m171020_183816_add_company_and_system_config_tables extends Migration
{
    public function safeUp()
    {
        $tables = Yii::$app->db->schema->getTableNames();

        $this->createTable('{{%company}}', [
            'id' => $this->primaryKey(),
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'logo' => Schema::TYPE_STRING,
            'role' => Schema::TYPE_STRING
        ]);

        $this->createTable('{{%system_configuration}}', [
            'id' => $this->primaryKey(),
            'company_id' => Schema::TYPE_INTEGER . ' NOT NULL'
        ]);

        if(in_array('system_configuration', $tables)){
            $this->createIndex('idx-company-id', '{{%system_configuration}}', 'company_id');
            $this->addForeignKey('fk-company-id', '{{%system_configuration}}', 'company_id', '{{%company}}', 'id', 'CASCADE', 'CASCADE');
        }
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-company-id', '{{%system_configuration}}');
        $this->dropIndex('idx-company-id', '{{%system_configuration}}');

        $this->dropTable('{{%system_configuration}}');
        $this->dropTable('{{&company}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171020_183816_add_company_and_system_config_tables cannot be reverted.\n";

        return false;
    }
    */
}
