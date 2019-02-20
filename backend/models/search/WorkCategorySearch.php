<?php
/**
 * Created by Ed.Creater <ed.creater@gmail.com>.
 * Author Site: https://codesweet.ru
 * Date: 27.02.2018
 */

namespace backend\models\search;

use common\models\WorkCategory;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * WorkCategorySearch represents the model behind the search form about `common\models\WorkCategory`.
 */
class WorkCategorySearch extends WorkCategory
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id', 'status'], 'integer'],
			[['slug', 'title'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function scenarios()
	{
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	/**
	 * Creates data provider instance with search query applied
	 * @return ActiveDataProvider
	 */
	public function search($params)
	{
		$query = WorkCategory::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
			'id' => $this->id,
			'status' => $this->status,
		]);

		$query->andFilterWhere(['like', 'slug', $this->slug])
		      ->andFilterWhere(['like', 'title', $this->title]);

		return $dataProvider;
	}
}
