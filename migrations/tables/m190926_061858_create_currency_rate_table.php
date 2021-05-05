<?php

use app\common\migration\BaseMigration;

/**
 * Handles the creation of table `{{%currency_rate}}`.
 */
class m190926_061858_create_currency_rate_table extends BaseMigration
{
    public $tableName = '{{%currency_rate}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'currency_code' => $this->string(4)->unique()->notNull(),
            'kes_to_currency' => $this->decimal(10, 2)->notNull()->defaultValue(0)
        ], $this->tableOptions);

        $this->insert($this->tableName, [
            'currency_code' => 'USD',
            'kes_to_currency' => 107.79,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
