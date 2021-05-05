<?php

use app\common\migration\BaseMigration;

/**
 * Handles the creation of table `{{%user_type}}`.
 */
class m190917_104343_create_user_type_table extends BaseMigration
{
    public $tableName = '{{%user_type}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'user_type' => $this->string(20)->comment('User Type')->unique(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null),
        ], $this->tableOptions);

        $this->addPrimaryKey('user_type_pk', $this->tableName, 'user_type');
        $this->addForeignKey('user_type_fk', '{{%user}}', 'user_type', $this->tableName, 'user_type', 'restrict', 'cascade');

        $this->insert($this->tableName, ['user_type' => 'Admin']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('user_type_fk', '{{%user}}');
        $this->dropTable($this->tableName);
    }
}
