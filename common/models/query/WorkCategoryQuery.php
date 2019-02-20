<?php
/**
 * Created by Ed.Creater <ed.creater@gmail.com>.
 * Author Site: https://codesweet.ru
 * Date: 27.02.2018
 */

namespace common\models\query;

use common\models\WorkCategory;
use yii\db\ActiveQuery;

class WorkCategoryQuery extends ActiveQuery
{
	/**
	 * @return $this
	 */
	public function active()
	{
		$this->andWhere(['status' => WorkCategory::STATUS_ACTIVE]);

		return $this;
	}

}
