<?php
namespace Controller\v0;
use Strawframework\Base\Controller, Strawframework\Base\Result;
use Common\Code;
use Strawframework\Common\Valid;

/**
 * @Ro (name='Article')
 */
class Article extends Controller{

    /**
     * 查询所有内容
     * @Request(uri='/list', target='get')
     */
    public function list(){

        list($count, $list) = $this->getService('Article')->getList($this->getRequests());

        if (0 == $count)
            return new Result(Code::IS_EMPTY);

        return new Result(Code::SUCCESS, '', compact('count', 'list'));
    }

    /**
     * 查询一篇内容
     * @Request(uri='/', target='get')
     * @Required(column='id')
     */
    public function article(){

        $this->getService('Article')->getArticle($this->getRequests()->getId());
    }

    /**
     * 添加新文章
     * @Request(uri='/', target='post')
     * @Required(column='uid,title,content,cids')
     */
    public function newArticle(){
        $uid = $this->getRequests()->getUid();
        if (false == Valid::header('token', function($token) use ($uid){
            //登录失败 (模拟)
            if (false == $this->getService('Member')->validToken($token, $uid))
                throw new \Error\User('LOGIN_ERROR');
            return true;
        })){
            //未登录
            return new Result(Code::FORBIDDEN);
        }

        if (false == $this->getService('Article')->addArticle($this->getRequests()))
            return new Result(Code::FAIL, '添加失败, 请重试');
        else{
            return new Result(Code::SUCCESS);
        }
    }

    /**
     * 添加新分类
     * @Request(uri='/category', target='post')
     * @Required(column='category')
     * @return Result
     * @throws \Error\Article
     */
    public function newCategory(){


        if (false == $this->getService('Article')->addCategory($this->getRequests()))
            return new Result(Code::FAIL, '添加失败, 请重试');

        return new Result(Code::SUCCESS);
    }
}