<?php
namespace Logic;
use Dvo\Relation;
use Strawframework\Base\Logic;
use Strawframework\Common\Funs;

/**
 * user logic
 */

class User extends Logic {

    /**
     * @param int $uid
     *
     * @return null|string
     * @throws \Exception
     */
    public function getName(int $uid): ? string{
        $entity = new Relation();
        $entity->setUserName('newname');
        $entity->setUpdateAt();
        //$entity2 = new \Dvo\User('User');
        //$entity2->setUserName('newname2');
        return $this->getModel('Relation')->getRelationViaUid($uid);
    }
}