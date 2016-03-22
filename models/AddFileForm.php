<?php

namespace app\models;

use yii\base\Model;

class AddFileForm extends Model
{

    public $title;
    public $description;

    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
        ];
    }

}
