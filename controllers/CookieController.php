<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Cookie;

class CookieController extends Controller
{
    /*
    public function actionIndex()
    {
        // Obtener el valor actual de la cookie, si existe
        $cookieValue = Yii::$app->request->cookies->getValue('mySelectValue', 1);

        // Renderizar la vista con el valor de la cookie
        return $this->render('index', [
            'cookieValue' => $cookieValue,
        ]);
    }
    */

    public function actionSetCookie()
    {
        // Obtener el valor del select del formulario
        $newValue = Yii::$app->request->post('selectValue');

        // Crear o actualizar la cookie
        $cookie = new Cookie([
            'name' => 'mySelectValue',
            'value' => $newValue,
            'expire' => time() + 86400 * 30, // La cookie expira en 30 días
        ]);
        Yii::$app->response->cookies->add($cookie);

        // Redirigir de nuevo a la página principal
        //return $this->redirect(['/']);
        return $this->redirect(Yii::$app->request->referrer);
    }
}