<?php

namespace app\models;

use yii\base\Model;

class Image extends Model
{
    const FOLDER_IMG = '/img';


    public static function getImage()
    {
        $file = 'milk.jpg';

        return self::FOLDER_IMG . '/' . $file;
    }
}

