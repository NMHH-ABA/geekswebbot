<?php
include 'vendor/autoload.php';
include 'vendor/Telegram.php';
include_once 'vendor/jdf.php';
date_default_timezone_set("asia/tehran");
// Set the bot TOKEN
$bot_id = "69707027:AAEBGJPfjZHaY1320czxkd6_9-BYVK6-ggg";
// Instances the class
$telegram = new Telegram($bot_id);
$textoriginal = $telegram->Text();
$username = $telegram->Username();
$name = $telegram->FirstName();
$family = $telegram->LastName();
$message_id = $telegram->MessageID();
$user_id = $telegram->UserID(); 
$chat_id = $telegram->ChatID(); 
$text = strtolower($textoriginal);
$msgType = $telegram->getUpdateType();
$msgcaptiom = $telegram->Caption();
$file_id = $telegram->photoFileID();

$callback_data    = $telegram->Callback_Data();
$callback_query   = $telegram->Callback_Query();
$callback_chat_id = $telegram->Callback_ChatID();
$callbackmessage_id = $telegram->MessageID();
$callbackurlepisode = $telegram->callbackurlepisode();
$callbackurlshow = $telegram->callbackurlshow();

if ($text == '/start')
{
    $option =   [
        [
            $telegram->buildInlineKeyBoardButton("آخرین ها", $url = '', $callback_data = 'last'),
            $telegram->buildInlineKeyBoardButton("زمان پخش برنامه ها", $url = '', $callback_data = 'month'),
        ],
        [
            $telegram->buildInlineKeyBoardButton("برنامه ها", $url = '', $callback_data = 'genres'),
            $telegram->buildInlineKeyBoardButton("اتاق خبر", $url = '', $callback_data = 'news'),
            $telegram->buildInlineKeyBoardButton("فرکانس", $url = '', $callback_data = 'frequency'),
        ],
    ];

    $keyb = $telegram->buildInlineKeyBoard($option);

    $telegram->SendMessage(array('chat_id' => $chat_id,  'reply_markup' => $keyb, 'text' => "ربات بچه های من و تو\n\nیکی از گزینه ها رو انتخاب کنید"));
    #convert to json
    #$text1 = file_get_contents('users.txt');
    #$text2 = explode('-',$text1);
    #$text3 = json_encode($text2, JSON_FORCE_OBJECT);
    #file_put_contents('testfile.txt', $text3);

    #save new users chat id
    $UserFileName = "users.txt";
    $UserFileHandle = fopen($UserFileName, 'a') or die("can't open file");

    $search = file_get_contents('users.txt');
    $UserstringData = "-$chat_id";
    if (stristr($search, $UserstringData) == true)
    {
        fclose($UserFileHandle);
    }
    elseif (stristr($search, $UserstringData) == false)
    {
        fwrite($UserFileHandle, $UserstringData);
        fclose($UserFileHandle);
    }
    #$fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    #$telegram->SendMessage(array('chat_id' => $chat_id,  'text' => $fullurl));
}
else
{
    $telegram->sendMessage(['chat_id' => $chat_id, 'text' => "Invalid Input"]);
}
