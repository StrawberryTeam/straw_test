<?php
namespace Controller\v0;
use Strawframework\Base\Controller, Strawframework\Base\Result;
use Logic\User, Common\Code;

/**
 * @Ro (name='Article')
 */
class Article extends Controller{

    public function __construct(){
        //加载模板
        parent::__construct($isView=false);
    }

    /**
     * @Request (uri="/", target='get')
     * @Required (column='id, title')
     */
    public function getInfo(){

        //set Get id 1 | 2
        $userName = $this->getService('Content')->getUser($this->getRequests()->getId());

        if (empty($userName))
            return new Result(Code::IS_EMPTY); //httpcode 204 nothing to show

        return new Result(Code::HTTP_OK, '', ['name' => $userName]);
    }

    /**
     * 添加一个新用户
     * @Request(uri='/', target='post')
     * @Required (column='userName, sex, age')
     * @throws \Error\Article
     * @throws \Exception
     */
    public function addUser(){

        //性别合法性
        if (!in_array($this->getRequests()->getSex(), [User::SEX_MALE, User::SEX_FEMALE]))
            throw new \Error\Article('SEX_INVALID', $this->getRequests()->getSex(), User::SEX_MALE . ' or ' . User::SEX_FEMALE);

        //年龄合法性
        if ((User::AGE_MIN <=> $this->getRequests()->getAge()) > 0 || (User::AGE_MAX <=> $this->getRequests()->getAge()) < 0)
            throw new \Error\Article('AGE_INVALID', $this->getRequests()->getAge());


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