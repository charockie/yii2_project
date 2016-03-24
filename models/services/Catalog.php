<?php

namespace app\models\services;

use yii\base\Model;

class Catalog
{

    public function getTree($dir = null, $item = null)
    {
        $dir = $dir.$item;
        $data = scandir($dir);
        $result = array();
        foreach($data as $item){
            if (strpos($item, '.') != 0 || strpos($item, '.') === false) {
                if (is_dir($dir.$item)) {
                    $item .=DIRECTORY_SEPARATOR;
                    $result[$item] = $this->getTree($dir, $item);
                } else {
                    $result[$item] = $item;
                }
            }
        }
        return $result;
    }

    public function getViewTree($dir = null, $item = null, $result = null , $display = null)
    {
        $dir = $dir.$item;
        $d = $item;
        $data = scandir($dir);
        $result .= '<ul '.$display.'>';
        foreach($data as $item){
            if (strpos($item, '.') != 0 || strpos($item, '.') === false) {
                if (is_dir($dir.$item)) {
                    $result .= '<li class="bg-info"><a><span>'.$item.'(Directory)</span></a></li>';
                    $item .=DIRECTORY_SEPARATOR;
//                    $display = 'hidden';
                    $result = $this->getViewTree($dir, $item, $result, $display);
                } else {
                    $result .= '<li class="bg-info"><a href="?r=manager%2Fopen&name='.$d.$item.'">'.$item.'(File)</a></li>';
                }
            }
        }
        $result .= '</ul>';
        return $result;
    }

    public function getFolder($item, $it = null)
    {
        $dir = $item;
        $data = scandir($dir);
        $result = '<ul class="list-unstyled">';
        foreach($data as $item){
            if (strpos($item, '.') != 0 || strpos($item, '.') === false) {
                if (is_dir($dir.$item)) {
                    $result .= '<li class="bg-info"><a href="?r=manager%2Fmenu&item='.$it.$item.DIRECTORY_SEPARATOR.'"><span>'.$item.'(Directory)</span></a></li>';
                } else {
                    $result .= '<li class="bg-info"><a href="?r=manager%2Fmenu&item='.$it.$item.'">'.$item.'(File)</a></li>';
                }
            }
        }
        return $result .= '</ul>';
    }

}
