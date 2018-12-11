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

    /**
     * 添加一个新内容
     * @param \Dvo\Article $dvo
     *
     * @return bool|mixed|\MongoDB\InsertManyResult|\MongoDB\InsertOneResult
     */
    public function addArticle(\Dvo\Article $dvo): bool{
        return $this->insert($dvo);
    }

    /**
     * 获取所有内容
     * @param \Dvo\Article $dvo
     *
     * @return array|\Illuminate\Database\Eloquent\Builder|mixed|null
     */
    public function getList(\Dvo\Article $dvo, array $data = [], ? int $offset = null, ? int $limit = null): object{
        return $this->query($dvo)->data($data)->limit($limit ?? 10)->offset($offset ?? 0)->getAll();
    }

    /**
     * 获取符合条件的条数
     * @param \Dvo\Article $dvo
     * @param array        $data
     *
     * @return int
     */
    public function getCount(\Dvo\Article $dvo, array $data = []): int{
        return $this->query($dvo)->data($data)->count('id');
    }

    public function getArticle(int $id){

        $a= $this->where('id', $id)->getOne();
        var_dump($a, $this->getLastSql());die;
    }
}