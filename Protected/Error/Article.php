<?php
namespace Error;

/**
 * 模块异常报错
 */

class Article extends \Strawframework\Base\Error {

    //当前模块的 Error code 10 Strawframework 保留
    protected $code = '12';

    //占位符 => 错误码
    protected $errorCode = [
        'ID_INVALID' => '01',
        'CATEGORY_NAME_INVALID' => '02',
        'CATEGROY_NOT_EXISTS' => '03',
    ];

    /**
     * Article constructor.
     *
     * @param string ...$msgKeyAndValue
     *
     */
    public function __construct(string ...$msgKeyAndValue) {
        //第二个参数为语言包
        parent::__construct($msgKeyAndValue, 'ArticleError');
    }
}