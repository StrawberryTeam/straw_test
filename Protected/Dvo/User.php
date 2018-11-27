<?php
namespace Dvo;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;
use Strawframework\Base\DataViewObject;

/**
 * User
 */
class User extends DataViewObject {
    /**
     * @var array
     */
    public static $dvoObject = [];

    /**
     * @Column (name='_id', type='\MongoDB\BSON\ObjectID')
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
     * @Column (name='follower', type='array')
     */
    protected $follower;

    /**
     * @Column (name='following', type='array')
     */
    protected $following;

    /**
     * 加入时间
     * @Column (name='join_time', type='\MongoDB\BSON\UTCDateTime')
     */
    protected $joinTime;

    /**
     * @Column (name='update_at', type='\MongoDB\BSON\UTCDateTime')
     */
    protected $updateAt;

    public function getId(): string
    {
        return (string)$this->id;
    }

    /**
     * 返回注册时间格式
     * @return string
     */
    public function getJoinTime(): string
    {
        return $this->joinTime->toDateTime()->format('Y-m-d H:i:s');
    }

    /*
     * 自定义取值
     */
    public function getUpdateAt(): string
    {
        return $this->updateAt->toDateTime()->format('Y-m-d H:i:s');
    }

    /**
     * ReadOnly or System write Column
     * @return $this
     */
    public function setUpdateAt(): User
    {
        $this->updateAt = new UTCDateTime();
        return $this;
    }

    /**
     * 关注了新的人
     *
     * @param array $follow
     *
     * @return User
     * @throws User
     */
    public function setFollowing(array $follow): User{

        $_convert = [
            'uid' => function($id) : ObjectId{
                return new ObjectId($id);
            },
            'follow_msg' => function($followMsg): String{
                return $followMsg;
            }
        ];

        foreach ($follow as $key => $value) {
            foreach ($value as $k => $v) {
                try {
                    $follow[$key]->$k = $_convert[$k]($v);
                }catch (\Error $e){
                    throw new \Error\User('INPUT_ERROR', $key . ' -> ' . $k);
                }
            }
        }

        $follow['follow_time'] = new UTCDateTime();
        $this->following = $follow;
        return $this;
    }

}