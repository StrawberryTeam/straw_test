<?php
namespace Controllers\v1;
use Strawframework\Base\Controller;

/**
 * 
 */
class Test extends Controller{

    public function __construct(){
        //加载模板
        parent::__construct($isView=false);

    }

    /**
     * @Request (uri='/index', target='get')
     */
    public function index(){

        echo 'home';
    }

    /**
     * 我知道
     * @param id int
     * @Request (uri="/article", target='get')
     * @return int
     */
    public function getArticle(){
        var_dump($this->getRequests()->getTitle());
       
        echo 'get article';
    }

    /**
     * @Request(uri='/article', target='post')
     */
    public function setArticle(){

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