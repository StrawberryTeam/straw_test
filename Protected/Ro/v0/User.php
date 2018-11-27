<?php
namespace Ro\v0;
use Strawframework\Base\RequestObject;

/**
 * Ro
 */
class User extends RequestObject {

    /**
     * @Column (name='id', type='string')
     */
    protected $id;

    /**
     * 用户名称
     * @Column (name='user_name', type='string')
     */
    protected $userName;

    /**
     * @Column (name='sex', type='string')
     */
    protected $sex;

    /**
     * @Column (name='age', type='int')
     */
    protected $age;

    /**
     * @Column (name='age_range', type='string')
     */
    protected $ageRange;

    /**
     * @Column (name='follow', type='string')
     */
    protected $follow;

    /**
     * @Column (name='join_time', type='string')
     */
    protected $joinTime;

    //自定义过滤器
    public function setUserName($v) {
        return strip_tags($v);
    }

    //自定义取值器
    //public function getId() {
    //    return 111;
    //}
}