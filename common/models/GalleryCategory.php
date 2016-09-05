<?php
    namespace common\models;
    use Yii;
    use yii\db\ActiveRecord;

    /**
     * This is the model class for table "{{%gallery_category}}".
     *
     * @property integer $id
     * @property string $title
     *
     * @property GalleryItem[] $galleryItems
     */
    class GalleryCategory extends ActiveRecord{
        /**
         * @inheritdoc
         */
        public static function tableName(){
            return '{{%gallery_category}}';
        }

        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [['title'], 'required'],
                [['title'], 'string', 'max' => 255],
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels(){
            return [
                'id' => 'ID',
                'title' => 'Название',
            ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getGalleryItems(){
            return $this->hasMany(GalleryItem::className(), ['categoryId' => 'id']);
        }
    }
