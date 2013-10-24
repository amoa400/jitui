<?php
// 加密字符串
function encrypt($s) {
	return md5(sha1($s));
}
	
// 获取时间
function getTime() {
	return time();
}

// 转换成时间
function intToTime($time, $type = '') {
	if (empty($type)) $type = 'Y-m-d H:i:s';
	return date($type, $time);
}

// 转换成使用时间
function intToUseTime($time) {
	$time_t = $time;
	
	$day = (int)($time_t / 86400);
	$time_t -= $day * 86400;

	$hour = (int)($time_t / 3600);
	$time_t -= $hour * 3600;
	
	$minute = (int)($time_t / 60);
	$time_t -= $minute * 60;
	
	$second = $time_t;
	
	$s = '';
	if (!empty($day)) $s .= $day . '天';
	if (!empty($day) || !empty($hour)) $s .= $hour . '小时';
	if (!empty($day) || !empty($hour) || !empty($minute)) $s .= $minute . '分';
	if (!empty($day) || !empty($hour) || !empty($minute) || !empty($second)) $s .= $second . '秒';
	
	return $s;
}

// 转换成时间
function timeToInt($time) {
	return strtotime($time);
}

// 前台过滤
function html( $s ) {
	return htmlspecialchars( $s );
}
	
// 获取日期
function getCntDate() {
	return date('Y-m-d', getTime());
}
	
// 元素是否在集合里
function isIn( $data, $arr ) {
	foreach( $arr as $a ) {
		if ( $data == $a ) return true;
	}
	return false;
}
	
// 检车变量是否是日期
function isDate($date, $format) {
	$unixTime = strtotime($date);
	$checkDate = date($format, $unixTime);
	if($checkDate == $date)
		return $date;
	else
		return 0;
}

// 将br转换成\n
function br2nl($text) {    
    return preg_replace('/<br\\s*?\/??>/i', '', $text);   
}

// 递归创建目录
function recursiveMkdir($path, $mode = 0775){
	if (!file_exists($path)) {
		recursiveMkdir(dirname($path), $mode);
		mkdir($path, $mode);
	}
}

// 是否登录
function isLogin($role = 0, $redirect = true) {
	if (empty($_SESSION['login']) || ($role != 0 && $_SESSION['role'] != $role)) {
		if ($redirect) redirect(U('/index/index'));
		return false;
	}
	return true;
}

// 截取字符串
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true) {
    if(function_exists("mb_substr")){
            if ($suffix && strlen($str)>$length)
                return mb_substr($str, $start, $length, $charset)."...";
        else
                 return mb_substr($str, $start, $length, $charset);
    }
    elseif(function_exists('iconv_substr')) {
            if ($suffix && strlen($str)>$length)
                return iconv_substr($str,$start,$length,$charset)."...";
        else
                return iconv_substr($str,$start,$length,$charset);
    }
    $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("",array_slice($match[0], $start, $length));
    if($suffix) return $slice."…";
    return $slice;
}

// 是否为电子邮箱
function validEmail($email){
	$isValid = true;
	$atIndex = strrpos($email, "@");
	if (is_bool($atIndex) && !$atIndex){
		$isValid = false;
	}else{
		$domain = substr($email, $atIndex+1);
		$local = substr($email, 0, $atIndex);
		$localLen = strlen($local);
		$domainLen = strlen($domain);
		if ($localLen < 1 || $localLen > 64){
			// local part length exceeded
			$isValid = false;
		}else if ($domainLen < 1 || $domainLen > 255){
			// domain part length exceeded
			$isValid = false;
		}else if ($local[0] == '.' || $local[$localLen-1] == '.'){
			// local part starts or ends with '.'
			$isValid = false;
		}else if (preg_match('/\\.\\./', $local)){
			// local part has two consecutive dots
			$isValid = false;
		}else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain)){
			// character not valid in domain part
			$isValid = false;
		}else if (preg_match('/\\.\\./', $domain)){
			// domain part has two consecutive dots
			$isValid = false;
		}else if(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',str_replace("\\\\","",$local))){
			// character not valid in local part unless 
			// local part is quoted
			if (!preg_match('/^"(\\\\"|[^"])+"$/',str_replace("\\\\","",$local))){
				$isValid = false;
			}
		}
		if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A"))){
			// domain not found in DNS
			$isValid = false;
		}
	}
	return $isValid;
}

// 生成随机字符
function randomChar($len = 10, $head = '') {
	$s = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	$ret = '';
	for ($i = 0; $i < $len; $i++) $ret .= $s[rand()%strlen($s)];
	return $head . $ret;
}