<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%work_preview}}`.
 */
class m231119_153556_create_table_work_preview extends Migration
{

    /** @var string  */
    protected $tableName = '{{%work_preview}}';

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
            'work_id' => $this->integer(11)->notNull(),
            'path' => $this->string(255)->notNull(),
            'base_url' => $this->string(255),
            'type' => $this->string(255),
            'size' => $this->integer(11),
            'name' => $this->string(255),
            'created_at' => $this->integer(11),
            'order' => $this->integer(11),
        ], $collation);

        // add foreign key for table `work`
        $this->addForeignKey(
            'fk_work_preview_work',
            $this->tableName,
            'work_id',
            '{{%work}}',
            'id',
            'cascade',
            'cascade'
        );

        $this->createIndex('fk_work_attachment_work', $this->tableName, 'work_id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `work`
        $this->dropForeignKey(
            'fk_work_preview_work',
            '{{%work_preview}}'
        );

        $this->dropTable($this->tableName);
    }
}
