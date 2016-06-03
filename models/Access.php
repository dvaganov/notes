<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "access".
 *
 * @property integer $id
 * @property integer $ownerID
 * @property integer $guestID
 * @property string $date
 *
 * @property Users $guest
 * @property Users $owner
 */
class Access extends \yii\db\ActiveRecord
{
  /**
   * Date format for validation.
   * @var string DATE_FORMAT
   */
  const DATE_FORMAT = 'Y-m-d';
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
            [['ownerID', 'guestID', 'date'], 'required'],
            [['ownerID', 'guestID'], 'integer'],
            [['date'], 'date', 'format' => 'php:' . static::DATE_FORMAT],
            [['guestID'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['guestID' => 'id']],
            [['ownerID'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['ownerID' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ownerID' => Yii::t('app', 'Owner ID'),
            'guestID' => Yii::t('app', 'Guest ID'),
            'date' => Yii::t('app', 'Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuest()
    {
        return $this->hasOne(Users::className(), ['id' => 'guestID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(Users::className(), ['id' => 'ownerID']);
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
