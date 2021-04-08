<?php
namespace backend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use backend\models\TovarForm;
use common\models\Category;
use common\models\Tovar;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;

class TovarController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                // 'only' => ['index', 'create', 'update', 'delete'],
                'only' => [],
                'rules' => [
                    [
                        'allow' => true,
                        // 'actions' => ['index', 'create', 'update', 'delete'],
                        'roles' => ['admin','owner','manager'],
                    ]
                ],
            ],
        ];
    }
    public function actionIndex()
    {
       // $tovar = Tovar::find()->all();
        $dataProvider = new ActiveDataProvider([
            'query' => Tovar::find(),
        ]);

        return $this->render('index',[
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCreate()
    {
        $model = new TovarForm;
        if($model->load(Yii::$app->request->post()))
        {
            $model->imageFile = UploadedFile::getInstances($model,'imageFile');
           if($imagePath=$model->upload())
           {
            $tovar = new Tovar;
            $tovar->name = $model->name;
            $tovar->description = $model->description;
            $tovar->count = $model->count;
            $tovar->category_id = $model->category_id ;
            $tovar->price = $model->price ;
            $tovar->url_image = json_encode($imagePath);
            if($tovar->save())
            {
             Yii::$app->session->setFlash('success', 'Товар збережено в БД ');
            }
            else{
                Yii::$app->session->setFlash('error', 'Помилка НЕ збережено в БД ');
               }
           }
         return  $this->redirect(['tovar/index']);
          
        }
        $categories = Category::find()->all();
        foreach ($categories as $category) {
            $category_array[$category->id] = $category->name;
        }

        return $this->render('create', [
            'model' => $model,
            'categories' => $category_array,
            'initialPreview' => [],
            'initialConfig' => [],
            'tovar_id'=> '',
        ]);
    }
    public function actionUpdate($id){
        $model = new TovarForm;
        $tovar = Tovar::findOne(['id' => $id]);
        if($model->load(Yii::$app->request->post()))
        {
            $model->imageFile = UploadedFile::getInstances($model,'imageFile');
            $imagePath=$model->upload();
           if($imagePath !== false)
           {
            
            $tovar->name = $model->name;
            $tovar->description = $model->description;
            $tovar->count = $model->count;
            $tovar->category_id = $model->category_id ;
            $tovar->price = $model->price ;
            if($imagePath)
            {
                $image = json_decode($tovar->url_image,true);
                $imagePath = array_merge($image, $imagePath);
                $tovar->url_image = json_encode($imagePath);

            }
            $tovar->url_image = json_encode($imagePath);
            if($tovar->save())
            {
             Yii::$app->session->setFlash('success', 'Товар збережено в БД ');
            }
            else{
                Yii::$app->session->setFlash('error', 'Помилка НЕ збережено в БД ');
               }
           }
         return  $this->redirect(['tovar/index']);
          
        }

        $model->name = $tovar->name;
        $model->description = $tovar->description;
        $model->count = $tovar->count;
        $model->price = $tovar->price;
        $model->category_id = $tovar->category_id;
        $categories = Category::find()->all();
        foreach ($categories as $category) {
            $category_array[$category->id] = $category->name;
        }
        $images= json_decode($tovar->url_image,true);
        $initialPreview = [];
        $initialConfig = [];
        foreach ($images as $image) {
            $initialPreview[]='../../' . $image;
          
            $initialConfig []=[
                'key' => $image,
            ];
        }

        return $this->render('create', [
            'model' => $model,
            'categories' => $category_array,
            'initialPreview' => $initialPreview,
            'tovar_id'=> $tovar->id,
            'initialConfig' =>  $initialConfig,
        ]);

    }

    public function actionDelete($id){
        $model = new TovarForm;
       
       
        $tovar = Tovar::findOne(['id' => $id]);
        $images = json_decode($tovar->url_image,true);
        $result = [];
        foreach ($images as $value) {  
               unlink($value);
        }
      
        if($tovar -> delete())
            {
             Yii::$app->session->setFlash('success', 'Товар видалено з БД ');
            }
            else{
                Yii::$app->session->setFlash('error', 'Помилка НЕ видалено з БД ');
            }
           
        return  $this->redirect(['tovar/index']);
    }
    public function actionFileDeleteTovar($id){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if(isset($_POST['key'])){
            $image = $_POST['key'];
            unlink($_POST['key']);
            $tovar = Tovar::findOne(['id' => $id]);
            $images = json_decode($tovar->url_image,true);
            $result = [];
            foreach ($images as $value) {
                if($image != $value){
                    $result[] = $value;
                }
            }
            $tovar->url_image = json_encode($result);
            $tovar->save();
        }
        return true;
    }
    public function actionView($id){
        $model = new TovarForm;
        $tovar = Tovar::findOne(['id' => $id]);
        if($model->load(Yii::$app->request->post()))
        {
            $model->imageFile = UploadedFile::getInstances($model,'imageFile');
            $imagePath=$model->upload();
           if($imagePath !== false)
           {
            
            $tovar->name = $model->name;
            $tovar->description = $model->description;
            $tovar->count = $model->count;
            $tovar->category_id = $model->category_id ;
            $tovar->price = $model->price ;
            if($imagePath)
            {
                $image = json_decode($tovar->url_image,true);
                $imagePath = array_merge($image, $imagePath);
                $tovar->url_image = json_encode($imagePath);

            }
            $tovar->url_image = json_encode($imagePath);
            
           }
         return  $this->redirect(['tovar/index']);
          
        }

        $model->name = $tovar->name;
        $model->description = $tovar->description;
        $model->count = $tovar->count;
        $model->price = $tovar->price;
        $model->category_id = $tovar->category_id;
        
        $categories = Category::find()->all();
        foreach ($categories as $category) {
            $category_array[$category->id] = $category->name;
        }
        $images= json_decode($tovar->url_image,true);
        $initialPreview = [];
        $initialConfig = [];
        foreach ($images as $image) {
            $initialPreview[]='../../' . $image;
          
            $initialConfig []=[
                'key' => $image,
            ];
        }

        return $this->render('view', [
            'model' => $model,
            'categories' => $category_array,
            'initialPreview' => $initialPreview,
            'tovar_id'=> $tovar->id,
            'initialConfig' =>  $initialConfig,
        ]);

    }
}