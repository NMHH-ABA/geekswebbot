<?php
if (!file_exists('madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
    }
    include 'madeline.php';
    $MadelineProto = new \danog\MadelineProto\API('session.madeline');
    $MadelineProto->start();
    $MadelineProto->messages->sendMessage(['peer' => '@StageExtraAdmin', 'message' => 'SALAM']);
    
	$peer = '@StageExtraAdmin';
	$sentMessage =  $MadelineProto->messages->sendMedia([
	    'peer' => $peer,
	    'media' => [
	        '_' => 'inputMediaDocumentExternal',
	        'url' => new \danog\MadelineProto\FileCallback(
	            'https://d2rwmwucnr0d10.cloudfront.net/videoClips/1572.mp4',
	            function ($progress) use ($MadelineProto, $peer) {
	                 $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => 'Upload progress: '.$progress.'%']);
	            }
	        ),
	        'attributes' => [
	            ['_' => 'documentAttributeVideo', 'round_message' => false, 'supports_streaming' => true]
	        ]
	    ],
	    'message' => '[This is the caption](https://t.me/MadelineProto)',
	    'parse_mode' => 'Markdown'
	]);

	$output_file_name =  $MadelineProto->download_to_file(
	    $sentMessage,
	    new \danog\MadelineProto\FileCallback(
	        '/tmp/myname.mp4',
	        function ($progress) use ($MadelineProto, $peer) {
	             $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => 'Download progress: '.$progress.'%']);
	        }
	    )
	);
