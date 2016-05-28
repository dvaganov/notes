<?php

use yii\db\Migration;

class m160528_135628_ceate_user_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username' => $this->string(45)->notNull()->unique(),
            'email' => $this->string(45)->notNull(),
            'password' => $this->string(255)->notNull(),
            'authKey' => $this->string(255)->unique()
        ]);

        $this->insert('users', [
            'username' => 'admin',
            'email' => 'admin@mail.org',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'authKey' => \Yii::$app->security->generateRandomString()
        ]);

        $this->insert('users', [
            'username' => 'demo',
            'email' => 'demo@mail.org',
            'password' => password_hash('demo', PASSWORD_DEFAULT),
            'authKey' => \Yii::$app->security->generateRandomString()
        ]);
    }

    public function safeDown()
    {
        $this->delete('users', ['id' => 2]);
        $this->delete('users', ['id' => 1]);
        $this->dropTable('users');
    }
}
