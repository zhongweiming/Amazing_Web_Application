<?php 
header("content-type:text/html;charset=utf-8");
date_default_timezone_set("PRC");
session_start();
// 设置 include_path
//define("FILE_ROOT",dirname(__FILE__)); // ROOT = "/var/www/html/Project/Trade/"
//set_include_path(get_include_path().PATH_SEPARATOR.FILE_ROOT.DIRECTORY_SEPARATOR."lib".PATH_SEPARATOR.FILE_ROOT.DIRECTORY_SEPARATOR."core".PATH_SEPARATOR.FILE_ROOT.DIRECTORY_SEPARATOR."configs");
//echo get_include_path();

require_once 'lib/image.func.php';
require_once 'lib/mysql.func.php';
require_once 'lib/common.func.php';
require_once 'lib/string.func.php';
require_once 'lib/page.func.php';
require_once 'lib/upload.func.php';
require_once 'configs/configs.php';
require_once 'core/admin.inc.php';
require_once 'core/cate.inc.php';
require_once 'core/pro.inc.php';
require_once 'core/album.inc.php';
require_once 'core/user.inc.php';
require_once 'configs/configs.php';
$link = connect();