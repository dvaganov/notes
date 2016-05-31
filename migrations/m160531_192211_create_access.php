<?php

use yii\db\Migration;

/**
 * Handles the creation for table `access`.
 */
class m160531_192211_create_access extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('access', [
            'id' => $this->primaryKey(),
            'userOwner' => $this->integer()->notNull(),
            'userGuest' => $this->integer()->notNull(),
            'date' => $this->date()->notNull()
        ]);

        $this->createIndex(
            'idx-acess-userOwner',
            'access',
            'userOwner'
        );

        $this->createIndex(
            'idx-acess-userGuest',
            'access',
            'userGuest'
        );

        $this->addForeignKey(
            'fk-access-userOwner',
            'access',
            'userOwner',
            'users',
            'id',
            'NO ACTION'
        );

        $this->addForeignKey(
            'fk-access-userGuest',
            'access',
            'userGuest',
            'users',
            'id',
            'NO ACTION'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-access-userGuest', 'access');
        $this->dropForeignKey('fk-access-userOwner', 'access');
        $this->dropIndex('idx-acess-userGuest', 'access');
        $this->dropIndex('idx-acess-userOwner', 'access');
        $this->dropTable('access');
    }
}
