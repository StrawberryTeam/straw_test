<?php
namespace Service;
use Error\Article;
use Strawframework\Base\RequestObject;
use Strawframework\Base\Service;

/**
 * 会员 Service
 */

class Member extends Service {


    public function get(){
        return $this->getModel('Relation')->getRelationViaUid(12);//Get Model 验证
    }

    public function getUser(int $uid):? string{
        return $this->getLogic('User')->getName($uid);
    }

    /**
     * 添加新用户
     * @param RequestObject $ro
     *
     * @return bool
     * @throws Article
     */
    public function addUser(RequestObject $ro): bool{

        //用户名称是否存在
        if (true == $this->getLogic('User')->existsName($ro->getUserName()))
            throw new Article('USER_EXISTS', $ro->getUserName());

        //添加新用户
        return $this->getLogic('User')->addUser($ro);
    }
}