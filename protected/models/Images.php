<?php

/**
 * This is the model class for table "image".
 * Note: I have to change this Model to Images instead of Image because of this name is conflict with Image.php in the Extension
 *
 * The followings are the available columns in table 'image':
 * @property integer $id
 * @property string $location  // For WL subwiz - used for image filename
 * @property string $tag
 * @property string $url
 * @property string $license
 * @property string $photographer
 * @property string $source
 *
 * The followings are the available model relations:
 * @property Dataset[] $datasets
 */
class Images extends ImageHaver
{

    /** @var $image_upload CUploadedFile */
    public $image_upload;
    public $is_no_image = 0;  // Boolean showing if it is a generic dataset image
    public static $fup_img = '/images/fair.png';
    public $old_image;  // For WL subwiz - not sure if this is being used
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Image the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'image';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('image_upload', 'file', 'types'=>'jpg, jpeg, gif, png', 'allowEmpty'=>true, 'on'=>'update'),
            array('image_upload', 'validateImageUpload'),
            array('license, photographer, source', 'required'),
            array('tag', 'length', 'max'=>120),
            array('url, source', 'length', 'max'=>256),
            array('photographer', 'length', 'max'=>128),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, tag, url, license, photographer, source', 'safe', 'on'=>'search'),
        );
    }

    /**
     * Tests whether any attributes are missing for image object
     * 
     * New function for WL submission wizard.
     * 
     * @param $attribute
     * @param $params
     */
    public function validateImageUpload($attribute, $params)
    {
        // IF this image is NOT a generic dataset image AND $attribute has a value AND ( image is a new database table record OR location has value "no_image.jpg")
        if (!$this->is_no_image && !$this->$attribute && ($this->getIsNewRecord() || $this->location == 'no_image.png')) {
            $labels = $this->attributeLabels();
            $this->addError($attribute, $labels[$attribute] . ' cannot be blank.');
        }
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'datasets' => array(self::HAS_MANY, 'Dataset', 'image_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'tag' => 'Image Title',
            'url' => 'Image URL',
            'license' => 'Image License',
            'photographer' => 'Image Credit',
            'source' => 'Image Source',
            'image_upload' => 'Upload Image',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('tag',$this->tag,true);
        $criteria->compare('url',$this->url,true);
        $criteria->compare('license',$this->license,true);
        $criteria->compare('photographer',$this->photographer,true);
        $criteria->compare('source',$this->source,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }


    public function save($runValidation = true, $attributes = NULL){
        Yii::log('', CLogger::LEVEL_INFO, '==== In Images::save function ====');
        if (!parent::save()) return false;
        $this->updateImage('image_upload');
        return true;
   }

    public function getImageTypeName() {
        return "image_upload";
    }

    /**
     * Shows if this image object is a generic dataset image or not
     * 
     * New function for WL submission wizard.
     * 
     * 0 = use custom image provided for submitter
     * 1 = use generic dataset image
     * 
     * @param $isNoImage
     */
    public function setIsNoImage($isNoImage)
    {
        $this->is_no_image = (int)$isNoImage;
    }

    /**
     * New function for WL submission wizard
     * 
     * @param $data
     */
    public function loadByData($data)
    {
        if (!$data['is_no_image']) {
            $this->image_upload = CUploadedFile::getInstance($this, 'image_upload');
            if ($this->image_upload) {
                $this->old_image = $this->url;

                $fileName = time() . '.' . $this->image_upload->getExtensionName();
                $this->url = MainHelper::getUploadsDir() . '/' . $fileName;
                $this->location = $fileName;
            }

            $this->tag = $data['tag'];
            $this->license = $data['license'];
            $this->photographer = $data['photographer'];
            $this->source = $data['source'];
            $this->is_no_image = 0;
        } else {
            if ($this->url && $this->url != "http://gigadb.org/images/data/cropped/no_image.png") {
                $this->old_image = $this->url;
            }

            $this->url="http://gigadb.org/images/data/cropped/no_image.png";
            $this->location="no_image.jpg";
            $this->tag="no image icon";
            $this->license="Public domain";
            $this->photographer="GigaDB";
            $this->source="GigaDB";
            $this->is_no_image = 1;
        }
    }

    /**
     * New function for WL submission wizard
     * 
     * @return bool
     * @throws Exception
     */
    public function saveImageFile()
    {
        if ($this->image_upload) {
            $res = Gregwar\Image\Image::open($this->image_upload->getTempName())
                ->resize(400, 400, 0xffffff)
                ->save($this->url);

            if (!$res) {
                return false;
            }

            if ($this->old_image && file_exists($this->old_image)) {
                unlink($this->old_image);
            }
        }

        return true;
    }

#    // Or this, for that matter
#    public function updateImage($type) {
#        if (!isset($_POST["use_$type"]) or $_POST["use_$type"]!= 'current') {
#    	    $image = CUploadedFile::getInstanceByName("{$type}_image");
#	        if ($image !== null) {
#                  $this->setImage($type, $image);
#                  $this->location = $this->image($type);
#            }
#        }
#    }
}
