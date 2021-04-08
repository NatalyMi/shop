<?php
use yii\helpers\Url;
?>
    <div class="container">
    <div id="carouselExampleControls" class="carousel slide m-3" data-ride="carousel">
  <div class="carousel-inner">
  <?php
   
     foreach ($promotion as $key => $value) {
      $images= json_decode($value->url_image,true);
    ?>
    <div class="carousel-item active">
      <img src="<?= $images[0]?>" class="d-block w-100" style="height: 500px;" alt="...">
    </div>
    <?php
    break;
     }
    ?>
    <?php
    $i=0;
     foreach ($promotion as $key => $value) {
       $i++;
      $images= json_decode($value->url_image,true);
      if($i>1)
      {
    ?>
    <div class="carousel-item">
      <img src="<?= $images[0]?>" class="d-block w-100" style="height: 500px;" alt="...">
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
    <div class="row">
   
  <div class="col-4">
    <div class="list-group" id="list-tab" role="tablist">
    <?php
    
    
     foreach ($category as $key => $value) {     
    ?>
      <a class="list-group-item list-group-item-action active" id="list-<?= $value->id?>-list" data-toggle="list" href="#list-<?= $value->id?>" role="tab" aria-controls="<?= $value->id?>"><?= $value->name?></a>
      <?php
      break;
     }
    ?>
     <?php
   $i=0;
    
     foreach ($category as $key => $value) {    
       $i++;
       if($i>1)
       { 
    ?>
      <a class="list-group-item list-group-item-action " id="list-<?= $value->id?>-list" data-toggle="list" href="#list-<?= $value->id?>" role="tab" aria-controls="<?= $value->id?>"><?= $value->name?></a>
      <?php
       }
     }
    ?>
     
    </div>
  </div>
  <div class="col-8">
    <div class="tab-content" id="nav-tabContent">
    <?php
    
    
     foreach ($category as $key => $value) {
        $category_id = $value->id;
        
    ?>
      <div class="tab-pane fade show active" id="list-<?= $value->id?>" role="tabpanel" aria-labelledby="list-<?= $value->id?>-list">
      <?php
     $tovar_array = array_filter($tovar, function($item) use ($category_id){
        if($item->category_id == $category_id)
        return true;
     });
     foreach ($tovar_array as $key => $value) {
      $images= json_decode($value->url_image,true);
    ?>
      <div class="card" style="width: 18rem;">
  <img src="<?= $images[0]?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?= $value->name?></h5>
    <p class="card-text"><?= $value->description?></p>
    <a href="<?= Url::to(["/tovar/$value->id/view"])?>" class="btn btn-primary">Переглянути</a>
  </div>
</div>
<?php
     }
    ?>
      </div>
      <?php
      break;
     }
    ?>
       <?php
    $i=0;

     foreach ($category as $key => $value) {
        $category_id = $value->id;
        $i++;
        if($i>1){
    ?>
      <div class="tab-pane fade show " id="list-<?= $value->id?>" role="tabpanel" aria-labelledby="list-<?= $value->id?>-list">
      <?php
     $tovar_array = array_filter($tovar, function($item) use ($category_id){
        if($item->category_id == $category_id)
        return true;
     });
     foreach ($tovar_array as $key => $value) {
      $images= json_decode($value->url_image,true);
    ?>
      <div class="card" style="width: 18rem;">
  <img src="<?= $images[0]?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?= $value->name?></h5>
    <a href="<?= Url::to(["/tovar/$value->id/view"])?>" class="btn btn-primary">Переглянути</a>
  </div>
</div>
<?php
     }
    ?>
      </div>
      <?php
        }
     }
    ?>
      </div>
  </div>
</div>
    </div>
</div>