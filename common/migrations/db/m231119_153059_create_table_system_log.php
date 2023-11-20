<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%system_log}}`.
 */
class m231119_153059_create_table_system_log extends Migration
{

    /** @var string  */
    protected $tableName = '{{%system_log}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $collation = null;
        if ($this->db->driverName === 'mysql') {
            $collation = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->notNull(),
            'level' => $this->integer(11),
            'category' => $this->string(255),
            'log_time' => $this->double(),
            'prefix' => $this->text(),
            'message' => $this->text(),
        ], $collation);


        $this->createIndex('idx_log_level', $this->tableName, 'level');
        $this->createIndex('idx_log_category', $this->tableName, 'category');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropIndex('idx_log_level', $this->tableName);
        $this->dropIndex('idx_log_category', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
