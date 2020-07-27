<?php
header('Content-type: text/html; charset=utf-8');
include 'vendor/autoload.php'; #for heroku deploy
include 'vendor/Telegram.php';
$request = file_get_contents("php://input");
$arrayMessage = json_decode($request, true);
$bot_id = "1187354831:AAFEZ4sfFsaweLiFeQHv__s9lWP0uHA7A1g";
$chat_id = $arrayMessage['message']['from']['id'];
$text = $arrayMessage['message']['text'];
$message_id = $arrayMessage['message']['message_id'];
$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
if(preg_match($reg_exUrl, $text, $url)) {$url = $url[0];}
else
{
    $telegram -> respondSuccess();
}
$download = explode('?url=', $url);
$getcdn = explode('&', $download[1]);
$cdn = $getcdn[0];
$getfilename = explode('=', $getcdn[1]);
$filename = $getfilename[1];
$directurl = "http://" . $cdn . ".iosyar.iosf1.ir/IDM/" . $filename;
$txt = urlencode($directurl);
$api = "https://api.telegram.org/bot" . $bot_id . "/sendMessage?chat_id=" . $chat_id . "&reply_to_message_id=" . $message_id ."&text=" . $txt;
file_get_contents($api);
