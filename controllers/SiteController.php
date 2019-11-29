<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\FxUser;
use yii\web\Session;

class SiteController extends Controller
{
    //允许post提交
    public $enableCsrfValidation=false;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [],
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => [],
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
	
    public function actionSign()
    {
        $request = Yii::$app->request;
        $ip = $_SERVER["REMOTE_ADDR"];
        if($request->isAjax){
            $model = new FxUser();
            $model->name = $request->post('name');
            $model->password = $request->post('pwd');
            $model->start_time = time();
            $model->ip = $ip;
            $res = FxUser::find()->where(['name'=>$model->name])->all();
            if(!empty($res)){
                $data['result'] = false;
                $data['exp'] = "该用户名已占用！";
            }else{
                if($model->save()){
                    $data['result'] = true;
                }else{
                    $data['result'] = false;
                    $data['exp'] = "注册失败！";
                }
            }
            echo json_encode($data);
            return;
        }else{
            return $this->render('sign');
        }
    }
	

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $session = Yii::$app->session;
        $request = Yii::$app->request;
        if($request->isAjax){
            $model = new FxUser();
            $model->name = $request->post('name');
            $model->password = $request->post('pwd');
            $res = FxUser::find()->where(['name'=>$model->name,'password'=>$model->password])->one();
            if(!empty($res)){
                $session['user'] = [
                    'id' => $res['uid'],
                    'username' => $res['name'],
                    'status' => $res['status']
                ];
                 $data['result'] = true;
//                var_dump($session['user']['id']);die();
            }else{
                $data['result'] = false;
                $data['exp'] = "用户名或密码错误！";
            }
            echo json_encode($data);
            return;
        }else{
            if(isset(Yii::$app->session['user'])){
                return $this->goHome();
            }
            return $this->render('login');
        }
        
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        $session = Yii::$app->session;
        $session->remove('user');
        return $this->redirect('/');
    }
    
    

        /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    
}
