<?php
/**
 * Created by PhpStorm.
 * User: lukace
 * Date: 18-7-7
 * Time: 上午1:16
 */
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'include.php';
//$sql = "select * from administrator";
//$totalRows = getResultNum($sql);
////echo $totalRows;
//$pageSize = 2;
//// 得到总页码数
//$totalPage = ceil($totalRows / $pageSize);
////echo $totalPage;
//$page = $_REQUEST['page'] ? (int)$_REQUEST['page'] : 1;
//if ($page < 1 || $page == null || !is_numeric($page)) {
//    $page = 1;
//} elseif ($page >= $totalPage) {
//    $page = $totalPage;
//}
//$offset = ($page - 1) * $pageSize;
//$sql = "select * from administrator limit {$offset},{$pageSize}";
//$rows = fetchAll($sql);
////print_r($rows);
//foreach ($rows as $row) {
//    echo "编号: " . $row['id'] . "<br/>";
//    echo "管理员名称: " . $row['username'] . "<hr/>";
//}
//$url = $_SERVER['PHP_SELF'];
//$index = ($page == 1) ? "首页" : "<a href='{$url}?page=1'>首页</a>";
//$last = ($page == $totalPage) ? "尾页" : "<a href='{$url}?page={$totalPage}'>尾页</a>";
//$prev = ($page == 1) ? "上一页" : "<a href='{$url}?page=" . ($page - 1) . "'>上一页</a>";
//$next = ($page == $totalPage) ? "下一页" : "<a href='{$url}?page=" . ($page + 1) . "'>下一页</a>";
//$str = "总共{$totalPage}页/当前是第{$page}页";
//for ($i = 1; $i <= $totalPage; $i++) {
//    if ($page == $i) {
//        $p .= "[{$i}]";
//    } else {
//        $p .= "<a href='{$url}?page={$i}'>[{$i}]</a>";
//    }
//}
//echo showPage($page, $totalPage);
//echo "<hr/>";
//echo $str."<br/>".$index.$prev.$p.$next.$last;
$bashPath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "Project/Trade";
//echo $bashPath;
$uploadPath = $bashPath . "/uploads";
$imagePath = $bashPath . "/images";
$uploadFiles = uploadFile($uploadPath);
print_r($uploadFiles);
if (is_array($uploadFiles) && $uploadFiles) {
    foreach ($uploadFiles as $key => $uploadFile) {
        thumb($uploadPath . DIRECTORY_SEPARATOR . $uploadFile['name'], $imagePath . "/image_50/" . $uploadFile['name'], 50, 50);
        thumb($uploadPath . DIRECTORY_SEPARATOR . $uploadFile['name'], $imagePath . "/image_220/" . $uploadFile['name'], 220, 220);
        thumb($uploadPath . DIRECTORY_SEPARATOR . $uploadFile['name'], $imagePath . "/image_350/" . $uploadFile['name'], 350, 350);
        thumb($uploadPath . DIRECTORY_SEPARATOR . $uploadFile['name'], $imagePath . "/image_800/" . $uploadFile['name'], 800, 800);
    }
}
