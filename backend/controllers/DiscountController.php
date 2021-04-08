<?php
namespace backend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use backend\models\DiscountForm;

use common\models\Discount;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;

class DiscountController extends Controller
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
       // $discount = Discount::find()->all();
        $dataProvider = new ActiveDataProvider([
            'query' => Discount::find(),
        ]);

        return $this->render('index',[
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCreate()
    {
        $model = new DiscountForm;
        if($model->load(Yii::$app->request->post()))
        {
            $model->imageFile = UploadedFile::getInstances($model,'imageFile');
           if($imagePath=$model->upload())
           {
            $discount = new Discount;
            $discount->name = $model->name;
            $discount->description = $model->description;
        
            $discount->percent = $model->percent ;
           
            if($discount->save())
            {
             Yii::$app->session->setFlash('success', 'Товар збережено в БД ');
            }
            else{
                Yii::$app->session->setFlash('error', 'Помилка НЕ збережено в БД ');
               }
           }
         return  $this->redirect(['discount/index']);
          
        }
      

        return $this->render('create', [
            'model' => $model,
           
            'initialPreview' => [],
            'initialConfig' => [],
            'discount_id'=> '',
        ]);
    }
    public function actionUpdate($id){
        $model = new DiscountForm;
        $discount = Discount::findOne(['id' => $id]);
        if($model->load(Yii::$app->request->post()))
        {
          
            
            $discount->name = $model->name;
            $discount->description = $model->description;
           
            $discount->percent = $model->percent ;
          
            if($discount->save())
            {
             Yii::$app->session->setFlash('success', 'Товар збережено в БД ');
            }
            else{
                Yii::$app->session->setFlash('error', 'Помилка НЕ збережено в БД ');
               }
           
         return  $this->redirect(['discount/index']);
          
        }

        $model->name = $discount->name;
        $model->description = $discount->description;
       
        $model->percent = $discount->percent;
    
        $initialPreview = [];
        $initialConfig = [];
      

        return $this->render('create', [
            'model' => $model,
          
            'initialPreview' => $initialPreview,
            'discount_id'=> $discount->id,
            'initialConfig' =>  $initialConfig,
        ]);

    }

    public function actionDelete($id){
        $model = new DiscountForm;
       
       
        $discount = Discount::findOne(['id' => $id]);
      
        if($discount -> delete())
            {
             Yii::$app->session->setFlash('success', 'Товар видалено з БД ');
            }
            else{
                Yii::$app->session->setFlash('error', 'Помилка НЕ видалено з БД ');
            }
           
        return  $this->redirect(['discount/index']);
    }
   
    public function actionView($id){
        $model = new DiscountForm;
        $discount = Discount::findOne(['id' => $id]);
        if($model->load(Yii::$app->request->post()))
        {
          
            
            $discount->name = $model->name;
         
        
            $discount->percent = $model->percent ;
           
            
           
         return  $this->redirect(['discount/index']);
          
        }

        $model->name = $discount->name;
        $model->description = $discount->description;
       
        $model->percent = $discount->percent;
      
        $initialPreview = [];
        $initialConfig = [];
   
        return $this->render('view', [
            'model' => $model,
            
            'initialPreview' => $initialPreview,
            'discount_id'=> $discount->id,
            'initialConfig' =>  $initialConfig,
        ]);

    }
}