<?php
namespace frontend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Category;
use common\models\Tovar;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;

class TovarController extends Controller
{
    
    public function actionView($id){
       
       
       $tovar = Tovar::find()->where(['id' => $id])->one();
        return $this->render('view',[
            'model' => $tovar,
        ]);
    }
}