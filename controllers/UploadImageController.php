<?php
namespace app\controllers;

use app\models\UploadFormLevelOne;
use app\models\UploadFormLevelTwo;

use app\repositories\ImagesRepo;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;// Clase de Yii para subir archivos


class UploadImageController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $securityLevel = Yii::$app->request->cookies->getValue('mySelectValue', 1);
        // Security Level
        switch ($securityLevel) {
            case 1:
                //Level 1 totally Unsafe
                $model = new UploadFormLevelOne();
                break;
            case 2:
                $model = new UploadFormLevelTwo();
                break;
            default:
                die("Module under construction plase visit https://github.com/benjamin-castillo/yiisploitable for more information");
                break;
        }

        $webroot = Yii::getAlias('@webroot');

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->validate()) {
                // Save file on server

                $filePath = $webroot . '/uploads/' . $model->file->baseName . '.' . $model->file->extension;
                $successfull = $model->file->saveAs($filePath);

                if ($successfull) {
                    switch ($securityLevel) {
                        case 1:  // Level 1
                            return $this->render('upload-success', [
                                'filePath' => $filePath,
                                'securityLevel' => $securityLevel
                            ]);
                            break;
                        case 3: // Level 2
                            $ImageSmallPath = $filePath;//  Use the same file and overwrite
                            ImagesRepo::Resize($filePath, $ImageSmallPath, 300, 300);
                            return $this->render('upload-success', [
                                'filePath' => $filePath,
                                'securityLevel' => $securityLevel,
                                'ImageSmallPath' => $ImageSmallPath
                            ]);
                            break;

                    }
                }
            }
        }


        return $this->render('/upload-image/index', ['model' => $model, 'securityLevel' => $securityLevel]);

    }


}