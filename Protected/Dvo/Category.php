<?php
namespace Dvo;
use Strawframework\Base\DataViewObject;

/**
 * Category
 */
class Category extends DataViewObject {
    /**
     * @var array
     */
    public static $dvoObject = [];

    /**
     * @Column (name='cid', type='int')
     */
    protected $cid;

    /**
     * @Column (name='category', type='string')
     */
    protected $category;

    /**
     * @Column (name='update_at', type='string')
     */
    protected $updateAt;

    public function getCid(){
        return 'c' . $this->cid;
    }
}