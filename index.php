<?php
include 'vendor/autoload.php';
include 'vendor/Telegram.php';
include_once 'vendor/jdf.php';
date_default_timezone_set("asia/tehran");
// Set the bot TOKEN
$bot_id = "821293043:AAGV87SgJErV0yQm3np9uvZ3WXKvViX0E10";
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

$EID0 = file_get_contents('EID0.txt');
$EID1 = file_get_contents('EID1.txt');
$EID2 = file_get_contents('EID2.txt');

$SID0 = file_get_contents('SID0.txt');
$SID1 = file_get_contents('SID1.txt');
$SID2 = file_get_contents('SID2.txt');

$callback_data    = $telegram->Callback_Data();
$callback_query   = $telegram->Callback_Query();
$callback_chat_id = $telegram->Callback_ChatID();

if ($callback_query !== null && $callback_query != '') 
{

    if ($callback_data == "lastid0")
    {
    $episodeurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/episodedetails?id=" . $EID0;
    $episoderequest = file_get_contents($episodeurl);
    $episodearrayMessage = json_decode($episoderequest, true);
    $status = $episodearrayMessage['status'];

    if ($status == "1")
    {
        $episodeformattedEpisodeTitle = $episodearrayMessage['details']['formattedEpisodeTitle'];
        $episodelandscapeImgIxUrl = $episodearrayMessage['details']['episodelandscapeImgIxUrl'];
        $episodevideoM3u8Url = $episodearrayMessage['details']['videoM3u8Url'];
        $episodeshowID = $episodearrayMessage['details']['showID'];        
        $episodeDescription = $episodearrayMessage['details']['episodeDescription'];
        $Description1 = strip_tags($episodeDescription);
        $Description2 = str_replace("&laquo;", "", $Description1);
        $Description3 = str_replace("&zwnj;", " ", $Description2);
        $Description4 = str_replace("&raquo;", "", $Description3);
        $Description5 = str_replace("&nbsp;", " ", $Description4);
        $Description = "Show ID >>> " . $episodeshowID . "\n" . $Description5;

        $telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $episodelandscapeImgIxUrl]);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $Description]);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $episodevideoM3u8Url]);
    }


    if ($status == "0")
    {
        $error = $episodearrayMessage['errors']['0']['messageCode'];
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $error . " EpisodeID"]);
    }
    }

    if ($callback_data == "lastid1")
    {
    $episodeurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/episodedetails?id=" . $EID1;
    $episoderequest = file_get_contents($episodeurl);
    $episodearrayMessage = json_decode($episoderequest, true);
    $status = $episodearrayMessage['status'];

    if ($status == "1")
    {
        $episodeformattedEpisodeTitle = $episodearrayMessage['details']['formattedEpisodeTitle'];
        $episodelandscapeImgIxUrl = $episodearrayMessage['details']['episodelandscapeImgIxUrl'];
        $episodevideoM3u8Url = $episodearrayMessage['details']['videoM3u8Url'];
        $episodeshowID = $episodearrayMessage['details']['showID'];        
        $episodeDescription = $episodearrayMessage['details']['episodeDescription'];
        $Description1 = strip_tags($episodeDescription);
        $Description2 = str_replace("&laquo;", "", $Description1);
        $Description3 = str_replace("&zwnj;", " ", $Description2);
        $Description4 = str_replace("&raquo;", "", $Description3);
        $Description5 = str_replace("&nbsp;", " ", $Description4);
        $Description = "Show ID >>> " . $episodeshowID . "\n" . $Description5;

        $telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $episodelandscapeImgIxUrl]);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $Description]);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $episodevideoM3u8Url]);
    }


    if ($status == "0")
    {
        $error = $episodearrayMessage['errors']['0']['messageCode'];
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $error . " EpisodeID"]);
    }
    }


    if ($callback_data == "lastid2")
    {
    $episodeurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/episodedetails?id=" . $EID2;
    $episoderequest = file_get_contents($episodeurl);
    $episodearrayMessage = json_decode($episoderequest, true);
    $status = $episodearrayMessage['status'];

    if ($status == "1")
    {
        $episodeformattedEpisodeTitle = $episodearrayMessage['details']['formattedEpisodeTitle'];
        $episodelandscapeImgIxUrl = $episodearrayMessage['details']['episodelandscapeImgIxUrl'];
        $episodevideoM3u8Url = $episodearrayMessage['details']['videoM3u8Url'];
        $episodeshowID = $episodearrayMessage['details']['showID'];        
        $episodeDescription = $episodearrayMessage['details']['episodeDescription'];
        $Description1 = strip_tags($episodeDescription);
        $Description2 = str_replace("&laquo;", "", $Description1);
        $Description3 = str_replace("&zwnj;", " ", $Description2);
        $Description4 = str_replace("&raquo;", "", $Description3);
        $Description5 = str_replace("&nbsp;", " ", $Description4);
        $Description = "Show ID >>> " . $episodeshowID . "\n" . $Description5;

        $telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $episodelandscapeImgIxUrl]);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $Description]);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $episodevideoM3u8Url]);
    }


    if ($status == "0")
    {
        $error = $episodearrayMessage['errors']['0']['messageCode'];
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $error . " EpisodeID"]);
    }
    }

    if ($callback_data == "lastshowID0")
    {
    $showurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/details?id=" . $SID0;
    $showrequest = file_get_contents($showurl);
    $showarrayMessage = json_decode($showrequest, true);

    $status = $showarrayMessage['status'];

    if ($status == "1")
    {
        $showurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/details?id=" . $SID0;
        $showrequest = file_get_contents($showurl);
        $showarrayMessage = json_decode($showrequest, true);
        $showTitle = $showarrayMessage['details']['showTitle'];
        $showoverlayImgIxUrl = $showarrayMessage['details']['overlayImgIxUrl'];
        $showShortDescription = $showarrayMessage['details']['showShortDescription'];
        $showSynopsis = $showarrayMessage['details']['showSynopsis'];
        $Description1 = strip_tags($showSynopsis);
        $Description2 = str_replace("&laquo;", "", $Description1);
        $Description3 = str_replace("&zwnj;", " ", $Description2);
        $Description4 = str_replace("&raquo;", "", $Description3);
        $Description5 = str_replace("&nbsp;", " ", $Description4);
        $Description6 = ($showTitle . "\n" . $showShortDescription . "\n" . $Description5);
        $Description7 = mb_substr($Description6 , 0 , 1024 , "UTF-8");
        
        $telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $showoverlayImgIxUrl, 'caption' => $Description7]);

        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $SID0]);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => "test"]);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $status]);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $showTitle]);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $showoverlayImgIxUrl]);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $Description7]);
    }

    if ($status == "0")
    {
        $error = $showarrayMessage['errors']['0']['messageCode'];
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $error . " ShowID"]);
    }
    }

    if ($callback_data == "lastshowID1")
    {
    $showurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/details?id=" . $SID1;
    $showrequest = file_get_contents($showurl);
    $showarrayMessage = json_decode($showrequest, true);
    $showTitle = $showarrayMessage['details']['showTitle'];
    $showoverlayImgIxUrl = $showarrayMessage['details']['overlayImgIxUrl'];
    $showShortDescription = $showarrayMessage['details']['showShortDescription'];
    $showSynopsis = $showarrayMessage['details']['showSynopsis'];

    $status = $showarrayMessage['status'];

    if ($status == "1")
    {
        $Description1 = strip_tags($showSynopsis);
        $Description2 = str_replace("&laquo;", "", $Description1);
        $Description3 = str_replace("&zwnj;", " ", $Description2);
        $Description4 = str_replace("&raquo;", "", $Description3);
        $Description5 = str_replace("&nbsp;", " ", $Description4);
        $Description6 = ($showTitle . "\n" . $showShortDescription . "\n" . $Description5);
        $Description7 = mb_substr($Description6 , 0 , 1024 , "UTF-8");

        $telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $showoverlayImgIxUrl, 'caption' => $Description7]);
    }
    if ($status == "0")
    {
        $error = $showarrayMessage['errors']['0']['messageCode'];
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $error . " ShowID"]);
    }
    }

    if ($callback_data == "lastshowID2")
    {
    $showurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/details?id=" . $SID2;
    $showrequest = file_get_contents($showurl);
    $showarrayMessage = json_decode($showrequest, true);
    $showTitle = $showarrayMessage['details']['showTitle'];
    $showoverlayImgIxUrl = $showarrayMessage['details']['overlayImgIxUrl'];
    $showShortDescription = $showarrayMessage['details']['showShortDescription'];
    $showSynopsis = $showarrayMessage['details']['showSynopsis'];

    $status = $showarrayMessage['status'];

    if ($status == "1")
    {
        $Description1 = strip_tags($showSynopsis);
        $Description2 = str_replace("&laquo;", "", $Description1);
        $Description3 = str_replace("&zwnj;", " ", $Description2);
        $Description4 = str_replace("&raquo;", "", $Description3);
        $Description5 = str_replace("&nbsp;", " ", $Description4);
        $Description6 = ($showTitle . "\n" . $showShortDescription . "\n" . $Description5);
        $Description7 = mb_substr($Description6 , 0 , 1024 , "UTF-8");

        $telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $showoverlayImgIxUrl, 'caption' => $Description7]);
    }
    if ($status == "0")
    {
        $error = $showarrayMessage['errors']['0']['messageCode'];
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $error . " ShowID"]);
    }
    }
}

