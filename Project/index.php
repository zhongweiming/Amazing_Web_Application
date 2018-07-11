<?php
require_once 'include.php';
$cates = getAllcate();
if (!($cates && is_array($cates))) {
    alertMes("不好意思, 网站维护中!!!", "https://www.baidu.com");
}

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>首页</title>
    <link type="text/css" rel="stylesheet" href="styles/reset.css">
    <link type="text/css" rel="stylesheet" href="styles/main.css">
    <!--[if IE 6]>
    <script type="text/javascript" src="js/DD_belatedPNG_0.0.8a-min.js"></script>
    <script type="text/javascript" src="js/ie6Fixpng.js"></script>
    <![endif]-->
</head>
<body>
<div class="headerBar">
    <div class="topBar">
        <div class="comWidth">
            <div class="leftArea">
                <a href="#" class="collection">收藏本站</a>
            </div>
            <div class="rightArea">
                <?php if ($_SESSION['loginFlag']): ?>
                    <span>欢迎您</span><?php echo $_SESSION['username']; ?>
                    <a href="doAction.php?act=userOut">[退出]</a>
                <?php else: ?>
                    <a href="login.php">[登录]</a><a href="reg.php">[免费注册]</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="logoBar">
        <div class="comWidth">
            <div class="logo fl">
                <a href="index.php"><img src="images/logo.png" alt="乐易"></a>
            </div>
            <div class="search_box fl">
                <input type="text" class="search_text fl">
                <input type="button" value="搜 索" class="search_btn fr">
            </div>
            <div class="shopCar fr">
                <a href="shoppingCart.php" class="shopText fl">购物车</a>
                <span class="shopNum fl">0</span>
            </div>
        </div>
    </div>
    <div class="navBox">
        <div class="comWidth clearfix">
            <div class="shopClass fl">
                <h3>全部商品分类<i class="shopClass_icon"></i></h3>
                <div class="shopClass_show">
                    <dl class="shopClass_item">
                        <dt><a href="#" class="b">软件学院</a> </dt>
                        <dd><a href="#">考研</a> <a href="#">教材</a> <a href="#">扩展</a></dd>
                    </dl>
                    <dl class="shopClass_item">
                        <dt><a href="#" class="b">通信工程学院</a> </dt>
                        <dd><a href="#">考研</a> <a href="#">教材</a> <a href="#">扩展</a></dd>
                    </dl>
                    <dl class="shopClass_item">
                        <dt><a href="#" class="b">微电子学院</a> </dt>
                        <dd><a href="#">考研</a> <a href="#">教材</a> <a href="#">扩展</a></dd>
                    </dl>
                    <dl class="shopClass_item">
                        <dt><a href="#" class="b">电子工程学院</a> </dt>
                        <dd><a href="#">考研</a> <a href="#">教材</a> <a href="#">扩展</a></dd>
                    </dl>
                    <dl class="shopClass_item">
                        <dt><a href="#" class="b">经济与管理学院</a> </dt>
                        <dd><a href="#">考研</a> <a href="#">教材</a> <a href="#">扩展</a></dd>
                    </dl>
                </div>

                <div class="shopClass_list hide">
                    <div class="shopClass_cont">
                        <dl class="shopList_item">
                            <dt>电脑装机</dt>
                            <dd>
                                <a href="#">文字啊</a><a href="#">文字字啊</a><a href="#">文字字字啊</a><a href="#">文字啊</a><a
                                        href="#">文字</a><a href="#">文字啊</a>
                            </dd>
                        </dl>
                        <dl class="shopList_item">
                            <dt>电脑装机</dt>
                            <dd>
                                <a href="#">文字啊</a><a href="#">文字字啊</a><a href="#">文字字字啊</a><a href="#">文字啊</a><a
                                        href="#">文字</a><a href="#">文字啊</a><a href="#">文字啊</a><a href="#">文字字啊</a><a
                                        href="#">文字字字啊</a><a href="#">文字啊</a><a href="#">文字</a><a href="#">文字啊</a><a
                                        href="#">文字啊</a>
                            </dd>
                        </dl>
                        <dl class="shopList_item">
                            <dt>电脑装机</dt>
                            <dd>
                                <a href="#">文字啊</a><a href="#">文字字啊</a><a href="#">文字字字啊</a><a href="#">文字啊</a><a
                                        href="#">文字</a><a href="#">文字啊</a><a href="#">文字啊</a><a href="#">文字字啊</a><a
                                        href="#">文字字字啊</a><a href="#">文字啊</a><a href="#">文字</a><a href="#">文字啊</a><a
                                        href="#">文字啊</a>
                            </dd>
                        </dl>
                        <dl class="shopList_item">
                            <dt>电脑装机</dt>
                            <dd>
                                <a href="#">文字啊</a><a href="#">文字字啊</a><a href="#">文字字字啊</a><a href="#">文字啊</a><a
                                        href="#">文字</a><a href="#">文字啊</a><a href="#">文字啊</a><a href="#">文字字啊</a><a
                                        href="#">文字字字啊</a><a href="#">文字啊</a><a href="#">文字</a><a href="#">文字啊</a><a
                                        href="#">文字啊</a>
                            </dd>
                        </dl>
                        <dl class="shopList_item">
                            <dt>电脑装机</dt>
                            <dd>
                                <a href="#">文字啊</a><a href="#">文字字啊</a><a href="#">文字字字啊</a><a href="#">文字啊</a><a
                                        href="#">文字</a><a href="#">文字啊</a><a href="#">文字啊</a><a href="#">文字字啊</a><a
                                        href="#">文字字字啊</a><a href="#">文字啊</a><a href="#">文字</a><a href="#">文字啊</a><a
                                        href="#">文字啊</a>
                            </dd>
                        </dl>
                        <div class="shopList_links">
                            <a href="#">文字测试内容等等<span></span></a><a href="#">文字容等等<span></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="nav fl">
                <li><a href="#" class="active">学习资料</a></li>
                <li><a href="#">健身器材</a></li>
                <li><a href="#">女生专用</a></li>
                <li><a href="#">户外</a></li>
                <li><a href="#">电子设备</a></li>
                <li><a href="#">全部商品</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="banner comWidth clearfix">
    <div class="banner_bar banner_big">
        <ul class="imgBox">
            <li><a href="#"><img src="images/banner/1.jpg" alt="banner"></a></li>
            <li><a href="#"><img src="images/banner/banner_02.jpg" alt="banner"></a></li>
        </ul>
        <div class="imgNum">
            <a href="#" class="active"></a><a href="#"></a><a href="#"></a><a href="#"></a>
        </div>
    </div>
