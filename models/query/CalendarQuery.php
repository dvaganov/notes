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
     * Add guest filter to access.
     * @param string $date date in format Y-m-d
     */
    public function whereDate($date)
    {
        return $this->andWhere(['like', 'date', $date]);
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
        echo $userID . $date;
        return $this->orWhere([
                'and', 'creatorID = :userID',
                ['like', 'dateEvent', $date]
            ],
            ['userID' => $userID]
        );
    }
}
