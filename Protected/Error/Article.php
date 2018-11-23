<?php
namespace Error;

/**
 * 模块异常报错
 */

class Article extends \Strawframework\Base\Error {

    //当前模块的 Error code 10 Strawframework 保留
    protected $code = '11';

    //占位符 => 错误码
    protected $errorCode = [
        'ID_INVALID' => '01',
        'INPUT_ERROR' => '02',
        'SEX_INVALID' => '03',
        'AGE_INVALID' => '04',
        'USER_EXISTS' => '05',
    ];

    public function __construct(string ...$msgKeyAndValue) {
        //第二个参数为语言包
        parent::__construct($msgKeyAndValue, 'ArticleError');
    }
}