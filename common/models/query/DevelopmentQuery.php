<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\Development;
use yii\db\ActiveQuery;

class DevelopmentQuery extends ActiveQuery
{
	public function published()
	{
		$this->andWhere(['status' => Development::STATUS_PUBLISHED]);
		$this->andWhere(['<', '{{%development}}.published_at', time()]);
		return $this;
	}
}
