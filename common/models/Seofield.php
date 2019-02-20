<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "seofield".
 *
 * @property int $id
 * @property string $seotitle
 * @property string $seodescription
 *
 * @property Article[] $articles
 */
class Seofield extends ActiveRecord
{

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%seofield}}';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['seotitle', 'seodescription'], 'string', 'max' => 512]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('common', 'ID'),
			'seotitle' => Yii::t('common', 'SEO Title'),
			'seodescription' => Yii::t('common', 'SEO Description')
		];
	}

	public function getArticles()
	{
		return $this->hasMany(Article::className(), ['seofield_id' => 'id']);
	}

}
