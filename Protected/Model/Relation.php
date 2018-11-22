<?php
namespace Model;
use Strawframework\Base\Model;

/**
 * 用户关系表
 */

class Relation extends Model {

    //表前缀, 不设置此参数使用库配置中 DB_PREFIX 若为空则无
    protected $pre = 'straw_';

    //真实表名, 不填则与类同名
    protected $table = 'relation_user';

    public function __construct() {
        //连接的库 Tag
        parent::__construct('mongo');
    }

    public function getRelationViaUid(int $uid): ?string{
        $relations = [
            1 => 'zl',
            2 => 'hz'
        ];
        return $relations[$uid];
    }
}