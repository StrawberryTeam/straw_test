<?php
namespace Ro\v0;
use Strawframework\Base\RequestObject;

/**
 * Ro
 */
class Article extends RequestObject {

    /**
     * @Column (name='id', type='int')
     */
    protected $id;

    /**
     * 发布者 uid
     * @Column (name='uid', type='string')
     */
    protected $uid;

    /**
     * @Column (name='query', type='string')
     */
    protected $query;

    /**
     * @Column (name='cids', type='string')
     */
    protected $cids;

    /**
     * @Column (name='tags', type='string')
     */
    protected $tags;

    /**
     * @Column (name='offset', type='int')
     */
    protected $offset;

    /**
     * @Column (name='limit', type='int')
     */
    protected $limit;

    /**
     * @Column (name='category', type='string')
     */
    protected $category;

    /**
     * @Column (name='title', type='string')
     */
    protected $title;

    /**
     * @Column (name='content', type='string')
     */
    protected $content;
}