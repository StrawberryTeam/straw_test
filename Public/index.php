<?php
//根据环境读取配置文件
const APP_ENV = 'DEVELOPMENT'; //开发环境配置
//const APP_ENV = 'PRODUCTION'; //生产环境配置

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', realpath(dirname(__FILE__) . DS . '..' . DS) . DS);
//fastcgi.conf  open_basedir remove on nginx conf
require_once(ROOT_PATH . 'Strawframework' . DS . 'Common' . DS . 'Main.php');

//Run
Strawframework\Common\Main::getInstance()->setEnv(APP_ENV)->configure()->run();