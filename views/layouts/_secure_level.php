<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $cookieValue int */
?>

<h3>Actual security Level</h3>

<?php $form = ActiveForm::begin(['action' => ['cookie/set-cookie']]); ?>

<?= Html::dropDownList('selectValue', $cookieValue, [
    1 => 'Low security 1',
    2 => 'Medium security 2',
    3 => 'High Security 3',
], ['class' => 'form-control']) ?>

<div class="form-group" style="margin-top: 20px;">
    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>