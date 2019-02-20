<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\DevelopmentCategory;
use yii\db\ActiveQuery;

class DevelopmentCategoryQuery extends ActiveQuery
{
	/**
	 * @return $this
	 */
	public function active()
	{
		$this->andWhere(['status' => DevelopmentCategory::STATUS_ACTIVE]);

		return $this;
	}

	/**
	 * @return $this
	 */
	public function noParents()
	{
		$this->andWhere('{{%development_category}}.parent_id IS NULL');

		return $this;
	}
}
