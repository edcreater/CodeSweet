<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%file_storage_item}}`.
 */
class m231119_153065_create_table_file_storage_item extends Migration
{

    /** @var string  */
    protected $tableName = '{{%file_storage_item}}';

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
            'component' => $this->string(255)->notNull(),
            'base_url' => $this->string(1024)->notNull(),
            'path' => $this->string(1024)->notNull(),
            'type' => $this->string(255),
            'size' => $this->integer(11),
            'name' => $this->string(255),
            'upload_ip' => $this->string(15),
            'created_at' => $this->integer(11)->notNull(),
        ], $collation);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
