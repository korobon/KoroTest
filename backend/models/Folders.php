<?php

namespace app\models;

use Yii;
use frontend\models\Files;

/**
 * This is the model class for table "folders".
 *
 * @property integer $id
 * @property string $name
 * @property integer $cant_files
 * @property string $ruta
 * @property integer $id_files
 *
 * @property Files $idFiles
 */
class Folders extends \yii\db\ActiveRecord
{
    public $list1;
    public $list2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'folders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nameFolder', 'cant_files', 'ruta', 'id_files', 'list1', 'list2'], 'required'],
            [['cant_files', 'id_files'], 'integer'],
            [['nameFolder', 'file'], 'string', 'max' => 100],
            [['ruta'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idFolder' => 'ID',
            'nameFolder' => 'Name',
            'cant_files' => 'Cant Files',
            'ruta' => 'Ruta',
            'id_files' => 'Files',
            'list1' => 'Category',
            'list2' => 'Sites',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdFiles()
    {
        return $this->hasOne(Files::className(), ['id' => 'id_files']);
    }
}
