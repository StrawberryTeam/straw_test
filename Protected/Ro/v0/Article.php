<?php
namespace Ro\v0;
use Strawframework\Base\RequestObject;

/**
 * Ro
 */
class Article extends RequestObject {

    /**
     * @Column (name='id', type='int')
     * RequestObject
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