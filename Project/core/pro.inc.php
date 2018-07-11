<?php
/**
 * 添加商品
 * @return string
 */
function addPro()
{
    $arr = $_POST;
    $arr['publishTime'] = time();
    $projectPath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'Project/Trade';
    $uploadPath = $projectPath . '/uploads';
//    $path = "uploads";
    $uploadFiles = uploadFile($uploadPath);
    if (is_array($uploadFiles) && $uploadFiles) {

//        print_r($uploadFiles);
        // 生成缩略图
//        foreach ($uploadFiles as $uploadFile) {
//            thumb($uploadPath . DIRECTORY_SEPARATOR . $uploadFile['name'], $uploadPath . "/image_50" , $uploadFile['name'], 50, 50);
//            thumb($uploadPath . DIRECTORY_SEPARATOR . $uploadFile['name'], $uploadPath . "/image_220" , $uploadFile['name'], 220, 220);
//            thumb($uploadPath . DIRECTORY_SEPARATOR . $uploadFile['name'], $uploadPath . "/image_350" , $uploadFile['name'], 350, 350);
//            thumb($uploadPath . DIRECTORY_SEPARATOR . $uploadFile['name'], $uploadPath . "/image_800" , $uploadFile['name'], 800, 800);
//        }

        $pid = insert("product", $arr);
//        $pid = getInsertId();

//        print_r($pid);
//        print_r($pid);

        if ($pid) {
            foreach ($uploadFiles as $uploadFile) {
                $arr1['pid'] = $pid;
                $arr1['albumPath'] = $uploadFile['name'];
                insert("album", $arr1);
            }
            $mes = "<p>添加成功!</p><a href='addPro.php' target='mainFrame'>继续添加</a>|<a href='listPro.php' target='mainFrame'>查看商品列表</a>";
        } else {
            foreach ($uploadFiles as $uploadFile) {
                if (file_exists($uploadPath . "/image_50/" . $uploadFile['name'])) {
                    unlink($uploadPath . "/image_50/" . $uploadFile['name']);
                }
                if (file_exists($uploadPath . "/image_220/" . $uploadFile['name'])) {
                    unlink($uploadPath . "/image_220/" . $uploadFile['name']);
                }
                if (file_exists($uploadPath . "/image_350/" . $uploadFile['name'])) {
                    unlink($uploadPath . "/image_350/" . $uploadFile['name']);
                }
                if (file_exists($uploadPath . "/image_800/" . $uploadFile['name'])) {
                    unlink($uploadPath . "/image_800/" . $uploadFile['name']);
                }
            }
            $mes = "<p>添加失败!</p><a href='addPro.php' target='mainFrame'>重新添加</a>";
        }
    } else {
        $mes = "没有上传图片";
    }

    return $mes;
}

/**
 *编辑商品
 * @param int $id
 * @return string
 */
function editPro($id)
{
    $arr = $_POST;
    print_r($arr);
//    $path = "uploads";
    $projectPath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'Project/Trade';
    $uploadPath = $projectPath . '/uploads';
    $uploadFiles = uploadFile($uploadPath);

    // 更新产品表
    $where = "id={$id}";
    $res = update("product", $arr, $where);
    $pid = $id;
    if ($res >= 0 && $pid) {
        // 更新图片
        if (is_array($uploadFiles) && $uploadFiles) {
//            foreach ($uploadFiles as $key => $uploadFile) {
//                thumb($uploadPath . DIRECTORY_SEPARATOR . $uploadFile['name'], $uploadPath . "/image_50/" . $uploadFile['name'], 50, 50);
//                thumb($uploadPath . DIRECTORY_SEPARATOR . $uploadFile['name'], $uploadPath . "/image_220/" . $uploadFile['name'], 220, 220);
//                thumb($uploadPath . DIRECTORY_SEPARATOR . $uploadFile['name'], $uploadPath . "/image_350/" . $uploadFile['name'], 350, 350);
//                thumb($uploadPath . DIRECTORY_SEPARATOR . $uploadFile['name'], $uploadPath . "/image_800/" . $uploadFile['name'], 800, 800);
//            }
            foreach ($uploadFiles as $uploadFile) {
                $arr1['pid'] = $pid;
                $arr1['albumPath'] = $uploadFile['name'];
                update("album", $arr1, $where);
            }

        }

        $mes = "<p>编辑成功!</p><a href='listPro.php' target='mainFrame'>查看商品列表</a>";
    } elseif ($res == 0) {
    } else {
        foreach ($uploadFiles as $uploadFile) {
            if (file_exists($uploadPath . "/image_800/" . $uploadFile['name'])) {
                unlink($uploadPath . "/image_800/" . $uploadFile['name']);
            }
            if (file_exists($uploadPath . "/image_50/" . $uploadFile['name'])) {
                unlink($uploadPath . "/image_50/" . $uploadFile['name']);
            }
            if (file_exists($uploadPath . "/image_220/" . $uploadFile['name'])) {
                unlink($uploadPath . "/image_220/" . $uploadFile['name']);
            }
            if (file_exists($uploadPath . "/image_350/" . $uploadFile['name'])) {
                unlink($uploadPath . "/image_350/" . $uploadFile['name']);
            }
        }

        $mes = "<p>编辑失败!</p><a href='listPro.php' target='mainFrame'>重新编辑</a>";

    }

    return $mes;
}

