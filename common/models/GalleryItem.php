<?php
    namespace common\models;
    use Yii;
    use yii\db\ActiveRecord;

    /**
     * This is the model class for table "{{%gallery_item}}".
     *
     * @property integer $id
     * @property integer $categoryId
     * @property string $picture
     * @property string $description
     *
     * @property GalleryCategory $category
     */
    class GalleryItem extends ActiveRecord{
        /**
         * @inheritdoc
         */
        public static function tableName(){
            return '{{%gallery_item}}';
        }

        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [['categoryId'], 'integer'],
                [['categoryId', 'picture'], 'required'],
                [['description'], 'string'],
                [['picture'], 'string', 'max' => 255],
                [
                    ['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => GalleryCategory::className(),
                    'targetAttribute' => ['categoryId' => 'id']
                ],
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels(){
            return [
                'id' => 'ID',
                'categoryId' => 'Категория',
                'picture' => 'Изображение',
                'description' => 'Описание',
            ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getCategory(){
            return $this->hasOne(GalleryCategory::className(), ['id' => 'categoryId']);
        }
    }
