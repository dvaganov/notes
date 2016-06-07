<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Calendar]].
 *
 * @see \app\models\Calendar
 */
class CalendarQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\Calendar[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Calendar|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * Add creator filter to calendar.
     * @param int $userID creator id
     */
    public function whereOwner($userID)
    {
        return $this->andWhere('creatorID = :userID', ['userID' => $userID]);
    }

    public function withUserAndDate($userID, $date)
    {
        $this->orWhere([
                'and',
                'creatorID = :userID',
                'CAST(dateEvent AS DATE) = :date'
            ],
            [
                'userID' => $userID,
                'date' => $date
            ]
        );
        return $this;
    }
}
