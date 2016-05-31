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
            'creator' => $this->integer()->notNull(),
            'dateEvent' => $this->dateTime()->notNull() . ' DEFAULT CURRENT_TIMESTAMP'
        ]);

        $this->createIndex(
            'idx-calendar-creator',
            'calendar',
            'creator'
        );

        $this->addForeignKey(
            'fk-calendar-creator',
            'calendar',
            'creator',
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
        $this->dropForeignKey('fk-calendar-creator', 'calendar');
        $this->dropIndex('idx-calendar-creator', 'calendar');
        $this->dropTable('calendar');
    }
}
