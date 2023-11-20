<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%timeline_event}}`.
 */
class m231119_153078_create_table_timeline_event extends Migration
{

    /** @var string  */
    protected $tableName = '{{%timeline_event}}';

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
            'application' => $this->string(64)->notNull(),
            'category' => $this->string(64)->notNull(),
            'event' => $this->string(64)->notNull(),
            'data' => $this->text(),
            'created_at' => $this->integer(11)->notNull(),
        ], $collation);


        $this->createIndex('idx_created_at', $this->tableName, 'created_at');

        $this->batchInsert(
            '{{%timeline_event}}',
            ['application', 'category', 'event', 'data', 'created_at'],
            [
                ['frontend', 'user', 'signup', json_encode(['public_identity' => 'webmaster', 'user_id' => 1, 'created_at' => time()]), time()],
                ['frontend', 'user', 'signup', json_encode(['public_identity' => 'manager', 'user_id' => 2, 'created_at' => time()]), time()],
                ['frontend', 'user', 'signup', json_encode(['public_identity' => 'user', 'user_id' => 3, 'created_at' => time()]), time()]
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropIndex('idx_created_at', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
