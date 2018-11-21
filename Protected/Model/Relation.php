<?php
namespace Model;
use Strawframework\Base\Model;

/**
 * 用户关系表
 */

class Relation extends Model {


    public function getRelationViaUid(int $uid): ?string{
        $relations = [
            1 => 'zl',
            2 => 'hz'
        ];
        return $relations[$uid];
    }
}