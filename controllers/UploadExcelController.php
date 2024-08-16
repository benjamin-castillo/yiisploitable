<?php
namespace app\controllers;

use app\models\UploadFormExcelLevelOne;
use app\models\UploadFormExcelLevelTwo;
use yii\web\UploadedFile;
use yii\web\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yii;

class UploadExcelController extends Controller
{

    public function actionIndex()
    {
        $securityLevel = Yii::$app->request->cookies->getValue('mySelectValue', 1);
        // Security Level
        switch ($securityLevel) {
            case 1:
                //Level 1 totally Unsafe
                $model = new UploadFormExcelLevelOne();
                break;
            case 2:
                $model = new UploadFormExcelLevelTwo();
                break;
            case 3:
                die("Module under construction plase visit https://github.com/benjamin-castillo/yiisploitable for more information");
                break;
            default:
                die("Hey your are Hacker");
                break;
        }

        $webroot = Yii::getAlias('@webroot');

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->validate()) { // Valid correct file format
                // Save file on server
                $filePath = $webroot . '/uploads/' . $model->file->baseName . '.' . $model->file->extension;

                $successfull = $model->file->saveAs($filePath);

                if ($successfull) {
                    switch ($securityLevel) {
                        case 1:  // Level 1
                            $inputFileName = $filePath; // set File Path
                            // Cargar el archivo Excel
                            $spreadsheet = IOFactory::load($inputFileName);
                            // Seleccionar la primera hoja
                            $sheet = $spreadsheet->getActiveSheet();
                            // Read all files
                            $data = [];
                            foreach ($sheet->getRowIterator() as $row) {
                                $rowData = [];
                                $cellIterator = $row->getCellIterator();
                                $cellIterator->setIterateOnlyExistingCells(false); // Si es necesario incluir celdas vacías
                                foreach ($cellIterator as $cell) {
                                    $rowData[] = $cell->getValue();
                                }
                                $data[] = $rowData;
                            }

                            return $this->render('upload-success', [
                                'filePath' => $filePath,
                                'securityLevel' => $securityLevel,
                                'data' => $data
                            ]);
                            break;

                        case 2: // Level 2
                            $inputFileName = $filePath; // set File Path
                            $data = [];
                            try {
                                // Cargar el archivo Excel
                                $spreadsheet = IOFactory::load($inputFileName);

                                // Seleccionar la primera hoja
                                $sheet = $spreadsheet->getActiveSheet();

                                // Leer todas las filas
                                foreach ($sheet->getRowIterator() as $row) {
                                    $rowData = [];
                                    $cellIterator = $row->getCellIterator();
                                    $cellIterator->setIterateOnlyExistingCells(false); // Si es necesario incluir celdas vacías
                                    foreach ($cellIterator as $cell) {
                                        $rowData[] = $cell->getValue();
                                    }
                                    $data[] = $rowData;
                                }

                                // Mostrar los datos leídos
                                //print_r($data);
                            } catch (\Exception $e) {
                                die("<br>" . 'Error leyendo el archivo Excel: ' . $e->getMessage());
                            }

                            return $this->render('upload-success', [
                                'filePath' => $filePath,
                                'securityLevel' => $securityLevel,
                                'data' => $data
                            ]);
                            break;

                    }
                } else {
                    die("<br>There is an error to save file");
                }
            }
        }

        return $this->render('/upload-excel/index', ['model' => $model, 'securityLevel' => $securityLevel]);
    }

}