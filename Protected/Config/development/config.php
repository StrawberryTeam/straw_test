<?php

/**
 * 主配置项目
 */

return [
    //winterspring
    // 'api_key' => '230d2f705f9281e82e6b6fad903835eb',
    'site_name' => 'StrawTest',
    //网站主域名
    'site_domain' => 'zlizhe.com',
    //首选语言包 - => _
    'default_lang' => 'zh_CN',
    //传入参数格式
    'input_type' => 'form', //form(urlencoded) | json 2种方式都可以传2进制
    //返回参数格式
    'output_type' => 'json', //json | xml | html | jsonp
    //default database
    'database' => 'mongo',
    //是否启用 cache 
    'cache' => 'file',
    //默认缓存时间 5min = 300
    'cache_expire' => 0,
    //默认的日志方法
    'log' => 'file',
    //加载其他配置文件
    'ext' => [
        'databases',
        'caches',
        'logs'
    ]
];
