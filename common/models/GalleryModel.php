<?php
    namespace common\models;
    use Yii;
    use yii\base\Model;

    class GalleryModel extends Model{
        public $categoryModel;
        public $items;

        protected $_galleryItemModels = [];

        public function load($data){
            if(!$this->categoryModel->load($data) || !$this->categoryModel->validate()){
                $this->addError('categoryModel', 'category Error');
            }
            foreach($data['items'] as $i => $item){
                $this->_galleryItemModels[$i] = new GalleryItem();
                if(!$this->_galleryItemModels[$i]->load($item) || !$this->_galleryItemModels[$i]->validate()){
                    $this->addError('items', 'items '.$i.' error');
                }
            }

            if($this->hasErrors()){
                return false;
            }

            return true;
        }

        public function save(){
            $transaction = Yii::$app->db->beginTransaction();
            try{
                if(!$this->categoryModel->save()){
                    throw new \Exception('Category not save!');
                }

                foreach($this->_galleryItemModels as $galleryItem){
                    $galleryItem->categoryId = $this->categoryModel->id;
                    if(!$galleryItem->save()){
                        throw new \Exception('Gallery Item not Save!');
                    }
                }
                $transaction->commit();
                return true;
            }catch(\Exception $e){
                $transaction->rollBack();
                return false;
            }
        }

    }