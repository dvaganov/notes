<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "access".
 *
 * @property integer $id
 * @property integer $userOwner
 * @property integer $userGuest
 * @property string $date
 *
 * @property Users $userGuest0
 * @property Users $userOwner0
 */
class Access extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'access';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userOwner', 'userGuest', 'date'], 'required'],
            [['userOwner', 'userGuest'], 'integer'],
            [['date'], 'safe'],
            [['userGuest'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['userGuest' => 'id']],
            [['userOwner'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['userOwner' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'userOwner' => Yii::t('app', 'User Owner'),
            'userGuest' => Yii::t('app', 'User Guest'),
            'date' => Yii::t('app', 'Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserGuest0()
    {
        return $this->hasOne(Users::className(), ['id' => 'userGuest']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserOwner0()
    {
        return $this->hasOne(Users::className(), ['id' => 'userOwner']);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\AccessQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\AccessQuery(get_called_class());
    }
}
