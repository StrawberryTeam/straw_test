<?php
namespace Controller\v0;
use Strawframework\Base\Controller, Strawframework\Base\Result;
use Common\Code;

/**
 * @Ro (name='User')
 */
class User extends Controller{
    /* @Request(uri="/log",target="get") */
    public function logtest(){
        var_dump(Log::getInstance()->info('测试测试测试222',(array)$this->getRequests()));

    }
    /**
     * 取一个用户
     * @Request (uri="/", target='get')
     * @Required (column='id')
     * @return Result
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
     */
    public function addUser(){

        $result = $this->getService('Member')->addUser($this->getRequests());

        if (false == $result)
            return new Result(Code::FAIL);

        return new Result(Code::CREATED);
    }

    /**
     * 更新一个用户信息 @todo 更新值(post)或和条件值(get) 有相同字段 如果处理 Ro
     * @Request(uri='/', target='put')
     * @Required(column='id')
     * @return Result
     * @throws \Error\User
     */
    public function modifyUser(){

        $modifyNum = $this->getService('Member')->modifyUser($this->getRequests());

        return new Result(Code::SUCCESS, '', ['modify_num' => $modifyNum]);
    }

    /**
     * 删除一个用户
     * @Request(uri='/', target='delete')
     * @Required(column='id')
     * @return Result
     * @throws \Exception
     */
    public function removeUser(){

        $removeNum = $this->getService('Member')->removeUser($this->getRequests());

        return new Result(Code::SUCCESS, '', ['remove_num' => $removeNum]);
    }
}