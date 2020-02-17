<?php
include 'vendor/autoload.php';
include 'vendor/Telegram.php';
include_once 'vendor/jdf.php');

$telegram = new Zelenin\Telegram\Bot\Api('821293043:AAGV87SgJErV0yQm3np9uvZ3WXKvViX0E10'); // Set your access token
$update = json_decode(file_get_contents('php://input'));
$chat_id = $update->message->chat->id;
$textoriginal = $update->message->text;
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
