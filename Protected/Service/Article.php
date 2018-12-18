<?php
namespace Service;
use Strawframework\Base\Service;

/**
 * Article Service
 */

class Article extends Service {
    public function getArticle(int $id){

        $this->getLogic('Article')->getArticle($id);
    }

    /**
     * 返回符合条件的条数与内容
     * @param \Ro\v0\Article $ro
     *
     * @return array
     */
    public function getList(\Ro\v0\Article $ro): array {


        list($c, $a) = $this->getLogic('Article')->getList($ro);
        foreach ($a as $value) {
            var_dump($value);
        }
        die;
    }

    /**
     * 验证内容是否合法
     * @param \Ro\v0\Article $ro
     *
     * @return int
     * @throws \Error\Article
     */
    public function addArticle(\Ro\v0\Article $ro): bool{

        $nonCids = $this->categoryExists($ro->getCids());

        //分类有部分不存在
        if (true !== $nonCids)
            throw new \Error\Article('CATEGROY_NOT_EXISTS', implode(',', array_values($nonCids)));

        return $this->getLogic('Article')->addArticle($ro);
    }

    /**
     * 添加分类
     * @param \Ro\v0\Article $ro
     *
     * @return bool
     * @throws \Error\Article
     */
    public function addCategory(\Ro\v0\Article $ro): bool{

        if (false == $this->validCategory($ro->getCategory())){
            throw new \Error\Article('CATEGORY_NAME_INVALID', $ro->getCategory(), '分类名称长度 2 - 10 位');
        }else{
            return $this->getLogic('Article')->addCategory($ro->getCategory());
        }
    }

    /**
     * 分类id 是否存在 返回 true 或不存在的 id
     * @param $cids
     *
     * @return array|bool
     */
    public function categoryExists($cids){

        $category = $this->getLogic('Article')->getCategoryList(['cids' => $cids]);

        $hasCids = array_column($category->toArray(), 'cid');

        $nonCids = array_diff(explode(',', $cids), $hasCids);

        if (count($nonCids) > 0)
            return $nonCids;

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