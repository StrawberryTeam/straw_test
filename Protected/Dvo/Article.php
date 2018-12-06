<?php
namespace Dvo;
use Strawframework\Base\DataViewObject;

/**
 * Article
 */
class Article extends DataViewObject {
    /**
     * @var array
     */
    public static $dvoObject = [];

    /**
     * @Column (name='id', type='int')
     */
    protected $id;

    /**
     * @Column (name='title', type='string')
     */
    protected $title;

    /**
     * @Column (name='content', type='string')
     */
    protected $content;

    /**
     * @Column (name='created_uid', type='string')
     */
    protected $createdUid;

    /**
     * @Column (name='created_at', type='int')
     */
    protected $createdAt;

    /**
     * @Column (name='update_at', type='int')
     */
    protected $updateAt;
}