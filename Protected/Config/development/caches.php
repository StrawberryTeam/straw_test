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
];