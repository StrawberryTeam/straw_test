<?php
namespace Controller\v0;
use Strawframework\Base\Controller, Strawframework\Base\Result;
use Common\Code;

/**
 * @Ro (name='User')
 */
class User extends Controller{

    /**
     * 取一个用户
     * @Request (uri="/", target='get')
     * @Required (column='id')
     * @return Result
     * @throws \Exception
     */
    public function getInfo(){

        //set Get id 1 | 2
        $userInfo = $this->getService('Member')->getUser($this->getRequests()->getId());

        if (!$userInfo)
            return new Result(Code::IS_EMPTY); //httpcode 204 nothing to show

        return new Result(Code::SUCCESS, '', $userInfo);
    }

    /**
     * 取用户列表
     * @Request (uri="/list", target='get')
     * @return Result
     * @throws \Exception
     */
    public function getList(){

        list($count, $list) = $this->getService('Member')->getUserList($this->getRequests());

        if (0 == $count)
            return new Result(Code::IS_EMPTY); //httpcode 204 nothing to show

        return new Result(Code::SUCCESS, '', compact('count', 'list'));
    }

    /**
     * 添加一个新用户
     * @Request(uri='/', target='post')
     * @Required (column='userName, sex, age')
     * @throws \Error\User
     * @throws \Exception
     */
    public function addUser(){

        $result = $this->getService('Member')->addUser($this->getRequests());

        if (false == $result)
            return new Result(Code::FAIL);

        return new Result(Code::SUCCESS);
    }

    /**
     * @Request(uri='/', target='put')
     */
    public function modifyUser(){

        $this->getService('Member')->modifyUser($this->getRequests());
    }

    /**
     * @Request(uri='/article', target='delete')
     */
    public function deleteArticle(){
        echo 'delete article';
    }
}