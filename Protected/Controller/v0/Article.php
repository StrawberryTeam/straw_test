<?php
namespace Controller\v0;
use Strawframework\Base\Controller;
use Util\Code;

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
        //var_dump($this->getRequests()->getId());

         //throw new \Strawframework\Base\Error('aaa');
         //throw new \Error\Article('ID_INVALID', 'idabc');
        var_dump(Code::SUCCESS);
        echo 'get article';
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