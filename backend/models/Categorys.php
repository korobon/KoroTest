<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categorys".
 *
 * @property integer $id
 * @property string $name_fr
 * @property string $name_en
 * @property string $observation
 * @property string $created
 * @property string $modified
 */
class Categorys extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categorys';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_fr', 'name_en'], 'required'],
            [['created', 'modified'], 'safe'],
            [['name_fr', 'name_en'], 'string', 'max' => 100],
            [['observation'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_fr' => 'Name Fr',
            'name_en' => 'Name En',
            'observation' => 'Observation',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }
}
