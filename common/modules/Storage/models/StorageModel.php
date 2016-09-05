<?php

    namespace common\modules\Storage\models;

    use common\modules\Storage\StorageModule;
    use Imagine\Image\Box;
    use Yii;
    use yii\base\Model;
    use yii\helpers\FileHelper;
    use yii\imagine\Image;
    use yii\validators\Validator;

    class StorageModel extends Model{
        public    $file;
        public    $maxFiles = 1;
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

        public static function resizeImage($from, $files){
            if(is_string($files)){
                $files = json_decode($files);
            }else{
                $coverArr = [];
                foreach($files as $item){
                    if(strrpos($item, '\\')){
                        $coverArr[] = substr($item, strrpos($item, '\\') + 1);
                    }else{
                        $coverArr[] = $item;
                    }
                }
                $files = $coverArr;
            }

            foreach($files as $file){
                $image = Image::getImagine()
                              ->open($from.DIRECTORY_SEPARATOR.$file);

                $thumbBox = new Box(Yii::$app->params['servicesCover']['width'], Yii::$app->params['servicesCover']['height']);
                $image->thumbnail($thumbBox)
                      ->save($from.DIRECTORY_SEPARATOR.$file, ['quality' => 100]);
            }
        }

        public static function move($from, $to, $files){
            if(is_string($files)){
                $files = json_decode($files);
            }else{
                $coverArr = [];
                foreach($files as $item){
                    if(strrpos($item, '\\')){
                        $coverArr[] = substr($item, strrpos($item, '\\') + 1);
                    }else{
                        $coverArr[] = $item;
                    }
                }
                $files = $coverArr;
            }

            if(!is_dir($to)){
                FileHelper::createDirectory($to);
            }

            foreach($files as $file){
                if(file_exists($from.DIRECTORY_SEPARATOR.$file) && copy($from.DIRECTORY_SEPARATOR.$file, $to.DIRECTORY_SEPARATOR.$file)){
                    unlink($from.DIRECTORY_SEPARATOR.$file);
                }
            }
        }

        public static function delete($path){
            $module = StorageModule::getInstance();
            $storageDir = $module->BaseDir;

            if($path && file_exists($storageDir.DIRECTORY_SEPARATOR.$path)){
                unlink($storageDir.DIRECTORY_SEPARATOR.$path);
                $uploadedFile = Yii::$app->session->get('picture');
                foreach($uploadedFile as $key => $value){
                    if($value == $path){
                        unset($uploadedFile[$key]);
                        $uploadedFile = array_values($uploadedFile);
                    }
                }
                Yii::$app->session->set('picture', $uploadedFile);

                return true;
            }

            return false;
        }

        public function getSavedPath(){
            return $this->savedPath;
        }

        public function storageValidator($attribute, $params){
            switch($this->file->extension){
                //images
                case 'gif':
                case 'jpeg':
                case 'jpg':
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

                //docs
                case 'pdf':
                case 'txt':
                case 'rtf':
                case 'odt':
                case 'ott':
                case 'odp':
                case 'otp':
                case 'ods':
                case 'ots':
                case 'odc':
                case 'odf':
                case 'doc':
                case 'xls':
                case 'xlsm':
                case 'ppt':
                case 'docx':
                case 'dotx':
                case 'xlsx':
                case 'pptx':
                    break;

                //video
                case 'avi':
                case 'flv':
                case 'mov':
                case 'mp4':
                case 'mpg':
                case 'wmv':
                    break;

                //archives
                case '7z':
                case 'rar':
                case 'zip':
                case 'gz':
                case 'tar':
                case 'tgz':
                    break;

                //audio
                case 'mp3':
                case 'ogg':
                case 'wma':
                    break;
                default:
                    $this->addError($attribute, 'Unknow format');
            }
        }
    }

