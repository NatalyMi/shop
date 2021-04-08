<?php
use yii\helpers\Url;
?>
<h1 class="text-center m-3"><?=$model->name?></h1>
<div id="carouselExampleControls" class="carousel slide m-3" data-ride="carousel">
  <div class="carousel-inner">
  <?php
 
       $images= json_decode($model->url_image,true);
     foreach ($images as $key => $value) {
    
    ?>
    <div class="carousel-item active">
      <img src="/<?= $value?>" class="d-block w-100" style="height: 500px;" alt="...">
    </div>
    <?php
    break;
     }
    ?>
    <?php
    $i = 0;
     foreach ($images as $key => $value) {
       $i++;
      if($i>1)
      {
    ?>
    <div class="carousel-item">
      <img src="/<?= $value?>" class="d-block w-100" style="height: 500px;" alt="...">
    </div>
    <?php
      }
     }
    ?>
    
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<h2 class="text-left m-3">Ціна: <?=$model->price?> грн</h2>
<a href="<?= Url::to(["/order/$model->id/create"])?>" class="btn btn-success m-3">Купити</a>
<h3 class="text-left m-3">Про товар</h3>
<p class="m-3"><?=$model->description?></p>

