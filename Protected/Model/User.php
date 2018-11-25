<?php
namespace Model;
use Dvo\User as UserDvo;
use MongoDB\BSON\UTCDateTime;
use MongoDB\Model\BSONDocument;
use Strawframework\Base\Model;

/**
 * 用户关系表
 */

class User extends Model {

    //表前缀, 不设置此参数使用库配置中 DB_PREFIX 若为空则无
    protected $pre = 'straw_';

    //真实表名, 不填则与类同名
    protected $table = 'member_user';

    public function __construct() {
        //连接的库 Tag
        parent::__construct('mongo');
    }

    /**
     * 获取一个用户的信息
     * @param UserDvo $dvo
     *
     * @return array|null
     */
    public function getUser(UserDvo $dvo): object {

        $res = $this->query($dvo)->getOne();
        return $res;
    }

    /**
     * 添加一个新用户
     * @param UserDvo $dvo
     *
     * @return bool
     * @throws \Exception
     */
    public function addUser(UserDvo $dvo): bool{

        $dvo->setJoinTime(new UTCDateTime());
        $dvo->setUpdateAt();
        return $this->insert($dvo)->getInsertedCount() > 0 ? true : false;
    }

    public function getRelationViaUid(int $uid): ?string{
        $relations = [
            1 => 'zl',
            2 => 'hz'
        ];
        return $relations[$uid];
    }
}