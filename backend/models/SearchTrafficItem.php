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

            $dataProvider = new ActiveDataProvider([
                                                       'query' => $query,
                                                   ]);

            $this->load($params);

            if(!$this->validate()){
                return $dataProvider;
            }
            $query->andFilterWhere([
                                       'categoryId' => $this->categoryId,
                                   ]);


            return $dataProvider;
        }
    }
