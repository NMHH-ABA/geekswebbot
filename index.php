<?php
require 'vendor/autoload.php';

$telegram = new Zelenin\Telegram\Bot\Api('821293043:AAGV87SgJErV0yQm3np9uvZ3WXKvViX0E10'); // Set your access token
$update = json_decode(file_get_contents('php://input'));
$chat_id = $update->message->chat->id;

//your app
try {

    if($update->message->text == '/start')
    {
    	$response = $telegram->sendChatAction(['chat_id' => $chat_id, 'action' => 'typing']);
    	$response = $telegram->sendMessage([
        	'chat_id' => $chat_id,
        	'text' => "Bot is Online!"
     	]);
    }
    else
    {
    	$response = $telegram->sendChatAction(['chat_id' => $chat_id, 'action' => 'typing']);
    	$response = $telegram->sendMessage([
    		'chat_id' => $chat_id,
    		'text' => "Invalid command"
    		]);
    }

} catch (\Zelenin\Telegram\Bot\NotOkException $e) {

    //echo error message ot log it
    //echo $e->getMessage();

}
