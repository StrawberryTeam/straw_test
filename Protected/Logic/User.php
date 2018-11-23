<?php
namespace Logic;
use Dvo\Relation;
use Strawframework\Base\Logic;
use Strawframework\Base\RequestObject;

/**
 * user logic
 */

class User extends Logic {

    //男
    const SEX_MALE = 'male';

    //女
    const SEX_FEMALE = 'female';

    //最小
    const AGE_MIN = 1;
    //最大年龄
    const AGE_MAX = 99;

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

    /**
     * 检查用户是否存在
     * @param string $name
     *
     * @return bool
     */
    public function existsName(string $name): bool{

        $dvo = new \Dvo\User();
        $dvo->setUserName($name);
        $userInfo = $this->getModel('User')->getUser($dvo);
        var_dump($userInfo);die;
        return false;
    }


    /**
     * 添加用户逻辑
     * @param RequestObject $ro
     *
     * @return bool
     * @throws \Exception
     */
    public function addUser(RequestObject $ro): bool{

        $dvo = new \Dvo\User();
        $dvo->setUserName($ro->getUserName())->setSex($ro->getSex())->setAge($ro->getAge());

        return $this->getModel('User')->addUser($dvo);
    }
}