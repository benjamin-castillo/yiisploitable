<?php
use yii\helpers\Html;
$this->title = '¡File upload success! Level ' . $securityLevel;
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<?php
if (isset($ImageSmallPath)) {
    echo Html::a('See small file version', ['uploads/' . basename($ImageSmallPath)], ['target' => '_blank']);
} else { // not image
    echo Html::a('See file', ['uploads/' . basename($filePath)], ['target' => '_blank']);
}
?>