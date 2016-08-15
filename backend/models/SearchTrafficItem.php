<?php

    namespace backend\models;

    use common\models\TrafficCategory;
    use Yii;
    use yii\base\Model;
    use yii\data\ActiveDataProvider;
    use common\models\TrafficItem;

    /**
     * SearchTrafficItem represents the model behind the search form about `common\models\TrafficItem`.
     */
    class SearchTrafficItem extends TrafficItem{
        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [['id', 'categoryId'], 'integer'],
                [['title', 'cover', 'description'], 'safe'],
            ];
        }

        /**
         * @inheritdoc
         */
        public function scenarios(){
            // bypass scenarios() implementation in the parent class
            return Model::scenarios();
        }

        /**
         * Creates data provider instance with search query applied
         *
         * @param array $params
         *
         * @return ActiveDataProvider
         */
        public function search($params){
            $query = TrafficItem::find();
            if(!isset($this->categoryId)){
                $this->categoryId = TrafficCategory::find()
                                                   ->all()[0]->id;
            }
            // add conditions that should always apply here

            $dataProvider = new ActiveDataProvider([
                                                       'query' => $query,
                                                   ]);

            $this->load($params);

            if(!$this->validate()){
                // uncomment the following line if you do not want to return any records when validation fails
                // $query->where('0=1');
                return $dataProvider;
            }

            // grid filtering conditions
            $query->andFilterWhere([
                                       'id'         => $this->id,
                                       'categoryId' => $this->categoryId,
                                   ]);

            $query->andFilterWhere(['like', 'title', $this->title])
                  ->andFilterWhere(['like', 'cover', $this->cover])
                  ->andFilterWhere(['like', 'description', $this->description]);

            return $dataProvider;
        }
    }
