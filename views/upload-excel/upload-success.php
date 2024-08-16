<?php
use yii\helpers\Html;
$this->title = '¡File upload success!  Level ' . $securityLevel;
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<?php
if (isset($data)) {
    echo Html::a('See file', ['uploads/' . basename($filePath)], ['target' => '_blank']);
    echo "<h3>Total fields readed:" . count($data) . "</h3>";
} else { // not image
    echo ("<br>Something is wrong or File empty");
}
?>