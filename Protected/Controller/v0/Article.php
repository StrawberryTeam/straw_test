<?php
namespace Controller\v0;
use Strawframework\Base\Controller, Strawframework\Base\Result;
use Common\Code;

/**
 * @Ro (name='Article')
 */
class Article extends Controller{

    /**
     * @Request(uri='/list', target='get')
     */
    public function list(){

        $this->getService('Article')->getList($this->getRequests());
    }

    /**
     * @Request(uri='/', target='post')
     * @Required(column='title,content,cids')
     */
    public function newArticle(){

        $this->getService('Article')->addArticle($this->getRequests());
    }

    /**
     * 添加新分类
     * @Request(uri='/category', target='post')
     * @Required(column='category')
     * @return Result
     * @throws \Error\Article
     */
    public function newCategory(){

        $cateId = $this->getService('Article')->addCategory($this->getRequests());
        return new Result(Code::SUCCESS, '', ['cate_id' => $cateId]);
    }
}