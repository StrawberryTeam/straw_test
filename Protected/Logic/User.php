<?php
namespace Logic;
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
     * @param RequestObject $ro
     * @param array|null    $ages
     *
     * @return array|null
     * @throws \Exception
     */
    public function getUserList(RequestObject $ro, ? array $ages): ? array{

        $dvo = new \Dvo\User($ro, 'sex');
        //相同字段 不同值 设置别名 别名类型与原名 需完全相同，遵循原名 set 方法
        $dvo->_setAlias('age', 'minAge', $ages['minAge']);
        $dvo->_setAlias('age', 'maxAge', $ages['maxAge']);

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
     * @throws \Exception
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