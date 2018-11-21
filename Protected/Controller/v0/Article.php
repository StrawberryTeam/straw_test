<?php
namespace Controller\v0;
use Strawframework\Base\Controller;
use Common\Code;
use Strawframework\Base\RequestObject;
use Strawframework\Base\Result;

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
     * @Request(uri='/', target='post')
     */
    public function set(){

        //throw new \Error\Article('ID_INVALID', $this->getRequests()->getId());
        //return (new Result(Code::HTTP_OK, 'ok2322', null, true))->toJsonp('cl');
        echo 'set article';
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