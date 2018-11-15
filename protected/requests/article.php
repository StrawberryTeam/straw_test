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
     * @Column (name='/id/{}', type='int')
     */
    private $id;

    /**
     * @Column (name='/{}', type='string')
     */
    private $title;
}