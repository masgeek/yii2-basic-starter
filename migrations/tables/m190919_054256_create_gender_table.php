<?php

use app\common\migration\BaseMigration;
use yii\db\Schema;

/**
 * Handles the creation of table `{{%gender}}`.
 */
class m190919_054256_create_gender_table extends BaseMigration
{
    public $tableName = '{{%gender}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->bigPrimaryKey(11),
            'gender' => $this->string(10)->notNull()->unique()
        ], $this->tableOptions);

        $this->insert($this->tableName, ['gender' => 'Female']);
        $this->insert($this->tableName, ['gender' => 'Male']);

        $this->createIndex('idx-gender-id', $this->tableName, 'id', true);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-gender-id', 'hs_hr_employee');
        $this->dropIndex('idx-gender-id', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
