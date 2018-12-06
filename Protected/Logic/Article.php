<?php
namespace Logic;
use Strawframework\Base\Logic;

/**
 * Article logic
 */

class Article extends Logic {


    public function getList(\Ro\v0\Article $ro){

        $dvo = new \Dvo\Article();
        if ($ro->getCreatedUid())
            $dvo->setCreatedUid($ro->getCreatedUid());


        $data = [];
        return $this->getModel('Article')->getList($dvo, $data);
    }

    public function getCategoryList(array $params){

        $dvo = new \Dvo\Category();
        if ($params['cids']){
            $dvo->_setAlias(false, 'cids', $params['cids']);
        }

        return $this->getModel('Category')->getList($dvo);
    }

    /**
     * 添加分类
     * @param string $category
     *
     * @return bool
     * @throws \Exception
     */
    public function addCategory(string $category): int{
        $dvo = new \Dvo\Category();
        $dvo->setCategory($category);
        return $this->getModel('Category')->addCategory($dvo);
    }
}