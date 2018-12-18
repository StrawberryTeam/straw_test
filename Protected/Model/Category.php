<?php
namespace Model;
use Strawframework\Base\Model;

/**
 * 分类
 */

class Category extends Model {

    //表前缀, 不设置此参数使用库配置中 DB_PREFIX 若为空则无
    //protected $pre = 'straw_';

    //真实表名, 不填则与类同名
    protected $table = 'category';

    public function __construct() {
        //连接的库 Tag
        parent::__construct('mysql');
    }


    /**
     * @param \Dvo\Category $dvo
     *
     * @return bool|mixed|\MongoDB\InsertManyResult|\MongoDB\InsertOneResult
     */
    public function addCategory(\Dvo\Category $dvo): bool{

        return $this->insert($dvo);
    }

    public function getList(\Dvo\Category $dvo) {
        $res = $this->data(['cid' => ['$whereIn' => ':_cids']])->query($dvo)->getAll();
        return $res;
    }
}