<?php

class ImageHaver extends CActiveRecord {

    public $size = 600;
    public $thumbSize = 120;
    public $smallThumbSize = 64;

    /**
     * Create directories for images to be uploaded and created in
     *
     * $dir will be ../../images/uploads/image_upload
     * $dir_thumbs will be ../../images/uploads/thumbs
     * $dir_small_thumbs will be ../../images/uploads/small_thumbs
     *
     * @param $type
     */
    public function createDirs($type) {
        $dir = Yii::getPathOfAlias('uploadPath') . "/{$type}";
        $dir_thumbs = "$dir/thumbs";
        $dir_small_thumbs = "$dir/small_thumbs";
        if (!file_exists($dir)) mkdir($dir);
        if (!file_exists($dir_thumbs)) mkdir($dir_thumbs);
        if (!file_exists($dir_small_thumbs)) mkdir($dir_small_thumbs);
    }

    /**
     * Return path to file without leading directory or URL
     *
     * @param $type
     * @param string $size image size
     * @return string $path
     */
    public function getPath($type, $size='') {
        $class = get_class($this);
        $dir = "/$type";
        switch ($size) {
            case 'thumb': $dir = "$dir/thumbs"; break;
            case 'small_thumb': $dir = "$dir/small_thumbs"; break;
            // Default: Full-sized image straight in $dir
        }

        if (property_exists($class, 'has_photo_id') and isset($this->photo_id)) {
            $path = "$dir/{$class}_{$this->photo_id}.png";
        } else {
            $path = "$dir/{$class}_{$this->id}.png";
        }
        #Yii::log(__FUNCTION__."> path: $path", 'debug');
        return $path;
    }

    /**
     * Returns absolute path?
     *
     * @param $type
     * @param string $size
     * @return string
     */
    public function getFullPath($type, $size="") {
        return Yii::getPathOfAlias('uploadPath') . $this->getPath($type, $size);
    }

    /**
     * Returns URL for image which will be /images/uploads/
     *
     * @param $type
     * @param string $size
     * @return string
     */
    public function getUrl($type, $size="") {
        return Yii::app()->request->baseURL . Yii::getPathOfAlias('uploadURL') . $this->getPath($type, $size);
    }

    /**
     * Returns URL for full size image file
     *
     * @param $type
     * @return string|null
     */
    public function image($type) {
        $path = $this->getFullPath($type);
        if (!file_exists($path)) return null;
        return $this->getUrl($type);
    }

    /**
     * Returns URL for thumbnail images
     *
     * @param $type
     * @return string|null
     */
    public function thumb($type) {
        $path = $this->getFullPath($type, 'thumb');
        if (!file_exists($path)) return null;
        return $this->getUrl($type, 'thumb');
    }

    /**
     * Returns URL for small thumbnail images
     *
     * @param $type
     * @return string|null
     */
    public function smallThumb($type) {
        $path = $this->getFullPath($type, 'small_thumb');
        if (!file_exists($path)) return null;
        return $this->getUrl($type, 'small_thumb');
    }

    /**
     * Saves full size image and creates thumbnails of it
     *
     * @param $type
     * @param $image
     * @return bool
     */
    public function setImage($type, $image) {
        $path = $this->getFullPath($type);
        $thumbPath = $this->getFullPath($type, 'thumb');
        $smallThumbPath = $this->getFullPath($type, 'small_thumb');
        #Yii::log(__FUNCTION__."> path: $path", 'debug');
        #Yii::log(__FUNCTION__."> thumbPath: $thumbPath", 'debug');
        #Yii::log(__FUNCTION__."> smallThumbPath: $smallThumbPath", 'debug');
        if ($image->getSize() > 0) {
            Yii::log(__FUNCTION__."> attempting to store image : $path",'debug');
            $this->createDirs($type);
            if (!$image->saveAs($path)) {
                Yii::log("Could not save file to path: $path", 'error');
                return false;
            }
	    #Yii::log("Got it to: $path", 'debug');
            //            $this->transformImage($path, $path, $this->size, null);
            $this->transformImage($path, $thumbPath, $this->thumbSize, null);
            $this->transformImage($path, $smallThumbPath, $this->smallThumbSize, null);
        } else {
            if (file_exists($path)) return unlink($path);
            else return true;
        }
    }

    /**
     * Generate new thumbnails from existing image
     *
     * @param $type
     */
    public function resizeImages($type) {
        $path = $this->getFullPath($type);
        $thumbPath = $this->getFullPath($type, 'thumb');
        $smallThumbPath = $this->getFullPath($type, 'small_thumb');
        #Yii::log(__FUNCTION__.'> Path: ' . $path, 'debug');
        $this->createDirs($type);

        if (file_exists($path)) {
            Yii::log(__FUNCTION__.'> Resizing image: ' . $path, 'debug');
            $this->transformImage($path, $thumbPath, $this->thumbSize, null);
            $this->transformImage($path, $smallThumbPath, $this->smallThumbSize, null);
        }
    }


