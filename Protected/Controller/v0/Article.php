<?php
namespace Controller\v0;
use Strawframework\Base\Controller;
use Strawframework\Base\Log;
use Common\Code;

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
        var_dump(Log::getInstance()->info('测试测试测试222',(array)$this->getRequests()));
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