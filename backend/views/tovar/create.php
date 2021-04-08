<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\select2\Select2;
use kartik\widgets\FileInput;

use yii\widgets\ActiveForm;

$this->title = 'Створення товару';
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
                <?=$form->field($model, 'name')->textInput();?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?=$form->field($model, 'description')->textarea(['row' => '3'])->label('Опис товару');?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?=$form->field($model, 'count')->textInput(['type' => 'number', 'min' => 0, 'step' => '1']);?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?=$form->field($model, 'price')->textInput(['type' => 'number', 'min' => 0, 'step' => '0.1']);?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                
                <?=$form->field($model, 'category_id')->widget(Select2::classname(),[
                    'language' => 'uk-UA',
                    'data' => $categories,
                    'options' => ['placeholder' => 'Виберіть ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);?>
            </div>
        </div>
        <div class="row">
                    <div class="col-md-12">
                   <?= $form->field($model, 'imageFile')->widget(FileInput::classname(),[
    'name' => 'attachment_49[]',
    'options'=>[
        'multiple'=>true,
        'max' => 10,
    ],
    'pluginOptions' => [
        'initialPreview'=> $initialPreview,
        'initialPreviewConfig' => $initialConfig,
        'initialPreviewAsData'=>true,
        'showCaption' => false,
        'showUpload' => false,
        'removeClass' => 'btn btn-default pull-right',
        'browseClass' => 'btn btn-primary pull-right',
        'overwriteInitial'=>false,
        'maxFileSize'=>2800,
        'deleteUrl' => Url::to(['/tovar/' . $tovar_id . '/file-delete-tovar']),
    ]
]); ?>
                    </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?=Html::submitButton('Зберегти',['class'=>'btn btn-success btn-block]'])?>
            </div>
        </div>
    </div>
    <?php
        ActiveForm::end();
    ?>
</div>