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

    //展示插入的内容
    public function getContent(){
        return htmlspecialchars_decode($this->content);
    }

    //插入的内容
    public function setContent($content){
        $this->content = htmlspecialchars($content);
        return $this;
    }
}