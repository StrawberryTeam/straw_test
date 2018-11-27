<?php
namespace Service;
use Logic\User;
use Strawframework\Base\RequestObject;
use Strawframework\Base\Service;

/**
 * 会员 Service
 */

class Member extends Service {

    /**
     * 获取用户列表
     *
     * @param RequestObject $ro
     *
     * @return array|null
     * @throws User
     * @throws \Exception
     */
    public function getUserList(RequestObject $ro):? array{
        //传入条件 sex
        if ($ro->getSex()){
            if (false == $this->validSex($ro->getSex()))
                throw new \Error\User('SEX_INVALID', $ro->getSex(), User::SEX_MALE . ' or ' . User::SEX_FEMALE);
        }

        //传入条件 age 10-20
        if ($ro->getAgeRange()){
            list($minAge, $maxAge) = explode('-', $ro->getAgeRange());

            if (!$minAge || !$maxAge)
                throw new \Error\User('INPUT_ERROR', 'age');

            if (false == $this->validAge($minAge))
                throw new \Error\User('AGE_INVALID', $ro->getAgeRange());


            if (false == $this->validAge($maxAge))
                throw new \Error\User('AGE_INVALID', $ro->getAgeRange());
        }

        $userList = $this->getLogic('User')->getUserList($ro, compact('minAge', 'maxAge'));

        return $userList;
    }

    /**
     * 获取一个用户
     * @param string $uid
     *
     * @return null|object
     * @throws \Exception
     */
    public function getUser(string $uid):? object {
        return $this->getLogic('User')->getUserViaId($uid);
    }

    //性别合法性
    private function validSex(string $sex): bool{
        if (!in_array($sex, [User::SEX_MALE, User::SEX_FEMALE]))
            return false;

        return true;
    }

    //年龄合法性
    private function validAge(int $age): bool{
        if ($age < User::AGE_MIN || $age > User::AGE_MAX)
            return false;

        return true;
    }

    /**
     * 添加新用户
     *
     * @param RequestObject $ro
     *
     * @return bool
     * @throws User
     * @throws \Exception
     */
    public function addUser(RequestObject $ro): bool{

        if (false == $this->validSex($ro->getSex()))
            throw new \Error\User('SEX_INVALID', $ro->getSex(), User::SEX_MALE . ' or ' . User::SEX_FEMALE);

        if (false == $this->validAge($ro->getAge()))
            throw new \Error\User('AGE_INVALID', $ro->getAge());

        //用户名称是否存在
        if (true == $this->getLogic('User')->existsName($ro->getUserName()))
            throw new \Error\User('USER_EXISTS', $ro->getUserName());

        //添加新用户
        return $this->getLogic('User')->addUser($ro);
    }

    //编辑用户
    public function modifyUser(): bool{

    }
}