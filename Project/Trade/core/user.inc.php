<?php
function reg()
{
    $arr = $_POST;
    $arr['password'] = md5($_POST['password']);
    $arr['regTime'] = time();
    $uploadFile = uploadFile();

    //print_r($uploadFile);
    if ($uploadFile && is_array($uploadFile)) {
        $arr['avatar'] = $uploadFile[0]['name'];
    } else {
        return "注册失败";
    }

    print_r($uploadFile);

    $projectPath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'Project/Trade';
    $uploadPath = $projectPath . '/uploads';

//	print_r($arr);exit;
    if (insert("user", $arr)) {
        $mes = "注册成功!<br/>3秒钟后跳转到登陆页面!<meta http-equiv='refresh' content='3;url=login.php'/>";
    } else {
        $filename = $uploadPath . $uploadFile[0]['name'];
        if (file_exists($filename)) {
            unlink($filename);
        }
        $mes = "注册失败!<br/><a href='reg.php'>重新注册</a>|<a href='index.php'>查看首页</a>";
    }
    return $mes;
}

function login($link)
{
    $username = $_POST['username'];
    //addslashes():使用反斜线引用特殊字符
//    $username=addslashes($username);
    $username = mysqli_real_escape_string($link, $username);
    $password = md5($_POST['password']);
    $sql = "select * from user where username='{$username}' and password='{$password}'";
    //$resNum=getResultNum($sql);
    $row = fetchOne($sql);
    //echo $resNum;
    if ($row) {
        $_SESSION['loginFlag'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $mes = "登陆成功！<br/>3秒钟后跳转到首页<meta http-equiv='refresh' content='3;url=index.php'/>";
    } else {
        $mes = "登陆失败！<a href='login.php'>重新登陆</a>";
    }
    return $mes;
}

function checkUserLogined()
{
    if ($_SESSION['username'] == "" && $_COOKIE['username'] == "") {
        alertMes("请先登陆", "login.php");
    }
}

function userOut()
{
    $_SESSION = array();
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), "", time() - 1);
    }

    session_destroy();
    header("location:index.php");
}

//function addCart() {
//    $username = $_SESSION['username'];
//    $sql = "select id from user where username='{$username}'";
//    $userId = fetchOne($sql);
//    print_r($userId);
//
//    $productId = $_POST['productId'];
//    $sql = "select internetPrice from product where id='{$productId}'";
//    $productPrice = fetchOne($sql);
//    print_r($productId);
//
//}

//加入购物车 $goods_id, $goods_num
function addCart($productId)
{
    echo $productId;

    $mes = "haha";
    return $mes;
//
//    $username = $_SESSION['username'];
//    $sql = "select id from user where username=''";
//    $cur_cart_array = unserialize(stripslashes($_COOKIE['shop_cart_info']));
//    if ($cur_cart_array == "") {
//
//        $cart_info[0][] = $goods_id;
//        $cart_info[0][] = $goods_num;
//
//        setcookie("shop_cart_info", serialize($cart_info));
//
//    } elseif ($cur_cart_array <> "") {
//
//        //返回数组键名倒序取最大
//        $ar_keys = array_keys($cur_cart_array);
//        rsort($ar_keys);
//        $max_array_keyid = $ar_keys[0] + 1;
//
//        //遍历当前的购物车数组
//        //遍历每个商品信息数组的0值，如果键值为0且货号相同则购物车存在相同货品
//        foreach ($cur_cart_array as $goods_current_cart) {
//            foreach ($goods_current_cart as $key => $goods_current_id){
//                if ($key == 0 and $goods_current_id == $goods_id) {
//                    alertMes("已存在相同的物品", "../proDetails.php");
//                    exit();
//                }
//            }
//   }
//
//        $cur_cart_array[$max_array_keyid][] = $goods_id;
//        $cur_cart_array[$max_array_keyid][] = $goods_num;
//
//        setcookie("shop_cart_info", serialize($cur_cart_array));
//
//    }

}

//从购物车删除
function delCart($goods_array_id)
{

    $cur_goods_array = unserialize(stripslashes($_COOKIE['shop_cart_info']));

//删除该商品在数组中的位置
    unset($cur_goods_array[$goods_array_id]);
    setcookie("shop_cart_info", serialize($cur_goods_array));

}

//修改购物车货品数量
function update_cart($up_id, $up_num, $goods_ids)
{

    //先清空cookie,以便重新设置，传递过来三个数组参数 1数组的标识 2商品数量数组 3商品编号数组
    //如果不清空cookie则无法处理数量为零的商品
    setcookie("shop_cart_info", "");
    foreach ($up_id as $song) {

        //先返回数组当前单元；再把指针向下移动一个位置
        $goods_nums = current($up_num);
        $goods_id = current($goods_ids);
        next($up_num);
        next($goods_ids);

        //当商品数量为空的时候，注销此处的数组值并用continue 2 语句避开下面的操作，继续做foreach循环
        while ($goods_nums == 0) {
            unset($song);
            continue 2;
        }

        $cur_goods_array[$song][0] = $goods_id;
        $cur_goods_array[$song][1] = $goods_nums;

    }

    setcookie("shop_cart_info", serialize($cur_goods_array));
}


