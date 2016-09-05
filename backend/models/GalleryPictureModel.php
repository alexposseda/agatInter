<?php

    namespace backend\models;

    use Imagine\Image\Box;
    use Imagine\Image\Point;
    use yii\alexposseda\fileManager\FileManager;
    use yii\alexposseda\fileManager\models\FileManagerModel;
    use yii\imagine\Image;

    class GalleryPictureModel extends FileManagerModel{
        const BASE_PREFIX = 'base_';
        const THUMB_PREFIX = 'thumb_';
        const THUMB = [
            'width' => 340,
            'height' => 200
        ];
        const BASE = [
            'width' => 1020,
            'height' => 600
        ];

        public function uploadFile($directory){
            $fileName = uniqid(time(), true);
            $this->savePath = $directory.DIRECTORY_SEPARATOR.$fileName.'.'.$this->file->extension;

            if(!$this->file->saveAs(FileManager::getInstance()
                                               ->getStoragePath().$this->savePath)
            ){
                $this->addError(FileManager::getInstance()
                                           ->getAttributeName(), 'Upload failed');
            }

            $picture = Image::getImagine()
                            ->open(FileManager::getInstance()
                                              ->getStoragePath().$this->savePath);
            $pictureSize = $picture->getSize();
            $pictureK = self::BASE['width']/self::BASE['height'];

            if($pictureSize->getWidth() > self::BASE['width']){
                $width = $pictureSize->getWidth() / $pictureK;
                $cropX = ($pictureSize->getWidth() - $width) / 2;
            }else{
                $width = $pictureSize->getWidth();
                $cropX = 0;
            }
            if($pictureSize->getHeight() > self::BASE['height']){
                $height = $pictureSize->getHeight() / $pictureK;
                $cropY = ($pictureSize->getHeight() - $height) / 2;
            }else{
                $height = $pictureSize->getHeight();
                $cropY = 0;
            }

            $cropBox = new Box(self::BASE['width'], self::BASE['height']);
            $thumbBox = new Box(self::THUMB['width'], self::THUMB['height']);
            $baseName = FileManager::getInstance()
                                   ->getStoragePath().$directory.DIRECTORY_SEPARATOR.self::BASE_PREFIX.$fileName.'.'.$this->file->extension;
            $thumbName = FileManager::getInstance()
                                   ->getStoragePath().$directory.DIRECTORY_SEPARATOR.self::THUMB_PREFIX.$fileName.'.'.$this->file->extension;

            $picture->resize($cropBox)->save($baseName);
            $picture->thumbnail($thumbBox)->save($thumbName);

            return $this;
        }

        public static function removeFile($file){
            $fileName = substr($file, strrpos($file, '/')+1);
            $dirName = substr($file, 0, strrpos($file, '/')+1);
            $baseName = $dirName.self::BASE_PREFIX.$fileName;
            $thumbName = $dirName.self::THUMB_PREFIX.$fileName;

            $removeResult = [
                'full' => FileManager::getInstance()->removeFile($file, FileManager::FORMAT_BASE),
                'base' => FileManager::getInstance()->removeFile($baseName, FileManager::FORMAT_BASE),
                'thumb' => FileManager::getInstance()->removeFile($thumbName, FileManager::FORMAT_BASE),
            ];
            if($removeResult['full']['error'] || $removeResult['base']['error'] || $removeResult['thumb']['error']){
                return FileManager::getInstance()->createResponse(['error'=> ['Файлы удалены не полностью!']]);
            }
            return FileManager::getInstance()->createResponse(['success'=> ['Файлы удалены полностью!']]);
        }

        public static function getThumb($file){
            $dirName = substr($file, 0, strrpos($file, '/')+1);
            $fileName = substr($file, strrpos($file, '/')+1);

            return FileManager::getInstance()->getStorageUrl().$dirName.self::THUMB_PREFIX.$fileName;
        }

        public static function getBase($file){
            $dirName = substr($file, 0, strrpos($file, '/')+1);
            $fileName = substr($file, strrpos($file, '/')+1);

            return FileManager::getInstance()->getStorageUrl().$dirName.self::BASE_PREFIX.$fileName;
        }

    }