  // Where should this go?

  /**
   * Creates file selector for choosing dataset image file
   *
   * @param $type
   */
  public function imageChooserField($type) {
    $image = $this->image($type);

    // Quick fix for the problem with Images_.png
    $fn = '' ;
    if($image){
        $fn = explode('/' , $image);
        $fn = end($fn);
    }

    if ($image !== null && $fn != 'Images_.png') {
      ?>
        <table>
          <tr>
            <td width="30"><?=CHtml::radioButton("use_$type", true, array('value'=>'current'))?></td>
            <td>Keep <a href="<?= $image ?>">current</a></td>
          </tr>
          <tr>
            <td width="30"><?=CHtml::radioButton("use_$type", false, array('value'=>''))?></td>
            <td><?=CHtml::fileField("{$type}_image")?></td>
          </tr>
        </table>
      <?php
        } else {
      echo CHtml::fileField("{$type}_image");
    }
  }

    // Or this, for that matter

    /**
     * Update image for dataset given an image is already present in dataset
     *
     * @param $type
     */
    public function updateImage($type) {
        if (!isset($_POST["use_$type"]) or $_POST["use_$type"]!= 'current') {
    	    $image = CUploadedFile::getInstanceByName("{$type}_image");
	        if ($image !== null) {
                $this->setImage($type, $image);
                Yii::log('update image', 'debug');
            }
        }
    }

    /**
     * Returns HTML image tag
     *
     * @param $type
     * @param string $alt
     * @return string
     */
    public function imageTag($type, $alt='') {
        $url = $this->image($type);
        if (!$url) return $this->defaultImage($type);
        return "<img src='$url' alt='$alt' />";
    }

    /**
     * Returns HTML image tag with thumbTag class value
     *
     * @param $type
     * @param string $alt
     * @return string
     */
    public function thumbTag($type, $alt='') {
      $url = $this->thumb($type);
      if (!$url) return $this->thumbDefaultImage($type);
      return "<img src='$url' alt='$alt' class='thumbTag' />";
    }

    /**
     * Returns HTML image tag with thumbTag class value
     *
     * @param $type
     * @param string $alt
     * @return string
     */
    public function smallThumbTag($type, $alt='') {
        $url = $this->smallThumb($type);
        if (!$url) return $this->smallDefaultImage($type);
        return "<img src='$url' alt='$alt' class='thumbTag' />";
    }

    /**
     * Returns HTML image tag with given size
     *
     * @param $type
     * @param string $alt
     * @return string
     */
    public function featureTitleTag($type, $alt='') {
        $url = $this->smallThumb($type);
        if ($url)
          return "<img src='$url' alt='$alt' height='18' width='18' />";
    }

    /**
     * Returns HTML image tag
     *
     * @param $type
     * @param string $alt
     * @return string
     */
    public function defaultImage($type, $alt='') {
        if (!$alt) {
            $alt = "anonymous $type";
        }
        $url = Yii::app()->request->baseURL.'/images/anon_'.$type.'.png';
        return "<img src='$url' alt='$alt' />";
    }

    /**
     * Returns HTML image tag for anonymous images
     *
     * @param $type
     * @param string $alt
     * @return string
     */
    public function thumbDefaultImage($type, $alt='') {
        if (!$alt) {
            $alt = "anonymous $type";
        }
        $url = Yii::app()->request->baseURL.'/images/anon_'.$type.'.png';
        return "<img src='$url' alt='$alt' class='thumbTag' />";
    }

    /**
     * Returns HTML image tag for small anonymous images
     *
     * @param $type
     * @param string $alt
     * @return string
     */
    public function smallDefaultImage($type, $alt='') {
        if (!$alt) {
            $alt = "anonymous $type";
        }
        $url = Yii::app()->request->baseURL.'/images/small_anon_'.$type.'.png';
        return "<img src='$url' alt='$alt' />";
    }

    /**
     * Creates a new image with custom size in a given directory
     *
     * @param $fromPath
     * @param $toPath
     * @param $width
     * @param $height
     */
    public function transformImage($fromPath, $toPath, $width, $height) {
        $image = Yii::app()->image->load($fromPath);
        if ($image) {
            $image->resize($width, $height);
            #Yii::log("From path: $fromPath", "error");
            #Yii::log("Saving to path: $toPath", "error");
            $image->save($toPath);
        }
    }

}
