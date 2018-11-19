<?php
declare(strict_types=1);

//php7+ nginx conf: {fastcgi.conf} remove line {open_basedir...}

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', realpath(dirname(__FILE__) . DS . '..' . DS) . DS);
require_once(ROOT_PATH . 'Strawframework' . DS . 'Common' . DS . 'Main.php');

//Run
Strawframework\Common\Main::getInstance()->getEnv()->configure('Straw')->run();