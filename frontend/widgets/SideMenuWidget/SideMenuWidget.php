<?php
    namespace frontend\widgets\SideMenuWidget;
    use Yii;
    use yii\base\Widget;

    class SideMenuWidget extends Widget{
        public $route;
        public $menuItems = [];

        public function init(){
            parent::init();
            foreach($this->menuItems as $key => $outerItem){
                if($outerItem['innerMenu'] and is_array($outerItem['innerMenu']['items'])){
                    foreach($outerItem['innerMenu']['items'] as $id => $title){
                        $label = $title;
                        $url = [$this->menuItems[$key]['url'][0], $outerItem['innerMenu']['paramName'] => $id];
                        $outerItem['innerMenu']['items'][$id] = [
                            'label' => $label,
                            'url' => $url,
                            'labelOptions' => []
                        ];
                    }
                    $this->menuItems[$key] = $outerItem;
                }
            }
        }

        public function run(){
            if($this->route === null && Yii::$app->controller !== null){
                $this->route = Yii::$app->controller->getRoute();
            }
            foreach($this->menuItems as $key => $outerItem){
                $isActive = false;
                if(!isset($outerItem['labelOptions'])){
                    $this->menuItems[$key]['labelOptions'] = [];
                }
                if($this->isItemActive($outerItem)){
                    $isActive = true;
                    if(isset($outerItem['labelOptions']['class'])){
                        $this->menuItems[$key]['labelOptions']['class'] .= ' active';
                    }else{
                        $this->menuItems[$key]['labelOptions']['class'] = 'active';
                    }
                }
                if(is_array($outerItem['innerMenu']['items'])){
                    foreach($outerItem['innerMenu']['items'] as $index => $item){
                        if($isActive and $item['url'][$outerItem['innerMenu']['paramName']] == Yii::$app->request->get($outerItem['innerMenu']['paramName'])){
                            $this->menuItems[$key]['innerMenu']['items'][$index]['labelOptions']['class'] = 'active';
                        }
                    }
                }
            }
            SideMenuWidgetAsset::register(Yii::$app->getView());

            return $this->render('side_menu_widget', ['menuItems' => $this->menuItems]);
        }

        protected function isItemActive($item){
            if(isset($item['url']) && is_array($item['url']) && isset($item['url'][0])){
                $route = Yii::getAlias($item['url'][0]);
                if($route[0] !== '/' && Yii::$app->controller){
                    $route = Yii::$app->controller->module->getUniqueId().'/'.$route;
                }
                if(ltrim($route, '/') !== $this->route){
                    return false;
                }
                unset($item['url']['#']);
                if(count($item['url']) > 1){
                    $params = $item['url'];
                    unset($params[0]);
                    foreach($params as $name => $value){
                        if($value !== null && (!isset($this->params[$name]) || $this->params[$name] != $value)){
                            return false;
                        }
                    }
                }

                return true;
            }

            return false;
        }
    }