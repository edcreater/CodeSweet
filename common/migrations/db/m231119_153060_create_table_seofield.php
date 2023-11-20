<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%seofield}}`.
 */
class m231119_153060_create_table_seofield extends Migration
{

    /** @var string  */
    protected $tableName = '{{%seofield}}';

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
            'seotitle' => $this->string(512),
            'seodescription' => $this->string(512),
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
