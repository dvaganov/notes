<?php

use yii\db\Migration;

class m160528_135628_ceate_user_table extends Migration
{
    public function up()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->unique(),
            'email' => $this->string(255),
            'password' => $this->string(255)
        ]);

        $this->insert('users', [
            'name' => 'admin',
            'email' => 'admin@mail.org',
            'password' => password_hash('admin', PASSWORD_DEFAULT)
        ]);
    }

    public function down()
    {
        $this->delete('users', ['id' => 1]);
        $this->dropTable('users');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
