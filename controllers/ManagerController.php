<?php

namespace app\controllers;

use app\models\services\Catalog;
use app\models\AddFileForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;


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

    public function actionMenu($item = null)
    {
        $root = dirname(__DIR__).DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'manager'.DIRECTORY_SEPARATOR;
        ($item === null) ? $rootDir = $root : $rootDir = $root.$item;

        if (is_dir($rootDir)) {
            $catalog = new Catalog();

            $items = explode('\\', $item);
            $result = $catalog->getFolder($rootDir, $item);
            return $this->render('menu', ['catalog' => $result, 'items' => $items]);
        } else {
            $model = New AddFileForm();

            $data = file_get_contents($rootDir, true);
            $model->description = $data;

            $items = explode('\\', $item);
            $item = array_pop($items);
            $model->title = $item;
            return $this->render('file', ['model' => $model, 'file' => $item, 'items' => $items]);
        }
    }

}
