<?php
namespace Error;
use Lang\v0\zh_CN\ArticleError;

/**
 * 模块异常报错
 */

class Article extends \Strawframework\Base\Error {

    //当前模块的 Error code 10 Strawframework 保留
    protected $code = '11';

    //占位符 => 错误码
    protected $errorCode = [
        'ID_INVALID' => '01'
    ];

    // Strawframework error
    public function __construct(string ...$msgKeyAndValue) {
        //第二个参数为语言包 @todo 配置加载相应语言
        parent::__construct($msgKeyAndValue, 'ArticleError');
    }
}