<?php
namespace Logic;
use Dvo\Relation;
use Error\Article;
use function MongoDB\BSON\fromPHP;
use function MongoDB\BSON\toPHP;
use MongoDB\BSON\UTCDateTime;
use Strawframework\Base\Logic;
use Strawframework\Base\Model;
use Strawframework\Base\RequestObject;
use Strawframework\Common\Funs;

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

    public function getUserList(RequestObject $ro, ? array $ages): ? array{

        $dvo = new \Dvo\User($ro, 'sex');
        $dvo->setAge($ages['minAge']);
        //$dvo->setJoinTime(new UTCDateTime(strtotime($ro->getJoinTime())* 1000));

        $data = [];
        if ($ro->getSex()){
            $data['sex'] = ':sex';
            $data['age2'] = ':sex2';
        }

        if (!empty($ages)){
            $data['age'] = ['$gt' => ':age'];
        }

        $list = $this->getModel('User')->data($data)->query($dvo)->getAll();
        var_dump($list);die;
        return $list;
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
            throw new Article('INPUT_ERROR', $id);
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