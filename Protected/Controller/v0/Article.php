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

        //throw new \Error\Article('ID_INVALID', $this->getRequests()->getId());
        //return (new Result(Code::HTTP_OK, 'ok2322', null, true))->toJsonp('cl');
        return (new Result(Code::HTTP_OK, 'ok2322', null));
    }

    /**
     * @Request(uri='/', target='post')
     */
    public function set(){

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