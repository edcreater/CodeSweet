<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%development}}`.
 */
class m231119_153110_create_table_development extends Migration
{

    /** @var string  */
    protected $development = '{{%development}}';
    protected $developmentCategory = '{{%development_category}}';
    protected $developmentAttachment = '{{%development_attachment}}';
    protected $developmentPreview = '{{%development_preview}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $collation = null;
        if ($this->db->driverName === 'mysql') {
            $collation = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->developmentPreview, [
            'id' => $this->primaryKey()->notNull(),
            'development_id' => $this->integer(11)->notNull(),
            'path' => $this->string(255)->notNull(),
            'base_url' => $this->string(255),
            'type' => $this->string(255),
            'size' => $this->integer(11),
            'name' => $this->string(255),
            'created_at' => $this->integer(11),
            'order' => $this->integer(11),
        ], $collation);

        $this->createTable($this->developmentAttachment, [
            'id' => $this->primaryKey()->notNull(),
            'development_id' => $this->integer(11)->notNull(),
            'path' => $this->string(255)->notNull(),
            'base_url' => $this->string(255),
            'type' => $this->string(255),
            'size' => $this->integer(11),
            'name' => $this->string(255),
            'created_at' => $this->integer(11),
            'order' => $this->integer(11),
        ], $collation);

        $this->createTable($this->developmentCategory, [
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

        $this->createTable($this->development, [
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
         * Create keys for table development_preview
         */

         // add foreign key for table `development`
         $this->addForeignKey(
             'fk_development_preview_development',
             $this->developmentPreview,
             'development_id',
             '{{%development}}',
             'id',
             'cascade',
             'cascade'
         );

         /**
         * Create keys for table development_category
         */
        // add foreign key for table `seofield`
        $this->addForeignKey(
            'fk_development_category_seofield',
            $this->developmentCategory,
            'seofield_id',
            '{{%seofield}}',
            'id',
            'set null',
            'cascade'
        );

        /**
         * Create keys for table development_attachment
         */

         // add foreign key for table `development`
         $this->addForeignKey(
             'fk_development_attachment_development',
             $this->developmentAttachment,
             'development_id',
             '{{%development}}',
             'id',
             'cascade',
             'cascade'
         );

         /**
         * Create keys for table development
         */

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk_development_author',
            $this->development,
            'created_by',
            '{{%user}}',
            'id',
            'restrict',
            'cascade'
        );

        // add foreign key for table `development_category`
        $this->addForeignKey(
            'fk_development_category',
            $this->development,
            'category_id',
            '{{%development_category}}',
            'id',
            'restrict',
            'cascade'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk_development_updater',
            $this->development,
            'updated_by',
            '{{%user}}',
            'id',
            'set null',
            'cascade'
        );

        // add foreign key for table `seofield`
        $this->addForeignKey(
            'fk_development_seofield',
            $this->development,
            'seofield_id',
            '{{%seofield}}',
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
         * Drop keys for table development_preview
         */

         // drops index for column `development_id`
         $this->dropIndex(
             'fk_development_preview_development',
             '{{%development_preview}}'
         );

        /**
         * Drop keys for table development_category
         */

         // drops foreign key for table `seofield`
         $this->dropForeignKey(
             'fk_development_category_seofield',
             '{{%development_category}}'
         );

        /**
         * Drop keys for table development_attachment
         */

        // drops foreign key for table `development_attachment`
        $this->dropForeignKey(
            'fk_development_attachment_development',
            '{{%development_attachment}}'
        );

        /**
         * Drop keys for table development
         */

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk_development_author',
            '{{%development}}'
        );

        // drops foreign key for table `development_category`
        $this->dropForeignKey(
            'fk_development_category',
            '{{%development}}'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk_development_updater',
            '{{%development}}'
        );

        // drops foreign key for table `seofield`
        $this->dropForeignKey(
            'fk_development_seofield',
            '{{%development}}'
        );

        $this->dropTable($this->development);
        $this->dropTable($this->developmentCategory);
        $this->dropTable($this->developmentAttachment);
        $this->dropTable($this->developmentPreview);
    }
}