elseif ($text == '/start') 
{
    $telegram->sendMessage(['chat_id' => $chat_id, 'text' => "Bot is Online!"]);
}

elseif ($text == '/news')
{
    $newsapi = "https://dr905zevbmkvz.cloudfront.net/api/v1/publicrole/newsmodule/banner";
    $newsrequest = file_get_contents($newsapi);
    $newsarrayMessage = json_decode($newsrequest, true);
    $newsstrapline1 = $newsarrayMessage['details']['strapline1'];
    $newslandscapeImgIxUrl = $newsarrayMessage['details']['landscapeImgIxUrl'];
    $telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $newslandscapeImgIxUrl, 'caption' => $newsstrapline1]);

    $newsvideoapi = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/newsmodule/newsvideo";
    $newsvideorequest = file_get_contents($newsvideoapi);
    $newsvideoarrayMessage = json_decode($newsvideorequest, true);
    $newsvideoDownloadUrl = $newsvideoarrayMessage['details']['videoDownloadUrl'];
    $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $newsvideoDownloadUrl]);
}

elseif ($text == '/last')
{
    $lasturl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/homemodule/catchupepsiodes";
    $lastrequest = file_get_contents($lasturl);
    $lastarrayMessage = json_decode($lastrequest, true);

    $lastformattedEpisodeTitle0 = $lastarrayMessage['details']['list']['0']['formattedEpisodeTitle'];
    $lastepisodeNumber0 = $lastarrayMessage['details']['list']['0']['episodeNumber'];
    $lastlandscapeImgIxUrl0 = $lastarrayMessage['details']['list']['0']['landscapeImgIxUrl'];
    $lastid0 = $lastarrayMessage['details']['list']['0']['id'];
    $lastshowID0 = $lastarrayMessage['details']['list']['0']['showID'];
    $lastepisodeDateUTC0 = $lastarrayMessage['details']['list']['0']['episodeDateUTC'];
    $lastgetdate10 = explode("T", $lastepisodeDateUTC0, 2);
    $lastgetdate20 = explode("-", $lastgetdate10[0], 3);
    $lastshowtime0 = gregorian_to_jalali($lastgetdate20[0], $lastgetdate20[1], $lastgetdate20[2], '-');
    $lastcaption0 = $lastformattedEpisodeTitle0 . "\nLive On >>> " . $lastshowtime0;

    $option0 = [
                [
                $telegram->buildInlineKeyBoardButton("Episode on site (" . $lastid0 . ")", $url = "https://www.manototv.com/episode/" . $lastid0),
                $telegram->buildInlineKeyBoardButton("Show on site (" . $lastshowID0 . ")", $url = "https://www.manototv.com/show/" . $lastshowID0),
                ],
                [$telegram->buildInlineKeyBoardButton('Episode Details', $url = '', $callback_data = "lastid0"),
                 $telegram->buildInlineKeyBoardButton('Show Details', $url = '', $callback_data = "lastshowID0"),
                ],
            ];

    file_put_contents("EID0.txt", $lastid0);
    file_put_contents("SID0.txt", $lastshowID0);

        $keyb0 = $telegram->buildInlineKeyBoard($option0);
        $telegram->sendPhoto(['chat_id' => $chat_id, 'reply_markup' => $keyb0, 'photo' => $lastlandscapeImgIxUrl0, 'caption' => $lastcaption0]);

    

    $lastformattedEpisodeTitle1 = $lastarrayMessage['details']['list']['1']['formattedEpisodeTitle'];
    $lastepisodeNumber1 = $lastarrayMessage['details']['list']['1']['episodeNumber'];
    $lastlandscapeImgIxUrl1 = $lastarrayMessage['details']['list']['1']['landscapeImgIxUrl'];
    $lastid1 = $lastarrayMessage['details']['list']['1']['id'];
    $lastshowID1 = $lastarrayMessage['details']['list']['1']['showID'];
    $lastepisodeDateUTC1 = $lastarrayMessage['details']['list']['1']['episodeDateUTC'];
    $lastgetdate11 = explode("T", $lastepisodeDateUTC1, 2);
    $lastgetdate21 = explode("-", $lastgetdate11[0], 3);
    $lastshowtime1 = gregorian_to_jalali($lastgetdate21[0], $lastgetdate21[1], $lastgetdate21[2], '-');
    $lastcaption1 = $lastformattedEpisodeTitle1 ."\nLive On >>> " . $lastshowtime1;

    $option1 = [
                [
                $telegram->buildInlineKeyBoardButton("Episode on site (" . $lastid1 . ")", $url = "https://www.manototv.com/episode/" . $lastid1),
                $telegram->buildInlineKeyBoardButton("Show on site (" . $lastshowID1 . ")", $url = "https://www.manototv.com/show/" . $lastshowID1),
                ],
                [$telegram->buildInlineKeyBoardButton('Episode Details', $url = '', $callback_data = "lastid1"),
                 $telegram->buildInlineKeyBoardButton('Show Details', $url = '', $callback_data = "lastshowID1"),
                ],
            ];

    file_put_contents("EID1.txt", $lastid1);
    file_put_contents("SID1.txt", $lastshowID1);

        $keyb1 = $telegram->buildInlineKeyBoard($option1);
        $telegram->sendPhoto(['chat_id' => $chat_id, 'reply_markup' => $keyb1, 'photo' => $lastlandscapeImgIxUrl1, 'caption' => $lastcaption1]);


    $lastformattedEpisodeTitle2 = $lastarrayMessage['details']['list']['2']['formattedEpisodeTitle'];
    $lastepisodeNumber2 = $lastarrayMessage['details']['list']['2']['episodeNumber'];
    $lastlandscapeImgIxUrl2 = $lastarrayMessage['details']['list']['2']['landscapeImgIxUrl'];
    $lastid2 = $lastarrayMessage['details']['list']['2']['id'];
    $lastshowID2 = $lastarrayMessage['details']['list']['2']['showID'];
    $lastepisodeDateUTC2 = $lastarrayMessage['details']['list']['2']['episodeDateUTC'];
    $lastgetdate12 = explode("T", $lastepisodeDateUTC2, 2);
    $lastgetdate22 = explode("-", $lastgetdate12[0], 3);
    $lastshowtime2 = gregorian_to_jalali($lastgetdate22[0], $lastgetdate22[1], $lastgetdate22[2], '-');
    $lastcaption2 = $lastformattedEpisodeTitle2 . "\nLive On >>> " . $lastshowtime2;

    $option2 = [
                [
                $telegram->buildInlineKeyBoardButton("Episode on site (" . $lastid2 . ")", $url = "https://www.manototv.com/episode/" . $lastid2),
                $telegram->buildInlineKeyBoardButton("Show on site (" . $lastshowID2 . ")", $url = "https://www.manototv.com/show/" . $lastshowID2),
                ],
                [$telegram->buildInlineKeyBoardButton('Episode Details', $url = '', $callback_data = "lastid2"),
                 $telegram->buildInlineKeyBoardButton('Show Details', $url = '', $callback_data = "lastshowID2"),
                ],
            ];

    file_put_contents("EID2.txt", $lastid2);
    file_put_contents("SID2.txt", $lastshowID2);

        $keyb2 = $telegram->buildInlineKeyBoard($option2);
        $telegram->sendPhoto(['chat_id' => $chat_id, 'reply_markup' => $keyb2, 'photo' => $lastlandscapeImgIxUrl2, 'caption' => $lastcaption2]);


}
elseif (strstr($text, "e") == true)
{
    $getepisodeid = explode("e", $text, 2);
    $episodeurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/episodedetails?id=" . $getepisodeid[1];
    $episoderequest = file_get_contents($episodeurl);
    $episodearrayMessage = json_decode($episoderequest, true);

    $status = $episodearrayMessage['status'];

    if ($status == "1")
    {
        $episodeformattedEpisodeTitle = $episodearrayMessage['details']['formattedEpisodeTitle'];
        $episodelandscapeImgIxUrl = $episodearrayMessage['details']['episodelandscapeImgIxUrl'];
        $episodevideoM3u8Url = $episodearrayMessage['details']['videoM3u8Url'];
        $episodeshowID = $episodearrayMessage['details']['showID'];        
        $episodeDescription = $episodearrayMessage['details']['episodeDescription'];
        $Description1 = strip_tags($episodeDescription);
        $Description2 = str_replace("&laquo;", "", $Description1);
        $Description3 = str_replace("&zwnj;", " ", $Description2);
        $Description4 = str_replace("&raquo;", "", $Description3);
        $Description5 = str_replace("&nbsp;", " ", $Description4);
        $Description = "Show ID >>> " . $episodeshowID . "\n" . $Description5;

        $telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $episodelandscapeImgIxUrl]);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $Description]);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $episodevideoM3u8Url]);
    }


    if ($status == "0")
    {
        $error = $episodearrayMessage['errors']['0']['messageCode'];
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $error . " EpisodeID"]);
    }
}

