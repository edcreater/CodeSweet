<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%work}}`.
 */
class m231119_153256_create_table_work extends Migration
{

    /** @var string  */
    protected $work = '{{%work}}';
    protected $workCategory = '{{%work_category}}';
    protected $workAttachment = '{{%work_attachment}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $collation = null;
        if ($this->db->driverName === 'mysql') {
            $collation = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->work, [
            'id' => $this->primaryKey()->notNull(),
            'slug' => $this->string(1024)->notNull(),
            'title' => $this->string(1024)->notNull(),
            'subtitle' => $this->string(1024)->notNull(),
            'body' => $this->text()->notNull(),
            'view' => $this->string(255),
            'size' => $this->string(255)->notNull(),
            'category_id' => $this->integer(11),
            'thumbnail_base_url' => $this->string(1024),
            'thumbnail_path' => $this->string(1024),
            'seofield_id' => $this->integer(11),
            'status' => $this->smallInteger(6)->notNull()->defaultValue(0),
            'created_by' => $this->integer(11),
            'updated_by' => $this->integer(11),
            'published_at' => $this->integer(11),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ], $collation);

        $this->createTable($this->workCategory, [
            'id' => $this->primaryKey()->notNull(),
            'slug' => $this->string(1024)->notNull(),
            'title' => $this->string(512)->notNull(),
            'body' => $this->text(),
            'seofield_id' => $this->integer(11),
            'status' => $this->smallInteger(6)->notNull()->defaultValue(0),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ], $collation);

        $this->createTable($this->workAttachment, [
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


        /**
         * Create foreign keys for table work
         */

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk_work_author',
            $this->work,
            'created_by',
            '{{%user}}',
            'id',
            'restrict',
            'cascade'
        );

        // add foreign key for table `work_category`
        $this->addForeignKey(
            'fk_work_category',
            $this->work,
            'category_id',
            '{{%work_category}}',
            'id',
            'restrict',
            'cascade'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk_work_updater',
            $this->work,
            'updated_by',
            '{{%user}}',
            'id',
            'set null',
            'cascade'
        );

        // add foreign key for table `seofield`
        $this->addForeignKey(
            'fk_work_seofield',
            $this->work,
            'seofield_id',
            '{{%seofield}}',
            'id',
            'set null',
            'cascade'
        );

        /**
         * Create foreign keys for table work category
         */
        // add foreign key for table `seofield`
        $this->addForeignKey(
            'fk_work_category_seofield',
            $this->workCategory,
            'seofield_id',
            '{{%seofield}}',
            'id',
            'set null',
            'cascade'
        );

        /**
         * Create foreign keys for table work_attachment
         */
        // add foreign key for table `work`
        $this->addForeignKey(
            'fk_work_attachment_work',
            $this->workAttachment,
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

        /**
         * Remove keys for table work attachment
         */
        // drops foreign key for table `work`
        $this->dropForeignKey(
            'fk_work_attachment_work',
            '{{%work_attachment}}'
        );
        /**
         * Remove keys for table work category
         */

         // drops foreign key for table `seofield`
         $this->dropForeignKey(
             'fk_work_category_seofield',
             '{{%work_category}}'
         );

        /**
         * Remove keys for table work
         */

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk_work_author',
            '{{%work}}'
        );

        // drops foreign key for table `work_category`
        $this->dropForeignKey(
            'fk_work_category',
            '{{%work}}'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk_work_updater',
            '{{%work}}'
        );

        // drops foreign key for table `seofield`
        $this->dropForeignKey(
            'work_ibfk_2',
            '{{%work}}'
        );

        /**
         * Drop tables
         */
        $this->dropTable($this->work);
        $this->dropTable($this->workCategory);
        $this->dropTable($this->workAttachment);
    }
}
