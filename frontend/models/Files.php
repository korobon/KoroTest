<?php

namespace frontend\models;
use Yii;
use yii\db\ActiveRecord;

class Files extends ActiveRecord{
    
    public static function getDb()
    {
        return Yii::$app->db;
    }
    
    public static function tableName()
    {
        return 'files';
    }
    
}