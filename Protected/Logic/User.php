<?php
namespace Logic;
use Service\Member;
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
     * 获取所有用户
     * @param \Ro\v0\User $ro
     * @param array|null    $ages
     *
     * @return array|null
     * @throws \Exception
     */
    public function getUserList(\Ro\v0\User $ro, ? array $ages): array{

        $dvo = new \Dvo\User($ro, 'sex');

        //根据加入时间查询
        //if ($ro->getJoinTime())
        //    $dvo->setJoinTime(new UTCDateTime(strtotime($ro->getJoinTime())* 1000));

        $data = [];
        //查不同性别
        if ($ro->getSex()){
            $data['sex'] = ':sex';
        }

        //查年龄范围
        if (!empty($ages)){
            //相同字段 不同值 设置别名 别名类型与原名 需完全相同，遵循原名 set 方法
            $dvo->_setAlias('age', 'minAge', $ages['minAge']);
            $dvo->_setAlias('age', 'maxAge', $ages['maxAge']);

            $data['$and'] = [
                ['age' => ['$gte' => ':_minAge']],
                ['age' => ['$lte' => ':_maxAge']],
            ];
        }

        $count = $this->getModel('User')->getCount($dvo, $data);
        if (0 == $count)
            return [0, null];

        $list = $this->getModel('User')->getList($dvo, $data);
        return [$count, $list];
    }

    /**
     * 通过 id 获取一个用户的信息
     * @param string $id
     *
     * @return null|object
     * @throws \Exception
     */
    public function getUserViaId(string $id): ? object{
        $dvo = new \Dvo\User();
        $dvo->setId($id);
        try{
            $userInfo = $this->getModel('User')->getUser($dvo);
        }catch (\Exception $e){
            //@todo set log
            throw new \Error\User('INPUT_ERROR', $id);
        }
        return $userInfo;
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
        //var_dump(Model::toArray($userInfo));die;
        if ($userInfo)
            return true;
        return false;
    }


    /**
     * 添加用户逻辑
     * @param \Ro\v0\User $ro
     *
     * @return bool
     * @throws \Exception
     */
    public function addUser(\Ro\v0\User $ro): bool{

        $dvo = new \Dvo\User();
        $dvo->setUserName($ro->getUserName())->setSex($ro->getSex())->setAge($ro->getAge());

        return $this->getModel('User')->addUser($dvo);
    }


    /**
     * 更新用户信息
     * @param \Ro\v0\User $ro
     *
     * @return int
     * @throws \Error\User
     */
    public function modifyUser(\Ro\v0\User $ro): int{
        $filter = new \Dvo\User($ro, 'id');

        $dvo = new \Dvo\User($ro, implode(',', Member::MODIFY_AVAILABLE_FILED));

        //没有传入待更新值
        if (true == $dvo->isEmpty())
            throw new \Error\User('MODIFY_PARAM_INVALID');

        return $this->getModel('User')->modifyUser($filter, $dvo);
    }

    /**
     * 删除用户
     * @param \Ro\v0\User $ro
     *
     * @return int
     * @throws \Exception
     */
    public function removeUser(\Ro\v0\User $ro): int{
        $dvo = new \Dvo\User($ro, 'id');

        return $this->getModel('User')->removeUser($dvo);
    }
}