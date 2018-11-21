<?php
namespace Logic;
use Dvo\Relation;
use Strawframework\Base\Logic;

/**
 * user logic
 */

class User extends Logic {

    public function getName(int $uid): ? string{
        $entity = new Relation();
        $entity->setUserName('newname');
        $entity->setUpdateAt();
        //$entity2 = new \Dvo\User('User');
        //$entity2->setUserName('newname2');
        return $this->getModel('Relation')->getRelationViaUid($uid);
    }
}