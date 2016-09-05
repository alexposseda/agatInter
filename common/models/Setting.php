<?php
    namespace common\models;
    use Yii;
    use yii\base\Model;

    /**
     * This is the model class for table "{{%setting}}".
     *
     * @property integer $id
     * @property string $settingName
     * @property string $settingValue
     */
    class Setting extends \yii\db\ActiveRecord{
        /**
         * @inheritdoc
         */
        public static
        function tableName(){
            return '{{%setting}}';
        }

        /**
         * @inheritdoc
         */
        public
        function rules(){
            return [
                [['settingName', 'settingValue'], 'string', 'max' => 255],
                [['settingName'], 'unique'],
            ];
        }

        /**
         * @inheritdoc
         */
        public
        function attributeLabels(){
            return [
                'id' => 'ID',
                'settingName' => 'Setting Name',
                'settingValue' => 'Setting Value',
            ];
        }

        /**
         * @param Model $formModel
         * @return bool
         */
        public static
        function saveSetting($formModel){
            foreach($formModel->attributes as $settingName => $settingValue){
                $model = static::find()->where(['settingName' => $settingName])->one();
                $model->settingValue = $settingValue;
                if(!$model->save(true)){
                    $formModel->addError($settingName, 'Ошибка добавления...');
                };
            }
        }
    }
