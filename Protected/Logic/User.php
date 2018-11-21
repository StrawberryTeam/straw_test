<?php
namespace Logic;
use Strawframework\Base\Logic;

/**
 * user logic
 */

class User extends Logic {

    public function getName(int $uid): ? string{
        return $this->getModel('Relation')->getRelationViaUid($uid);
    }
}