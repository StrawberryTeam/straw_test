<?php
namespace Model;
use Dvo\User as UserDvo;
use function MongoDB\BSON\fromPHP;
use function MongoDB\BSON\toJSON;
use MongoDB\BSON\UTCDateTime;
use MongoDB\Driver\Cursor;
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
     * @return object|null
     * @throws \Exception
     */
    public function getUser(UserDvo $dvo):? object {

        $res = $this->query($dvo)->getOne();
        return $res;
    }

    /**
     * 获取用户列表
     * @param UserDvo    $dvo
     * @param array|null $query
     *
     * @return array|null
     */
    public function getList(UserDvo $dvo, ? array $query = []):? array{
        $list = $this->data($query)->query($dvo)->getAll();
        return $list;
    }

    /**
     * 用户总数
     * @param UserDvo    $dvo
     * @param array|null $query
     *
     * @return int|null
     */
    public function getCount(UserDvo $dvo, ? array $query = []):? int{
        return $this->data($query)->query($dvo)->count();
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

    /**
     * 更新用户信息
     * @param UserDvo $filter
     * @param UserDvo $dvo
     *
     * @return int 更新条数
     * @throws \Error\User 未匹配到更新条件
     */
    public function modifyUser(UserDvo $filter, UserDvo $dvo): int{
        $dvo->setUpdateAt();

        $result = $this->update($dvo, $filter);

        //未匹配到数据
        if (0 == $result->getMatchedCount())
            throw new \Error\User('MODIFY_NOTFOUND', $filter->getId());

        return $result->getModifiedCount();
    }

    /**
     * 删除用户
     * @param UserDvo $dvo
     *
     * @return int
     */
    public function removeUser(UserDvo $dvo): int{

        return $this->delete($dvo);
    }
}