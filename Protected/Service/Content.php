<?php
namespace Service;
use Strawframework\Base\Service;

/**
 * Content Service
 */

class Content extends Service {


    public function get(){
        return $this->getModel('Relation')->getRelationViaUid(12);//Get Model 验证
    }

    public function getUser(int $uid):? string{
        return $this->getLogic('User')->getName($uid);
    }
}