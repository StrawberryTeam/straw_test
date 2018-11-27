<?php
/**
 * 缓存配置
 *  saveSrc     日志存放路径
 *  formatter   日志格式
 *      ====>JsonFormatter
 *      ====>LineFormatter
 *
 * cycle        记录周期
 *      ====>single     将日志记录到单个文件中。该日志处理器对应Monolog的StreamHandler
 *      ====>daily      以日期为单位将日志进行归档，每天创建一个新的日志文件记录日志。该日志处理器 对应Monolog的RotatingFileHandler
 *      ====>weekly     每周
 *      ====>monthly    每月
 *      ====>annually   每年
 *
 *  address     邮箱
 *  password    邮箱密码
 *
 */
return [
    'type'=>[
        'FILE'=>[
            'saveSrc'=>LOGS_PATH,
            'formatter'=>'LineFormatter',
            'cycle'=>'single'
        ],
        'EMAIL'=>[
            'address'=>'abc@def.com',
            'password'=>'123456',
            'formatter'=>'LineFormatter',
        ]
    ],
    'level' => [
        'INFO' => 'FILE',       //关键事件
        'WARNING' => 'EMAIL',    //出现非错误的异常
//        'NOTICE' => 'EMAIL',     //普通但是重要的事件
//        'ERROR' => 'EMAIL',      //运行时错误，但是不需要立刻处理
//        'DEBUG' => 'FILE',      //详细的debug信息
//        'CRITICA' => 'FILE',    //严重错误
//        'EMERGENCY' => 'FILE'   //系统不可用
    ],
];