<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%widget_menu}}`.
 */
class m231119_153140_create_table_widget_menu extends Migration
{

    /** @var string  */
    protected $tableName = '{{%widget_menu}}';

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
            'key' => $this->string(32)->notNull(),
            'title' => $this->string(255)->notNull(),
            'items' => $this->text()->notNull(),
            'status' => $this->smallInteger(6)->notNull()->defaultValue(0),
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
