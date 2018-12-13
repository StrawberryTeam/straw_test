<?php
/**
 * 缓存配置
 *  saveSrc     日志存放路径
 *  formatter   日志格式
 *      ====> Html
 *      ====> Json
 *      ====> Line
 *      ====> Loggly
 *      ====> Logstash
 *      ====> Mongodb
 *      ====> Elastica
 *      ====> Flow
 *
 */
return [
    'file'    => [
        'type'      => 'file',
        'saveSrc'   => LOGS_PATH,
        'srcFormat' => 'Y-m/d', // 文件名格式 / 为文件夹 Y-m/d = 2018-02/20  20 is file
        'fileName'  => '', //自定义文件名称 留空则使用 srcFormat 作为文件名, 'file.log' => 2018-02/20file.log, 设置 srcFormat = 'Y-m/d/' => 2018-02/20/file.log
        'formatter' => 'Line',
        'maxFiles'  => '30', //最大存储文件数
    ],
    'email'   => [
        'type'       => 'email',
        'subject'    => sprintf('[%s Error] An error has Occurred! ', \Strawframework\Straw::$config['site_name']), //邮件标题
        'receiver'   => '', //接收者
        'sender'     => '',
        'senderName' => sprintf('%s Alarm', \Strawframework\Straw::$config['site_name']),
        'smtpHost'   => 'smtp.exmail.qq.com',
        'smtpPort'   => 25,
        'password'   => '', //发件人邮箱
        'formatter'  => 'Line',
    ],
    'mongodb' => [
        'type'           => 'mongodb',
        'dbName'         => \Strawframework\Straw::$config['databases']['mongo']['DB_NAME'], //数据库名
        'collectionName' => 'logs', //表名
        'mongoConnect'   => 'mongodb://127.0.0.1:27017/', //连接 mongodb mongodb://username:password@hostname:port
    ],
    //es
    'elastic' => [
        'type'   => 'elastic',
        'host'   => 'http://127.0.0.1:9200', //es host
        'index'  => 'log', //name
    ],
];