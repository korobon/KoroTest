<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sites".
 *
 * @property integer $id
 * @property string $field
 * @property string $description
 * @property string $observation
 * @property integer $image_category_id
 * @property string $created
 * @property string $modified
 *
 * @property Categorys $imageCategory
 */
class Sites extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sites';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['field', 'description', 'image_category_id'], 'required'],
            [['image_category_id'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['field'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 150],
            [['observation'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'field' => 'Field',
            'description' => 'Description',
            'observation' => 'Observation',
            'image_category_id' => 'Image Category ID',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImageCategory()
    {
        return $this->hasOne(Categorys::className(), ['id' => 'image_category_id']);
    }
}
