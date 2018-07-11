<?php 
/**
 * 生成验证码
 * @param int $type
 * @param int $length
 * @return string
 */
function buildRandomString($type = 1, $length = 4) {
    if ($type == 1) {
        $chars = join("", range(0, 9)); // 生成纯数字的验证码
    } elseif ($type == 2) {
        $chars = join("", array_merge(range("a", "z"), range("A", "Z"))); // 生成纯字母的验证码
    } elseif ($type == 3) {
        // 生成一个字母数字混合的验证码
        $chars = join("", array_merge(range("a", "z"), range("A", "Z"), range(0, 9)));
    }

    if ($length > strlen($chars)) {
        exit("验证码长度不够");
    }

    // 打乱验证码
    $chars = str_shuffle($chars);
    return substr($chars, 0, $length);
}
/**
 * 生成唯一字符串
 * @return string
 */
function getUniName() {
	return md5(uniqid(microtime(true), true));
}

/**
 * 得到文件的扩展名
 * @param string $filename
 * @return string
 */
function getExt($filename) {
	return strtolower(end(explode(".", $filename)));
}