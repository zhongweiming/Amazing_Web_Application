<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'include.php';
$link = connect();
echo mysqli_get_server_info($link);