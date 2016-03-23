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
        $e = [];
        $r = $this->tree($dir, $e);
        var_dump($r);
        die;

        return $this->render('menu', ['files' => $files, 'folders' => $folders]);
    }

    public function tree($dir = null, $result, $item = null, $i = 0)
    {
        $dir = $dir.$item;
        $data = scandir($dir);
        $result[$i] = $result;
        echo '<ul>';
        foreach($data as $item){
            if (strpos($item, '.') != 0 || strpos($item, '.') === false) {
                if (is_dir($dir.$item)) {
                    echo '<p>Directory: '.$item.'</p>';
                    $result[] = $item;
                    $item .=DIRECTORY_SEPARATOR;
                    $this->tree($dir, $result, $item, $i++);
                } else {
                    echo '<li>File: '.$item.'</li>';
                    $result[] = $item;
                }
            }
        }
        echo '</ul>';
        return $result;
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
