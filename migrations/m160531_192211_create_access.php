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
            'ownerID' => $this->integer()->notNull(),
            'guestID' => $this->integer()->notNull(),
            'date' => $this->date()->notNull()
        ]);

        $this->createIndex(
            'idx-acess-ownerID',
            'access',
            'ownerID'
        );

        $this->createIndex(
            'idx-acess-guestID',
            'access',
            'guestID'
        );

        $this->addForeignKey(
            'fk-access-ownerID',
            'access',
            'ownerID',
            'users',
            'id',
            'NO ACTION'
        );

        $this->addForeignKey(
            'fk-access-guestID',
            'access',
            'guestID',
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
        $this->dropForeignKey('fk-access-guestID', 'access');
        $this->dropForeignKey('fk-access-ownerID', 'access');
        $this->dropIndex('idx-acess-guestID', 'access');
        $this->dropIndex('idx-acess-ownerID', 'access');
        $this->dropTable('access');
    }
}
