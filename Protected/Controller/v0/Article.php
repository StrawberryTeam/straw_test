<?php
namespace Controller\v0;
use Strawframework\Base\Controller, Strawframework\Base\Result;
use Common\Code;
use Strawframework\Base\Model;

/**
 * @Ro (name='Article')
 */
class Article extends Controller{

    public function __construct(){
        //加载模板
        parent::__construct($isView=false);
    }

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

        return new Result(Code::HTTP_OK, '', Model::toArray($userInfo));
    }

    /**
     * 取用户列表
     * @Request (uri="/list", target='get')
     * @return Result
     * @throws \Exception
     */
    public function getList(){

        $userList = $this->getService('Member')->getUserList($this->getRequests());
    }

    /**
     * 添加一个新用户
     * @Request(uri='/', target='post')
     * @Required (column='userName, sex, age')
     * @throws \Error\Article
     * @throws \Exception
     */
    public function addUser(){

        $result = $this->getService('Member')->addUser($this->getRequests());

        if (false == $result)
            return new Result(Code::FAIL);

        return new Result(Code::SUCCESS);
    }

    /**
     * @Request(uri='/article', target='put')
     */
    public function updateArticle(){

        echo 'update article';
    }

    /**
     * @Request(uri='/article', target='delete')
     */
    public function deleteArticle(){
        echo 'delete article';
    }
}