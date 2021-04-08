<?php
namespace backend\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use backend\models\UserForm;
use backend\models\User;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;

class UserController extends Controller
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
       // $user = user::find()->all();
        $dataProvider = new ActiveDataProvider([
            'query' => user::find(),
        ]);

        return $this->render('index',[
            'dataProvider' => $dataProvider
        ]);
    }

    
    public function actionUpdate($id){
        $model = new UserForm;
        $user = User::findOne(['id' => $id]);
        if($model->load(Yii::$app->request->post()))
        {   
            $user->username = $model->username;
            $user->email = $model->email;    
            if($user->save())
            {
             Yii::$app->session->setFlash('success', 'Товар збережено в БД ');
            }
            else{
                Yii::$app->session->setFlash('error', 'Помилка НЕ збережено в БД ');
               }
           
         return  $this->redirect(['user/index']);
          
        }

        $model->username = $user->username;
        $model->email = $user->email;
       
       
      
        $initialPreview = [];
        $initialConfig = [];

        return $this->render('create', [
            'model' => $model,
            'initialPreview' => $initialPreview,
            'user_id'=> $user->id,
            'initialConfig' =>  $initialConfig,
        ]);

    }

    public function actionDelete($id){
        $model = new UserForm;
        $user = User::findOne(['id' => $id]);
        if($user -> delete())
            {
             Yii::$app->session->setFlash('success', 'Товар видалено з БД ');
            }
            else{
                Yii::$app->session->setFlash('error', 'Помилка НЕ видалено з БД ');
            }
           
        return  $this->redirect(['user/index']);
    }
  
    public function actionView($id){
        $model = new UserForm;
        $user = User::findOne(['id' => $id]);
        if($model->load(Yii::$app->request->post()))
        {
           
            $user->username = $model->username;
            $user->email = $model->email;
           
         return  $this->redirect(['user/index']);
          
        }

        $model->username = $user->username;
        $model->email = $user->email;
       
      
        $initialPreview = [];
        $initialConfig = [];
       

        return $this->render('view', [
            'model' => $model,
            'initialPreview' => $initialPreview,
            'user_id'=> $user->id,
            'initialConfig' =>  $initialConfig,
        ]);

    }
}