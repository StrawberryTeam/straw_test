<?php
/**
 * 缓存配置
 */
return [
    //测试使用本机
    'redis' => [
        'CACHE_TYPE' => 'redis',
        'CACHE_HOST' => '127.0.0.1',
        'CACHE_AUTH' => '',
        'CACHE_PORT' => 6379,
    ],

    'file' => [
        'CACHE_TYPE' => 'file',
        'CACHE_PATH' => ROOT_PATH.'/Runtime/Cache/File/',
        'CACHE_PREFIX' => 'straw_',
        'CACHE_EXPIRE' => 0
    ]
];