<?php
/**
 * Created by Ed.Creater <ed.creater@gmail.com>.
 * Author Site: https://codesweet.ru
 * Date: 27.02.2018
 */

namespace backend\models\search;

use common\models\Work;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * WorkSearch represents the model behind the search form about `common\models\Work`.
 */
class WorkSearch extends Work
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id', 'category_id', 'created_by', 'updated_by', 'status', 'published_at', 'created_at', 'updated_at'], 'integer'],
			[['slug', 'title', 'body'], 'safe'],
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
		$query = Work::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
			'id' => $this->id,
			'slug' => $this->slug,
			'created_by' => $this->created_by,
			'category_id' => $this->category_id,
			'updated_by' => $this->updated_by,
			'status' => $this->status,
			'published_at' => $this->published_at,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
		]);

		$query->andFilterWhere(['like', 'slug', $this->slug])
		      ->andFilterWhere(['like', 'title', $this->title])
		      ->andFilterWhere(['like', 'body', $this->body]);

		return $dataProvider;
	}
}
