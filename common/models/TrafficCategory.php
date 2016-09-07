<?php

    namespace common\models;

    use Imagine\Image\Box;
    use Yii;
    use yii\alexposseda\fileManager\FileManager;
    use yii\db\ActiveRecord;
    use yii\helpers\FileHelper;
    use yii\imagine\Image;

    /**
     * This is the model class for table "agi_traffic_category".
     *
     * @property integer       $id
     * @property string        $title
     *
     * @property TrafficItem[] $trafficItems
     */
    class TrafficCategory extends ActiveRecord{
        /**
         * @inheritdoc
         */
        public static function tableName(){
            return 'agi_traffic_category';
        }

        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [['title'], 'required']
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels(){
            return [
                'id'          => 'ID',
                'title'       => 'Название',
            ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getTrafficItems(){
            return $this->hasMany(TrafficItem::className(), ['categoryId' => 'id']);
        }
    }
