<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = 'Upload Level ' . $securityLevel;
$this->params['breadcrumbs'][] = $this->title;
switch ($securityLevel) {
    case 1:
        $msg = "Upload any kind of file including excel";
        break;
    case 2:
        $msg = "Upload Excel files xls, xlsx";
        break;
    default:
        die("Module under construction plase visit https://github.com/benjamin-castillo/yiisploitable for more information");
        break;
}
?>
<h1><?= Html::encode($this->title) ?></h1>
<p><?= $msg ?></p>
<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'] // Necesario para subir archivos
]) ?>

<?= $form->field($model, 'file')->fileInput() ?>

<div class="form-group">
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end() ?>