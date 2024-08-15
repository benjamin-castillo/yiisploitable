<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadFormLevelTwo extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;

    public function rules()
    {
        return [
            [
                ['file'],
                'file',
                'skipOnEmpty' => false,
                'extensions' => 'png, jpg' //Filter just images
            ],
        ];
    }
}