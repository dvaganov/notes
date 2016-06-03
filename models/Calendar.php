<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "calendar".
 *
 * @property integer $id
 * @property string $text
 * @property integer $creatorID
 * @property string $dateEvent
 *
 * @property Users $creator
 */
class Calendar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'calendar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'required'],
            [['text'], 'string'],
            [['dateEvent'], 'date', 'format' => 'php:Y-m-d'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'text' => Yii::t('app', 'Text'),
            'creatorID' => Yii::t('app', 'Creator ID'),
            'dateEvent' => Yii::t('app', 'Date Event'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(Users::className(), ['id' => 'creatorID']);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\CalendarQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\CalendarQuery(get_called_class());
    }

    /**
     * Do operations with model before save it to DB.
     * @param array $insert
     */
    public function beforeSave($insert)
    {
        $result = false;
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->creatorID = \Yii::$app->user->id;
            }
            $result = true;
        }
        return $result;
    }
}
