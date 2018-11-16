<?php
/**
 * User: Zack Lee
 * Date: 2018/11/15
 * Time: 21:33
 */

namespace requests;


use strawframework\base\Request;

class article extends Request {

    /**
     * @Column (name='id', type='int')
     */
    protected $id;

    /**
     * @Column (name='get_title', type='string')
     */
    protected $title;

    //过滤 id
    public function setId($v){
        return $v . 'set';
    }
}