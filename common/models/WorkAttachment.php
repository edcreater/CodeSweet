<?php
/**
 * Created by Ed.Creater <ed.creater@gmail.com>.
 * Author Site: https://codesweet.ru
 * Date: 27.02.2018
 */

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%work_attachment}}".
 *
 * @property integer $id
 * @property integer $work_id
 * @property string $base_url
 * @property string $path
 * @property string $url
 * @property string $name
 * @property string $type
 * @property string $size
 * @property integer $order
 *
 * @property Work $work
 */
class WorkAttachment extends ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%work_attachment}}';
	}

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			[
				'class' => TimestampBehavior::className(),
				'updatedAtAttribute' => false
			]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['work_id', 'path'], 'required'],
			[['work_id', 'size', 'order'], 'integer'],
			[['base_url', 'path', 'type', 'name'], 'string', 'max' => 255]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('common', 'ID'),
			'work_id' => Yii::t('common', 'Work ID'),
			'base_url' => Yii::t('common', 'Base Url'),
			'path' => Yii::t('common', 'Path'),
			'size' => Yii::t('common', 'Size'),
			'order' => Yii::t('common', 'Order'),
			'type' => Yii::t('common', 'Type'),
			'name' => Yii::t('common', 'Name')
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getWork()
	{
		return $this->hasOne(Work::className(), ['id' => 'work_id']);
	}

	public function getUrl()
	{
		return $this->base_url . '/' . $this->path;
	}
}
