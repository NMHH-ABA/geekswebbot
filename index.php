<?php
include 'vendor/autoload.php';
include 'vendor/Telegram.php';
include_once 'vendor/jdf.php';
date_default_timezone_set("asia/tehran");
// Set the bot TOKEN
$bot_id = "1279873723:AAEjyOf7og7FWiK0IAXJ9vyPqqwItv-6HEs";
// Instances the class
$telegram = new Telegram($bot_id);
$textoriginal = $telegram->Text();
$username = $telegram->Username();
$name = $telegram->FirstName();
$family = $telegram->LastName();
$message_id = $telegram->MessageID();
$user_id = $telegram->UserID();
$chat_id = $telegram->ChatID();
$Caption = $telegram->Caption();
$text = strtolower($textoriginal);
$msgType = $telegram->getUpdateType();
$msgcaptiom = $telegram->Caption();
$file_id = $telegram->photoFileID();

$callback_data    = $telegram->Callback_Data();
$callback_query = $telegram->Callback_Query();
$callback_chat_id = $telegram->Callback_ChatID();
$callbackmessage_id = $telegram->MessageID();
$callbackurlepisode = $telegram->callbackurlepisode();
$callbackurlshow = $telegram->callbackurlshow();
$inline_query_id = $telegram->Inline_Query_ID ();
$inline_query_text = $telegram->Inline_Query_Text();

$startb =   [
    [

        $telegram->buildInlineKeyBoardButton("آخرین ها", $url = '', $callback_data = 'last'),
        $telegram->buildInlineKeyBoardButton("زمان پخش برنامه ها", $url = '', $callback_data = 'month'),
    ],
    [
        $telegram->buildInlineKeyBoardButton("برنامه ها", $url = '', $callback_data = 'genres'),
        $telegram->buildInlineKeyBoardButton("اتاق خبر", $url = '', $callback_data = 'news'),
        $telegram->buildInlineKeyBoardButton("فرکانس", $url = '', $callback_data = 'frequency'),
    ],
    [
        #$telegram->buildInlineKeyBoardButton("سریال ها", $url = '', $callback_data = 'serieslist'),
        $telegram->buildInlineKeyBoardButton("اپ منوتو", $url = '', $callback_data = 'app'),
    ],
];

