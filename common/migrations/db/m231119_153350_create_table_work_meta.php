<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%work_meta}}`.
 */
class m231119_153350_create_table_work_meta extends Migration
{

    /** @var string  */
    protected $tableName = '{{%work_meta}}';

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
            'key' => $this->string(255)->notNull(),
            'value' => $this->string(255),
            'order' => $this->integer(11),
            'status' => $this->smallInteger(6)->notNull()->defaultValue(0),
        ], $collation);


        // add foreign key for table `work`
        $this->addForeignKey(
            'fk_work_meta_work',
            $this->tableName,
            'work_id',
            '{{%work}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `work`
        $this->dropForeignKey(
            'fk_work_meta_work',
            '{{%work_meta}}'
        );

        $this->dropTable($this->tableName);
    }
}
