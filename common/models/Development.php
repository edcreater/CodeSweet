<?php

namespace common\models;

use common\models\query\DevelopmentQuery;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "development".
 *
 * @property integer $id
 * @property string $slug
 * @property string $title
 * @property string $subtitle
 * @property string $body
 * @property string $view
 * @property string $thumbnail_base_url
 * @property string $thumbnail_path
 * @property array $attachments
 * @property integer $category_id
 * @property integer $seotitle
 * @property integer $seodescription
 * @property integer $status
 * @property integer $published_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $author
 * @property User $updater
 * @property DevelopmentCategory $category
 * @property DevelopmentAttachment[] $developmentAttachments
 */
class Development extends ActiveRecord
{
	const STATUS_PUBLISHED = 1;
	const STATUS_DRAFT = 0;

	/**
	 * @var array
	 */
	public $attachments;

	/**
	 * @var array
	 */
	public $thumbnail;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%development}}';
	}

	/**
	 * @return DevelopmentQuery
	 */
	public static function find()
	{
		return new DevelopmentQuery(get_called_class());
	}

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			TimestampBehavior::className(),
			BlameableBehavior::className(),
			[
				'class' => SluggableBehavior::className(),
				'attribute' => 'title',
				'immutable' => true
			],
			[
				'class' => UploadBehavior::className(),
				'attribute' => 'attachments',
				'multiple' => true,
				'uploadRelation' => 'developmentAttachments',
				'pathAttribute' => 'path',
				'baseUrlAttribute' => 'base_url',
				'orderAttribute' => 'order',
				'typeAttribute' => 'type',
				'sizeAttribute' => 'size',
				'nameAttribute' => 'name',
			],
			[
				'class' => UploadBehavior::className(),
				'filesStorage' => 'thumbStorage',
				'attribute' => 'thumbnail',
				'pathAttribute' => 'thumbnail_path',
				'baseUrlAttribute' => 'thumbnail_base_url'
			]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['title', 'body', 'category_id'], 'required'],
			[['slug'], 'unique'],
			[['body'], 'string'],
			[['published_at'], 'default', 'value' => function () {
				return date(DATE_ISO8601);
			}],
			[['published_at'], 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => true],
			[['category_id'], 'exist', 'targetClass' => DevelopmentCategory::className(), 'targetAttribute' => 'id'],
			[['seofield_id'], 'exist', 'targetClass' => Seofield::className(), 'targetAttribute' => 'id'],
			[['status'], 'integer'],
			[['slug', 'thumbnail_base_url', 'thumbnail_path'], 'string', 'max' => 1024],
			[['title', 'subtitle'], 'string', 'max' => 512],
			[['view'], 'string', 'max' => 255],
			[['attachments', 'thumbnail'], 'safe']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('common', 'ID'),
			'slug' => Yii::t('common', 'Slug'),
			'title' => Yii::t('common', 'Title'),
			'subtitle' => Yii::t('common', 'Subtitle'),
			'body' => Yii::t('common', 'Body'),
			'view' => Yii::t('common', 'Development View'),
			'thumbnail' => Yii::t('common', 'Thumbnail'),
			'category_id' => Yii::t('common', 'Category'),
			'seofield_id' => Yii::t('common', 'SEO fields'),
			'status' => Yii::t('common', 'Published'),
			'published_at' => Yii::t('common', 'Published At'),
			'created_by' => Yii::t('common', 'Author'),
			'updated_by' => Yii::t('common', 'Updater'),
			'created_at' => Yii::t('common', 'Created At'),
			'updated_at' => Yii::t('common', 'Updated At')
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getAuthor()
	{
		return $this->hasOne(User::className(), ['id' => 'created_by']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUpdater()
	{
		return $this->hasOne(User::className(), ['id' => 'updated_by']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCategory()
	{
		return $this->hasOne(DevelopmentCategory::className(), ['id' => 'category_id']);
	}

	/**
	 * @inheritdoc
	 */
	public function getSeofield()
	{
		return $this->hasOne(Seofield::className(), ['id' => 'seofield_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getDevelopmentAttachments()
	{
		return $this->hasMany(DevelopmentAttachment::className(), ['development_id' => 'id']);
	}
}