</div>
<?php foreach ($cates as $cate): ?>
    <div class="shopTit comWidth">
        <span class="icon"></span>
        <h3><?php echo $cate['cName']; ?></h3>
        <a href="#" class="more">更多&gt;&gt;</a>
    </div>
    <div class="shopList comWidth clearfix">
        <div class="leftArea">
            <div class="banner_bar banner_sm">
                <ul class="imgBox">
                    <li><a href="#"><img src="images/banner/banner_sm_01.jpg" alt="banner"></a></li>
                    <li><a href="#"><img src="images/banner/banner_sm_02.jpg" alt="banner"></a></li>
                </ul>
                <div class="imgNum">
                    <a href="#" class="active"></a><a href="#"></a><a href="#"></a><a href="#"></a>
                </div>
            </div>
        </div>
        <div class="rightArea">
            <div class="shopList_top clearfix">
                <?php
                $pros = getProsByCid($cate['id']);
                if ($pros && is_array($pros)):
                    foreach ($pros as $pro):
                        $proImg = getProImgById($pro['id']);
                        ?>
                        <div class="shop_item">
                            <div class="shop_img">
                                <a href="proDetails.php?id=<?php echo $pro['id']; ?>" target="_blank"><img height="200"
                                                                                                           width="187"
                                                                                                           src="uploads/<?php echo $proImg['albumPath']; ?>"
                                                                                                           alt=""></a>
                            </div>
                            <h6><?php echo $pro['pName']; ?></h6>
                            <p><?php echo $pro['internetPrice']; ?>元</p>
                        </div>
                    <?php
                    endforeach;
                endif;
                ?>

            </div>
            <div class="shopList_sm clearfix">
                <?php
                $prosSmall = getSmallProsByCid($cate['id']);
                if ($prosSmall && is_array($prosSmall)):
                    foreach ($prosSmall as $proSmall):
                        $proSmallImg = getProImgById($proSmall['id']);
                        ?>
                        <div class="shopItem_sm">
                            <div class="shopItem_smImg">
                                <a href="proDetails.php?id=<?php echo $proSmall['id']; ?>" target="_blank"><img
                                            width="95" height="95"
                                            src="image_220/<?php echo $proSmallImg['albumPath']; ?>" alt=""></a>
                            </div>
                            <div class="shopItem_text">
                                <p><?php echo $proSmall['pName']; ?></p>
                                <h3>￥<?php echo $proSmall['internetPrice']; ?>    </h3>
                            </div>
                        </div>
                    <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<div class="hr_25"></div>
</body>
</html>
