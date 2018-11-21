<?php
namespace Dvo;
use MongoDB\BSON\UTCDateTime;
use Strawframework\Base\DataViewObject;

/**
 * Dvo
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
     * @Column (name='user_name', type='int')
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
     * ReadOnly or System write Column
     * @return $this
     */
    public function setUpdateAt(): Relation
    {
        $this->updateAt = new UTCDateTime();
        return $this;
    }
}