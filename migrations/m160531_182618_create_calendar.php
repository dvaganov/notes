<?php

use yii\db\Migration;

/**
 * Handles the creation for table `calendar`.
 */
class m160531_182618_create_calendar extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('calendar', [
            'id' => $this->primaryKey(),
            'text' => $this->text()->notNull(),
            'creatorID' => $this->integer()->notNull(),
            'dateEvent' => $this->dateTime()->notNull() . ' DEFAULT CURRENT_TIMESTAMP'
        ]);

        $this->createIndex(
            'idx-calendar-creatorID',
            'calendar',
            'creatorID'
        );

        $this->addForeignKey(
            'fk-calendar-creatorID',
            'calendar',
            'creatorID',
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
        $this->dropForeignKey('fk-calendar-creatorID', 'calendar');
        $this->dropIndex('idx-calendar-creatorID', 'calendar');
        $this->dropTable('calendar');
    }
}
