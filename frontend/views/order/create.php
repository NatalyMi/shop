<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\select2\Select2;
use kartik\widgets\FileInput;

use yii\widgets\ActiveForm;

$this->title = 'Оформлення замовлення';
$this->params['breadcrumbs'][] = ['label' => 'Товар', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


 $this->registerJs("$('#orderform-count').change(function(){
     var price = $(this).val() * $('#price').attr('value');
  $('#price').html(price);
    });");
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4><?=$this->title;?></h4>
    </div>
    <?php
    $form=ActiveForm::begin(['id' => 'order-create']);
    ?>
     <div class="panel-body">
     <div class="row">
            <div class="col-md-6">
              <h2> <?=$tovar->name?></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?=$form->field($model, 'count')->textInput(['type' => 'number', 'min' => 0, 'step' => '1']);?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
              <p>Всього: <span value = "<?=$tovar->price?>" id="price"> <?=$tovar->price?></span> грн</p>
            </div>
        </div>
        <div class="row">

            <div class="col-md-12">
                <?=Html::submitButton('Замовити',['class'=>'btn btn-success btn-block]'])?>
            </div>
        </div>
    </div>
    <?php
        ActiveForm::end();
    ?>
</div>