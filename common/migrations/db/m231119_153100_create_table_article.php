<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%article}}`.
 */
class m231119_153100_create_table_article extends Migration
{

    /** @var string  */
    protected $articleTableName = '{{%article}}';
    protected $articleCategoryTableName = '{{%article_category}}';
    protected $articleAttachmentTableName = '{{%article_attachment}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $collation = null;
        if ($this->db->driverName === 'mysql') {
            $collation = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->articleCategoryTableName, [
            'id' => $this->primaryKey()->notNull(),
            'slug' => $this->string(1024)->notNull(),
            'title' => $this->string(512)->notNull(),
            'subtitle' => $this->string(512)->defaultValue('NULL'),
            'body' => $this->text(),
            'parent_id' => $this->integer(11),
            'seofield_id' => $this->integer(11),
            'status' => $this->smallInteger(6)->notNull()->defaultValue(0),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ], $collation);

        $this->createTable($this->articleAttachmentTableName, [
            'id' => $this->primaryKey()->notNull(),
            'article_id' => $this->integer(11)->notNull(),
            'path' => $this->string(255)->notNull(),
            'base_url' => $this->string(255),
            'type' => $this->string(255),
            'size' => $this->integer(11),
            'name' => $this->string(255),
            'created_at' => $this->integer(11),
            'order' => $this->integer(11),
        ], $collation);


        $this->createTable($this->articleTableName, [
            'id' => $this->primaryKey()->notNull(),
            'slug' => $this->string(1024)->notNull(),
            'title' => $this->string(512)->notNull(),
            'subtitle' => $this->string(512),
            'body' => $this->text()->notNull(),
            'view' => $this->string(255),
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


        /**
         * Create keys for table article_category
         */
        // add foreign key for table `article_category`
        $this->addForeignKey(
            'fk_article_category_parent',
            $this->articleCategoryTableName,
            'parent_id',
            '{{%article_category}}',
            'id',
            'restrict',
            'cascade'
        );

        // add foreign key for table `seofield`
        $this->addForeignKey(
            'fk_article_category_seofield',
            $this->articleCategoryTableName,
            'seofield_id',
            '{{%seofield}}',
            'id',
            'set null',
            'cascade'
        );

        /**
         * Create keys for table article_attachment
         */
        // add foreign key for table `article`
        $this->addForeignKey(
            'fk_article_attachment_article',
            $this->articleAttachmentTableName,
            'article_id',
            '{{%article}}',
            'id',
            'cascade',
            'cascade'
        );

        /**
         * Create keys for table article
         */
        // add foreign key for table `seofield`
        $this->addForeignKey(
            'fk_article_seofield',
            $this->articleTableName,
            'seofield_id',
            '{{%seofield}}',
            'id',
            'set null',
            'cascade'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk_article_author',
            $this->articleTableName,
            'created_by',
            '{{%user}}',
            'id',
            'restrict',
            'cascade'
        );

        // add foreign key for table `article_category`
        $this->addForeignKey(
            'fk_article_category',
            $this->articleTableName,
            'category_id',
            '{{%article_category}}',
            'id',
            'restrict',
            'cascade'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk_article_updater',
            $this->articleTableName,
            'updated_by',
            '{{%user}}',
            'id',
            'set null',
            'cascade'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        /**
         * Remove keys for table article
         */
        // drops foreign key for table `seofield`
        $this->dropForeignKey(
            'fk_article_seofield',
            '{{%article}}'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk_article_author',
            '{{%article}}'
        );

        // drops foreign key for table `article_category`
        $this->dropForeignKey(
            'fk_article_category',
            '{{%article}}'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk_article_updater',
            '{{%article}}'
        );

        /**
         * Remove keys for table article_attachment
         */

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk_article_attachment_article',
            '{{%article_attachment}}'
        );

        /**
         * Remove keys for table article_category
         */

         // drops foreign key for table `article_category`
         $this->dropForeignKey(
             'fk_article_category_parent',
             '{{%article_category}}'
         );

        // drops foreign key for table `seofield`
        $this->dropForeignKey(
            'fk_article_category_seofield',
            '{{%article_category}}'
        );

        /**
         * Drop tables
         */

        $this->dropTable($this->articleTableName);
        $this->dropTable($this->articleCategoryTableName);
        $this->dropTable($this->articleAttachmentTableName);
    }
}
