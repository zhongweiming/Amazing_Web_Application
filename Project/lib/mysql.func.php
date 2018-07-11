<?php
/**
 * 连接数据库
 * @return resource
 */
function connect()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PWD) or die("数据库连接失败Error:" . mysqli_errno($link) . ":" . mysqli_error($link));
    mysqli_set_charset($link, DB_CHARSET);
    mysqli_select_db($link, DB_DBNAME) or die("指定数据库打开失败");
    return $link;
}

/**
 * 完成记录插入的操作
 * @param string $table
 * @param array $array
 * @return number
 */
function insert($table, $array)
{
    $link = connect();
    $keys = join(",", array_keys($array));
    $values = "'" . join("','", array_values($array)) . "'";
    $sql = "insert {$table}($keys) values({$values})";
    mysqli_query($link, $sql);
    return mysqli_insert_id($link);
}

// update administrator set username='lukace' where id=1
/**
 * 记录的更新操作
 * @param string $table
 * @param array $array
 * @param string $where
 * @return number
 */
function update($table, $array, $where = null)
{
    $link = connect();
    foreach ($array as $key => $val) {
        if ($str == null) {
            $sep = "";
        } else {
            $sep = ",";
        }
        $str .= $sep . $key . "='" . $val . "'";
    }
    $sql = "update {$table} set {$str} " . ($where == null ? null : " where " . $where);
    $result = mysqli_query($link, $sql);
    if ($result) {
        return mysqli_affected_rows($link);
    } else {
        return 0;
    }
}

/**
 *    删除记录
 * @param string $table
 * @param string $where
 * @return number
 */
function delete($table, $where = null)
{
    $link = connect();
    $where = $where == null ? null : " where " . $where;
    $sql = "delete from {$table} {$where}";
    mysqli_query($link, $sql);
    return mysqli_affected_rows($link);
}

/**
 *得到指定一条记录
 * @param string $sql
 * @param string $result_type
 * @return multitype:
 */
function fetchOne($sql, $result_type = MYSQLI_ASSOC)
{
    $link = connect();
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result, $result_type);
    return $row;
}


/**
 * 得到结果集中所有记录 ...
 * @param string $sql
 * @param string $result_type
 * @return multitype:
 */
function fetchAll($sql, $result_type = MYSQLI_ASSOC)
{
    $link = connect();
    $result = mysqli_query($link, $sql);
    while (@$row = mysqli_fetch_array($result, $result_type)) {
        $rows[] = $row;
    }
    return $rows;
}

/**
 * 得到结果集中的记录条数
 * @param unknown_type $sql
 * @return number
 */
function getResultNum($sql)
{
    $link = connect();
    $result = mysqli_query($link, $sql);
    return mysqli_num_rows($result);
}

///**
// * 得到上一步插入记录的ID号
// * @return number
// */
//function getInsertId()
//{
//    $link = connect();
//    return mysqli_insert_id($link);
//}

