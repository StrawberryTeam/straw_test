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
     * @param \Ro\v0\User $ro
     *
     * @return array|null
     * @throws User
     * @throws \Exception
     */
    public function getUserList(\Ro\v0\User $ro):? array{
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
            $ages = compact('minAge', 'maxAge');
        }

        $userList = $this->getLogic('User')->getUserList($ro, $ages ?? null);

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
     * @param \Ro\v0\User $ro
     *
     * @return bool
     * @throws \Error\User
     */
    public function addUser(\Ro\v0\User $ro): bool{

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

    //允许编辑的字段
    const MODIFY_AVAILABLE_FILED = ['userName', 'sex', 'age'];

    /**
     * 编辑用户
     * @param \Ro\v0\User $ro
     *
     * @return int
     * @throws \Error\User
     */
    public function modifyUser(\Ro\v0\User $ro): int{
        //若更新名称 名称不能与其他用户重复
        if ($ro->getUserName()){
            //用户名称是否存在
            if (true == $this->getLogic('User')->existsName($ro->getUserName()))
                throw new \Error\User('USER_EXISTS', $ro->getUserName());
        }

        return $this->getLogic('User')->modifyUser($ro);
    }

    /**
     * 删除用户
     * @param \Ro\v0\User $ro
     *
     * @return int
     * @throws \Exception
     */
    public function removeUser(\Ro\v0\User $ro): int{

        return $this->getLogic('User')->removeUser($ro);
    }


    /**
     * 模拟用户登录之后并返回 token 供其他接口验证
     * @param string $id
     *
     * @return string
     */
    public function logged(string $id): string{

        return password_hash($id, PASSWORD_DEFAULT);
    }

    /**
     * 模拟验证用户是否登录成功
     * @param string $token
     * @param string $id
     *
     * @return bool
     */
    public function validToken(string $token, string $id): bool{
        return password_verify($id, $token);
    }
}