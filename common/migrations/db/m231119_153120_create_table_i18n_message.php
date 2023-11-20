<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%i18n_message}}`.
 */
class m231119_153120_create_table_i18n_message extends Migration
{

    /** @var string  */
    protected $i18nMessage = '{{%i18n_message}}';
    protected $i18nSourceMessage = '{{%i18n_source_message}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $collation = null;
        if ($this->db->driverName === 'mysql') {
            $collation = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->i18nSourceMessage, [
            'id' => $this->primaryKey()->notNull(),
            'category' => $this->string(32),
            'message' => $this->text(),
        ], $collation);

        $this->createTable($this->i18nMessage, [
            'id' => $this->integer(11)->notNull(),
            'language' => $this->string(16)->notNull(),
            'translation' => $this->text(),
        ], $collation);


        /**
         * Create keys for table i18n_message
         */

        // add foreign key for table `i18n_source_message`
        $this->addForeignKey(
            'fk_i18n_message_source_message',
            $this->i18nMessage,
            'id',
            '{{%i18n_source_message}}',
            'id',
            'cascade',
            'cascade'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {

        /**
         * Remove keys for table i18n_message
         */

        // drops foreign key for table `i18n_source_message`
        $this->dropForeignKey(
            'fk_i18n_message_source_message',
            '{{%i18n_message}}'
        );

        /**
         * Drop tables
         */

        $this->dropTable($this->i18nMessage);
        $this->dropTable($this->i18nSourceMessage);
    }
}
