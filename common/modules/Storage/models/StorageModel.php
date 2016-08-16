<?php

    namespace common\modules\Storage\models;

    use common\modules\Storage\StorageModule;
    use Yii;
    use yii\base\Model;
    use yii\helpers\FileHelper;
    use yii\validators\Validator;

    class StorageModel extends Model{
        public    $file;
        public    $maxFiles;
        protected $savedPath;

        public function rules(){
            return [
                ['file', 'required'],
                ['file', 'storageValidator'],
            ];
        }

        public function scenarios(){
            return ['default' => ['file']];
        }

        public function upload($directory){
            $module = StorageModule::getInstance();
            $storageDir = $module->BaseDir;
            $fileName = uniqid(time(), true).'.'.$this->file->extension;
            switch($this->file->extension){
                case 'jpg':
                case 'jpeg':
                case 'png':
                    $sessionName = 'picture';
                    break;

                default:
                    return false;
            }
            $path = FileHelper::normalizePath($storageDir.DIRECTORY_SEPARATOR.$directory.DIRECTORY_SEPARATOR.$fileName);
            if($this->file->saveAs($path)){
                $this->savedPath = $directory.DIRECTORY_SEPARATOR.$fileName;
                $uploadedFile = Yii::$app->session->get($sessionName);
                if(!$uploadedFile){
                    $uploadedFile = [];
                }
                $uploadedFile[] = $directory.DIRECTORY_SEPARATOR.$fileName;
                Yii::$app->session->set($sessionName, $uploadedFile);

                return true;
            }

            return false;
        }

        public function remove($sessionName){
            $path = Yii::$app->request->post('path');
            $module = StorageModule::getInstance();
            $storageDir = $module->BaseDir;

            if($path && file_exists($storageDir.DIRECTORY_SEPARATOR.$path)){
                unlink($storageDir.DIRECTORY_SEPARATOR.$path);
                $uploadedFile = Yii::$app->session->get($sessionName);
                foreach($uploadedFile as $key => $value){
                    if($value == $path){
                        unset($uploadedFile[$key]);
                        $uploadedFile = array_values($uploadedFile);
                    }
                }
                Yii::$app->session->set($sessionName, $uploadedFile);

                return true;
            }

            return false;
        }

        public function getSavedPath(){
            return $this->savedPath;
        }

        public function storageValidator($attribute, $params){
            switch($this->file->extension){
                case 'jpg':
                case 'jpeg':
                case 'png':
                    $validator = Validator::createValidator('file', $this, ['file'], [
                        'skipOnEmpty' => false,
                        'extensions'  => 'png, jpg, jpeg',
                        'maxFiles'    => $this->maxFiles,
                        'maxSize'     => 1024 * 1024
                    ]);
                    if(!$validator->validate($this->file)){
                        $this->addError($attribute, 'Error');
                    }
                    break;
                default:
                    $this->addError($attribute, 'Unknow format');
            }
        }
    }