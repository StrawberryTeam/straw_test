<?php

/**
 * 主配置项目
 */

return [
    //winterspring
    // 'api_key' => '230d2f705f9281e82e6b6fad903835eb',
    'site_name' => '卡通世界',
    //网站主域名
    'site_domain' => 'zlizhe.com',
    //首选语言包 - => _
    'default_lang' => 'zh_CN',
    //本应用 module
    'module_name' => 'pi',
    //default database 留空则不使用不加载数据库配置
    'database' => 'mongo',
    //是否启用 cache  留空则不使用不加载cache配置
    'cache' => 'redis',
    //默认缓存时间 5min = 300
    'cache_expire' => 0,
];
