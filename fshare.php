<?php
/////////////////////////////////////
// NAME : MAI VĂN LINH             //
// PHONE : 089.9923.084            //
// EMAIL : linhghostteam@gmail.com //
/////////////////////////////////////
error_reporting(0);
function CURL_FSHARE($url, $data = ''){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    if ($data){ curl_setopt($ch, CURLOPT_POST ,1); curl_setopt($ch, CURLOPT_POSTFIELDS, $data); }
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, "User-Agent=Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 6);
    $result = curl_exec($ch);
    curl_close ($ch);
    return $result;

}
$url = $_GET['url'];
preg_match('#<meta name="csrf-token" content="(.*?)">#',CURL_FSHARE($url),$dt);
preg_match('#<input type="hidden" name="linkcode" value="(.*?)">#',CURL_FSHARE($url),$lc);
$exp = explode('/', $url);
$json = CURL_FSHARE('https://www.fshare.vn/download/get', '_csrf-app='.urlencode($dt[1]).'&linkcode='.$lc[1].'&withFcode5=0&fcode=');
echo 'Tên File :'.json_decode($json, true)['name'].'<br />'.'Link Tải :'.'<a href="'.json_decode($json, true)['url'].'">'.json_decode($json, true)['url'].'</a>';
?>