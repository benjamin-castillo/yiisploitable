<?php
use yii\helpers\Html;
$this->title = 'Unsafe Upload Level ' . $securityLevel;
$this->params['breadcrumbs'][] = $this->title;
?>

<p>¡File upload success!</p>

<p><?= Html::a('Ver archivo', ['uploads/' . basename($filePath)], ['target' => '_blank']) ?></p>