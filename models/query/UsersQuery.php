<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Users]].
 *
 * @see \app\models\Users
 */
class UsersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\Users[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Users|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * Exclude the user from search result.
     * @param int $userID
     * @return $this
     */
    public function excludeUser($userID)
    {
        return $this->andWhere('id != :userID', ['userID' => $userID]);
    }

    /**
     * Select id and username as value.
     * @param int $userID
     * @return $this
     */
    public function selectForAutocomplete()
    {
        return $this->select(['id', 'username AS value']);
    }
}
