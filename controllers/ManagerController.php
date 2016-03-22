<?php

namespace app\controllers;

use app\models\AddFileForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
//use app\models\LoginForm;


class ManagerController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionMenu()
    {
//        $dir = dirname(__DIR__).DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'manager';
//        $data = scandir($dir);
//var_dump($data);die;
//        $files = [];
//        $folders = [];
//        foreach($data as $dat) {
//            if ($dat[0] == '' || $dat[0] == '.'){
//
//            }else {
//                if(strstr($dat, '.')) {
//                    $files[] = $dat;
//                }else{
//                    $folders[] = $dat;
//                }
//            }
//        }

        $dir = dirname(__DIR__).DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'manager'.DIRECTORY_SEPARATOR;
        $data = scandir($dir);
//        unset($data[0], $data[1]);

        $this->tree($data, $dir);
        die;

        return $this->render('menu', ['files' => $files, 'folders' => $folders]);
    }

    public function tree($data = null, $dir = null)
    {
        echo '<ul>';
        foreach($data as $item){
            if ($item[0] == '' || $item[0] == '.') {
            }else{
                if (is_dir($dir.$item)) {
                    $dir = $dir.$item.DIRECTORY_SEPARATOR;
                    $data = scandir($dir);
//                    unset($data[0], $data[1]);
//                    var_dump($dir);
//                    var_dump($data);

                    $this->tree($data, $dir);
                } else {
                    echo '<li>'.$item.'</li>';
                }
            }
        }
        echo '</ul>';
    }

    public function actionOpen($name)
    {
        $model = New AddFileForm();

        $dir = dirname(__DIR__).DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'manager'.DIRECTORY_SEPARATOR;
        $dir.= $name;
        $data = file_get_contents($dir, true);


        $model->title = $name;
        $model->description = $data;


        return $this->render('file', ['model' => $model]);
    }

}