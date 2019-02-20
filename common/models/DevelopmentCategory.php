<?php

namespace common\models;

use common\models\query\DevelopmentCategoryQuery;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "development_category".
 *
 * @property integer $id
 * @property string $slug
 * @property string $title
 * @property string $subtitle
 * @property integer $status
 *
 * @property Development[] $development
 * @property DevelopmentCategory $parent
 * @property integer $seotitle
 * @property integer $seodescription
 */
class DevelopmentCategory extends ActiveRecord
{
	const STATUS_ACTIVE = 1;
	const STATUS_DRAFT = 0;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%development_category}}';
	}

	/**
	 * @return DevelopmentCategoryQuery
	 */
	public static function find()
	{
		return new DevelopmentCategoryQuery(get_called_class());
	}

	public function behaviors()
	{
		return [
			TimestampBehavior::className(),
			[
				'class' => SluggableBehavior::className(),
				'attribute' => 'title',
				'immutable' => true
			]
		];
	}


	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['title'], 'required'],
			[['title', 'subtitle'], 'string', 'max' => 512],
			[['slug'], 'unique'],
			[['slug'], 'string', 'max' => 1024],
			['status', 'integer'],
			['parent_id', 'exist', 'targetClass' => DevelopmentCategory::className(), 'targetAttribute' => 'id'],
			[['seofield_id'], 'exist', 'targetClass' => Seofield::className(), 'targetAttribute' => 'id']
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
			'parent_id' => Yii::t('common', 'Parent Category'),
			'seofield_id' => Yii::t('common', 'SEO fields'),
			'status' => Yii::t('common', 'Active')
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getDevelopments()
	{
		return $this->hasMany(Development::className(), ['category_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getParent()
	{
		return $this->hasMany(DevelopmentCategory::className(), ['id' => 'parent_id']);
	}

	/**
	 * @inheritdoc
	 */
	public function getSeofield()
	{
		return $this->hasOne(Seofield::className(), ['id' => 'seofield_id']);
	}
}
