<?php
namespace Logic;
use Strawframework\Base\DataViewObject;
use Strawframework\Base\Logic;
use Strawframework\Base\RequestObject;

/**
 * Article logic
 */

class Article extends Logic {

    public function getArticle(int $id){
        return $this->getModel('Article')->getArticle($id);
    }

    /**
     * 获得所有内容
     * @param \Ro\v0\Article $ro
     *
     * @return array|\Illuminate\Database\Eloquent\Builder|mixed|null
     * @throws \Exception
     */
    public function getList(\Ro\v0\Article $ro): array{

        $dvo = new \Dvo\Article();
        if ($ro->getUid())
            $dvo->setCreatedUid($ro->getUid());


        $data = [];

        $count = $this->getModel('Article')->getCount($dvo, $data);

        //没有内容
        if (0 == $count)
            return [0, null];

        return [$count, $this->getModel('Article')->getList($dvo, $data, $ro->getOffset(), $ro->getLimit())];
    }

    /**
     * 所有分类
     * @param array $params
     *
     * @return array|\Illuminate\Database\Eloquent\Builder|mixed|null
     * @throws \Exception
     */
    public function getCategoryList(array $params){

        $dvo = new \Dvo\Category();
        if ($params['cids']){
            $dvo->_setArrayAlias(false, 'cids', explode(',', $params['cids']));
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
    public function addCategory(string $category): bool{
        $dvo = new \Dvo\Category();
        $dvo->setCategory($category);
        return $this->getModel('Category')->addCategory($dvo);
    }

    /**
     * 添加内容
     * @param \Ro\v0\Article $ro
     *
     * @return bool|mixed|\MongoDB\InsertManyResult|\MongoDB\InsertOneResult
     * @throws \Exception
     */
    public function addArticle(\Ro\v0\Article $ro): bool{
        $dvo = new \Dvo\Article($ro, [
            'title' => 'title',
            'content' => 'content',
            'uid' => 'createdUid'
        ]);

        return $this->getModel('Article')->addArticle($dvo);
    }
}