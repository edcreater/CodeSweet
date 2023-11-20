<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%widget_text}}`.
 */
class m231119_153150_create_table_widget_text extends Migration
{

    /** @var string  */
    protected $tableName = '{{%widget_text}}';

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
            'key' => $this->string(255)->notNull(),
            'title' => $this->string(255)->notNull(),
            'body' => $this->text()->notNull(),
            'status' => $this->smallInteger(6),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ], $collation);


        $this->createIndex('idx_widget_text_key', $this->tableName, 'key');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropIndex('idx_widget_text_key', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
