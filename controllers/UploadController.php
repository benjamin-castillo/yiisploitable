<?php
namespace app\controllers;

use app\models\UploadFormLevelOne;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;// Clase de Yii para subir archivos
//use app\models\UploadForm;

class UploadController extends Controller
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
            default:
                die("Module under construction plase visit https://github.com/benjamin-castillo/yiisploitable for more information");
                break;
        }

        $webroot = Yii::getAlias('@webroot');

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->validate()) {
                // Guardar el archivo en el servidor

                $filePath = $webroot . '/uploads/' . $model->file->baseName . '.' . $model->file->extension;
                $model->file->saveAs($filePath);

                // Aquí puedes agregar cualquier otra lógica necesaria

                return $this->render('upload-success', [
                    'filePath' => $filePath,
                    'securityLevel' => $securityLevel
                ]);
            }
        }


        return $this->render('/upload/index', ['model' => $model, 'securityLevel' => $securityLevel]);

    }


}