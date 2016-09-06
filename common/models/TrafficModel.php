<?php

    namespace common\models;

    use yii\base\Model;

    class TrafficModel extends Model{
        public $id = null;
        /**
         * @var TrafficCategory
         */
        public $trafficCategory;
        /**
         * @var TrafficItem[]
         */
        public $trafficItems = [];

        public function init(){
            parent::init();
            if(!is_null($this->id)){
                $this->trafficCategory = TrafficCategory::findOne($this->id);
                $this->trafficItems = $this->trafficCategory->getTrafficItems()
                                                            ->all();
            }else{
                $this->trafficCategory = new TrafficCategory();
            }
        }
    }