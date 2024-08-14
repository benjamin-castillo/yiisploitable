<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = 'Unsafe Upload Level ' . $securityLevel;
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<p>In this case exist a poor validation</p>
<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'] // Necesario para subir archivos
]) ?>

<?= $form->field($model, 'file')->fileInput() ?>

<div class="form-group">
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end() ?>