elseif (strstr($text, "s") == true)
{
    $getshowid = explode("s", $text, 2);
    $showurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/details?id=" . $getshowid[1];
    $showrequest = file_get_contents($showurl);
    $showarrayMessage = json_decode($showrequest, true);

    $status = $showarrayMessage['status'];

    $showTitle = $showarrayMessage['details']['showTitle'];

    $showoverlayImgIxUrl = $showarrayMessage['details']['overlayImgIxUrl'];
    $showShortDescription = $showarrayMessage['details']['showShortDescription'];
    $showSynopsis = $showarrayMessage['details']['showSynopsis'];
    $Description1 = strip_tags($showSynopsis);
    $Description2 = str_replace("&laquo;", " ", $Description1);
    $Description3 = str_replace("&zwnj;", " ", $Description2);
    $Description4 = str_replace("&raquo;", " ", $Description3);
    $Description5 = str_replace("&nbsp;", " ", $Description4);
    $Description6 = ($showTitle . "\n" . $showShortDescription . "\n" . $Description5);
    $telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $showoverlayImgIxUrl, 'caption' => $Description6]);
    $Description7 = mb_substr($Description6 , 0 , 1024 , "UTF-8");
    $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $showoverlayImgIxUrl]);
    

    $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $Description]);

    $telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $showoverlayImgIxUrl, 'caption' => $Description]);

        $serieurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/serieslist?id=" . $getshowid[1];
        $serierequests = file_get_contents($serieurl);
        $seriearrayMessage = json_decode($serierequests, true);
        $serieid = $seriearrayMessage['details']['list']['0']['id'];

        $epsodelisturl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/episodelist?id=" . $serieid;;
        $epsodelistrequest = file_get_contents($epsodelisturl);
        $epsodelistarrayMessage = json_decode($epsodelistrequest, true);

        $epsodelistid0 = $epsodelistarrayMessage['details']['list']['0']['id'];
        $epsodelistTitle0 = $epsodelistarrayMessage['details']['list']['0']['episodeTitle'];
        $formattedepsodelistTitle0 = $epsodelistarrayMessage['details']['list']['0']['formattedEpisodeTitle'];
        $epsodelistformattedShowTitle0 = $epsodelistarrayMessage['details']['list']['0']['formattedShowTitle'];
        $epsodelistlandscapeImgIxUrl0 = $epsodelistarrayMessage['details']['list']['0']['landscapeImgIxUrl'];
        $epsodelistDateUTC0 = $epsodelistarrayMessage['details']['list']['0']['episodeDateUTC'];
        $epsodelistgetdate10 = explode("T", $epsodelistDateUTC0, 2);
        $epsodelistgetdate20 = explode("-", $epsodelistgetdate10[0], 3);

        $epsodelistShowon0 = gregorian_to_jalali($epsodelistgetdate20[0], $epsodelistgetdate20[1], $epsodelistgetdate20[2], '-');
        $epsodelistcaption0 = ($epsodelistformattedShowTitle0 . " " . $formattedepsodelistTitle0 . "\n" . $epsodelistTitle0 . "\n" . $epsodelistShowon0 . "\nhttps://www.manototv.com/episode/" . $epsodelistid0);

        $telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $epsodelistlandscapeImgIxUrl0, 'caption' => $epsodelistcaption0]);


        $epsodelistid1 = $epsodelistarrayMessage['details']['list']['1']['id'];
        $epsodelistTitle1 = $epsodelistarrayMessage['details']['list']['1']['episodeTitle'];
        $formattedepsodelistTitle1 = $epsodelistarrayMessage['details']['list']['1']['formattedEpisodeTitle'];
        $epsodelistformattedShowTitle1 = $epsodelistarrayMessage['details']['list']['1']['formattedShowTitle'];
        $epsodelistlandscapeImgIxUrl1 = $epsodelistarrayMessage['details']['list']['1']['landscapeImgIxUrl'];
        $epsodelistDateUTC1 = $epsodelistarrayMessage['details']['list']['1']['episodeDateUTC'];
        $epsodelistgetdate11 = explode("T", $epsodelistDateUTC1, 2);
        $epsodelistgetdate21 = explode("-", $epsodelistgetdate11[0], 3);

        $epsodelistShowon1 = gregorian_to_jalali($epsodelistgetdate21[0], $epsodelistgetdate21[1], $epsodelistgetdate21[2], '-');
        $epsodelistcaption1 = ($epsodelistformattedShowTitle1 . " " . $formattedepsodelistTitle1 . "\n" . $epsodelistTitle1 . "\n" . $epsodelistShowon1 . "\nhttps://www.manototv.com/episode/" . $epsodelistid1);

        $telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $epsodelistlandscapeImgIxUrl1, 'caption' => $epsodelistcaption1]);

        $epsodelistid2 = $epsodelistarrayMessage['details']['list']['2']['id'];
        $epsodelistTitle2 = $epsodelistarrayMessage['details']['list']['2']['episodeTitle'];
        $formattedepsodelistTitle2 = $epsodelistarrayMessage['details']['list']['2']['formattedEpisodeTitle'];
        $epsodelistformattedShowTitle2 = $epsodelistarrayMessage['details']['list']['2']['formattedShowTitle'];
        $epsodelistlandscapeImgIxUrl2 = $epsodelistarrayMessage['details']['list']['2']['landscapeImgIxUrl'];
        $epsodelistDateUTC2 = $epsodelistarrayMessage['details']['list']['2']['episodeDateUTC'];
        $epsodelistgetdate12 = explode("T", $epsodelistDateUTC2, 2);
        $epsodelistgetdate22 = explode("-", $epsodelistgetdate12[0], 3);

        $epsodelistgetShowon2 = gregorian_to_jalali($epsodelistgetdate22[0], $epsodelistgetdate22[1], $epsodelistgetdate22[2], '-');
        $epsodelistcaption2 = ($epsodelistformattedShowTitle2 . " " . $formattedepsodelistTitle2 . "\n" . $epsodelistTitle2 . "\n" . $epsodelistgetShowon2 . "\nhttps://www.manototv.com/episode/" . $epsodelistid2);

        $telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $epsodelistlandscapeImgIxUrl2, 'caption' => $epsodelistcaption2]);
}

