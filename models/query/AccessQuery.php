<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Access]].
 *
 * @see \app\models\Access
 */
class AccessQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\Access[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Access|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * Add guest filter to access.
     * @param int $userID guest id
     */
    public function whereGuest($userID)
    {
        return $this->andWhere('guestID = :guestID', ['guestID' => $userID]);
    }

    /**
     * Add user filter to access.
     * @param int $userID guest id
     */
    public function whereUser($userID)
    {
        return $this->andWhere('userID = :userID', ['userID' => $userID]);
    }

    /**
     * Add date filter to access.
     * @param string $date
     */
    public function whereDate($date)
    {
        return $this->andWhere('date = :date', ['date' => $date]);
    }
}
