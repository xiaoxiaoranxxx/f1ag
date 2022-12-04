<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=1', '1', '1');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->prepare("insert into log (src_ip,addr,method,src_url,cos_url,payload,useragent,referer,date) values (:src_ip,:addr,:method,:src_url,:cos_url,:payload,:useragent,:referer,now())");
$stmt->bindParam(':src_ip', $a1);
$stmt->bindParam(':addr', $a2);
$stmt->bindParam(':method', $a3);
$stmt->bindParam(':src_url', $a4);
$stmt->bindParam(':cos_url', $a5);
$stmt->bindParam(':payload', $a6);
$stmt->bindParam(':useragent', $a7);
$stmt->bindParam(':referer', $a8);


$a1 = $_SERVER["REMOTE_ADDR"];

if ($a1 == "127.0.0.1") {
    $a2 = "本机地址";
} elseif (preg_match('/^(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:[.](?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}$/', $a1)) {
    $data = file_get_contents('https://whois.pconline.com.cn/ipJson.jsp?ip=' . $a1 . '&json=true');
    $ipobj = json_decode(iconv("gb2312", "UTF-8", $data));
    $a2 = $ipobj->addr;
} else {
    $a2 =  $a1 . "错误";
}

$a3 = $_SERVER['REQUEST_METHOD'];
$a4 = 'https://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER["SERVER_PORT"] . urldecode($_SERVER["REQUEST_URI"]);

$i = mt_rand(0, 7572);
$a5 = md5($i . "*")  . ".jpg";
$url = "https://xiuxiu-1306082599.cos.ap-beijing.myqcloud.com/images/num/" . $a5;


$a6 = @urldecode(file_get_contents('php://input'));
$a7 = $_SERVER['HTTP_USER_AGENT'];
$a8 = @$_SERVER['HTTP_REFERER'];

$stmt->execute();


$waf = "/(flag|base|cmd|shell|eval|system|\.\.\/|\$_|proc_|socket_|posix_|stream_|assert|phpinfo|exec|preg_|file_|passt|preg_r|show_|call_user)/i";
$result_get = preg_match_all($waf, urldecode($a4));
$result_post = preg_match_all($waf, urldecode($a6));
if ($result_get + $result_post != 0) {
    die(0);
}

?>