elseif (strstr($text, "-") == true)
{
    if (stristr($text, " - ") == true)
    {
        $scheduletext = explode(" - ", $text, 2);
    }
    else
    {
        $scheduletext = explode("-", $text, 2);
    }


    $dateinput = explode(" ", $scheduletext[0], 3);
    $Thirty = "13";
    $Y = $Thirty . $dateinput[0];
    $M = $dateinput[1];
    $D = $dateinput[2];
    $dateinputFa = jalali_to_gregorian($Y, $M, $D, "-");
    $dateinput2FA = explode("-", $dateinputFa, 3);


    $dateinputMonth = strlen($dateinput2FA[1]);
    if (($dateinputMonth == 1) == true)
    {
        $zero = "0";
        $Month = $zero . $dateinput2FA[1];
    }

    elseif (($dateinputMonth == 2) == true)
    {
        $Month = $dateinput2FA[1];
    }
    else
    {
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => "Invalid_Date"]);
    }


    $dateinputDay = strlen($dateinput2FA[2]);
    if (($dateinputDay == 1) == true)
    {
        $zero = "0";
        $Day = $zero . $dateinput2FA[2];
    }
    elseif (($dateinputDay == 2) == true)
    {
        $Day = $dateinput2FA[2];
    }

    else
    {
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => "Invalid_Date"]);
    }


    $dateinputYear = strlen($dateinput2FA[0]);
    if (($dateinputYear == 2) == true)
    {   
        $twenty = "20";
        $Year = $twenty . $dateinput2FA[0];
    }
    elseif (($dateinputYear == 4) == true)
    {
        $Year = $dateinput2FA[0];
    }

    else
    {
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => "Invalid_Date"]);
    }

    $DateMiladi = ($Year . "-" . $Month . "-" . $Day);

    $timeinput = explode(" ", $scheduletext[1], 2);

    $userTimezone = new DateTimeZone('Asia/Tehran');
    $gmtTimezone = new DateTimeZone('GMT');
    $myDateTime = new DateTime("$DateMiladi $timeinput[0]:$timeinput[1]", $gmtTimezone);
    $offset = $userTimezone->getOffset($myDateTime);
    $myInterval=DateInterval::createFromDateString((string)"-12600" . 'seconds');
    $myDateTime->add($myInterval);
    $result = $myDateTime->format('Y-m-d H:i:s');
    $datetime = explode(" ", $result, 2);
    $time = explode(":", $datetime[1], 3);
    $hour = $time[0];
    $hourplus = $hour +1;
    $min = $time[1];


    if ($timeinput[1] < "30" and $timeinput[1] !== "30" and $timeinput[1] !== "00" )
    {
        $minute = "30";
    }

    if ($timeinput[1] > "30" and $timeinput[1] !== "30" and $timeinput[1] !== "00" )
    {
        $minute = "00";
    }

    if ($timeinput[1] == "30")
    {
        $minute = "00";
    }
    if ($timeinput[1] == "00")
    {
        $minute = "30";
    }
    $scheduleurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/schedulemodule/schedule?from=" . $DateMiladi . "T" . $hour . ":" . $minute . ":00.000Z&to=" . $DateMiladi . "T" . $hourplus . ":" . $minute . ":00.000Z";

    $schedulerequest = file_get_contents($scheduleurl);
    $schedulearrayMessage = json_decode($schedulerequest, true);
    $dateUTCRoundedDownToFiveMinutes = $schedulearrayMessage['details']['list']['0']['dateUTCRoundedDownToFiveMinutes'];
    $userinputtime = ($DateMiladi . "T" . $hour . ":" . $minute . ":00");

    if ($dateUTCRoundedDownToFiveMinutes == $userinputtime)
    {
        $scheduleepisodeID = $schedulearrayMessage['details']['list']['0']['episodeID'];
        $scheduleshowID = $schedulearrayMessage['details']['list']['0']['showID'];
        $scheduleshowTitle = $schedulearrayMessage['details']['list']['0']['showTitle'];
        $scheduleepisodeNumber = $schedulearrayMessage['details']['list']['0']['episodeNumber'];
        $scheduleseasonNumber = $schedulearrayMessage['details']['list']['0']['seasonNumber'];
        $schedulecurrentHouseNumber = $schedulearrayMessage['details']['list']['0']['currentHouseNumber'];
        $scheduleportraitImgIxUrl = $schedulearrayMessage['details']['list']['0']['portraitImgIxUrl'];
    }

    if ($dateUTCRoundedDownToFiveMinutes !== $userinputtime)
    {
        $date1 = (explode("T", $dateUTCRoundedDownToFiveMinutes, 2));
        $date2 = (explode(":", $date1[1], 3));
        $data3 = $date2[0] - 1;
        $scheduleurl2 = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/schedulemodule/schedule?from=" . $DateMiladi . "T" . $data3 . ":30:00.000Z&to=" . $DateMiladi . "T" . $hourplus . ":" . $minute . ":00.000Z";

        $schedulerequest2 = file_get_contents($scheduleurl2);
        $schedulearrayMessage2 = json_decode($schedulerequest2, true);

        $scheduleepisodeID = $schedulearrayMessage2['details']['list']['0']['episodeID'];
        $scheduleshowTitle = $schedulearrayMessage2['details']['list']['0']['showTitle'];
        $scheduleepisodeNumber = $schedulearrayMessage2['details']['list']['0']['episodeNumber'];
        $scheduleseasonNumber = $schedulearrayMessage2['details']['list']['0']['seasonNumber'];
        $schedulecurrentHouseNumber = $schedulearrayMessage2['details']['list']['0']['currentHouseNumber'];
        $scheduleportraitImgIxUrl = $schedulearrayMessage2['details']['list']['0']['portraitImgIxUrl'];
    }

        $datea = (explode("T", $dateUTCRoundedDownToFiveMinutes, 2));
        $dateb = (explode(":", $datea[1], 3));

        if ($dateb[1] == "30")
    {
        $minute2 = "00";
    }

    if ($dateb[1] == "00")
    {
        $minute2 = "30";
    }

    $status = $schedulearrayMessage['status'];

    if ($status == "1")
    {
        $scheduleCaption = "live on >>> " . $timeinput[0] . ":" . $minute2 . "\nSHOW ID >>> " . $scheduleshowID . "\nEP ID >>> " . $scheduleepisodeID . "\n" . $scheduleshowTitle . "\nS" . $scheduleseasonNumber . "\nE" . $scheduleepisodeNumber . "\nhttps://d2rwmwucnr0d10.cloudfront.net/vod/" . $schedulecurrentHouseNumber . ".m3u8";
        $telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $scheduleportraitImgIxUrl, 'caption' => $scheduleCaption]);

        $option0 = [
                [$telegram->buildInlineKeyBoardButton('Episode Details', $url = 'tg://resolve?domain=manotoapibot&start=/news', $callback_data = "1"),
                 $telegram->buildInlineKeyBoardButton('Show Details', $url = '', $callback_data = "2"),
                ],
                ];

                $keyb0 = $telegram->buildInlineKeyBoard($option0);
        $telegram->sendPhoto(['chat_id' => $chat_id, 'reply_markup' => $keyb0, 'photo' => $scheduleportraitImgIxUrl, 'caption' => $scheduleCaption]);

    }
    elseif ($status == "0")
    {
        $error = $schedulearrayMessage['errors']['0']['messageCode'];
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $error . " ScheduleID"]);
    }
}
else
{
    $telegram->sendMessage(['chat_id' => $chat_id, 'text' => "Invalid Input"]);
}
