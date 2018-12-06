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
 * 内容表
 */

class Article extends Model {

    //表前缀, 不设置此参数使用库配置中 DB_PREFIX 若为空则无
    //protected $pre = 'straw_';

    //真实表名, 不填则与类同名
    protected $table = 'article';

    public function __construct() {
        //连接的库 Tag
        parent::__construct('mysql');
    }

}