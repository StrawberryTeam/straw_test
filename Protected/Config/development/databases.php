<?php
/**
 * 数据库设置
 */
return [
    //mongo example
    'mongo' => [
        'DB_TYPE' => 'mongodb',
        'DB_HOST' => '127.0.0.1', //读写分离多台逗号分割,　第一台为主写其他读 127.0.0.1,127.0.0.2,127.0.0.3
        'DB_USER' => '',
        'DB_PWD'  => '',
        'WRITE_MASTER' => false, //读写分离
        'DB_PREFIX' => '',
        'DB_NAME' => 'pi_2017',
        'DB_PORT' => 27017
    ],

    //mysql example
    'mysql' => [
        'DB_TYPE' => 'mysql',
        'DB_HOST' => '127.0.0.1',
        'DB_USER' => 'root',
        'DB_PWD'  => '123456',
        'WRITE_MASTER' => false, //读写分离
        'DB_PREFIX' => '',
        'DB_NAME' => '',
        'DB_PORT' => 3306
    ],
];