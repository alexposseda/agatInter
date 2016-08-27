<?php
    namespace backend\models;

    use common\models\GalleryCategory;
    use common\models\GalleryItem;
    use yii\base\Model;
    use yii\data\ActiveDataProvider;

    class SearchGalleryItems extends GalleryItem{
        public function rules(){
            return [
                [
                    [
                        'id',
                        'categoryId'
                    ],
                    'integer'
                ],
                [
                    [
                        'picture',
                        'description'
                    ],
                    'safe'
                ],
            ];
        }

        public function scenarios(){
            return Model::scenarios();
        }

        public function search($categoryId){
            $query = GalleryItem::find();
            if(!$categoryId){
                $this->categoryId = GalleryCategory::find()
                                                   ->all()[0]->id;
            }else{
                $this->categoryId = $categoryId;
            }

            $dataProvider = new ActiveDataProvider([
                                                       'query' => $query,
                                                   ]);

            if(!$this->validate()){
                return $dataProvider;
            }

            $query->andFilterWhere([
                                       'categoryId' => $this->categoryId,
                                   ]);
            return $dataProvider;
        }
    }