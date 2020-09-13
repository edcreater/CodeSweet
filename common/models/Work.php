<?php
/**
 * Created by Ed.Creater <ed.creater@gmail.com>.
 * Author Site: https://codesweet.ru
 * Date: 27.02.2018
 */

namespace common\models;

use common\models\query\WorkQuery;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "work".
 *
 * @property integer $id
 * @property string $slug
 * @property string $title
 * @property string $subtitle
 * @property string $body
 * @property string $view
 * @property string $size
 * @property string $thumbnail_base_url
 * @property string $thumbnail_path
 * @property array $attachments
 * @property array $previews
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
 * @property WorkCategory $category
 * @property WorkAttachment[] $workAttachments
 * @property WorkPreview[] $workPreviews
 */
class Work extends ActiveRecord
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
	public $previews;

	/**
	 * @var array
	 */
	public $thumbnail;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%work}}';
	}

	/**
	 * @return WorkQuery
	 */
	public static function find()
	{
		return new WorkQuery(get_called_class());
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
				'uploadRelation' => 'workAttachments',
				'pathAttribute' => 'path',
				'baseUrlAttribute' => 'base_url',
				'orderAttribute' => 'order',
				'typeAttribute' => 'type',
				'sizeAttribute' => 'size',
				'nameAttribute' => 'name',
			],
			[
				'class' => UploadBehavior::className(),
				'attribute' => 'previews',
				'multiple' => true,
				'uploadRelation' => 'workPreviews',
				'pathAttribute' => 'path',
				'baseUrlAttribute' => 'base_url',
				'orderAttribute' => 'order',
				'typeAttribute' => 'type',
				'sizeAttribute' => 'size',
				'nameAttribute' => 'name',
			],
			[
				'class' => UploadBehavior::className(),
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
			[['title', 'subtitle', 'body', 'category_id'], 'required'],
			[['slug'], 'unique'],
			[['body'], 'string'],
			[['published_at'], 'default', 'value' => function () {
				return date(DATE_ISO8601);
			}],
			[['published_at'], 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => true],
			[['category_id'], 'exist', 'targetClass' => WorkCategory::className(), 'targetAttribute' => 'id'],
            [['seofield_id'], 'exist', 'targetClass' => Seofield::className(), 'targetAttribute' => 'id'],
            [['status'], 'integer'],
			[['slug', 'thumbnail_base_url', 'thumbnail_path'], 'string', 'max' => 1024],
			[['title', 'subtitle'], 'string', 'max' => 1024],
			[['view', 'size'], 'string', 'max' => 255],
			[['attachments', 'thumbnail', 'previews'], 'safe']
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
			'view' => Yii::t('common', 'Work View'),
			'size' => Yii::t('common', 'Size'),
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
		return $this->hasOne(WorkCategory::className(), ['id' => 'category_id']);
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
	public function getWorkAttachments()
	{
		return $this->hasMany(WorkAttachment::className(), ['work_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getWorkPreviews()
	{
		return $this->hasMany(WorkPreview::className(), ['work_id' => 'id']);
	}
}