function delPro($id)
{
    $where = "id={$id}";
    $res = delete("product", $where);
    $projectPath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'Project/Trade';
    $uploadPath = $projectPath . '/uploads';
    $proImgs = getAllImgByProId($id);
    if ($proImgs && is_array($proImgs)) {
        foreach ($proImgs as $proImg) {
            if (file_exists($uploadPath . DIRECTORY_SEPARATOR . $proImg['albumPath'])) {
                unlink($uploadPath . DIRECTORY_SEPARATOR . $proImg['albumPath']);
            }
            if (file_exists($uploadPath . "/image_50/" . $proImg['albumPath'])) {
                unlink($uploadPath . "/image_50/" . $proImg['albumPath']);
            }
            if (file_exists($uploadPath . "/image_220/" . $proImg['albumPath'])) {
                unlink($uploadPath . "/image_220/" . $proImg['albumPath']);
            }
            if (file_exists($uploadPath . "/image_350/" . $proImg['albumPath'])) {
                unlink($uploadPath . "/image_350/" . $proImg['albumPath']);
            }
            if (file_exists($uploadPath . "/image_800/" . $proImg['albumPath'])) {
                unlink($uploadPath . "/image_800/" . $proImg['albumPath']);
            }

        }
    }
    $where1 = "pid={$id}";
    $res1 = delete("album", $where1);
    if ($res && $res1) {
        $mes = "删除成功!<br/><a href='listPro.php' target='mainFrame'>查看商品列表</a>";
    } else {
        $mes = "删除失败!<br/><a href='listPro.php' target='mainFrame'>重新删除</a>";
    }
    return $mes;
}


/**
 * 得到商品的所有信息
 * @return array
 */
function getAllProByAdmin()
{
    $sql = "select p.id,p.pName,p.pStyleID,p.pNum,p.marketPrice,p.internetPrice,p.pDesc,p.publishTime,p.isShow,p.isHot,c.cName from product as p join cate c on p.cId=c.id";
    $rows = fetchAll($sql);
    return $rows;
}

/**
 *根据商品id得到商品图片
 * @param int $id
 * @return array
 */
function getAllImgByProId($id)
{
    $sql = "select a.albumPath from album a where pid={$id}";
    $rows = fetchAll($sql);
    return $rows;
}

/**
 * 根据id得到商品的详细信息
 * @param int $id
 * @return array
 */
function getProById($id)
{
    $sql = "select p.id,p.pName,p.pStyleID,p.pNum,p.marketPrice,p.internetPrice,p.pDesc,p.publishTime,p.isShow,p.isHot,c.cName,p.cId from product as p join cate c on p.cId=c.id where p.id={$id}";
    $row = fetchOne($sql);
    return $row;
}

/**
 * 检查分类下是否有产品
 * @param int $cid
 * @return array
 */
function checkProExist($cid)
{
    $sql = "select * from product where cId={$cid}";
    $rows = fetchAll($sql);
    return $rows;
}

/**
 * 得到所有商品
 * @return array
 */
function getAllPros()
{
    $sql = "select p.id,p.pName,p.pStyleID,p.pNum,p.marketPrice,p.internetPrice,p.pDesc,p.publishTime,p.isShow,p.isHot,c.cName,p.cId from product as p join cate c on p.cId=c.id ";
    $rows = fetchAll($sql);
    return $rows;
}

/**
 *根据cid得到4条产品
 * @param int $cid
 * @return Array
 */
function getProsByCid($cid)
{
    $sql = "select p.id,p.pName,p.pStyleID,p.pNum,p.marketPrice,p.internetPrice,p.pDesc,p.publishTime,p.isShow,p.isHot,c.cName,p.cId from product as p join cate c on p.cId=c.id where p.cId={$cid} limit 4";
    $rows = fetchAll($sql);
    return $rows;
}

/**
 * 得到下4条产品
 * @param int $cid
 * @return array
 */
function getSmallProsByCid($cid)
{
    $sql = "select p.id,p.pName,p.pStyleID,p.pNum,p.marketPrice,p.internetPrice,p.pDesc,p.publishTime,p.isShow,p.isHot,c.cName,p.cId from product as p join cate c on p.cId=c.id where p.cId={$cid} limit 4,4";
    $rows = fetchAll($sql);
    return $rows;
}

/**
 *得到商品ID和商品名称
 * @return array
 */
function getProInfo()
{
    $sql = "select id,pName from product order by id asc";
    $rows = fetchAll($sql);
    return $rows;
}
