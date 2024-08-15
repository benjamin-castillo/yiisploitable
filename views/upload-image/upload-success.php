<?php
use yii\helpers\Html;
$this->title = 'Unsafe Upload Level ' . $securityLevel;
$this->params['breadcrumbs'][] = $this->title;
?>
<p>¡File upload success!</p>
<?php
if (isset($ImageSmallPath)) {
    echo Html::a('See small file version', ['uploads/' . basename($ImageSmallPath)], ['target' => '_blank']);
} else { // not image
    echo Html::a('See file', ['uploads/' . basename($filePath)], ['target' => '_blank']);
}
?>