if ($text == '/start')
{

    $keyb = $telegram->buildInlineKeyBoard($startb);

    $telegram->SendMessage(array('chat_id' => $chat_id,  'reply_markup' => $keyb, 'text' => "ربات بچه های من و تو\n\nیکی از گزینه ها رو انتخاب کنید"));

    #save new users chat id
    $UserFileName = "users.txt";
    $UserFileHandle = fopen($UserFileName, 'a') or die("can't open file");

    $search = file_get_contents('users.txt');
    $UserstringData = "\n$chat_id";
    if (stristr($search, $UserstringData) == true)
    {
        fclose($UserFileHandle);
    }
    elseif (stristr($search, $UserstringData) == false)
    {
        fwrite($UserFileHandle, $UserstringData);
        fclose($UserFileHandle);
    }
}
elseif ($text == 'callstart')
{
    $keyb = $telegram->buildInlineKeyBoard($startb);

    $telegram->editMessageText(array('chat_id' => $chat_id, 'message_id' => $callbackmessage_id, 'reply_markup' => $keyb, 'text' => "ربات بچه های من و تو\n\nیکی از گزینه ها رو انتخاب کنید"));
}
elseif ($text == 'month') # show month
{
    $day0= date_create(date("Y-m-d"));
    date_add($day0,date_interval_create_from_date_string("-1 days"));
    $Day0 =  date_format($day0,"Y-m-d");
    $Parts0 = explode('-', $Day0, 3);
    $TimeStamp0 = mktime(0, 0, 0, $Parts0[1], $Parts0[2], $Parts0[0]);
    $dayharfi0 = jgetdate($TimeStamp0);
    $dateharfi0 = tr_num(($dayharfi0[weekday] . " " . $dayharfi0[mday] . " " . $dayharfi0[month] . " " . $dayharfi0[year]), 'fa');

    $day1 = date_create(date("Y-m-d"));
    date_add($day1, date_interval_create_from_date_string("0 days"));
    $Day1 = date_format($day1, "Y-m-d");
    $Parts1 = explode('-', $Day1, 3);
    $TimeStamp1 = mktime(0, 0, 0, $Parts1[1], $Parts1[2], $Parts1[0]);
    $dayharfi1 = jgetdate($TimeStamp1);
    $dateharfi1 = tr_num(($dayharfi1[weekday] . " " . $dayharfi1[mday] . " " . $dayharfi1[month] . " " . $dayharfi1[year]), 'fa');
    $dayfa1 = $dayharfi1[year] . "-" . $dayharfi1[mon] . "-" . $dayharfi1[mday];

    $day2 = date_create(date("Y-m-d"));
    date_add($day2, date_interval_create_from_date_string("1 days"));
    $Day2 = date_format($day2, "Y-m-d");
    $Parts2 = explode('-', $Day2, 3);
    $TimeStamp2 = mktime(0, 0, 0, $Parts2[1], $Parts2[2], $Parts2[0]);
    $dayharfi2 = jgetdate($TimeStamp2);
    $dateharfi2 = tr_num(($dayharfi2[weekday] . " " . $dayharfi2[mday] . " " . $dayharfi2[month] . " " . $dayharfi2[year]), 'fa');

    $day3 = date_create(date("Y-m-d"));
    date_add($day3, date_interval_create_from_date_string("2 days"));
    $Day3 = date_format($day3, "Y-m-d");
    $Parts3 = explode('-', $Day3, 3);
    $TimeStamp3 = mktime(0, 0, 0, $Parts3[1], $Parts3[2], $Parts3[0]);
    $dayharfi3 = jgetdate($TimeStamp3);
    $dateharfi3 = tr_num(($dayharfi3[weekday] . " " . $dayharfi3[mday] . " " . $dayharfi3[month] . " " . $dayharfi3[year]), 'fa');

    $day4 = date_create(date("Y-m-d"));
    date_add($day4, date_interval_create_from_date_string("3 days"));
    $Day4 = date_format($day4, "Y-m-d");
    $Parts4 = explode('-', $Day4, 3);
    $TimeStamp4 = mktime(0, 0, 0, $Parts4[1], $Parts4[2], $Parts4[0]);
    $dayharfi4 = jgetdate($TimeStamp4);
    $dateharfi4 = tr_num(($dayharfi4[weekday] . " " . $dayharfi4[mday] . " " . $dayharfi4[month] . " " . $dayharfi4[year]), 'fa');

    $day5 = date_create(date("Y-m-d"));
    date_add($day5, date_interval_create_from_date_string("4 days"));
    $Day5 = date_format($day5, "Y-m-d");
    $Parts5 = explode('-', $Day5, 3);
    $TimeStamp5 = mktime(0, 0, 0, $Parts5[1], $Parts5[2], $Parts5[0]);
    $dayharfi5 = jgetdate($TimeStamp5);
    $dateharfi5 = tr_num(($dayharfi5[weekday] . " " . $dayharfi5[mday] . " " . $dayharfi5[month] . " " . $dayharfi5[year]), 'fa');

    $day6 = date_create(date("Y-m-d"));
    date_add($day6, date_interval_create_from_date_string("5 days"));
    $Day6 = date_format($day6, "Y-m-d");
    $Parts6 = explode('-', $Day6, 3);
    $TimeStamp6 = mktime(0, 0, 0, $Parts6[1], $Parts6[2], $Parts6[0]);
    $dayharfi6 = jgetdate($TimeStamp6);
    $dateharfi6 = tr_num(($dayharfi6[weekday] . " " . $dayharfi6[mday] . " " . $dayharfi6[month] . " " . $dayharfi6[year]), 'fa');

    $day7 = date_create(date("Y-m-d"));
    date_add($day7, date_interval_create_from_date_string("6 days"));
    $Day7 = date_format($day7, "Y-m-d");
    $Parts7 = explode('-', $Day7, 3);
    $TimeStamp7 = mktime(0, 0, 0, $Parts7[1], $Parts7[2], $Parts7[0]);
    $dayharfi7 = jgetdate($TimeStamp7);
    $dateharfi7 = tr_num(($dayharfi7[weekday] . " " . $dayharfi7[mday] . " " . $dayharfi7[month] . " " . $dayharfi7[year]), 'fa');

    $day8 = date_create(date("Y-m-d"));
    date_add($day8, date_interval_create_from_date_string("7 days"));
    $Day8 = date_format($day8, "Y-m-d");
    $Parts8 = explode('-', $Day8, 3);
    $TimeStamp8 = mktime(0, 0, 0, $Parts8[1], $Parts8[2], $Parts8[0]);
    $dayharfi8 = jgetdate($TimeStamp8);
    $dateharfi8 = tr_num(($dayharfi8[weekday] . " " . $dayharfi8[mday] . " " . $dayharfi8[month] . " " . $dayharfi8[year]), 'fa');


    $option = [
        [
            $telegram->buildInlineKeyBoardButton("فردا\n$dayharfi2[weekday] ($dayharfi2[mday])", $url = '', $callback_data = "zaman" . $Day2),
            $telegram->buildInlineKeyBoardButton("امروز\n$dayharfi1[weekday] ($dayharfi1[mday])", $url = '', $callback_data = "zaman" . $Day1),
            $telegram->buildInlineKeyBoardButton("دیروز\n$dayharfi0[weekday] ($dayharfi0[mday])", $url = '', $callback_data = "zaman" . $Day0),
        ],
        [
            $telegram->buildInlineKeyBoardButton("$dayharfi5[weekday] ($dayharfi5[mday])", $url = '', $callback_data = "zaman" . $Day5),
            $telegram->buildInlineKeyBoardButton("$dayharfi4[weekday] ($dayharfi4[mday])", $url = '', $callback_data = "zaman" . $Day4),
            $telegram->buildInlineKeyBoardButton("$dayharfi3[weekday] ($dayharfi3[mday])", $url = '', $callback_data = "zaman" . $Day3),
        ],
        [
            $telegram->buildInlineKeyBoardButton("$dayharfi8[weekday] ($dayharfi8[mday])", $url = '', $callback_data = "zaman" . $Day8),
            $telegram->buildInlineKeyBoardButton("$dayharfi7[weekday] ($dayharfi7[mday])", $url = '', $callback_data = "zaman" . $Day7),
            $telegram->buildInlineKeyBoardButton("$dayharfi6[weekday] ($dayharfi6[mday])", $url = '', $callback_data = "zaman" . $Day6),
        ],
        [
            $telegram->buildInlineKeyBoardButton("بازگشت به منوی اصلی", $url = '', $callback_data = 'callstart'),
        ],
    ];

    $keyb = $telegram->buildInlineKeyBoard($option);
    $telegram->editMessageText(array('chat_id' => $chat_id, 'message_id' => $callbackmessage_id, 'reply_markup' => $keyb, 'text' => "روز مورد نظر را انتخاب کنید  " . tr_num("$dayharfi1[month]  $dayharfi1[year]", 'fa') ));
}
elseif (stristr($text, 'zaman') == true) {
    $getDateEN = explode("zaman", $text, 2);
    $ENDATE = $getDateEN[1];

    $firstdate = date_create("$ENDATE");
    date_add($firstdate,date_interval_create_from_date_string("-1 days"));
    $ENDATEPre =  date_format($firstdate,"Y-m-d");

    $Parts = explode('-', $ENDATE, 3);
    $TimeStamp = mktime(0, 0, 0, $Parts[1], $Parts[2], $Parts[0]);
    $dayharfi = jgetdate($TimeStamp);
    $dateharfi = tr_num(($dayharfi[weekday] . " " . $dayharfi[mday] . " " . $dayharfi[month] . " " . $dayharfi[year]), 'fa');

    $scheduleurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/schedulemodule/schedule?from=" . $ENDATEPre . "T19:30:00.000Z&to=" . $ENDATE . "T19:30:00.000Z";
    $schedulerequest = file_get_contents($scheduleurl);
    $schedulearrayMessage = json_decode($schedulerequest, true);
    $scheduleItemID = $schedulearrayMessage['details']['list']['0']['scheduleItemID'];

    if (is_numeric($scheduleItemID) == "1") {
        $FileName = "myFile" . $chat_id . ".txt";
        $FileHandle = fopen($FileName, 'a') or die("can't open file");
        $stringData = "بچه ﻫﺎی ﻣﻦ و ﺗﻮ @BachehayeManotoBot\nﺑﺮﻧﺎﻣﻪ ﻫﺎی من و تو در تاریخ " . '*' . $dateharfi . '*' . "\n\n";
        fwrite($FileHandle, $stringData);
        fclose($FileHandle);
        $number = 0;
        do {

            $dateUTC = $schedulearrayMessage['details']['list'][$number]['dateUTCRoundedDownToFiveMinutes'];
            $showTitle = $schedulearrayMessage['details']['list'][$number]['showTitle'];
            $episodeNumberen = $schedulearrayMessage['details']['list'][$number]['episodeNumber'];
            $seasonNumberen = $schedulearrayMessage['details']['list'][$number]['seasonNumber'];
            $showID = $schedulearrayMessage['details']['list'][$number]['showID'];
            $episodeID = $schedulearrayMessage['details']['list'][$number]['episodeID'];
            #$schedulecurrentHouseNumber = $schedulearrayMessage['details']['list'][$number]['currentHouseNumber'];
            #$portraitImgIxUrl = $schedulearrayMessage['details']['list'][$number]['portraitImgIxUrl'];

            $time1 = explode("T", $dateUTC, 2);
            $time = explode(":", $time1[1], 3);
            $hour = $time[0];
            $minute = $time[1];

            $Snum = strlen($seasonNumberen);
            if ($Snum < 1 == true) {
                $ses = "";
            }
            if ($Snum > 0 == true) {
                $seasonNumber = tr_num($seasonNumberen, 'fa');
                $ses = "ﻓﺼﻞ " . $seasonNumber;
            }

            $Enum = strlen($episodeNumberen);
            if ($Enum < 1 == true) {
                $epi = " ";
            }
            if ($Enum > 0 == true) {
                $episodeNumber = tr_num($episodeNumberen, 'fa');
                $epi = "ﻗﺴﻤﺖ " . $episodeNumber;

            }

            $timestamp = mktime($hour, $minute, 00, $Month, $Day, $Year);
            $newdate = $timestamp + 16200;
            $result = date("H:i", $newdate);
            $TimeFA = tr_num($result, 'fa');

            $Shownum = strlen($showTitle);
            if ($Shownum < 1 == true) {
                $stringData = "";
            }
            if ($Shownum > 0 == true) {
                $showlink = "https://www.manototv.com/show/" . $showID;
                $episodelink = "https://www.manototv.com/episode/" . $episodeID;
                $stringData ="*" . $TimeFA . "*" . "\t\t" . "[" . $showTitle . "](" . $showlink . ") " . "\t\t\t" . $ses . "\t\t\t"  . "[" . $epi . "](" . $episodelink . ")\n";
            }

            $FileName = "myFile" . $chat_id . ".txt";
            $FileHandle = fopen($FileName, 'a') or die("can't open file");
            fwrite($FileHandle, $stringData);
            fclose($FileHandle);

            $number = $number + 1;
        } while ($number < 30);

        $FileName = "myFile" . $chat_id . ".txt";
        $sch2send = file_get_contents($FileName);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $sch2send, 'parse_mode' => 'Markdown', 'disable_web_page_preview' => "true"]);
        unlink($FileName);
    } else {
        $telegram->answerCallbackQuery(['callback_query_id' => $telegram->Callback_ID(), 'text' => "اطلاعات در دسترس نیست", 'show_alert' => true]);
    }

}
elseif ($text == 'last') {
    $lasturl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/homemodule/catchupepsiodes";
    $lastrequest = file_get_contents($lasturl);
    $lastarrayMessage = json_decode($lastrequest, true);

    $number = 0;
    do {
        $lastformattedEpisodeTitle = $lastarrayMessage['details']['list'][$number]['formattedEpisodeTitle'];
        $lastepisodeNumber = $lastarrayMessage['details']['list'][$number]['episodeNumber'];
        $lastlandscapeImgIxUrl = $lastarrayMessage['details']['list'][$number]['landscapeImgIxUrl'];
        $lastid = $lastarrayMessage['details']['list'][$number]['id'];
        $lastshowID = $lastarrayMessage['details']['list'][$number]['showID'];
        $lastepisodeDateUTC = $lastarrayMessage['details']['list'][$number]['episodeDateUTC'];
        $lastgetdate1 = explode("T", $lastepisodeDateUTC, 2);
        $lastgetdate2 = explode("-", $lastgetdate1[0], 3);
        $lastshowtime = gregorian_to_jalali($lastgetdate2[0], $lastgetdate2[1], $lastgetdate2[2], '-');
        $lastshowtimefa = tr_num($lastshowtime, 'fa');
        $showon = explode("-", $lastshowtimefa, 3);
        $lastcaption = ("@BachehayeManotoBot\n" . $lastformattedEpisodeTitle . "\nتاریخ پخش  " . $showon[2] . " " . $showon[1] . " " . $showon[0]);
        $arrayMessage = json_decode(file_get_contents("https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/episodedetails?id=$lastid"), true);
        $videoDownloadUrl = $arrayMessage['details']['videoDownloadUrl'];

        if (stristr($videoDownloadUrl, 'http') == true)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton("صفحه برنامه در سایت", $url = "https://www.manototv.com/show/" . $lastshowID),
                    $telegram->buildInlineKeyBoardButton("دیدن در سایت", $url = "https://www.manototv.com/episode/" . $lastid),
                ],
                [
                    $telegram->buildInlineKeyBoardButton('توضیحات برنامه', $url = '', $callback_data = "showdetail"),
                    $telegram->buildInlineKeyBoardButton('توضیحات قسمت', $url = '', $callback_data = "episodedetail"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton('دانلود', $url = '', $callback_data = "file=video=" . $lastid),
                ],
            ];
        }
        else
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton("صفحه برنامه در سایت", $url = "https://www.manototv.com/show/" . $lastshowID),
                    $telegram->buildInlineKeyBoardButton("دیدن در سایت", $url = "https://www.manototv.com/episode/" . $lastid),
                ],
                [
                    $telegram->buildInlineKeyBoardButton('توضیحات برنامه', $url = '', $callback_data = "showdetail"),
                    $telegram->buildInlineKeyBoardButton('توضیحات قسمت', $url = '', $callback_data = "episodedetail"),
                ],
            ];
        }

        $keyb = $telegram->buildInlineKeyBoard($option);
        $telegram->sendPhoto(['chat_id' => $chat_id, 'reply_markup' => $keyb, 'photo' => $lastlandscapeImgIxUrl, 'caption' => $lastcaption]);

        $number = $number + 1;
    } while ($number < 3);
    $option1 = [
        [
            $telegram->buildInlineKeyBoardButton('View More', $url = '', $callback_data = "last20"),
        ],
    ];

    $keyb1 = $telegram->buildInlineKeyBoard($option1);
    $telegram->sendMessage(['chat_id' => $chat_id, 'reply_markup' => $keyb1, 'text' => "ﺑﺮای دیدن 20 ﺑﺮﻧﺎﻣﻪ اخیر دکمه زیر را ﻟﻤﺲ کنید"]);
}
elseif ($text == "last20") # 20 More Episode
{
    $telegram->deleteMessage(['chat_id' => $chat_id, 'message_id' => $message_id]);
    $lasturl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/homemodule/catchupepsiodes";
    $lastrequest = file_get_contents($lasturl);
    $lastarrayMessage = json_decode($lastrequest, true);

    $number = 3;
    do {
        $lastformattedEpisodeTitle = $lastarrayMessage['details']['list'][$number]['formattedEpisodeTitle'];
        $lastepisodeNumber = $lastarrayMessage['details']['list'][$number]['episodeNumber'];
        $lastlandscapeImgIxUrl = $lastarrayMessage['details']['list'][$number]['landscapeImgIxUrl'];
        $lastid = $lastarrayMessage['details']['list'][$number]['id'];
        $lastshowID = $lastarrayMessage['details']['list'][$number]['showID'];
        $lastepisodeDateUTC = $lastarrayMessage['details']['list'][$number]['episodeDateUTC'];
        $lastgetdate1 = explode("T", $lastepisodeDateUTC, 2);
        $lastgetdate2 = explode("-", $lastgetdate1[0], 3);
        $lastshowtime = gregorian_to_jalali($lastgetdate2[0], $lastgetdate2[1], $lastgetdate2[2], '-');
        $lastshowtimefa = tr_num($lastshowtime, 'fa');
        $showon = explode("-", $lastshowtimefa, 3);
        $lastcaption = ("@BachehayeManotoBot\n" . $lastformattedEpisodeTitle . "\nتاریخ پخش  " . $showon[2] . " " . $showon[1] . " " . $showon[0]);
        $arrayMessage = json_decode(file_get_contents("https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/episodedetails?id=$lastid"), true);
        $videoDownloadUrl = $arrayMessage['details']['videoDownloadUrl'];

        if (stristr($videoDownloadUrl, 'http') == true)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton("صفحه برنامه در سایت", $url = "https://www.manototv.com/show/" . $lastshowID),
                    $telegram->buildInlineKeyBoardButton("دیدن در سایت", $url = "https://www.manototv.com/episode/" . $lastid),
                ],
                [
                    $telegram->buildInlineKeyBoardButton('توضیحات برنامه', $url = '', $callback_data = "showdetail"),
                    $telegram->buildInlineKeyBoardButton('توضیحات قسمت', $url = '', $callback_data = "episodedetail"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton('دانلود', $url = '', $callback_data = "file=video=" . $lastid),
                ],
            ];
        }
        else
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton("صفحه برنامه در سایت", $url = "https://www.manototv.com/show/" . $lastshowID),
                    $telegram->buildInlineKeyBoardButton("دیدن در سایت", $url = "https://www.manototv.com/episode/" . $lastid),
                ],
                [
                    $telegram->buildInlineKeyBoardButton('توضیحات برنامه', $url = '', $callback_data = "showdetail"),
                    $telegram->buildInlineKeyBoardButton('توضیحات قسمت', $url = '', $callback_data = "episodedetail"),
                ],
            ];
        }

        $keyb = $telegram->buildInlineKeyBoard($option);
        $telegram->sendPhoto(['chat_id' => $chat_id, 'reply_markup' => $keyb, 'photo' => $lastlandscapeImgIxUrl, 'caption' => $lastcaption]);

        $number = $number + 1;
    } while ($number < 20);
}
elseif ($text == 'news') {
    $newsapi = "https://dr905zevbmkvz.cloudfront.net/api/v1/publicrole/newsmodule/banner";
    $newsrequest = file_get_contents($newsapi);
    $newsarrayMessage = json_decode($newsrequest, true);
    $headline = $newsarrayMessage['details']['headline'];
    $newsstrapline1 = $newsarrayMessage['details']['strapline1'];
    $newslandscapeImgIxUrl = $newsarrayMessage['details']['landscapeImgIxUrl'];
    #$newslandscapeImgIxUrl = str_replace("https", "http", $newslandscapeImgIxUrl);

    copy($newslandscapeImgIxUrl, "newsbanner.jpeg");
    $filejpeg = new CURLFile("newsbanner.jpeg");

    $newsvideoapi = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/newsmodule/newsvideo";
    $newsvideorequest = file_get_contents($newsvideoapi);
    $newsvideoarrayMessage = json_decode($newsvideorequest, true);
    $newsvideoDownloadUrl = $newsvideoarrayMessage['details']['videoDownloadUrl'];
    #$telegram->sendMessage(['chat_id' => $chat_id, 'text' => $newsvideoDownloadUrl]);

    $option = [
        [
            $telegram->buildInlineKeyBoardButton("صفحه برنامه در سایت", $url = "https://www.manototv.com/news"),
        ],
        [
            $telegram->buildInlineKeyBoardButton('دانلود', $url = '', $callback_data = "file=news=000"),
        ],

    ];
    $keyb = $telegram->buildInlineKeyBoard($option);
    $telegram->sendPhoto(['chat_id' => $chat_id, 'reply_markup' => $keyb, 'photo' => $newslandscapeImgIxUrl, 'caption' => "@BachehayeManotoBot\n" . $headline . " " . $newsstrapline1, 'parse_mode' => 'HTML']);
    unlink("newsbanner.jpeg");
}
elseif ($text == 'frequency') {
    $file = new CURLFile("Manotofrequency.jpg");
    #$file = "AgACAgQAAxkBAAIU7V5PFnpf0aiNtDUYmaI6n199deNrAAI-sTEbIeZ4UmnbAzoTL6FTnZmgGwAEAQADAgADbQADPcYHAAEYBA";
    $telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $file, 'caption' => "@BachehayeManotoBot"]);

}
elseif ($text == "episodedetail") # Episode Detail
{
    $getepisodeid = explode("episode/", $callbackurlepisode, 2);

    $episodeurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/episodedetails?id=" . $getepisodeid[1];
    $episoderequest = file_get_contents($episodeurl);
    $episodearrayMessage = json_decode($episoderequest, true);
    $episodeformattedEpisodeTitle = $episodearrayMessage['details']['formattedEpisodeTitle'];
    $episodelandscapeImgIxUrl = $episodearrayMessage['details']['episodelandscapeImgIxUrl'];
    $episodevideoM3u8Url = $episodearrayMessage['details']['videoM3u8Url'];
    $episodeshowID = $episodearrayMessage['details']['showID'];
    $episodeDescription = $episodearrayMessage['details']['episodeDescription'];
    $status = $episodearrayMessage['status'];

    $Description1 = strip_tags($episodeDescription);
    $Description2 = str_replace("&laquo;", "", $Description1);
    $Description3 = str_replace("&zwnj;", " ", $Description2);
    $Description4 = str_replace("&raquo;", "", $Description3);
    $Description5 = str_replace("&nbsp;", " ", $Description4);
    $Description = ("@BachehayeManotoBot\n" . '<b>' . $episodeformattedEpisodeTitle . '</b>' . "\n" . $Description5);

    if ($status == 1) {
        if (stristr($episodelandscapeImgIxUrl, "autogenerated") == true) {
            $imgurl = explode("_", $episodelandscapeImgIxUrl, 2);

            if (stristr($episodelandscapeImgIxUrl, "png") == true) {
                $ext = ".png";
            } elseif (stristr($episodelandscapeImgIxUrl, "jpg") == true) {
                $ext = ".jpg";
            } elseif (stristr($episodelandscapeImgIxUrl, "jpeg") == true) {
                $ext = ".jpeg";
            }
            $telegram->sendMediaGroup(array('chat_id' => $chat_id, 'reply_to_message_id' => $callbackmessage_id, 'parse_mode' => 'HTML', 'media' => json_encode([
                ['type' => 'photo', media => $imgurl[0] . '_00034' . $ext],
                ['type' => 'photo', media => $imgurl[0] . '_00035' . $ext],
                ['type' => 'photo', media => $imgurl[0] . '_00036' . $ext],
                ['type' => 'photo', media => $imgurl[0] . '_00037' . $ext],
                ['type' => 'photo', media => $imgurl[0] . '_00038' . $ext],
                ['type' => 'photo', media => $imgurl[0] . '_00039' . $ext],
                ['type' => 'photo', media => $imgurl[0] . '_00040' . $ext],
                ['type' => 'photo', media => $imgurl[0] . '_00041' . $ext],
                ['type' => 'photo', media => $imgurl[0] . '_00042' . $ext],
                ['type' => 'photo', media => $imgurl[0] . '_00043' . $ext]
            ])
            ));
            $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $Description, 'parse_mode' => 'HTML']);
            #$telegram->sendMessage(['chat_id' => $chat_id, 'text' => $episodevideoM3u8Url, 'parse_mode' => 'HTML']);
        } else {
            #$telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $episodelandscapeImgIxUrl]);
            $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $Description, 'reply_to_message_id' => $callbackmessage_id, 'parse_mode' => 'HTML']);
            #$telegram->sendMessage(['chat_id' => $chat_id, 'text' => $episodevideoM3u8Url]);
        }
    }
    else {
        $telegram->answerCallbackQuery(['callback_query_id' => $telegram->Callback_ID(), 'text' => "اطلاعات در دسترس نیست", 'show_alert' => true]);
    }

}
elseif ($text == "showdetail") # Show Detail
{
    $getshowid = explode("show/", $callbackurlshow, 2);

    $showurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/details?id=" . $getshowid[1];
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
    $Description6 = strip_tags($showShortDescription);
    $Description = ("@BachehayeManotoBot\n" . '<b>' . $showTitle . '</b>' . "\n" . $Description6 . "\n" . $Description5);

    #$telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $showoverlayImgIxUrl]);
    $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $Description, 'reply_to_message_id' => $callbackmessage_id, 'parse_mode' => 'HTML']);
}
elseif (stristr($text, 'gnr') == true) # show show page
{
    $gnr = explode('gnr', $text);
    $url = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/list?sortBy=latest&genre=" . $gnr[0] . "&pageNumber=" . $gnr[1] . "&pageSize=21";
    $request = file_get_contents($url);
    $arrayMessage = json_decode($request, true);
    #$resultsCount = $arrayMessage['details']['resultsCount'];

    $id0 = $arrayMessage['details']['list']['0']['id'];
    $id1 = $arrayMessage['details']['list']['1']['id'];
    $id2 = $arrayMessage['details']['list']['2']['id'];
    $id3 = $arrayMessage['details']['list']['3']['id'];
    $id4 = $arrayMessage['details']['list']['4']['id'];
    $id5 = $arrayMessage['details']['list']['5']['id'];
    $id6 = $arrayMessage['details']['list']['6']['id'];
    $id7 = $arrayMessage['details']['list']['7']['id'];
    $id8 = $arrayMessage['details']['list']['8']['id'];
    $id9 = $arrayMessage['details']['list']['9']['id'];
    $id10 = $arrayMessage['details']['list']['10']['id'];
    $id11 = $arrayMessage['details']['list']['11']['id'];
    $id12 = $arrayMessage['details']['list']['12']['id'];
    $id13 = $arrayMessage['details']['list']['13']['id'];
    $id14 = $arrayMessage['details']['list']['14']['id'];
    $id15 = $arrayMessage['details']['list']['15']['id'];
    $id16 = $arrayMessage['details']['list']['16']['id'];
    $id17 = $arrayMessage['details']['list']['17']['id'];
    $id18 = $arrayMessage['details']['list']['18']['id'];
    $id19 = $arrayMessage['details']['list']['19']['id'];
    $id20 = $arrayMessage['details']['list']['20']['id'];

    $formattedShowTitle0 = $arrayMessage['details']['list']['0']['formattedShowTitle'];
    $formattedShowTitle1 = $arrayMessage['details']['list']['1']['formattedShowTitle'];
    $formattedShowTitle2 = $arrayMessage['details']['list']['2']['formattedShowTitle'];
    $formattedShowTitle3 = $arrayMessage['details']['list']['3']['formattedShowTitle'];
    $formattedShowTitle4 = $arrayMessage['details']['list']['4']['formattedShowTitle'];
    $formattedShowTitle5 = $arrayMessage['details']['list']['5']['formattedShowTitle'];
    $formattedShowTitle6 = $arrayMessage['details']['list']['6']['formattedShowTitle'];
    $formattedShowTitle7 = $arrayMessage['details']['list']['7']['formattedShowTitle'];
    $formattedShowTitle8 = $arrayMessage['details']['list']['8']['formattedShowTitle'];
    $formattedShowTitle9 = $arrayMessage['details']['list']['9']['formattedShowTitle'];
    $formattedShowTitle10 = $arrayMessage['details']['list']['10']['formattedShowTitle'];
    $formattedShowTitle11 = $arrayMessage['details']['list']['11']['formattedShowTitle'];
    $formattedShowTitle12 = $arrayMessage['details']['list']['12']['formattedShowTitle'];
    $formattedShowTitle13 = $arrayMessage['details']['list']['13']['formattedShowTitle'];
    $formattedShowTitle14 = $arrayMessage['details']['list']['14']['formattedShowTitle'];
    $formattedShowTitle15 = $arrayMessage['details']['list']['15']['formattedShowTitle'];
    $formattedShowTitle16 = $arrayMessage['details']['list']['16']['formattedShowTitle'];
    $formattedShowTitle17 = $arrayMessage['details']['list']['17']['formattedShowTitle'];
    $formattedShowTitle18 = $arrayMessage['details']['list']['18']['formattedShowTitle'];
    $formattedShowTitle19 = $arrayMessage['details']['list']['19']['formattedShowTitle'];
    $formattedShowTitle20 = $arrayMessage['details']['list']['20']['formattedShowTitle'];
    $number = $number + 1;

    $option = [
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle2 . " ", $url = '', $callback_data = $id2 . 'showsid'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle1 . " ", $url = '', $callback_data = $id1 . 'showsid'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle0 . " ", $url = '', $callback_data = $id0 . 'showsid'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle5 . " ", $url = '', $callback_data = $id5 . 'showsid'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle4 . " ", $url = '', $callback_data = $id4 . 'showsid'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle3 . " ", $url = '', $callback_data = $id3 . 'showsid'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle8 . " ", $url = '', $callback_data = $id8 . 'showsid'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle7 . " ", $url = '', $callback_data = $id7 . 'showsid'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle6 . " ", $url = '', $callback_data = $id6 . 'showsid'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle11 . " ", $url = '', $callback_data = $id11 . 'showsid'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle10 . " ", $url = '', $callback_data = $id10 . 'showsid'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle9 . " ", $url = '', $callback_data = $id9 . 'showsid'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle14 . " ", $url = '', $callback_data = $id14 . 'showsid'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle13 . " ", $url = '', $callback_data = $id13 . 'showsid'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle12 . " ", $url = '', $callback_data = $id12 . 'showsid'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle17 . " ", $url = '', $callback_data = $id17 . 'showsid'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle16 . " ", $url = '', $callback_data = $id16 . 'showsid'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle15 . " ", $url = '', $callback_data = $id15 . 'showsid'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle20 . " ", $url = '', $callback_data = $id20 . 'showsid'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle19 . " ", $url = '', $callback_data = $id19 . 'showsid'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle18 . " ", $url = '', $callback_data = $id18 . 'showsid'),
        ],
        [
            $telegram->buildInlineKeyBoardButton("صفحه ۵", $url = '', $callback_data = $gnr[0] . 'GNR5'),
            $telegram->buildInlineKeyBoardButton("صفحه ۴", $url = '', $callback_data = $gnr[0] . 'GNR4'),
            $telegram->buildInlineKeyBoardButton("صفحه ۳", $url = '', $callback_data = $gnr[0] . 'GNR3'),
            $telegram->buildInlineKeyBoardButton("صفحه ۲", $url = '', $callback_data = $gnr[0] . 'GNR2'),
            $telegram->buildInlineKeyBoardButton("صفحه ۱", $url = '', $callback_data = $gnr[0] . 'GNR1'),
        ],
        [
            $telegram->buildInlineKeyBoardButton("صفحه ۱۰", $url = '', $callback_data = $gnr[0] . 'GNR10'),
            $telegram->buildInlineKeyBoardButton("صفحه ۹", $url = '', $callback_data = $gnr[0] . 'GNR9'),
            $telegram->buildInlineKeyBoardButton("صفحه ۸", $url = '', $callback_data = $gnr[0] . 'GNR8'),
            $telegram->buildInlineKeyBoardButton("صفحه ۷", $url = '', $callback_data = $gnr[0] . 'GNR7'),
            $telegram->buildInlineKeyBoardButton("صفحه ۶", $url = '', $callback_data = $gnr[0] . 'GNR6'),
        ],
        [
            $telegram->buildInlineKeyBoardButton("بازگشت به منوی اصلی", $url = '', $callback_data = 'callstart'),
            $telegram->buildInlineKeyBoardButton("ژانرها", $url = '', $callback_data = 'genres'),
        ],
    ];
    $P = $gnr[1];
    $PN = tr_num($P, 'fa');
    $keyb = $telegram->buildInlineKeyBoard($option);
    $telegram->editMessageText(array('chat_id' => $chat_id, 'message_id' => $callbackmessage_id, 'reply_markup' => $keyb, 'text' => "برنامه موردنظرتون رو انتخاب کنید - صفحه " . $PN));
}
elseif (stristr($text, 'showsid') == true) {
    $getshowid = explode('showsid', $text);
    #$N = explode('-', $getshowid[1]);
    #$request = file_get_contents("php://input");
    #$arrayMessage = json_decode($request, true);
    #$Buttontext = $arrayMessage['callback_query']['message']['reply_markup']['inline_keyboard'][$N[0]][$N[1]]['text'];
    #$getshowid = explode("ID", $Buttontext, 2);
    $showurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/details?id=" . $getshowid[0];
    $showrequest = file_get_contents($showurl);
    $showarrayMessage = json_decode($showrequest, true);
    $showTitle = $showarrayMessage['details']['showTitle'];
    $showoverlayImgIxUrl = $showarrayMessage['details']['overlayImgIxUrl'];
    $showShortDescription = $showarrayMessage['details']['showShortDescription'];
    $ShortDescription = strip_tags($showShortDescription);
    $caption = ("@BachehayeManotoBot\n" . '<b>' . $showTitle . '</b>' . "\n" . $ShortDescription);

    $serieurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/serieslist?id=" . $getshowid[0];
    $serierequest = file_get_contents($serieurl);
    $seriearrayMessage = json_decode($serierequest, true);
    $serieList = $seriearrayMessage['details']['list'];
    $tedadserie = count($serieList);
    $vtsturl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/videocliplist?id=" . $getshowid[0];
    $vtsrequest = file_get_contents($vtsturl);
    $vtstarrayMessage = json_decode($vtsrequest, true);
    $vtsid = $vtstarrayMessage['details']['list']['0']['id'];
    $countserie = count($serieList);
    $serieTitle = [];
    $serieID = [];
    for ($p = 0; $p < $countserie; $p++)
    {
        $serieTitle[] = $seriearrayMessage['details']['list'][$p]['displayTitle'];
        $serieID[] = $seriearrayMessage['details']['list'][$p]['id'];
    }
    if (is_numeric($vtsid) == "1")
    {
        if ($tedadserie == 1)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton("دیدن در سایت", $url = "https://www.manototv.com/show/" . $getshowid[0]),
                    $telegram->buildInlineKeyBoardButton('توضیحات', $url = '', $callback_data = "showdetail"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[0]", $url = '', $callback_data = "Serielist" . $serieID[0]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("ویدیوهای کوتاه", $url = '', $callback_data = "vts" . $getshowid[0]),
                ],
            ];
        }
        elseif ($tedadserie == 2)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton("دیدن در سایت", $url = "https://www.manototv.com/show/" . $getshowid[0]),
                    $telegram->buildInlineKeyBoardButton('توضیحات', $url = '', $callback_data = "showdetail"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[0]", $url = '', $callback_data = "Serielist" . $serieID[0]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[1]", $url = '', $callback_data = "Serielist" . $serieID[1]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("ویدیوهای کوتاه", $url = '', $callback_data = "vts" . $getshowid[0]),
                ],
            ];
        }
        elseif ($tedadserie == 3)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton("دیدن در سایت", $url = "https://www.manototv.com/show/" . $getshowid[0]),
                    $telegram->buildInlineKeyBoardButton('توضیحات', $url = '', $callback_data = "showdetail"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[0]", $url = '', $callback_data = "Serielist" . $serieID[0]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[1]", $url = '', $callback_data = "Serielist" . $serieID[1]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[2]", $url = '', $callback_data = "Serielist" . $serieID[2]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("ویدیوهای کوتاه", $url = '', $callback_data = "vts" . $getshowid[0]),
                ],
            ];
        }
        elseif ($tedadserie == 4)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton("دیدن در سایت", $url = "https://www.manototv.com/show/" . $getshowid[0]),
                    $telegram->buildInlineKeyBoardButton('توضیحات', $url = '', $callback_data = "showdetail"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[2]", $url = '', $callback_data = "Serielist" . $serieID[2]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[3]", $url = '', $callback_data = "Serielist" . $serieID[3]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[0]", $url = '', $callback_data = "Serielist" . $serieID[0]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[1]", $url = '', $callback_data = "Serielist" . $serieID[1]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("ویدیوهای کوتاه", $url = '', $callback_data = "vts" . $getshowid[0]),
                ],
            ];
        }
        elseif ($tedadserie == 5)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton("دیدن در سایت", $url = "https://www.manototv.com/show/" . $getshowid[0]),
                    $telegram->buildInlineKeyBoardButton('توضیحات', $url = '', $callback_data = "showdetail"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[3]", $url = '', $callback_data = "Serielist" . $serieID[3]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[4]", $url = '', $callback_data = "Serielist" . $serieID[4]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[0]", $url = '', $callback_data = "Serielist" . $serieID[0]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[1]", $url = '', $callback_data = "Serielist" . $serieID[1]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[2]", $url = '', $callback_data = "Serielist" . $serieID[2]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("ویدیوهای کوتاه", $url = '', $callback_data = "vts" . $getshowid[0]),
                ],
            ];
        }
        elseif ($tedadserie == 6)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton("دیدن در سایت", $url = "https://www.manototv.com/show/" . $getshowid[0]),
                    $telegram->buildInlineKeyBoardButton('توضیحات', $url = '', $callback_data = "showdetail"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[3]", $url = '', $callback_data = "Serielist" . $serieID[3]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[4]", $url = '', $callback_data = "Serielist" . $serieID[4]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[5]", $url = '', $callback_data = "Serielist" . $serieID[5]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[0]", $url = '', $callback_data = "Serielist" . $serieID[0]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[1]", $url = '', $callback_data = "Serielist" . $serieID[1]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[2]", $url = '', $callback_data = "Serielist" . $serieID[2]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("ویدیوهای کوتاه", $url = '', $callback_data = "vts" . $getshowid[0]),
                ],
            ];
        }
        elseif ($tedadserie == 7)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton("دیدن در سایت", $url = "https://www.manototv.com/show/" . $getshowid[0]),
                    $telegram->buildInlineKeyBoardButton('توضیحات', $url = '', $callback_data = "showdetail"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[6]", $url = '', $callback_data = "Serielist" . $serieID[6]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[3]", $url = '', $callback_data = "Serielist" . $serieID[3]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[4]", $url = '', $callback_data = "Serielist" . $serieID[4]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[5]", $url = '', $callback_data = "Serielist" . $serieID[5]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[0]", $url = '', $callback_data = "Serielist" . $serieID[0]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[1]", $url = '', $callback_data = "Serielist" . $serieID[1]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[2]", $url = '', $callback_data = "Serielist" . $serieID[2]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("ویدیوهای کوتاه", $url = '', $callback_data = "vts" . $getshowid[0]),
                ],
            ];
        }
        elseif ($tedadserie == 8)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton("دیدن در سایت", $url = "https://www.manototv.com/show/" . $getshowid[0]),
                    $telegram->buildInlineKeyBoardButton('توضیحات', $url = '', $callback_data = "showdetail"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[6]", $url = '', $callback_data = "Serielist" . $serieID[6]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[7]", $url = '', $callback_data = "Serielist" . $serieID[7]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[3]", $url = '', $callback_data = "Serielist" . $serieID[3]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[4]", $url = '', $callback_data = "Serielist" . $serieID[4]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[5]", $url = '', $callback_data = "Serielist" . $serieID[5]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[0]", $url = '', $callback_data = "Serielist" . $serieID[0]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[1]", $url = '', $callback_data = "Serielist" . $serieID[1]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[2]", $url = '', $callback_data = "Serielist" . $serieID[2]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("ویدیوهای کوتاه", $url = '', $callback_data = "vts" . $getshowid[0]),
                ],
            ];
        }
        elseif ($tedadserie >= 9)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton("دیدن در سایت", $url = "https://www.manototv.com/show/" . $getshowid[0]),
                    $telegram->buildInlineKeyBoardButton('توضیحات', $url = '', $callback_data = "showdetail"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[6]", $url = '', $callback_data = "Serielist" . $serieID[6]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[7]", $url = '', $callback_data = "Serielist" . $serieID[7]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[8]", $url = '', $callback_data = "Serielist" . $serieID[8]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[3]", $url = '', $callback_data = "Serielist" . $serieID[3]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[4]", $url = '', $callback_data = "Serielist" . $serieID[4]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[5]", $url = '', $callback_data = "Serielist" . $serieID[5]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[0]", $url = '', $callback_data = "Serielist" . $serieID[0]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[1]", $url = '', $callback_data = "Serielist" . $serieID[1]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[2]", $url = '', $callback_data = "Serielist" . $serieID[2]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("ویدیوهای کوتاه", $url = '', $callback_data = "vts" . $getshowid[0]),
                ],
            ];
        }
    }
    else
    {
        if ($tedadserie == 1)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton("دیدن در سایت", $url = "https://www.manototv.com/show/" . $getshowid[0]),
                    $telegram->buildInlineKeyBoardButton('توضیحات', $url = '', $callback_data = "showdetail"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[0]", $url = '', $callback_data = "Serielist" . $serieID[0]),
                ],
            ];
        }
        elseif ($tedadserie == 2)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton("دیدن در سایت", $url = "https://www.manototv.com/show/" . $getshowid[0]),
                    $telegram->buildInlineKeyBoardButton('توضیحات', $url = '', $callback_data = "showdetail"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[0]", $url = '', $callback_data = "Serielist" . $serieID[0]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[1]", $url = '', $callback_data = "Serielist" . $serieID[1]),
                ],
            ];
        }
        elseif ($tedadserie == 3)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton("دیدن در سایت", $url = "https://www.manototv.com/show/" . $getshowid[0]),
                    $telegram->buildInlineKeyBoardButton('توضیحات', $url = '', $callback_data = "showdetail"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[0]", $url = '', $callback_data = "Serielist" . $serieID[0]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[1]", $url = '', $callback_data = "Serielist" . $serieID[1]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[2]", $url = '', $callback_data = "Serielist" . $serieID[2]),
                ],
            ];
        }
        elseif ($tedadserie == 4)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton("دیدن در سایت", $url = "https://www.manototv.com/show/" . $getshowid[0]),
                    $telegram->buildInlineKeyBoardButton('توضیحات', $url = '', $callback_data = "showdetail"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[2]", $url = '', $callback_data = "Serielist" . $serieID[2]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[3]", $url = '', $callback_data = "Serielist" . $serieID[3]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[0]", $url = '', $callback_data = "Serielist" . $serieID[0]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[1]", $url = '', $callback_data = "Serielist" . $serieID[1]),
                ],
            ];
        }
        elseif ($tedadserie == 5)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton("دیدن در سایت", $url = "https://www.manototv.com/show/" . $getshowid[0]),
                    $telegram->buildInlineKeyBoardButton('توضیحات', $url = '', $callback_data = "showdetail"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[3]", $url = '', $callback_data = "Serielist" . $serieID[3]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[4]", $url = '', $callback_data = "Serielist" . $serieID[4]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[0]", $url = '', $callback_data = "Serielist" . $serieID[0]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[1]", $url = '', $callback_data = "Serielist" . $serieID[1]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[2]", $url = '', $callback_data = "Serielist" . $serieID[2]),
                ],
            ];
        }
        elseif ($tedadserie == 6)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton("دیدن در سایت", $url = "https://www.manototv.com/show/" . $getshowid[0]),
                    $telegram->buildInlineKeyBoardButton('توضیحات', $url = '', $callback_data = "showdetail"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[3]", $url = '', $callback_data = "Serielist" . $serieID[3]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[4]", $url = '', $callback_data = "Serielist" . $serieID[4]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[5]", $url = '', $callback_data = "Serielist" . $serieID[5]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[0]", $url = '', $callback_data = "Serielist" . $serieID[0]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[1]", $url = '', $callback_data = "Serielist" . $serieID[1]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[2]", $url = '', $callback_data = "Serielist" . $serieID[2]),
                ],
            ];
        }
        elseif ($tedadserie == 7)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton("دیدن در سایت", $url = "https://www.manototv.com/show/" . $getshowid[0]),
                    $telegram->buildInlineKeyBoardButton('توضیحات', $url = '', $callback_data = "showdetail"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[6]", $url = '', $callback_data = "Serielist" . $serieID[6]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[3]", $url = '', $callback_data = "Serielist" . $serieID[3]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[4]", $url = '', $callback_data = "Serielist" . $serieID[4]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[5]", $url = '', $callback_data = "Serielist" . $serieID[5]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[0]", $url = '', $callback_data = "Serielist" . $serieID[0]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[1]", $url = '', $callback_data = "Serielist" . $serieID[1]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[2]", $url = '', $callback_data = "Serielist" . $serieID[2]),
                ],
            ];
        }
        elseif ($tedadserie == 8)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton("دیدن در سایت", $url = "https://www.manototv.com/show/" . $getshowid[0]),
                    $telegram->buildInlineKeyBoardButton('توضیحات', $url = '', $callback_data = "showdetail"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[6]", $url = '', $callback_data = "Serielist" . $serieID[6]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[7]", $url = '', $callback_data = "Serielist" . $serieID[7]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[3]", $url = '', $callback_data = "Serielist" . $serieID[3]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[4]", $url = '', $callback_data = "Serielist" . $serieID[4]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[5]", $url = '', $callback_data = "Serielist" . $serieID[5]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[0]", $url = '', $callback_data = "Serielist" . $serieID[0]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[1]", $url = '', $callback_data = "Serielist" . $serieID[1]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[2]", $url = '', $callback_data = "Serielist" . $serieID[2]),
                ],
            ];
        }
        elseif ($tedadserie >= 9)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton("دیدن در سایت", $url = "https://www.manototv.com/show/" . $getshowid[0]),
                    $telegram->buildInlineKeyBoardButton('توضیحات', $url = '', $callback_data = "showdetail"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[6]", $url = '', $callback_data = "Serielist" . $serieID[6]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[7]", $url = '', $callback_data = "Serielist" . $serieID[7]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[8]", $url = '', $callback_data = "Serielist" . $serieID[8]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[3]", $url = '', $callback_data = "Serielist" . $serieID[3]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[4]", $url = '', $callback_data = "Serielist" . $serieID[4]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[5]", $url = '', $callback_data = "Serielist" . $serieID[5]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("$serieTitle[0]", $url = '', $callback_data = "Serielist" . $serieID[0]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[1]", $url = '', $callback_data = "Serielist" . $serieID[1]),
                    $telegram->buildInlineKeyBoardButton("$serieTitle[2]", $url = '', $callback_data = "Serielist" . $serieID[2]),
                ],
            ];
        }
    }
    $keyb = $telegram->buildInlineKeyBoard($option);
    $telegram->sendPhoto(['chat_id' => $chat_id, 'reply_markup' => $keyb, 'photo' => $showoverlayImgIxUrl, 'caption' => $caption, 'reply_to_message_id' => $callbackmessage_id, 'parse_mode' => 'HTML']);
}
elseif (stristr($text, 'serielist') == true)
{
    $getshowid = explode('serielist', $text);
    $episodelisturl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/episodelist?id=" . $getshowid[1];
    $episodelistrequest = file_get_contents($episodelisturl);
    $episodelistarrayMessage = json_decode($episodelistrequest, true);
    $episodecount = $episodelistarrayMessage['details']['list'];
    $countepisode = count($episodecount);
    $EPTitle = [];
    $EPID = [];
    $formattedEpisodeTitle = [];
    if($getshowid[1] == 1309)
    {
        for ($p = 0; $p < $countepisode; $p++)
        {
            $EPTitle[] = $episodelistarrayMessage['details']['list'][$p]['episodeNumber'];
            $EPID[] = $episodelistarrayMessage['details']['list'][$p]['id'];
            $arrayMessage = json_decode(file_get_contents("https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/metadatamodule/pagetitle?url=https://www.manototv.com/episode/" . $episodelistarrayMessage['details']['list'][$p]['id']), true);
            $formattedEpisodeTitle[] = $arrayMessage['details']['pageTitle'];
        }
        $option = [
            [
                $telegram->buildInlineKeyBoardButton( "($EPTitle[18]) $formattedEpisodeTitle[18]" , $url = "", $callback_data ="ephls$EPID[18]"),
                $telegram->buildInlineKeyBoardButton( "($EPTitle[19]) $formattedEpisodeTitle[19]" , $url = "", $callback_data ="ephls$EPID[19]"),
            ],
            [
                $telegram->buildInlineKeyBoardButton( "($EPTitle[16]) $formattedEpisodeTitle[16]" , $url = "", $callback_data ="ephls$EPID[16]"),
                $telegram->buildInlineKeyBoardButton( "($EPTitle[17]) $formattedEpisodeTitle[17]" , $url = "", $callback_data ="ephls$EPID[17]"),
            ],
            [
                $telegram->buildInlineKeyBoardButton( "($EPTitle[14]) $formattedEpisodeTitle[14]" , $url = "", $callback_data ="ephls$EPID[14]"),
                $telegram->buildInlineKeyBoardButton( "($EPTitle[15]) $formattedEpisodeTitle[15]" , $url = "", $callback_data ="ephls$EPID[15]"),
            ],
            [
                $telegram->buildInlineKeyBoardButton( "($EPTitle[12]) $formattedEpisodeTitle[12]" , $url = "", $callback_data ="ephls$EPID[12]"),
                $telegram->buildInlineKeyBoardButton( "($EPTitle[13]) $formattedEpisodeTitle[13]" , $url = "", $callback_data ="ephls$EPID[13]"),
            ],
            [
                $telegram->buildInlineKeyBoardButton( "($EPTitle[10]) $formattedEpisodeTitle[10]" , $url = "", $callback_data ="ephls$EPID[10]"),
                $telegram->buildInlineKeyBoardButton( "($EPTitle[11]) $formattedEpisodeTitle[11]" , $url = "", $callback_data ="ephls$EPID[11]"),
            ],
            [
                $telegram->buildInlineKeyBoardButton( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "", $callback_data ="ephls$EPID[8]"),
                $telegram->buildInlineKeyBoardButton( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "", $callback_data ="ephls$EPID[9]"),
            ],
            [
                $telegram->buildInlineKeyBoardButton( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "", $callback_data ="ephls$EPID[6]"),
                $telegram->buildInlineKeyBoardButton( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "", $callback_data ="ephls$EPID[7]"),
            ],
            [
                $telegram->buildInlineKeyBoardButton( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "", $callback_data ="ephls$EPID[4]"),
                $telegram->buildInlineKeyBoardButton( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "", $callback_data ="ephls$EPID[5]"),
            ],
            [
                $telegram->buildInlineKeyBoardButton( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "", $callback_data ="ephls$EPID[2]"),
                $telegram->buildInlineKeyBoardButton( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "", $callback_data ="ephls$EPID[3]"),
            ],
            [
                $telegram->buildInlineKeyBoardButton( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "", $callback_data ="ephls$EPID[0]"),
                $telegram->buildInlineKeyBoardButton( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "", $callback_data ="ephls$EPID[1]"),
            ],
        ];
    }
    else
    {
        for ($p = 0; $p < $countepisode; $p++)
        {
            $EPTitle[] = $episodelistarrayMessage['details']['list'][$p]['episodeNumber'];
            $EPID[] = $episodelistarrayMessage['details']['list'][$p]['id'];
            $formattedEpisodeTitle[] = $episodelistarrayMessage['details']['list'][$p]['formattedEpisodeTitle'];
        }

        if ($countepisode == 1)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "", $callback_data ="ephls$EPID[0]"),
                ],
            ];
        }
        elseif ($countepisode == 2)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "", $callback_data ="ephls$EPID[0]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "", $callback_data ="ephls$EPID[1]"),
                ],
            ];
        }
        elseif ($countepisode == 3)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "", $callback_data ="ephls$EPID[0]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "", $callback_data ="ephls$EPID[1]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "", $callback_data ="ephls$EPID[2]"),
                ],
            ];
        }
        elseif ($countepisode == 4)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "", $callback_data ="ephls$EPID[2]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "", $callback_data ="ephls$EPID[3]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "", $callback_data ="ephls$EPID[0]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "", $callback_data ="ephls$EPID[1]"),
                ],
            ];
        }
        elseif ($countepisode == 5)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "", $callback_data ="ephls$EPID[3]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "", $callback_data ="ephls$EPID[4]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "", $callback_data ="ephls$EPID[0]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "", $callback_data ="ephls$EPID[1]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "", $callback_data ="ephls$EPID[2]"),
                ],
            ];
        }
        elseif ($countepisode == 6)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "", $callback_data ="ephls$EPID[3]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "", $callback_data ="ephls$EPID[4]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "", $callback_data ="ephls$EPID[5]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "", $callback_data ="ephls$EPID[0]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "", $callback_data ="ephls$EPID[1]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "", $callback_data ="ephls$EPID[2]"),
                ],
            ];
        }
        elseif ($countepisode == 7)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "", $callback_data ="ephls$EPID[6]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "", $callback_data ="ephls$EPID[3]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "", $callback_data ="ephls$EPID[4]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "", $callback_data ="ephls$EPID[5]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "", $callback_data ="ephls$EPID[0]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "", $callback_data ="ephls$EPID[1]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "", $callback_data ="ephls$EPID[2]"),
                ],
            ];
        }
        elseif ($countepisode == 8)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "", $callback_data ="ephls$EPID[6]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "", $callback_data ="ephls$EPID[7]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "", $callback_data ="ephls$EPID[3]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "", $callback_data ="ephls$EPID[4]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "", $callback_data ="ephls$EPID[5]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "", $callback_data ="ephls$EPID[0]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "", $callback_data ="ephls$EPID[1]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "", $callback_data ="ephls$EPID[2]"),
                ],
            ];
        }
        elseif ($countepisode == 9)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "", $callback_data ="ephls$EPID[6]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "", $callback_data ="ephls$EPID[7]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "", $callback_data ="ephls$EPID[8]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "", $callback_data ="ephls$EPID[3]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "", $callback_data ="ephls$EPID[4]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "", $callback_data ="ephls$EPID[5]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "", $callback_data ="ephls$EPID[0]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "", $callback_data ="ephls$EPID[1]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "", $callback_data ="ephls$EPID[2]"),
                ],
            ];
        }
        elseif ($countepisode == 10)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "", $callback_data ="ephls$EPID[9]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "", $callback_data ="ephls$EPID[6]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "", $callback_data ="ephls$EPID[7]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "", $callback_data ="ephls$EPID[8]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "", $callback_data ="ephls$EPID[3]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "", $callback_data ="ephls$EPID[4]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "", $callback_data ="ephls$EPID[5]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "", $callback_data ="ephls$EPID[0]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "", $callback_data ="ephls$EPID[1]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "", $callback_data ="ephls$EPID[2]"),
                ],
            ];
        }
        elseif ($countepisode == 11)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "", $callback_data ="ephls$EPID[9]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[10]) $formattedEpisodeTitle[10]" , $url = "", $callback_data ="ephls$EPID[10]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "", $callback_data ="ephls$EPID[6]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "", $callback_data ="ephls$EPID[7]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "", $callback_data ="ephls$EPID[8]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "", $callback_data ="ephls$EPID[3]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "", $callback_data ="ephls$EPID[4]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "", $callback_data ="ephls$EPID[5]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "", $callback_data ="ephls$EPID[0]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "", $callback_data ="ephls$EPID[1]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "", $callback_data ="ephls$EPID[2]"),
                ],
            ];
        }
        elseif ($countepisode == 12)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "", $callback_data ="ephls$EPID[9]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[10]) $formattedEpisodeTitle[10]" , $url = "", $callback_data ="ephls$EPID[10]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[11]) $formattedEpisodeTitle[11]" , $url = "", $callback_data ="ephls$EPID[11]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "", $callback_data ="ephls$EPID[6]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "", $callback_data ="ephls$EPID[7]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "", $callback_data ="ephls$EPID[8]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "", $callback_data ="ephls$EPID[3]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "", $callback_data ="ephls$EPID[4]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "", $callback_data ="ephls$EPID[5]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "", $callback_data ="ephls$EPID[0]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "", $callback_data ="ephls$EPID[1]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "", $callback_data ="ephls$EPID[2]"),
                ],
            ];
        }
        elseif ($countepisode == 13)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[12]) $formattedEpisodeTitle[12]" , $url = "", $callback_data ="ephls$EPID[12]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "", $callback_data ="ephls$EPID[9]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[10]) $formattedEpisodeTitle[10]" , $url = "", $callback_data ="ephls$EPID[10]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[11]) $formattedEpisodeTitle[11]" , $url = "", $callback_data ="ephls$EPID[11]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "", $callback_data ="ephls$EPID[6]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "", $callback_data ="ephls$EPID[7]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "", $callback_data ="ephls$EPID[8]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "", $callback_data ="ephls$EPID[3]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "", $callback_data ="ephls$EPID[4]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "", $callback_data ="ephls$EPID[5]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "", $callback_data ="ephls$EPID[0]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "", $callback_data ="ephls$EPID[1]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "", $callback_data ="ephls$EPID[2]"),
                ],
            ];
        }
        elseif ($countepisode == 14)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[12]) $formattedEpisodeTitle[12]" , $url = "", $callback_data ="ephls$EPID[12]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[13]) $formattedEpisodeTitle[13]" , $url = "", $callback_data ="ephls$EPID[13]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "", $callback_data ="ephls$EPID[9]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[10]) $formattedEpisodeTitle[10]" , $url = "", $callback_data ="ephls$EPID[10]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[11]) $formattedEpisodeTitle[11]" , $url = "", $callback_data ="ephls$EPID[11]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "", $callback_data ="ephls$EPID[6]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "", $callback_data ="ephls$EPID[7]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "", $callback_data ="ephls$EPID[8]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "", $callback_data ="ephls$EPID[3]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "", $callback_data ="ephls$EPID[4]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "", $callback_data ="ephls$EPID[5]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "", $callback_data ="ephls$EPID[0]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "", $callback_data ="ephls$EPID[1]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "", $callback_data ="ephls$EPID[2]"),
                ],
            ];
        }
        elseif ($countepisode == 15)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[12]) $formattedEpisodeTitle[12]" , $url = "", $callback_data ="ephls$EPID[12]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[13]) $formattedEpisodeTitle[13]" , $url = "", $callback_data ="ephls$EPID[13]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[14]) $formattedEpisodeTitle[14]" , $url = "", $callback_data ="ephls$EPID[14]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "", $callback_data ="ephls$EPID[9]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[10]) $formattedEpisodeTitle[10]" , $url = "", $callback_data ="ephls$EPID[10]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[11]) $formattedEpisodeTitle[11]" , $url = "", $callback_data ="ephls$EPID[11]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "", $callback_data ="ephls$EPID[6]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "", $callback_data ="ephls$EPID[7]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "", $callback_data ="ephls$EPID[8]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "", $callback_data ="ephls$EPID[3]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "", $callback_data ="ephls$EPID[4]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "", $callback_data ="ephls$EPID[5]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "", $callback_data ="ephls$EPID[0]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "", $callback_data ="ephls$EPID[1]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "", $callback_data ="ephls$EPID[2]"),
                ],
            ];
        }
        elseif ($countepisode == 16)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[15]) $formattedEpisodeTitle[15]" , $url = "", $callback_data ="ephls$EPID[15]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[12]) $formattedEpisodeTitle[12]" , $url = "", $callback_data ="ephls$EPID[12]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[13]) $formattedEpisodeTitle[13]" , $url = "", $callback_data ="ephls$EPID[13]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[14]) $formattedEpisodeTitle[14]" , $url = "", $callback_data ="ephls$EPID[14]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "", $callback_data ="ephls$EPID[9]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[10]) $formattedEpisodeTitle[10]" , $url = "", $callback_data ="ephls$EPID[10]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[11]) $formattedEpisodeTitle[11]" , $url = "", $callback_data ="ephls$EPID[11]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "", $callback_data ="ephls$EPID[6]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "", $callback_data ="ephls$EPID[7]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "", $callback_data ="ephls$EPID[8]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "", $callback_data ="ephls$EPID[3]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "", $callback_data ="ephls$EPID[4]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "", $callback_data ="ephls$EPID[5]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "", $callback_data ="ephls$EPID[0]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "", $callback_data ="ephls$EPID[1]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "", $callback_data ="ephls$EPID[2]"),
                ],
            ];
        }
        elseif ($countepisode == 17)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[15]) $formattedEpisodeTitle[15]" , $url = "", $callback_data ="ephls$EPID[15]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[16]) $formattedEpisodeTitle[16]" , $url = "", $callback_data ="ephls$EPID[16]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[12]) $formattedEpisodeTitle[12]" , $url = "", $callback_data ="ephls$EPID[12]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[13]) $formattedEpisodeTitle[13]" , $url = "", $callback_data ="ephls$EPID[13]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[14]) $formattedEpisodeTitle[14]" , $url = "", $callback_data ="ephls$EPID[14]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "", $callback_data ="ephls$EPID[9]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[10]) $formattedEpisodeTitle[10]" , $url = "", $callback_data ="ephls$EPID[10]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[11]) $formattedEpisodeTitle[11]" , $url = "", $callback_data ="ephls$EPID[11]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "", $callback_data ="ephls$EPID[6]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "", $callback_data ="ephls$EPID[7]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "", $callback_data ="ephls$EPID[8]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "", $callback_data ="ephls$EPID[3]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "", $callback_data ="ephls$EPID[4]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "", $callback_data ="ephls$EPID[5]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "", $callback_data ="ephls$EPID[0]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "", $callback_data ="ephls$EPID[1]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "", $callback_data ="ephls$EPID[2]"),
                ],
            ];
        }
        elseif ($countepisode == 18)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[15]) $formattedEpisodeTitle[15]" , $url = "", $callback_data ="ephls$EPID[15]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[16]) $formattedEpisodeTitle[16]" , $url = "", $callback_data ="ephls$EPID[16]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[17]) $formattedEpisodeTitle[17]" , $url = "", $callback_data ="ephls$EPID[17]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[12]) $formattedEpisodeTitle[12]" , $url = "", $callback_data ="ephls$EPID[12]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[13]) $formattedEpisodeTitle[13]" , $url = "", $callback_data ="ephls$EPID[13]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[14]) $formattedEpisodeTitle[14]" , $url = "", $callback_data ="ephls$EPID[14]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "", $callback_data ="ephls$EPID[9]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[10]) $formattedEpisodeTitle[10]" , $url = "", $callback_data ="ephls$EPID[10]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[11]) $formattedEpisodeTitle[11]" , $url = "", $callback_data ="ephls$EPID[11]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "", $callback_data ="ephls$EPID[6]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "", $callback_data ="ephls$EPID[7]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "", $callback_data ="ephls$EPID[8]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "", $callback_data ="ephls$EPID[3]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "", $callback_data ="ephls$EPID[4]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "", $callback_data ="ephls$EPID[5]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "", $callback_data ="ephls$EPID[0]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "", $callback_data ="ephls$EPID[1]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "", $callback_data ="ephls$EPID[2]"),
                ],
            ];
        }
        elseif ($countepisode == 19)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[18]) $formattedEpisodeTitle[18]" , $url = "", $callback_data ="ephls$EPID[18]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[15]) $formattedEpisodeTitle[15]" , $url = "", $callback_data ="ephls$EPID[15]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[16]) $formattedEpisodeTitle[16]" , $url = "", $callback_data ="ephls$EPID[16]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[17]) $formattedEpisodeTitle[17]" , $url = "", $callback_data ="ephls$EPID[17]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[12]) $formattedEpisodeTitle[12]" , $url = "", $callback_data ="ephls$EPID[12]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[13]) $formattedEpisodeTitle[13]" , $url = "", $callback_data ="ephls$EPID[13]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[14]) $formattedEpisodeTitle[14]" , $url = "", $callback_data ="ephls$EPID[14]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "", $callback_data ="ephls$EPID[9]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[10]) $formattedEpisodeTitle[10]" , $url = "", $callback_data ="ephls$EPID[10]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[11]) $formattedEpisodeTitle[11]" , $url = "", $callback_data ="ephls$EPID[11]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "", $callback_data ="ephls$EPID[6]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "", $callback_data ="ephls$EPID[7]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "", $callback_data ="ephls$EPID[8]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "", $callback_data ="ephls$EPID[3]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "", $callback_data ="ephls$EPID[4]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "", $callback_data ="ephls$EPID[5]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "", $callback_data ="ephls$EPID[0]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "", $callback_data ="ephls$EPID[1]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "", $callback_data ="ephls$EPID[2]"),
                ],
            ];
        }
        elseif ($countepisode == 20)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[18]) $formattedEpisodeTitle[18]" , $url = "", $callback_data ="ephls$EPID[18]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[19]) $formattedEpisodeTitle[19]" , $url = "", $callback_data ="ephls$EPID[19]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[15]) $formattedEpisodeTitle[15]" , $url = "", $callback_data ="ephls$EPID[15]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[16]) $formattedEpisodeTitle[16]" , $url = "", $callback_data ="ephls$EPID[16]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[17]) $formattedEpisodeTitle[17]" , $url = "", $callback_data ="ephls$EPID[17]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[12]) $formattedEpisodeTitle[12]" , $url = "", $callback_data ="ephls$EPID[12]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[13]) $formattedEpisodeTitle[13]" , $url = "", $callback_data ="ephls$EPID[13]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[14]) $formattedEpisodeTitle[14]" , $url = "", $callback_data ="ephls$EPID[14]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "", $callback_data ="ephls$EPID[9]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[10]) $formattedEpisodeTitle[10]" , $url = "", $callback_data ="ephls$EPID[10]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[11]) $formattedEpisodeTitle[11]" , $url = "", $callback_data ="ephls$EPID[11]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "", $callback_data ="ephls$EPID[6]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "", $callback_data ="ephls$EPID[7]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "", $callback_data ="ephls$EPID[8]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "", $callback_data ="ephls$EPID[3]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "", $callback_data ="ephls$EPID[4]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "", $callback_data ="ephls$EPID[5]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "", $callback_data ="ephls$EPID[0]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "", $callback_data ="ephls$EPID[1]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "", $callback_data ="ephls$EPID[2]"),
                ],
            ];
        }
        elseif ($countepisode == 21)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[18]) $formattedEpisodeTitle[18]" , $url = "", $callback_data ="ephls$EPID[18]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[19]) $formattedEpisodeTitle[19]" , $url = "", $callback_data ="ephls$EPID[19]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[20]) $formattedEpisodeTitle[20]" , $url = "", $callback_data ="ephls$EPID[20]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[15]) $formattedEpisodeTitle[15]" , $url = "", $callback_data ="ephls$EPID[15]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[16]) $formattedEpisodeTitle[16]" , $url = "", $callback_data ="ephls$EPID[16]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[17]) $formattedEpisodeTitle[17]" , $url = "", $callback_data ="ephls$EPID[17]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[12]) $formattedEpisodeTitle[12]" , $url = "", $callback_data ="ephls$EPID[12]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[13]) $formattedEpisodeTitle[13]" , $url = "", $callback_data ="ephls$EPID[13]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[14]) $formattedEpisodeTitle[14]" , $url = "", $callback_data ="ephls$EPID[14]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "", $callback_data ="ephls$EPID[9]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[10]) $formattedEpisodeTitle[10]" , $url = "", $callback_data ="ephls$EPID[10]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[11]) $formattedEpisodeTitle[11]" , $url = "", $callback_data ="ephls$EPID[11]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "", $callback_data ="ephls$EPID[6]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "", $callback_data ="ephls$EPID[7]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "", $callback_data ="ephls$EPID[8]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "", $callback_data ="ephls$EPID[3]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "", $callback_data ="ephls$EPID[4]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "", $callback_data ="ephls$EPID[5]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "", $callback_data ="ephls$EPID[0]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "", $callback_data ="ephls$EPID[1]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "", $callback_data ="ephls$EPID[2]"),
                ],
            ];
        }
        elseif ($countepisode == 22)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[21]) $formattedEpisodeTitle[21]" , $url = "", $callback_data ="ephls$EPID[21]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[18]) $formattedEpisodeTitle[18]" , $url = "", $callback_data ="ephls$EPID[18]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[19]) $formattedEpisodeTitle[19]" , $url = "", $callback_data ="ephls$EPID[19]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[20]) $formattedEpisodeTitle[20]" , $url = "", $callback_data ="ephls$EPID[20]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[15]) $formattedEpisodeTitle[15]" , $url = "", $callback_data ="ephls$EPID[15]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[16]) $formattedEpisodeTitle[16]" , $url = "", $callback_data ="ephls$EPID[16]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[17]) $formattedEpisodeTitle[17]" , $url = "", $callback_data ="ephls$EPID[17]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[12]) $formattedEpisodeTitle[12]" , $url = "", $callback_data ="ephls$EPID[12]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[13]) $formattedEpisodeTitle[13]" , $url = "", $callback_data ="ephls$EPID[13]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[14]) $formattedEpisodeTitle[14]" , $url = "", $callback_data ="ephls$EPID[14]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "", $callback_data ="ephls$EPID[9]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[10]) $formattedEpisodeTitle[10]" , $url = "", $callback_data ="ephls$EPID[10]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[11]) $formattedEpisodeTitle[11]" , $url = "", $callback_data ="ephls$EPID[11]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "", $callback_data ="ephls$EPID[6]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "", $callback_data ="ephls$EPID[7]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "", $callback_data ="ephls$EPID[8]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "", $callback_data ="ephls$EPID[3]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "", $callback_data ="ephls$EPID[4]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "", $callback_data ="ephls$EPID[5]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "", $callback_data ="ephls$EPID[0]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "", $callback_data ="ephls$EPID[1]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "", $callback_data ="ephls$EPID[2]"),
                ],
            ];
        }
        elseif ($countepisode == 23)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[21]) $formattedEpisodeTitle[21]" , $url = "", $callback_data ="ephls$EPID[21]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[22]) $formattedEpisodeTitle[22]" , $url = "", $callback_data ="ephls$EPID[22]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[18]) $formattedEpisodeTitle[18]" , $url = "", $callback_data ="ephls$EPID[18]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[19]) $formattedEpisodeTitle[19]" , $url = "", $callback_data ="ephls$EPID[19]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[20]) $formattedEpisodeTitle[20]" , $url = "", $callback_data ="ephls$EPID[20]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[15]) $formattedEpisodeTitle[15]" , $url = "", $callback_data ="ephls$EPID[15]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[16]) $formattedEpisodeTitle[16]" , $url = "", $callback_data ="ephls$EPID[16]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[17]) $formattedEpisodeTitle[17]" , $url = "", $callback_data ="ephls$EPID[17]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[12]) $formattedEpisodeTitle[12]" , $url = "", $callback_data ="ephls$EPID[12]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[13]) $formattedEpisodeTitle[13]" , $url = "", $callback_data ="ephls$EPID[13]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[14]) $formattedEpisodeTitle[14]" , $url = "", $callback_data ="ephls$EPID[14]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "", $callback_data ="ephls$EPID[9]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[10]) $formattedEpisodeTitle[10]" , $url = "", $callback_data ="ephls$EPID[10]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[11]) $formattedEpisodeTitle[11]" , $url = "", $callback_data ="ephls$EPID[11]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "", $callback_data ="ephls$EPID[6]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "", $callback_data ="ephls$EPID[7]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "", $callback_data ="ephls$EPID[8]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "", $callback_data ="ephls$EPID[3]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "", $callback_data ="ephls$EPID[4]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "", $callback_data ="ephls$EPID[5]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "", $callback_data ="ephls$EPID[0]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "", $callback_data ="ephls$EPID[1]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "", $callback_data ="ephls$EPID[2]"),
                ],
            ];
        }
        elseif ($countepisode >= 24)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[21]) $formattedEpisodeTitle[21]" , $url = "", $callback_data ="ephls$EPID[21]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[22]) $formattedEpisodeTitle[22]" , $url = "", $callback_data ="ephls$EPID[22]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[23]) $formattedEpisodeTitle[23]" , $url = "", $callback_data ="ephls$EPID[23]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[18]) $formattedEpisodeTitle[18]" , $url = "", $callback_data ="ephls$EPID[18]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[19]) $formattedEpisodeTitle[19]" , $url = "", $callback_data ="ephls$EPID[19]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[20]) $formattedEpisodeTitle[20]" , $url = "", $callback_data ="ephls$EPID[20]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[15]) $formattedEpisodeTitle[15]" , $url = "", $callback_data ="ephls$EPID[15]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[16]) $formattedEpisodeTitle[16]" , $url = "", $callback_data ="ephls$EPID[16]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[17]) $formattedEpisodeTitle[17]" , $url = "", $callback_data ="ephls$EPID[17]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[12]) $formattedEpisodeTitle[12]" , $url = "", $callback_data ="ephls$EPID[12]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[13]) $formattedEpisodeTitle[13]" , $url = "", $callback_data ="ephls$EPID[13]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[14]) $formattedEpisodeTitle[14]" , $url = "", $callback_data ="ephls$EPID[14]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "", $callback_data ="ephls$EPID[9]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[10]) $formattedEpisodeTitle[10]" , $url = "", $callback_data ="ephls$EPID[10]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[11]) $formattedEpisodeTitle[11]" , $url = "", $callback_data ="ephls$EPID[11]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "", $callback_data ="ephls$EPID[6]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "", $callback_data ="ephls$EPID[7]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "", $callback_data ="ephls$EPID[8]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "", $callback_data ="ephls$EPID[3]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "", $callback_data ="ephls$EPID[4]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "", $callback_data ="ephls$EPID[5]"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "", $callback_data ="ephls$EPID[0]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "", $callback_data ="ephls$EPID[1]"),
                    $telegram->buildInlineKeyBoardButton( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "", $callback_data ="ephls$EPID[2]"),
                ],
            ];
        }
    }

    $keyb = $telegram->buildInlineKeyBoard($option);
    $telegram->sendMessage(['chat_id' => $chat_id, 'reply_to_message_id' => $callbackmessage_id, 'reply_markup' => ($keyb), "text" => "قسمت موردنظر رو انتخاب کنید"]);
}
elseif (stristr($text, 'vts') == true)
{
    $getshowid = explode('vts', $text);
    $episodelisturl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/videocliplist?id=" . $getshowid[1];
    $episodelistrequest = file_get_contents($episodelisturl);
    $episodelistarrayMessage = json_decode($episodelistrequest, true);
    $episodecount = $episodelistarrayMessage['details']['list'];
    $countepisode = count($episodecount);
    $EPTitle = [];
    $EPID = [];
    for ($p = 0; $p < $countepisode; $p++)
    {
        $EPTitle[] = $episodelistarrayMessage['details']['list'][$p]['videoclipTitle'];
        $EPID[] = $episodelistarrayMessage['details']['list'][$p]['id'];
    }
    if ($countepisode == 1)
    {
        $option = [
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[0] , $url = "", $callback_data ="vthls" . $EPID[0]),
            ],
        ];
    }
    elseif ($countepisode == 2)
    {
        $option = [
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[0] , $url = "", $callback_data ="vthls" . $EPID[0]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[1] , $url = "", $callback_data ="vthls" . $EPID[1]),
            ],
        ];

        $keyb = $telegram->buildInlineKeyBoard($option);
    }
    elseif ($countepisode == 3)
    {
        $option = [
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[2] , $url = "", $callback_data ="vthls" . $EPID[2]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[0] , $url = "", $callback_data ="vthls" . $EPID[0]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[1] , $url = "", $callback_data ="vthls" . $EPID[1]),
            ],
        ];

        $keyb = $telegram->buildInlineKeyBoard($option);
    }
    elseif ($countepisode == 4)
    {
        $option = [
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[2] , $url = "", $callback_data ="vthls" . $EPID[2]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[3] , $url = "", $callback_data ="vthls" . $EPID[3]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[0] , $url = "", $callback_data ="vthls" . $EPID[0]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[1] , $url = "", $callback_data ="vthls" . $EPID[1]),
            ],
        ];

        $keyb = $telegram->buildInlineKeyBoard($option);
    }
    elseif ($countepisode == 5)
    {
        $option = [
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[4] , $url = "", $callback_data ="vthls" . $EPID[4]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[2] , $url = "", $callback_data ="vthls" . $EPID[2]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[3] , $url = "", $callback_data ="vthls" . $EPID[3]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[0] , $url = "", $callback_data ="vthls" . $EPID[0]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[1] , $url = "", $callback_data ="vthls" . $EPID[1]),
            ],
        ];

        $keyb = $telegram->buildInlineKeyBoard($option);
    }
    elseif ($countepisode == 6)
    {
        $option = [
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[4] , $url = "", $callback_data ="vthls" . $EPID[4]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[5] , $url = "", $callback_data ="vthls" . $EPID[5]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[2] , $url = "", $callback_data ="vthls" . $EPID[2]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[3] , $url = "", $callback_data ="vthls" . $EPID[3]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[0] , $url = "", $callback_data ="vthls" . $EPID[0]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[1] , $url = "", $callback_data ="vthls" . $EPID[1]),
            ],
        ];

        $keyb = $telegram->buildInlineKeyBoard($option);
    }
    elseif ($countepisode == 7)
    {
        $option = [
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[6] , $url = "", $callback_data ="vthls" . $EPID[6]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[4] , $url = "", $callback_data ="vthls" . $EPID[4]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[5] , $url = "", $callback_data ="vthls" . $EPID[5]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[2] , $url = "", $callback_data ="vthls" . $EPID[2]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[3] , $url = "", $callback_data ="vthls" . $EPID[3]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[0] , $url = "", $callback_data ="vthls" . $EPID[0]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[1] , $url = "", $callback_data ="vthls" . $EPID[1]),
            ],
        ];

        $keyb = $telegram->buildInlineKeyBoard($option);
    }
    elseif ($countepisode == 8)
    {
        $option = [
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[6] , $url = "", $callback_data ="vthls" . $EPID[6]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[7] , $url = "", $callback_data ="vthls" . $EPID[7]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[4] , $url = "", $callback_data ="vthls" . $EPID[4]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[5] , $url = "", $callback_data ="vthls" . $EPID[5]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[2] , $url = "", $callback_data ="vthls" . $EPID[2]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[3] , $url = "", $callback_data ="vthls" . $EPID[3]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[0] , $url = "", $callback_data ="vthls" . $EPID[0]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[1] , $url = "", $callback_data ="vthls" . $EPID[1]),
            ],
        ];

        $keyb = $telegram->buildInlineKeyBoard($option);
    }
    elseif ($countepisode == 9)
    {
        $option = [
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[8] , $url = "", $callback_data ="vthls" . $EPID[8]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[6] , $url = "", $callback_data ="vthls" . $EPID[6]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[7] , $url = "", $callback_data ="vthls" . $EPID[7]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[4] , $url = "", $callback_data ="vthls" . $EPID[4]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[5] , $url = "", $callback_data ="vthls" . $EPID[5]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[2] , $url = "", $callback_data ="vthls" . $EPID[2]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[3] , $url = "", $callback_data ="vthls" . $EPID[3]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[0] , $url = "", $callback_data ="vthls" . $EPID[0]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[1] , $url = "", $callback_data ="vthls" . $EPID[1]),
            ],
        ];

        $keyb = $telegram->buildInlineKeyBoard($option);
    }
    elseif ($countepisode == 10)
    {
        $option = [
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[8] , $url = "", $callback_data ="vthls" . $EPID[8]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[9] , $url = "", $callback_data ="vthls" . $EPID[9]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[6] , $url = "", $callback_data ="vthls" . $EPID[6]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[7] , $url = "", $callback_data ="vthls" . $EPID[7]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[4] , $url = "", $callback_data ="vthls" . $EPID[4]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[5] , $url = "", $callback_data ="vthls" . $EPID[5]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[2] , $url = "", $callback_data ="vthls" . $EPID[2]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[3] , $url = "", $callback_data ="vthls" . $EPID[3]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[0] , $url = "", $callback_data ="vthls" . $EPID[0]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[1] , $url = "", $callback_data ="vthls" . $EPID[1]),
            ],
        ];

        $keyb = $telegram->buildInlineKeyBoard($option);
    }
    elseif ($countepisode == 11)
    {
        $option = [
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[10] , $url = "", $callback_data ="vthls" . $EPID[10]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[8] , $url = "", $callback_data ="vthls" . $EPID[8]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[9] , $url = "", $callback_data ="vthls" . $EPID[9]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[6] , $url = "", $callback_data ="vthls" . $EPID[6]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[7] , $url = "", $callback_data ="vthls" . $EPID[7]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[4] , $url = "", $callback_data ="vthls" . $EPID[4]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[5] , $url = "", $callback_data ="vthls" . $EPID[5]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[2] , $url = "", $callback_data ="vthls" . $EPID[2]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[3] , $url = "", $callback_data ="vthls" . $EPID[3]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[0] , $url = "", $callback_data ="vthls" . $EPID[0]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[1] , $url = "", $callback_data ="vthls" . $EPID[1]),
            ],
        ];

        $keyb = $telegram->buildInlineKeyBoard($option);
    }
    elseif ($countepisode >= 12)
    {
        $option = [
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[10] , $url = "", $callback_data ="vthls" . $EPID[10]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[11] , $url = "", $callback_data ="vthls" . $EPID[11]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[8] , $url = "", $callback_data ="vthls" . $EPID[8]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[9] , $url = "", $callback_data ="vthls" . $EPID[9]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[6] , $url = "", $callback_data ="vthls" . $EPID[6]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[7] , $url = "", $callback_data ="vthls" . $EPID[7]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[4] , $url = "", $callback_data ="vthls" . $EPID[4]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[5] , $url = "", $callback_data ="vthls" . $EPID[5]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[2] , $url = "", $callback_data ="vthls" . $EPID[2]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[3] , $url = "", $callback_data ="vthls" . $EPID[3]),
            ],
            [
                $telegram->buildInlineKeyBoardButton( $EPTitle[0] , $url = "", $callback_data ="vthls" . $EPID[0]),
                $telegram->buildInlineKeyBoardButton( $EPTitle[1] , $url = "", $callback_data ="vthls" . $EPID[1]),
            ],
        ];

        $keyb = $telegram->buildInlineKeyBoard($option);
    }
    $keyb = $telegram->buildInlineKeyBoard($option);
    $telegram->sendMessage(['chat_id' => $chat_id, 'reply_to_message_id' => $callbackmessage_id, 'reply_markup' => ($keyb), "text" => "کلیپ موردنظر رو انتخاب کنید"]);
}
elseif ($text == "genres") # Show Show inline
{
    #$genreurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/genres";
    #$genrerequest = file_get_contents($genreurl);
    #$genrearrayMessage = json_decode($genrerequest, true);
    #$genre0 = $genrearrayMessage['details']['list']['0']['title'];
    #$genre1 = $genrearrayMessage['details']['list']['1']['title'];
    #$genre2 = $genrearrayMessage['details']['list']['2']['title'];
    #$genre3 = $genrearrayMessage['details']['list']['3']['title'];
    #$genre4 = $genrearrayMessage['details']['list']['4']['title'];
    #$genre5 = $genrearrayMessage['details']['list']['5']['title'];
    #$genre6 = $genrearrayMessage['details']['list']['6']['title'];
    #$genre7 = $genrearrayMessage['details']['list']['7']['title'];
    #$genre8 = $genrearrayMessage['details']['list']['8']['title'];
    #$genre9 = $genrearrayMessage['details']['list']['9']['title'];

    $option = [
        [
            $telegram->buildInlineKeyBoardButton("Manoto Original", $url = '', $callback_data = "Manoto+OriginalGNR1"),
        ],
        [
            $telegram->buildInlineKeyBoardButton("سرگرمی", $url = '', $callback_data = "EntertainmentGNR1"),
            $telegram->buildInlineKeyBoardButton("سیاسی/اجتماعی", $url = '', $callback_data = "Current+AffairsGNR1"),
            $telegram->buildInlineKeyBoardButton("کمدی", $url = '', $callback_data = "ComedyGNR1"),
        ],
        [
            $telegram->buildInlineKeyBoardButton("تاریخی", $url = '', $callback_data = "HistoryGNR1"),
            $telegram->buildInlineKeyBoardButton("سریال", $url = '', $callback_data = "DramaGNR1"),
            $telegram->buildInlineKeyBoardButton("حیات وحش", $url = '', $callback_data = "WildlifeGNR1"),
        ],
        [
            $telegram->buildInlineKeyBoardButton("فرهنگ و هنر", $url = '', $callback_data = "Art+%26+CultureGNR1"),
            $telegram->buildInlineKeyBoardButton("علمی", $url = '', $callback_data = "ScienceGNR1"),
            $telegram->buildInlineKeyBoardButton("ویژه برنامه", $url = '', $callback_data = "Special+GNR1"),
        ],
        [
            $telegram->buildInlineKeyBoardButton("همه برنامه ها", $url = '', $callback_data = "GNR1"),
        ],
        [
            $telegram->buildInlineKeyBoardButton("بازگشت به منوی اصلی", $url = '', $callback_data = 'callstart'),
        ],
    ];

    $keyb = $telegram->buildInlineKeyBoard($option);
    $telegram->editMessageText(array('chat_id' => $chat_id, 'message_id' => $callbackmessage_id, 'reply_markup' => $keyb, 'text' => "ژانر مورد نظر رو انتخاب کنید"));
}
elseif (stristr($text, 'series') == true)# Series
{
    $getid = explode('series', $text);
    $serieid = $getid[1];
    if ($serieid = "list")
    {
        $option = [
            [
                $telegram->buildInlineKeyBoardButton("سایه های آبی", $url = "https://t.me/joinchat/AAAAAEjJWffhkWb3eMJB0A"),
                $telegram->buildInlineKeyBoardButton("ویکتوریا", $url = "https://t.me/joinchat/AAAAAFWlo_acSio0D27mQQ"),
                $telegram->buildInlineKeyBoardButton("مارچلا", $url = "https://t.me/joinchat/AAAAAFQR_dLW8NStP-RtEg"),
            ],
            [
                $telegram->buildInlineKeyBoardButton("معجزه", $url = "https://t.me/joinchat/AAAAAEybBi9ncl_hiSWbjw"),
                $telegram->buildInlineKeyBoardButton("خانواده لیاژی", $url = "https://t.me/joinchat/AAAAAE70xii1g3McwTlznA"),
                $telegram->buildInlineKeyBoardButton("داستان جدایی", $url = "https://t.me/joinchat/AAAAAEw-f0z8-imejsk_0Q"),
            ],
            [
                $telegram->buildInlineKeyBoardButton("دوست نابغه من", $url = "https://t.me/joinchat/AAAAAFW7y5VdOrhjeRXjPg"),
                $telegram->buildInlineKeyBoardButton("خورشید نیمه شب", $url = "https://t.me/joinchat/AAAAAFWKtj1e_6Ua7VoZjQ"),
                $telegram->buildInlineKeyBoardButton("پروژه کتاب آبی", $url = "https://t.me/joinchat/AAAAAE_6sTQAVqZFKZqEiQ"),
            ],
            [
                $telegram->buildInlineKeyBoardButton("خانه ی بیچم", $url = "https://t.me/joinchat/AAAAAFZNW5nQmnJrggQ6Fw"),
                $telegram->buildInlineKeyBoardButton("کارآگاه خوش خوراک", $url = "https://t.me/joinchat/AAAAAE9qCHwNs49pd40WlA"),
                $telegram->buildInlineKeyBoardButton("بینوایان", $url = "https://t.me/joinchat/AAAAAESq9M7xYTI0YpD57w"),
            ],
            [
                $telegram->buildInlineKeyBoardButton("یک کارآگاه و نصفی", $url = "https://t.me/joinchat/AAAAAE7n9vUgui7PLck9Sg"),
                $telegram->buildInlineKeyBoardButton("آقای دکتر", $url = "https://t.me/joinchat/AAAAAEaHhIJUKjniuUBYyA"),
                $telegram->buildInlineKeyBoardButton("یگان ۶", $url = "https://t.me/joinchat/AAAAAERmPtymrXOSPNOmDQ"),
            ],
            [
                $telegram->buildInlineKeyBoardButton("بازگشت به منوی اصلی", $url = '', $callback_data = 'callstart'),
            ],
        ];

        $keyb = $telegram->buildInlineKeyBoard($option);
        $telegram->editMessageText(array('chat_id' => $chat_id, 'message_id' => $callbackmessage_id, 'reply_markup' => $keyb, 'text' => "سریال مورد نظر رو انتخاب کنید"));
    }
}
elseif ($text == 'send2all') {
    $users = file_get_contents('users.txt');
    $user = explode('-', $users);
    $tedaduser = count($user);

    $number = 1;
    do {
        $userchatid = $user[$number];
        $option =
            [
                [
                    $telegram->buildInlineKeyBoardButton("اینستاگرام بچه های من و تو", $url = "https://Instagram.com/BachehayeManototv"),
                ],
            ];

        $keyb = $telegram->buildInlineKeyBoard($option);
        $telegram->sendPhoto(['chat_id' => $userchatid, 'reply_markup' => $keyb, 'photo' => $file_id, 'caption' => $msgcaptiom]);

        $number = $number + 1;
    } while ($number <= $tedaduser);
    $telegram->sendMessage(['chat_id' => '122558527', 'text' => "sent to " . $tedaduser . " Users"]);
}
elseif ($text == 'senduserdata')
{

    $file = "https://uptotelebot.000webhostapp.com/manoto/users.txt";
    #$file = "https://uptotelebot.000webhostapp.com/BachehayeManoto/users.txt";
    $no_of_lines = count(file($file));
    $users = file_get_contents('users.txt');
    $user = explode('\n', $users);
    $tedaduser = count($user);
    $filetxt =  new CURLFile("users.txt");

    $telegram->sendMessage(['chat_id' => '122558527', 'text' =>  $no_of_lines . " Users"]);
    $telegram->sendDocument(['chat_id' => '122558527', 'document' =>  $filetxt]);
}
elseif ($text == 'app') {
    $option =   [
        [
            $telegram->buildInlineKeyBoardButton("لینک دانلود", $url = 'https://d2ad2ahvvsgngk.cloudfront.net/30010020.apk', $callback_data = ''),
        ],
        [
            $telegram->buildInlineKeyBoardButton("پلی استور", $url = 'https://play.google.com/store/apps/details?id=com.mtn.manoto', $callback_data = ''),
            $telegram->buildInlineKeyBoardButton("اپ استور", $url = 'https://apps.apple.com/us/app/marjan-television-network/id1176187407?ls=1', $callback_data = ''),
        ],
        [
            $telegram->buildInlineKeyBoardButton("بازگشت به منوی اصلی", $url = '', $callback_data = 'callstart'),
        ],
    ];
    $keyb = $telegram->buildInlineKeyBoard($option);

    $telegram->editMessageText(array('chat_id' => $chat_id, 'message_id' => $callbackmessage_id, 'reply_markup' => $keyb, 'text' => "لینک های دسترسی به اپ منوتو"));

}
elseif (strstr($text, "vthls") == true) {
    $getepisodeid = explode("vthls", $text, 2);
    $episodeurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/videoclipdetails?id=" . $getepisodeid[1];
    $episoderequest = file_get_contents($episodeurl);
    $episodearrayMessage = json_decode($episoderequest, true);
    $videoclipDescription = $episodearrayMessage['details']['videoclipDescription'];
    $episodeformattedEpisodeTitle = $episodearrayMessage['details']['videoclipTitle'];
    $episodelandscapeImgIxUrl = $episodearrayMessage['details']['videoCliplandscapeImgIxUrl'];
    $episodevideoM3u8Url = $episodearrayMessage['details']['videoM3u8Url'];
    $episodeshowID = $episodearrayMessage['details']['showID'];
    $Description = ("@BachehayeManotoBot\n" . '<b>' . $episodeformattedEpisodeTitle . '</b>' . "\n" . $videoclipDescription);

    $option = [
        [
            $telegram->buildInlineKeyBoardButton("صفحه برنامه در سایت", $url = "https://www.manototv.com/show/" . $episodeshowID),
            $telegram->buildInlineKeyBoardButton("دیدن در سایت", $url = "https://www.manototv.com/clip/" . $getepisodeid[1]),
        ],
        [
            $telegram->buildInlineKeyBoardButton('دانلود', $url = '', $callback_data = "file=clip=" . $getepisodeid[1]),
        ],
    ];

    $keyb = $telegram->buildInlineKeyBoard($option);
    $telegram->sendPhoto(['chat_id' => $chat_id,'photo' => $episodelandscapeImgIxUrl, 'reply_markup' => $keyb, 'caption' => $Description, 'parse_mode' => 'HTML']);
    #$telegram->sendMessage(['chat_id' => $chat_id, 'text' => $episodevideoM3u8Url]);
}
elseif (strstr($text, "file=") == true) {
    $one="1";
}
elseif (strstr($text, "ephls") == true) {
    $getepisodeid = explode("ephls", $text, 2);
    $episodeurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/episodedetails?id=" . $getepisodeid[1];
    $episoderequest = file_get_contents($episodeurl);
    $episodearrayMessage = json_decode($episoderequest, true);
    $episodeshowID = $episodearrayMessage['details']['showID'];
    $episodeformattedEpisodeTitle = $episodearrayMessage['details']['formattedEpisodeTitle'];
    $episodelandscapeImgIxUrl = $episodearrayMessage['details']['episodelandscapeImgIxUrl'];
    $episodevideoM3u8Url = $episodearrayMessage['details']['videoM3u8Url'];
    $Description = "@BachehayeManotoBot \n" .  "*$episodeformattedEpisodeTitle*";
    $status = $episodearrayMessage['status'];
    $videoDownloadUrl = $episodearrayMessage['details']['videoDownloadUrl'];
    copy($episodelandscapeImgIxUrl, "epiphoto.jpeg");
    $epiphoto = new CURLFile("epiphoto.jpeg");


    if ($status == "1") {
        if (stristr($videoDownloadUrl, 'http') == true)
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton("صفحه برنامه در سایت", $url = "https://www.manototv.com/show/" . $episodeshowID),
                    $telegram->buildInlineKeyBoardButton("دیدن در سایت", $url = "https://www.manototv.com/episode/" . $getepisodeid[1]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton('توضیحات برنامه', $url = '', $callback_data = "showdetail"),
                    $telegram->buildInlineKeyBoardButton('توضیحات قسمت', $url = '', $callback_data = "episodedetail"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton('دانلود', $url = '', $callback_data = "file=video=" . $getepisodeid[1]),
                ],
            ];
        }
        else
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton("صفحه برنامه در سایت", $url = "https://www.manototv.com/show/" . $episodeshowID),
                    $telegram->buildInlineKeyBoardButton("دیدن در سایت", $url = "https://www.manototv.com/episode/" . $getepisodeid[1]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton('توضیحات برنامه', $url = '', $callback_data = "showdetail"),
                    $telegram->buildInlineKeyBoardButton('توضیحات قسمت', $url = '', $callback_data = "episodedetail"),
                ],
            ];
        }

        $keyb = $telegram->buildInlineKeyBoard($option);
        $telegram->sendPhoto(['chat_id' => $chat_id, 'reply_markup' => $keyb, 'photo' => $epiphoto, 'caption' => $Description, 'parse_mode' => 'markdown']);
        #$telegram->sendMessage(['chat_id' => $chat_id, 'text' => $episodevideoM3u8Url]);
        unlink("epiphoto.jpeg");
    }

    if ($status == "0") {
        $error = $episodearrayMessage['errors']['0']['messageCode'];
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $error . " EpisodeID"]);
    }
}
elseif (strstr($text, '-') == true) {
    if (stristr($text, " - ") == true) {
        $scheduletext = explode(" - ", $text, 2);
    } else {
        $scheduletext = explode("-", $text, 2);
    }


    $dateinput = explode(" ", $scheduletext[0], 3);
    $Y = "1399";
    $M = $dateinput[1];
    $D = $dateinput[0];
    $dateinputEN = jalali_to_gregorian($Y, $M, $D);
    $Year = $dateinputEN[0];
    $mo = $dateinputEN[1];
    $da = $dateinputEN[2];

    $timeinput = explode(" ", $scheduletext[1], 3);
    $HO = $timeinput[0];
    $MI = $timeinput[1];

    $FADATE = date("Y-m-d H:i:s",mktime($HO,$MI,0,$mo,$da,$Year));//تاریخ روز ورودی به میلادی
    $firstdate = date_create("$FADATE");
    date_add($firstdate,date_interval_create_from_date_string("-16200 secs"));
    $ENDATE =  date_format($firstdate,"Y-m-d");
    $ENTIME =  date_format($firstdate,"H");

    if ($MI < "30" and $MI !== "30" and $MI !== "00") {
        $minute = "30";
    }

    if ($MI > "30" and $MI !== "30" and $MI !== "00") {
        $minute = "00";
    }

    if ($MI == "30") {
        $minute = "00";
    }
    if ($MI == "00") {
        $minute = "30";
    }

    $datein=date_create($ENTIME . ":" . $minute);
    date_add($datein,date_interval_create_from_date_string("60 minutes"));
    $hourplus = date_format($datein,"H:i");

    $scheduleurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/schedulemodule/schedule?from=" . $ENDATE . "T" . $ENTIME . ":" . $minute . ":00.000Z&to=" . $ENDATE . "T" . $hourplus . ":00.000Z";
    $schedulerequest = file_get_contents($scheduleurl);
    $schedulearrayMessage = json_decode($schedulerequest, true);
    $dateUTCRoundedDownToFiveMinutes = $schedulearrayMessage['details']['list']['0']['dateUTCRoundedDownToFiveMinutes'];
    $userinputtime = ($ENDATE . "T" . $ENTIME . ":" . $minute . ":00");
    $status = $schedulearrayMessage['status'];
    if ($dateUTCRoundedDownToFiveMinutes == $userinputtime) {
        $scheduleepisodeID0 = $schedulearrayMessage['details']['list']['0']['episodeID'];
        $scheduleshowID0 = $schedulearrayMessage['details']['list']['0']['showID'];
        $scheduleshowTitle0 = $schedulearrayMessage['details']['list']['0']['showTitle'];
        $scheduleepisodeNumber0 = $schedulearrayMessage['details']['list']['0']['episodeNumber'];
        $scheduleseasonNumber0 = $schedulearrayMessage['details']['list']['0']['seasonNumber'];
        $schedulecurrentHouseNumber0 = $schedulearrayMessage['details']['list']['0']['currentHouseNumber'];
        $scheduleportraitImgIxUrl0 = $schedulearrayMessage['details']['list']['0']['portraitImgIxUrl'];
        $dateUTCRoundedDownToFiveMinutes0 = $schedulearrayMessage['details']['list']['0']['dateUTCRoundedDownToFiveMinutes'];
    }

    if ($dateUTCRoundedDownToFiveMinutes !== $userinputtime)
    {
        $date1 = (explode("T", $dateUTCRoundedDownToFiveMinutes, 2));
        $date2 = (explode(":", $date1[1], 3));
        $data3 = $date2[0];

        $datein=date_create($date1[1]);
        date_add($datein,date_interval_create_from_date_string("-60 minutes"));
        $houredited = date_format($datein,"H:i");

        $scheduleurl2 = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/schedulemodule/schedule?from=" . $ENDATE . "T" . $houredited . ":00.000Z&to=" . $ENDATE . "T" . $hourplus . ":00.000Z";
        $schedulerequest2 = file_get_contents($scheduleurl2);
        $schedulearrayMessage2 = json_decode($schedulerequest2, true);

        $scheduleepisodeID0 = $schedulearrayMessage2['details']['list']['0']['episodeID'];
        $scheduleshowID0 = $schedulearrayMessage2['details']['list']['0']['showID'];
        $scheduleshowTitle0 = $schedulearrayMessage2['details']['list']['0']['showTitle'];
        $scheduleepisodeNumber0 = $schedulearrayMessage2['details']['list']['0']['episodeNumber'];
        $scheduleseasonNumber0 = $schedulearrayMessage2['details']['list']['0']['seasonNumber'];
        $schedulecurrentHouseNumber0 = $schedulearrayMessage2['details']['list']['0']['currentHouseNumber'];
        $scheduleportraitImgIxUrl0 = $schedulearrayMessage2['details']['list']['0']['portraitImgIxUrl'];
        $dateUTCRoundedDownToFiveMinutes0 = $schedulearrayMessage2['details']['list']['0']['dateUTCRoundedDownToFiveMinutes'];

        $scheduleepisodeID1 = $schedulearrayMessage2['details']['list']['1']['episodeID'];
        $scheduleshowID1 = $schedulearrayMessage2['details']['list']['1']['showID'];
        $scheduleshowTitle1 = $schedulearrayMessage2['details']['list']['1']['showTitle'];
        $scheduleepisodeNumber1= $schedulearrayMessage2['details']['list']['1']['episodeNumber'];
        $scheduleseasonNumber1 = $schedulearrayMessage2['details']['list']['1']['seasonNumber'];
        $schedulecurrentHouseNumber1= $schedulearrayMessage2['details']['list']['1']['currentHouseNumber'];
        $scheduleportraitImgIxUrl1 = $schedulearrayMessage2['details']['list']['1']['portraitImgIxUrl'];
        $dateUTCRoundedDownToFiveMinutes1 = $schedulearrayMessage2['details']['list']['1']['dateUTCRoundedDownToFiveMinutes'];
    }

    $datea = (explode("T", $dateUTCRoundedDownToFiveMinutes, 2));
    $dateb = (explode(":", $datea[1], 3));

    if ($dateb[1] == "30") {
        $minute2 = "00";
    }

    if ($dateb[1] == "00") {
        $minute2 = "30";
    }

    $epsodelistgetdate1 = explode("T", $dateUTCRoundedDownToFiveMinutes, 2);
    $epsodelistgetdate2 = explode("-", $epsodelistgetdate1[0], 3);

    $epsodelistShowon = gregorian_to_jalali($epsodelistgetdate2[0], $epsodelistgetdate2[1], $epsodelistgetdate2[2], '-');
    $epsodelistShowonfa = tr_num($epsodelistShowon, 'fa');
    $showon = explode("-", $epsodelistShowonfa, 3);

    $dateround0 = explode("T", $dateUTCRoundedDownToFiveMinutes0, 2);
    $dateroundin0=date_create($dateround0[1]);
    date_add($dateroundin0,date_interval_create_from_date_string("16200 secs"));
    $hourround0 = date_format($dateroundin0,"H:i");
    $HI0 = explode(":", $hourround0, 2);
    $hofa0 = tr_num($HI0[0] , 'fa');
    $mifa0 = tr_num($HI0[1], 'fa');

    $dateround1 = explode("T", $dateUTCRoundedDownToFiveMinutes1, 2);
    $dateroundin1=date_create($dateround1[1]);
    date_add($dateroundin1,date_interval_create_from_date_string("16200 secs"));
    $hourround1 = date_format($dateroundin1,"H:i");
    $HI1 = explode(":", $hourround1, 2);
    $hofa1 = tr_num($HI1[0] , 'fa');
    $mifa1 = tr_num($HI1[1], 'fa');

    if ($status == "1") {
        $scheduleCaption0 = "زمان پخش     " . $showon[2] . " " . $showon[1] . " " . $showon[0] . "   -   " .  $mifa0 . " : " . $hofa0 . "\n" . $scheduleshowTitle0 . "\nS" . $scheduleseasonNumber0 . "     E" . $scheduleepisodeNumber0 . "\nhttps://d2rwmwucnr0d10.cloudfront.net/vod/" . $schedulecurrentHouseNumber0 . ".m3u8";

        $option0 = [
            [
                $telegram->buildInlineKeyBoardButton("صفحه برنامه در سایت", $url = "https://www.manototv.com/show/" . $scheduleshowID0),
                $telegram->buildInlineKeyBoardButton("دیدن در سایت", $url = "https://www.manototv.com/episode/" . $scheduleepisodeID0),
            ],
            [
                $telegram->buildInlineKeyBoardButton('توضیحات برنامه', $url = '', $callback_data = "showdetail"),
                $telegram->buildInlineKeyBoardButton("توضیحات قسمت", $url = '', $callback_data = "episodedetail"),
            ],
        ];

        $keyb0 = $telegram->buildInlineKeyBoard($option0);
        $telegram->sendPhoto(['chat_id' => $chat_id, 'reply_markup' => $keyb0, 'photo' => $scheduleportraitImgIxUrl0, 'caption' => $scheduleCaption0]);

        $scheduleCaption1 = "پخش شده در     " . $showon[2] . " " . $showon[1] . " " . $showon[0] . "   -   " .  $mifa1 . " : " . $hofa1 . "\n" . $scheduleshowTitle1 . "\nS" . $scheduleseasonNumber1 . "     E" . $scheduleepisodeNumber1 . "\nhttps://d2rwmwucnr0d10.cloudfront.net/vod/" . $schedulecurrentHouseNumber1 . ".m3u8";

        $option1 = [
            [
                $telegram->buildInlineKeyBoardButton("صفحه برنامه در سایت", $url = "https://www.manototv.com/show/" . $scheduleshowID1),
                $telegram->buildInlineKeyBoardButton("دیدن در سایت", $url = "https://www.manototv.com/episode/" . $scheduleepisodeID1),
            ],
            [
                $telegram->buildInlineKeyBoardButton('توضیحات برنامه', $url = '', $callback_data = "showdetail"),
                $telegram->buildInlineKeyBoardButton("توضیحات قسمت", $url = '', $callback_data = "episodedetail"),
            ],
        ];

        $keyb1 = $telegram->buildInlineKeyBoard($option1);
        $telegram->sendPhoto(['chat_id' => $chat_id, 'reply_markup' => $keyb1, 'photo' => $scheduleportraitImgIxUrl1, 'caption' => $scheduleCaption1]);

    }
    elseif ($status == "0") {
        $error = $schedulearrayMessage['errors']['0']['messageCode'];
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $error . " ScheduleID"]);
    }
}
elseif ($msgType == 'photo') {
    if ($chat_id == '122558527') {

        $option =
            [
                [
                    $telegram->buildInlineKeyBoardButton("اینستاگرام بچه های من و تو", $url = "https://Instagram.com/BachehayeManototv"),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("ارسال برای همه", $url = '', $callback_data = "send2all"),
                    $telegram->buildInlineKeyBoardButton("ارسال لیست اعضا", $url = '', $callback_data = "senduserdata"),
                ],
            ];

        $keyb = $telegram->buildInlineKeyBoard($option);
        $telegram->sendPhoto(['chat_id' => "122558527", 'reply_markup' => $keyb, 'photo' => $file_id, 'caption' => $msgcaptiom]);
    }
}
elseif($msgType == 'inline_query')
{
    if(!empty($inline_query_text))
    {
        if($inline_query_text == "l")
        {
            $results = [];
            $p = 0;
            $url = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/homemodule/catchupepsiodes";
            $request = file_get_contents($url);
            $arrayMessage = json_decode($request, true);
            for ($p = 0; $p <= 19; $p++) {
                $episodeDateUTC = $arrayMessage['details']['list'][$p]['episodeDateUTC'];
                $getdate1 = explode("T", $episodeDateUTC, 2);
                $getdate2 = explode("-", $getdate1[0], 3);
                $showtime = gregorian_to_jalali($getdate2[0], $getdate2[1], $getdate2[2], '-');
                $showtimefa = tr_num($showtime, 'fa');
                $showon = explode("-", $showtimefa, 3);
                $Pakhsh = "زمان پخش " . $showon[2] . " " . $showon[1] . " " . $showon[0];
                $results[] = [
                    'type' => 'article',
                    'id' => base64_encode(rand()),
                    'title' =>  $arrayMessage['details']['list'][$p]['formattedEpisodeTitle'],
                    'message_text' =>  "ephls" . $arrayMessage['details']['list'][$p]['id'],
                    'description' =>  $Pakhsh,
                    'thumb_url' => $arrayMessage['details']['list'][$p]['landscapeImgIxUrl'],
                ];
            }
            $telegram->answerInlineQuery(['inline_query_id' => $inline_query_id, 'results' => json_encode($results)]);
        }
        else
        {
            $ENDATE = date("Y-m-d");
            $timeinput = explode(" ", $inline_query_text, 2);
            $HO = $timeinput[0];
            $MI = $timeinput[1];

            $FADATE = date("H:i:s", mktime($HO, $MI, 0));//تاریخ روز ورودی به میلادی
            $firstdate = date_create("$FADATE");
            date_add($firstdate, date_interval_create_from_date_string("-16200 secs"));
            $ENH = date_format($firstdate, "H");
            $ENHP = $ENH + 1;
            $ENS = date_format($firstdate, "i");

            $scheduleurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/schedulemodule/schedule?from=" . $ENDATE . "T" . $ENH . ":" . $ENS . ":00.000Z&to=" . $ENDATE . "T" . $ENHP . ":" . $ENS . ":00.000Z";
            $schedulerequest = file_get_contents($scheduleurl);
            $schedulearrayMessage = json_decode($schedulerequest, true);
            $scheduleItemID = $schedulearrayMessage['details']['list']['0']['scheduleItemID'];
            $dateUTC = $schedulearrayMessage['details']['list']["0"]['dateUTCRoundedDownToFiveMinutes'];
            $showTitle = $schedulearrayMessage['details']['list']["0"]['showTitle'];
            $episodeNumberen = $schedulearrayMessage['details']['list']["0"]['episodeNumber'];
            $seasonNumberen = $schedulearrayMessage['details']['list']["0"]['seasonNumber'];
            $showID = $schedulearrayMessage['details']['list']["0"]['showID'];
            $episodeID = $schedulearrayMessage['details']['list']["0"]['episodeID'];
            $schedulecurrentHouseNumber = $schedulearrayMessage['details']['list']["0"]['currentHouseNumber'];
            $portraitImgIxUrl = $schedulearrayMessage['details']['list']["0"]['portraitImgIxUrl'];

            $Snum = strlen($seasonNumberen);
            if ($Snum < 1 == true) {
                $ses = "";
            }
            if ($Snum > 0 == true) {
                $seasonNumber = tr_num($seasonNumberen, 'fa');
                $ses = "ﻓﺼﻞ " . $seasonNumber;
            }

            $Enum = strlen($episodeNumberen);
            if ($Enum < 1 == true) {
                $epi = " ";
            }
            if ($Enum > 0 == true) {
                $episodeNumber = tr_num($episodeNumberen, 'fa');
                $epi = "ﻗﺴﻤﺖ " . $episodeNumber;
            }

            $stringData = $showTitle . "  " . $ses . "  " . $epi;
            $results[] = [
                'type' => 'article',
                'id' => base64_encode(rand()),
                'title' => $stringData,
                'message_text' => "https://d2rwmwucnr0d10.cloudfront.net/pfs/" . $schedulecurrentHouseNumber . ".m3u8",
                'description' => $schedulecurrentHouseNumber,
                'thumb_url' => $portraitImgIxUrl,
            ];
            $telegram->answerInlineQuery(['inline_query_id' => $inline_query_id, 'results' => json_encode($results)]);
        }
    }
}
else
{
    $one = "1";
    #$telegram->sendMessage(['chat_id' => $chat_id, 'text' => "Invalid Input"]);
}
