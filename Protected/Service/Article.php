<?php
namespace Service;
use Strawframework\Base\Service;

/**
 * Article Service
 */

class Article extends Service {

    public function getList(\Ro\v0\Article $ro): array{

        return $this->getLogic('Article')->getList($ro);
    }

    public function addArticle(\Ro\v0\Article $ro): int{

        $this->categoryExists($ro->getCids());
    }

    /**
     * 添加分类
     * @param \Ro\v0\Article $ro
     *
     * @return bool
     * @throws \Error\Article
     */
    public function addCategory(\Ro\v0\Article $ro): int{

        if (false == $this->validCategory($ro->getCategory())){
            throw new \Error\Article('CATEGORY_NAME_INVALID', $ro->getCategory(), '分类名称长度 2 - 10 位');
        }else{
            return $this->getLogic('Article')->addCategory($ro->getCategory());
        }
    }

    public function categoryExists($cids){

        $category = $this->getLogic('Article')->getCategoryList(['cids' => $cids]);

        $hasCids = array_column($category->toArray(), 'cid');

        $noneCids = array_diff(explode(',', $cids), $hasCids);

        if (count($noneCids) > 0)
            throw new \Error\Article('CATEGROY_NOT_EXISTS', implode(',', array_values($noneCids)));

        return true;
    }

    /**
     * 分类长度 2 - 10 位
     * @param $category
     *
     * @return bool
     */
    public function validCategory($category): bool{

        $length = mb_strlen($category);

        if ($length < 2 || $length > 10)
            return false;

        return true;
    }
}