<?php

use yii\db\Migration;
use common\models\User;

class m171017_224336_add_auth_assignments extends Migration
{
    public function safeUp()
    {
        $tables = Yii::$app->db->schema->getTableNames();

        if (in_array('auth_item', $tables)) {
            $this->insert('auth_item', [
                'name' => 'admin',
                'type' => 0,
            ]);

            $this->insert('auth_item', [
                'name' => 'employee',
                'type' => 1,
            ]);

            $this->insert('auth_item', [
                'name' => 'guest',
                'type' => 1,
            ]);
        }

        if (in_array('auth_item_child', $tables)) {
            $this->insert('auth_item_child', [
                'parent' => 'admin',
                'child' => 'employee',
            ]);

            $this->insert('auth_item_child', [
                'parent' => 'employee',
                'child' => 'guest',
            ]);
        }


        if (in_array('user', $tables)) {
            $this->insert('user', [
                'first_name' => 'admin',
                'last_name' => 'admin',
                'username' => 'admin',
                'password_hash' => '$2y$10$4/e9/xADV0jW2M0CZITxdu3cqVpB7eFsUwn923X.MVTQu7Rua0El.', //mais1234
                'auth_key' => 'epNgFMBgifveWXBAZDH4c1nYON72xIQk',
                'updated_at' => '1502744670',
                'flags' => 0,
                'email' => 'maissoftware42@gmail.com'
            ]);
        }

        if (in_array('auth_assignment', $tables)) {
            $admin = User::find()->where(['username' => 'admin'])->one();

            $this->insert('auth_assignment', [
                'item_name' => 'admin',
                'user_id' => $admin->id,
            ]);
        }
    }

    public function safeDown()
    {
        $tables = Yii::$app->db->schema->getTableNames();

        if (in_array('auth_assignment', $tables)) {
            $admin = User::find()->where(['username' => 'admin'])->one();

            $this->delete('auth_assignment', [
                'item_name' => 'admin',
                'user_id' => $admin->id,
            ]);
        }

        if (in_array('user', $tables)) {
            $this->delete('user', [
                'first_name' => 'admin',
                'last_name' => 'admin',
                'username' => 'admin',
                'password_hash' => '$2y$10$4/e9/xADV0jW2M0CZITxdu3cqVpB7eFsUwn923X.MVTQu7Rua0El.', // mais1234
                'auth_key' => 'epNgFMBgifveWXBAZDH4c1nYON72xIQk',
                'updated_at' => '1502744670',
                'flags' => 0,
                'email' => 'maissoftware42@gmail.com'
            ]);
        }


        if (in_array('auth_item_child', $tables)) {
            $this->delete('auth_item_child', [
                'parent' => 'employee',
                'child' => 'guest',
            ]);

            $this->delete('auth_item_child', [
                'parent' => 'admin',
                'child' => 'employee',
            ]);
        }

        if (in_array('auth_item', $tables)) {
            $this->delete('auth_item', [
                'name' => 'guest',
                'type' => 1,
            ]);

            $this->delete('auth_item', [
                'name' => 'employee',
                'type' => 1,
            ]);

            $this->delete('auth_item', [
                'name' => 'admin',
                'type' => 0,
            ]);
        }
    }

}
