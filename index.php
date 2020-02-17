<?php
include 'vendor/autoload.php';
include 'vendor/Telegram.php';
include_once 'vendor/jdf.php';
$bot_id = "821293043:AAGV87SgJErV0yQm3np9uvZ3WXKvViX0E10";
$telegram = new Telegram($bot_id);
$textoriginal = $telegram->Text();
$chat_id = $telegram->ChatID(); 
$text = strtolower($textoriginal);

//your app

if($text == '/start')
    {

        $response = $telegram->sendMessage([
            'chat_id' => $chat_id,
            'text' => "Bot is Online!"
        ]);
    }
else
    {
        $response = $telegram->sendMessage([
            'chat_id' => $chat_id,
            'text' => "Invalid command"
            ]);
    }
