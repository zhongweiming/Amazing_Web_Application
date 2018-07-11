<?php 
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'lib/string.func.php';
require_once 'upload.func.php';
header("content-type:text/html;charset=utf-8");
$fileInfo=$_FILES['myFile'];
//echo $path;
print_r($fileInfo);
//echo exec('whoami');
//echo sys_get_temp_dir();
//$bashPath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "Project/Trade";
////echo $bashPath;
//$uploadPath = $bashPath . "/uploads";
//$imagePath = $bashPath . "/images";
//$uploadFiles = uploadFile($uploadPath);
//print_r($uploadFiles);
//if (is_array($uploadFiles) && $uploadFiles) {
//    foreach ($uploadFiles as $key => $uploadFile) {
//        thumb($uploadPath . DIRECTORY_SEPARATOR . $uploadFile['name'], $imagePath . "/image_50/" . $uploadFile['name'], 50, 50);
//        thumb($uploadPath . DIRECTORY_SEPARATOR . $uploadFile['name'], $imagePath . "/image_220/" . $uploadFile['name'], 220, 220);
//        thumb($uploadPath . DIRECTORY_SEPARATOR . $uploadFile['name'], $imagePath . "/image_350/" . $uploadFile['name'], 350, 350);
//        thumb($uploadPath . DIRECTORY_SEPARATOR . $uploadFile['name'], $imagePath . "/image_800/" . $uploadFile['name'], 800, 800);
//    }
//}