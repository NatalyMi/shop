<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\select2\Select2;
use kartik\widgets\FileInput;

use yii\widgets\ActiveForm;

$this->title = 'товар';
$this->params['breadcrumbs'][] = ['label' => 'Товар', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4><?=$this->title;?></h4>
    </div>
    <?php
    $form=ActiveForm::begin(['id' => 'tovar-create']);
    ?>
     <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
            <p>Назва</p>
                <?=$model->name?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <p>Опис товару</p>
                <?=$model->description?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            <p>Кількість</p>
                <?=$model->percent?>
            </div>
        </div>
        
      
    </div>
    <?php
        ActiveForm::end();
    ?>
</div>