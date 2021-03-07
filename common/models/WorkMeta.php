<?php

namespace common\models;

use common\behaviors\CacheInvalidateBehavior;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "work_meta".
 *
 * @property integer $id
 * @property string $key
 * @property integer $status
 *
 * @property WorkMeta[] $items
 */
class WorkMeta extends ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%work_meta}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'cacheInvalidate' => [
                'class' => CacheInvalidateBehavior::className(),
                'cacheComponent' => 'frontendCache',
                'keys' => [
                    function ($model) {
                        return [
                            self::className(),
                            $model->key
                        ];
                    }
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['work_id'], 'required'],
            [['work_id', 'status', 'order'], 'integer'],
            [['key'], 'required'],
            [['key'], 'unique'],
            [['key', 'value'], 'string', 'max' => 255]
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
            'key' => Yii::t('common', 'Key'),
            'key' => Yii::t('common', 'Value'),
            'status' => Yii::t('common', 'Active'),
            'order' => Yii::t('common', 'Order')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasOne(WorkMeta::className(), ['id' => 'work_id']);
    }
}
