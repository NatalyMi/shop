<?php
namespace frontend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Order;
use common\models\Tovar;
use frontend\models\OrderForm;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;

class OrderController extends Controller
{
    
    public function actionCreate($id)
    {
        $model = new OrderForm;
        $tovar = Tovar::find()->where(['id' => $id])->one();
        if($model->load(Yii::$app->request->post()))
        {
           if(Yii::$app->user->id == NULL)
           return  $this->redirect(['site/login']);
          
            $order = new Order;
            $order->count = $model->count;
            $order->customer_id = Yii::$app->user->id;
            $order->tovar_id = $id ;
            $order->sum = $tovar->price*$model->count ;
           
            if($order->save())
            {
             Yii::$app->session->setFlash('success', 'Замовлення створено');
            }
            else{
                Yii::$app->session->setFlash('error', 'Замовлення НЕ збережено ');
               }
           
         return  $this->redirect(['site/index']);
          
        }
       

        return $this->render('create', [
            'model' => $model,
            'tovar'=> $tovar,
        ]);
    }
    
}