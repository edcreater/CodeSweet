<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%widget_carousel}}`.
 */
class m231119_153130_create_table_widget_carousel extends Migration
{

    /** @var string  */
    protected $widgetCarousel = '{{%widget_carousel}}';
    protected $widgetCarouselItem = '{{%widget_carousel_item}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $collation = null;
        if ($this->db->driverName === 'mysql') {
            $collation = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->widgetCarouselItem, [
            'id' => $this->primaryKey()->notNull(),
            'carousel_id' => $this->integer(11)->notNull(),
            'base_url' => $this->string(1024),
            'path' => $this->string(1024),
            'asset_url' => $this->string(1024),
            'type' => $this->string(255),
            'url' => $this->string(1024),
            'caption' => $this->string(1024),
            'status' => $this->smallInteger(6)->notNull()->defaultValue(0),
            'order' => $this->integer(11)->defaultValue(0),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ], $collation);

        $this->createTable($this->widgetCarousel, [
            'id' => $this->primaryKey()->notNull(),
            'key' => $this->string(255)->notNull(),
            'status' => $this->smallInteger(6)->defaultValue(0),
        ], $collation);

        /**
         * Create foreign keys for table widget_carousel_item
         */
        // add foreign key for table `widget_carousel`
        $this->addForeignKey(
            'fk_item_carousel',
            $this->widgetCarouselItem,
            'carousel_id',
            '{{%widget_carousel}}',
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
         * Remove keys for table widget_carousel_item
         */
        // drops foreign key for table `widget_carousel`
        $this->dropForeignKey(
            'fk_item_carousel',
            '{{%widget_carousel_item}}'
        );

        /**
         * Drop tables
         */
        $this->dropTable($this->widgetCarousel);
    }
}
