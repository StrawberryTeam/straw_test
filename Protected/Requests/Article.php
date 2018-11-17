<?php
/**
 * User: Zack Lee
 * Date: 2018/11/15
 * Time: 21:33
 */

namespace Requests;


use Strawframework\Base\Request;

class Article extends Request {

    /**
     * @Column (name='id', type='int')
     */
    protected $id;

    /**
     * @Column (name='title', type='string')
     */
    protected $title;

    //自定义过滤器
    public function setId($v) {
        return htmlspecialchars($v);
    }

    //自定义取值器
    //public function getId() {
    //    return 111;
    //}
}