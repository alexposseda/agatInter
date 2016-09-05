<?php
    namespace backend\models;

    use common\models\GalleryCategory;
    use common\models\GalleryItem;
    use Yii;
    use yii\alexposseda\fileManager\FileManager;
    use yii\base\ErrorException;
    use yii\base\Exception;
    use yii\base\Model;

    class GalleryModel extends Model{
        public $id = null;
        /**
         * @var GalleryCategory
         */
        public $galleryCategory;
        /**
         * @var GalleryItem[]
         */
        public $galleryItems = [];

        public function init(){
            parent::init();
            if(!is_null($this->id)){
                $this->galleryCategory = GalleryCategory::findOne($this->id);
                $this->galleryItems = $this->galleryCategory->getGalleryItems()
                                                            ->all();
            }else{
                $this->galleryCategory = new GalleryCategory();
            }
        }

        public function loadAndValidate(){
            $isValid = false;
            if($this->galleryCategory->load(Yii::$app->request->post()) && $this->galleryCategory->validate()){
                $isValid = true;
            }

            if($isValid){
                $galleryItems = Yii::$app->request->post('GalleryItem');
                if($galleryItems){
                    foreach($galleryItems as $index => $data){
                        if(isset($data['id'])){
                            $this->galleryItems[$index] = GalleryItem::findOne($data['id']);
                        }else{
                            $this->galleryItems[$index] = new GalleryItem();
                        }
                    }

                    if(Model::loadMultiple($this->galleryItems, Yii::$app->request->post()) && Model::validateMultiple($this->galleryItems)){
                        $isValid = true;
                    }
                }else{
                    $isValid = true;
                }
            }

            return $isValid;
        }

        public function createCategory(){
            $transaction = Yii::$app->db->beginTransaction();
            try{
                if(!$this->galleryCategory->save()){
                    throw new ErrorException('Не могу сохранить категорию!');
                }

                foreach($this->galleryItems as $item){
                    $item->categoryId = $this->galleryCategory->id;
                    if(!$item->save()){
                        throw new ErrorException('Не могу сохранить изображение!');
                    }
                    FileManager::getInstance()->removeFromSession($item->picture);
                }
                $transaction->commit();
                return true;
            }catch(ErrorException $e){
                $transaction->rollBack();
                return false;
            }
        }

        public function updateCategory(){
            $transaction = Yii::$app->db->beginTransaction();
            try{
                if(!$this->galleryCategory->save()){
                    throw new ErrorException('Не могу сохранить категорию!');
                }

                foreach($this->galleryItems as $item){
                    if(!$item->id){
                        $item->categoryId = $this->galleryCategory->id;
                        if(!$item->save()){
                            throw new ErrorException('Не могу сохранить изображение!');
                        }
                        FileManager::getInstance()->removeFromSession($item->picture);
                    }else{
                        if(!$item->save()){
                            throw new ErrorException('Не могу обновить изображение!');
                        }
                    }
                }
                $transaction->commit();
                return true;
            }catch(ErrorException $e){
                $transaction->rollBack();
                return false;
            }
        }

        public function deleteCategory(){
            foreach($this->galleryItems as $item){
                $item->delete();
            }
            $this->galleryCategory->delete();
        }
    }