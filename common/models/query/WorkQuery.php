<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\Work;
use yii\db\ActiveQuery;

class WorkQuery extends ActiveQuery
{
	public function published()
	{
		$this->andWhere(['status' => Work::STATUS_PUBLISHED]);
		$this->andWhere(['<', '{{%work}}.published_at', time()]);
		return $this;
	}
}
