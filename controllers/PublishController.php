<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\ContactForm;
use app\models\FxContent;

class PublishController extends Controller
{
    
    //Yii允许post提交
    public $enableCsrfValidation=false;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['publish'],
                'rules' => [
                    [
                        'actions' => ['publish'],
                        'allow' => true,
                      //  'roles' => ['@'],   
                    ],
                    [
                        'actions' => ['publish'],
                        // 自定义一个规则，返回true表示满足该规则，可以访问，false表示不满足规则，也就不可以访问actions里面的操作啦
                        'matchCallback' => function ($rule, $action) {
                            return isset(Yii::$app->session['user']['11']) ? TRUE : FALSE;
                        },
                        'allow' => true,
                    ],
                ], 
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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

    public function actionPublish()
    {   
//        var_dump(Yii::$app->user->getId());die();
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        if($request->isAjax){
            $model = new FxContent();
            $model->content = $request->post('link');
            $model->add_time = time();
            $model->u_id = $session['user']['id'];
            $model->u_name = $session['user']['username'];
            if($model->save()){
                $data['result'] = true;
            }else{
                $data['result'] = false;
                $data['exp'] = "发布失败！";
            }
            echo json_encode($data);
            return;
        }else{
//            $lj = "https://pan.baidu.com/mbox/homepage?short=lbe7kqV";
//            if (!eregi("[hH][tT][tT][pP]([sS]?):\/\/(pan+\.)(baidu+\.)(com+\/)(mbox+\/)(homepage+\?)(short+\=)[0-9a-zA-Z]{5,8}$",$lj))
//            {
//                var_dump(preg_match_all("[hH][tT][tT][pP]([sS]?):\/\/(pan+\.)(baidu+\.)(com+\/)(mbox+\/)(homepage+\?)(short+\=)[0-9a-zA-Z]{5,8}$",$lj));

            
            return $this->render('publish');
        }
    }
}
