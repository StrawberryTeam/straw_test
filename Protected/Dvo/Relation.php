<?php
namespace Dvo;
use MongoDB\BSON\UTCDateTime;
use Strawframework\Base\DataViewObject;

/**
 * Dvo
 * 数据字段可用类型 ['int', 'string', 'bool', 'array', 'object'] 或其他 object 需要带命名空间 \MongoDB\BSON\ObjectID
 *
 * # For PHPStorm autocomplete
 * @property $getId
 * @method static DataViewObject getId()
 * @property $setId
 * @method static DataViewObject setId(string|object $id)
 *
 * @property $getUserName
 * @method static DataViewObject getUserName(string $userName)
 * @property $setUserName
 * @method static DataViewObject setUserName(string $userName)
 */

class Relation extends DataViewObject {
    /**
     * @var array
     */
    public static $dvoObject = [];

    /**
     * @Column (name='_id', type='\MongoDB\BSON\ObjectID')
     */
    protected $id;

    /**
     * @Column (name='user_name', type='string')
     */
    protected $userName;

    /**
     * @Column (name='update_at', type='\MongoDB\BSON\UTCDateTime')
     */
    protected $updateAt;

    /*
     * 自定义取值
     */
    public function getUpdateAt(): string
    {
        return $this->updateAt->toDateTime()->format('Y-m-d H:i:s');
    }

    /**
     * 自定义写入值
     * ReadOnly or System write Column
     * @return $this
     */
    public function setUpdateAt(): Relation
    {
        $this->updateAt = new UTCDateTime();
        return $this;
    }
}