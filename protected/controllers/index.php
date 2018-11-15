<?php
namespace controllers;
use \strawframework\base\Controller;

/**
 * 
 */
class Index extends Controller{

    public function __construct(){
        //加载模板
        parent::__construct($isView=false);

    }


    /**
     * 我知道
     * @param id int
     * @Request (uri="/home", target='get')
     * @return int
     */
    public function index(){
       
        echo 'home';
    }

    public function home(){
        echo 'im home action';
    }
}
