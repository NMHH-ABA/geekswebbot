<?php
#include 'vendor/autoload.php'; #for heroku deploy
include 'vendor/Telegram.php';
include_once 'vendor/jdf.php';
date_default_timezone_set ( "asia/tehran" );
// Set the bot TOKEN
$bot_id = "821293043:AAHge0iPAcuwYJmxtgJ9RLbz65_T_H1usns"; #manotoapibot
#$bot_id = "1279873723:AAEjyOf7og7FWiK0IAXJ9vyPqqwItv-6HEs"; #manotoapi_bot
#$bot_id = "69707027:AAEBGJPfjZHaY1320czxkd6_9-BYVK6-ggg"; #BachehayeManotoBot

$sendhlsurl = "1";

// Instances the class
$telegram = new Telegram( $bot_id );
$textoriginal = $telegram -> Text ();
$username = $telegram -> Username ();
$name = $telegram -> FirstName ();
$family = $telegram -> LastName ();
$message_id = $telegram -> MessageID ();
$user_id = $telegram -> UserID ();
$chat_id = $telegram -> ChatID ();
$Caption = $telegram -> Caption ();
$text = strtolower ( $textoriginal );
$msgType = $telegram -> getUpdateType ();
$msgcaptiom = $telegram -> Caption ();
$file_id = $telegram -> photoFileID ();

$callback_data = $telegram -> Callback_Data ();
$callback_query = $telegram -> Callback_Query ();
$callback_chat_id = $telegram -> Callback_ChatID ();
$callbackmessage_id = $telegram -> MessageID ();
$callbackurlepisode = $telegram -> callbackurlepisode ();
$callbackurlshow = $telegram -> callbackurlshow ();
$inline_query_id = $telegram -> Inline_Query_ID ();
$inline_query_text = $telegram -> Inline_Query_Text ();

if ( stristr ( $text , 'start' ) == TRUE )

{
    $handler = explode ( "start" , $text , 2 );
    $option = [
        [

            $telegram -> buildInlineKeyBoardButton ( "آخرین ها" , $url = '' , $callback_data = 'last-3' ) ,
            $telegram -> buildInlineKeyBoardButton ( "زمان پخش برنامه ها" , $url = '' , $callback_data = 'days-menu' ) ,
        ] ,
        [
            $telegram -> buildInlineKeyBoardButton ( "برنامه ها" , $url = '' , $callback_data = 'genres-menu' ) ,
            $telegram -> buildInlineKeyBoardButton ( "اتاق خبر" , $url = '' , $callback_data = 'news-main' ) ,
            $telegram -> buildInlineKeyBoardButton ( "فرکانس" , $url = '' , $callback_data = 'option-frequency' ) ,
        ] ,
        [
            #$telegram->buildInlineKeyBoardButton("سریال ها", $url = '', $callback_data = 'serieslist'),
            $telegram -> buildInlineKeyBoardButton ( "پخش زنده" , $url = 'https://kutt.it/pm4bgz' ) ,
            $telegram -> buildInlineKeyBoardButton ( "اپ منوتو" , $url = '' , $callback_data = 'option-app' ) ,
        ] ,
    ];
    if ( $handler[ 1 ] == "menu" )
    {
        $keyb = $telegram -> buildInlineKeyBoard ( $option );
        $telegram -> editMessageText ( [ 'chat_id' => $chat_id , 'message_id' => $callbackmessage_id , 'reply_markup' => $keyb , 'text' => "ربات بچه های من و تو\n\nیکی از گزینه ها رو انتخاب کنید" ] );
    }
    else
    {
        $keyb = $telegram -> buildInlineKeyBoard ( $option );

        $GetResult = $telegram -> SendMessage ( [ 'chat_id' => $chat_id , 'reply_markup' => $keyb , 'text' => "ربات بچه های من و تو\n\nیکی از گزینه ها رو انتخاب کنید" ] );
        #$telegram->SendMessage(array('chat_id' => $chat_id, 'text' => json_encode($GetResult))); # نتیجه تلگرام

        #$opt =   [[$telegram->buildKeyboardButton(" ", $request_contact = false, $request_location = false)],];
        #$keb = $telegram->buildKeyBoard($opt, $onetime = true, $resize = true, $selective = false);
        #$telegram->SendMessage(array('chat_id' => $chat_id,  'reply_markup' => $keb, 'text' => "ساخت کیبورد"));

        #save new users chat id
        $UserFileName = "users.txt";
        $UserFileHandle = fopen ( $UserFileName , 'a' ) or die( "can't open file" );

        $search = file_get_contents ( 'users.txt' );
        $UserstringData = "$chat_id\n";
        if ( stristr ( $search , $UserstringData ) == TRUE ) {
            fclose ( $UserFileHandle );
        }
        else if ( stristr ( $search , $UserstringData ) == FALSE ) {
            fwrite ( $UserFileHandle , $UserstringData );
            fclose ( $UserFileHandle );
        }
    }
}
else if ( stristr ( $text , 'news' ) == TRUE ) {
    $handler = explode ( "-" , $text , 2 );
    if ( $handler[ 1 ] == "main" ) {
        $array = json_decode ( file_get_contents ( "https://dr905zevbmkvz.cloudfront.net/api/v1/publicrole/newsmodule/banner" ), TRUE );
        $headline = $array[ 'details' ][ 'headline' ];
        $strapline1 = $array[ 'details' ][ 'strapline1' ];
        $ImgIxUrl = $array[ 'details' ][ 'landscapeImgIxUrl' ];
        #$newslandscapeImgIxUrl = str_replace("https", "http", $newslandscapeImgIxUrl);

        #copy ( $ImgIxUrl , "newsbanner.jpeg" );
        #$filejpeg = new CURLFile( "newsbanner.jpeg" );

        $array2 = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/newsmodule/newsvideo" ) , TRUE );
        $videoDownloadUrl = $array2[ 'details' ][ 'videoDownloadUrl' ];
        #$telegram->sendMessage(['chat_id' => $chat_id, 'text' => $videoDownloadUrl]);
        $option = [
            [
                $telegram -> buildInlineKeyBoardButton ( "صفحه برنامه در سایت" , $url = "https://www.manototv.com/news" ) ,
            ] ,
            [
                $telegram -> buildInlineKeyBoardButton ( 'دانلود فایل ویدیویی' , $url = '' , $callback_data = "file=news=000" ) ,
            ] ,
            [
                $telegram -> buildInlineKeyBoardButton ( 'دانلود فایل صوتی' , $url = '' , $callback_data = "audio|news|000" ) ,
            ] ,
            [
                $telegram -> buildInlineKeyBoardButton ( 'گزارش های اخیر' , $url = '' , $callback_data = "news-clips0" ) ,
            ] ,
        ];
        $keyb = $telegram -> buildInlineKeyBoard ( $option );
        $telegram -> sendPhoto ( [ 'chat_id' => $chat_id , 'reply_markup' => $keyb , 'photo' => $ImgIxUrl , 'caption' => "@BachehayeManotoBot\n" . $headline . " " . $strapline1 , 'parse_mode' => 'HTML' ] );
        #unlink ( "newsbanner.jpeg" );
    }
    else if ( stristr ( $handler[ 1 ] , 'clips' ) == TRUE ) {
        $handler = explode ( "clips" , $handler[ 1 ] , 2 );
        if ( $handler[ 1 ] == "0" ) {
            $array = json_decode ( file_get_contents ( "https://dr905zevbmkvz.cloudfront.net/api/v1/publicrole/homemodule/news" ) , TRUE );
            $id = [];
            $Title = [];
            for ( $NO = 0 ; $NO < 5 ; $NO ++ ) {
                $id[] = $array[ 'details' ][ 'list' ][ $NO ][ 'id' ];
                $Title[] = $array[ 'details' ][ 'list' ][ $NO ][ 'newsTitle' ];
            }

            $option = [
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 0 ] , $url = "" , $callback_data = "news-vt" . $id[ 0 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 1 ] , $url = "" , $callback_data = "news-vt" . $id[ 1 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 2 ] , $url = "" , $callback_data = "news-vt" . $id[ 2 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 3 ] , $url = "" , $callback_data = "news-vt" . $id[ 3 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 4 ] , $url = "" , $callback_data = "news-vt" . $id[ 4 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( "صفحه 5" , $url = "" , $callback_data = "news-clips5" ) ,
                    $telegram -> buildInlineKeyBoardButton ( "صفحه 4" , $url = "" , $callback_data = "news-clips4" ) ,
                    $telegram -> buildInlineKeyBoardButton ( "صفحه 3" , $url = "" , $callback_data = "news-clips3" ) ,
                    $telegram -> buildInlineKeyBoardButton ( "صفحه 2" , $url = "" , $callback_data = "news-clips2" ) ,
                    $telegram -> buildInlineKeyBoardButton ( "(صفحه 1)" , $url = "" , $callback_data = "news-clips1" ) ,
                ] ,
            ];
            $keyb = $telegram -> buildInlineKeyBoard ( $option );
            $telegram -> SendMessage ( [ 'chat_id' => $chat_id , 'reply_markup' => $keyb , 'text' => "یکی از کلیپ ها رو انتخاب کنید صفحه 1" ] );
        }
        else if ( $handler[ 1 ] == "1" ) {
            $array = json_decode ( file_get_contents ( "https://dr905zevbmkvz.cloudfront.net/api/v1/publicrole/homemodule/news" ) , TRUE );
            $id = [];
            $Title = [];
            for ( $NO = 0 ; $NO < 5 ; $NO ++ ) {
                $id[] = $array[ 'details' ][ 'list' ][ $NO ][ 'id' ];
                $Title[] = $array[ 'details' ][ 'list' ][ $NO ][ 'newsTitle' ];
            }

            $option = [
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 0 ] , $url = "" , $callback_data = "news-vt" . $id[ 0 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 1 ] , $url = "" , $callback_data = "news-vt" . $id[ 1 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 2 ] , $url = "" , $callback_data = "news-vt" . $id[ 2 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 3 ] , $url = "" , $callback_data = "news-vt" . $id[ 3 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 4 ] , $url = "" , $callback_data = "news-vt" . $id[ 4 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( "صفحه 5" , $url = "" , $callback_data = "news-clips5" ) ,
                    $telegram -> buildInlineKeyBoardButton ( "صفحه 4" , $url = "" , $callback_data = "news-clips4" ) ,
                    $telegram -> buildInlineKeyBoardButton ( "صفحه 3" , $url = "" , $callback_data = "news-clips3" ) ,
                    $telegram -> buildInlineKeyBoardButton ( "صفحه 2" , $url = "" , $callback_data = "news-clips2" ) ,
                    $telegram -> buildInlineKeyBoardButton ( "(صفحه 1)" , $url = "" , $callback_data = "news-clips1" ) ,
                ] ,
            ];
            $keyb = $telegram -> buildInlineKeyBoard ( $option );
            $telegram -> editMessageText ( [ 'chat_id' => $chat_id , 'message_id' => $callbackmessage_id , 'reply_markup' => $keyb , 'text' => "یکی از کلیپ ها رو انتخاب کنید صفحه " . $handler[ 1 ] ] );
        }
        else if ( $handler[ 1 ] == "2" ) {
            $array = json_decode ( file_get_contents ( "https://dr905zevbmkvz.cloudfront.net/api/v1/publicrole/homemodule/news" ) , TRUE );
            $id = [];
            $Title = [];
            for ( $NO = 5 ; $NO < 10 ; $NO ++ ) {
                $id[] = $array[ 'details' ][ 'list' ][ $NO ][ 'id' ];
                $Title[] = $array[ 'details' ][ 'list' ][ $NO ][ 'newsTitle' ];
            }

            $option = [
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 0 ] , $url = "" , $callback_data = "news-vt" . $id[ 0 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 1 ] , $url = "" , $callback_data = "news-vt" . $id[ 1 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 2 ] , $url = "" , $callback_data = "news-vt" . $id[ 2 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 3 ] , $url = "" , $callback_data = "news-vt" . $id[ 3 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 4 ] , $url = "" , $callback_data = "news-vt" . $id[ 4 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( "صفحه 5" , $url = "" , $callback_data = "news-clips5" ) ,
                    $telegram -> buildInlineKeyBoardButton ( "صفحه 4" , $url = "" , $callback_data = "news-clips4" ) ,
                    $telegram -> buildInlineKeyBoardButton ( "صفحه 3" , $url = "" , $callback_data = "news-clips3" ) ,
                    $telegram -> buildInlineKeyBoardButton ( "(صفحه 2)" , $url = "" , $callback_data = "news-clips2" ) ,
                    $telegram -> buildInlineKeyBoardButton ( "صفحه 1" , $url = "" , $callback_data = "news-clips1" ) ,
                ] ,
            ];
            $keyb = $telegram -> buildInlineKeyBoard ( $option );
            $telegram -> editMessageText ( [ 'chat_id' => $chat_id , 'message_id' => $callbackmessage_id , 'reply_markup' => $keyb , 'text' => "یکی از کلیپ ها رو انتخاب کنید صفحه " . $handler[ 1 ] ] );
        }
        else if ( $handler[ 1 ] == "3" ) {
            $array = json_decode ( file_get_contents ( "https://dr905zevbmkvz.cloudfront.net/api/v1/publicrole/homemodule/news" ) , TRUE );
            $id = [];
            $Title = [];
            for ( $NO = 10 ; $NO < 15 ; $NO ++ ) {
                $id[] = $array[ 'details' ][ 'list' ][ $NO ][ 'id' ];
                $Title[] = $array[ 'details' ][ 'list' ][ $NO ][ 'newsTitle' ];
            }

            $option = [
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 0 ] , $url = "" , $callback_data = "news-vt" . $id[ 0 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 1 ] , $url = "" , $callback_data = "news-vt" . $id[ 1 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 2 ] , $url = "" , $callback_data = "news-vt" . $id[ 2 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 3 ] , $url = "" , $callback_data = "news-vt" . $id[ 3 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 4 ] , $url = "" , $callback_data = "news-vt" . $id[ 4 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( "صفحه 5" , $url = "" , $callback_data = "news-clips5" ) ,
                    $telegram -> buildInlineKeyBoardButton ( "صفحه 4" , $url = "" , $callback_data = "news-clips4" ) ,
                    $telegram -> buildInlineKeyBoardButton ( "(صفحه 3)" , $url = "" , $callback_data = "news-clips3" ) ,
                    $telegram -> buildInlineKeyBoardButton ( "صفحه 2" , $url = "" , $callback_data = "news-clips2" ) ,
                    $telegram -> buildInlineKeyBoardButton ( "صفحه 1" , $url = "" , $callback_data = "news-clips1" ) ,
                ] ,
            ];
            $keyb = $telegram -> buildInlineKeyBoard ( $option );
            $telegram -> editMessageText ( [ 'chat_id' => $chat_id , 'message_id' => $callbackmessage_id , 'reply_markup' => $keyb , 'text' => "یکی از کلیپ ها رو انتخاب کنید صفه " . $handler[ 1 ] ] );
        }
        else if ( $handler[ 1 ] == "4" ) {
            $array = json_decode ( file_get_contents ( "https://dr905zevbmkvz.cloudfront.net/api/v1/publicrole/homemodule/news" ) , TRUE );
            $id = [];
            $Title = [];
            for ( $NO = 15 ; $NO < 20 ; $NO ++ ) {
                $id[] = $array[ 'details' ][ 'list' ][ $NO ][ 'id' ];
                $Title[] = $array[ 'details' ][ 'list' ][ $NO ][ 'newsTitle' ];
            }

            $option = [
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 0 ] , $url = "" , $callback_data = "news-vt" . $id[ 0 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 1 ] , $url = "" , $callback_data = "news-vt" . $id[ 1 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 2 ] , $url = "" , $callback_data = "news-vt" . $id[ 2 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 3 ] , $url = "" , $callback_data = "news-vt" . $id[ 3 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 4 ] , $url = "" , $callback_data = "news-vt" . $id[ 4 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( "صفحه 5" , $url = "" , $callback_data = "news-clips5" ) ,
                    $telegram -> buildInlineKeyBoardButton ( "(صفحه 4)" , $url = "" , $callback_data = "news-clips4" ) ,
                    $telegram -> buildInlineKeyBoardButton ( "صفحه 3" , $url = "" , $callback_data = "news-clips3" ) ,
                    $telegram -> buildInlineKeyBoardButton ( "صفحه 2" , $url = "" , $callback_data = "news-clips2" ) ,
                    $telegram -> buildInlineKeyBoardButton ( "صفحه 1" , $url = "" , $callback_data = "news-clips1" ) ,
                ] ,
            ];
            $keyb = $telegram -> buildInlineKeyBoard ( $option );
            $telegram -> editMessageText ( [ 'chat_id' => $chat_id , 'message_id' => $callbackmessage_id , 'reply_markup' => $keyb , 'text' => "یکی از کلیپ ها رو انتخاب کنید صفحه " . $handler[ 1 ] ] );
        }
        else if ( $handler[ 1 ] == "5" ) {
            $array = json_decode ( file_get_contents ( "https://dr905zevbmkvz.cloudfront.net/api/v1/publicrole/homemodule/news" ) , TRUE );
            $id = [];
            $Title = [];
            for ( $NO = 20 ; $NO < 25 ; $NO ++ ) {
                $id[] = $array[ 'details' ][ 'list' ][ $NO ][ 'id' ];
                $Title[] = $array[ 'details' ][ 'list' ][ $NO ][ 'newsTitle' ];
            }

            $option = [
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 0 ] , $url = "" , $callback_data = "news-vt" . $id[ 0 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 1 ] , $url = "" , $callback_data = "news-vt" . $id[ 1 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 2 ] , $url = "" , $callback_data = "news-vt" . $id[ 2 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 3 ] , $url = "" , $callback_data = "news-vt" . $id[ 3 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $Title[ 4 ] , $url = "" , $callback_data = "news-vt" . $id[ 4 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( "(صفحه 5)" , $url = "" , $callback_data = "news-clips5" ) ,
                    $telegram -> buildInlineKeyBoardButton ( "صفحه 4" , $url = "" , $callback_data = "news-clips4" ) ,
                    $telegram -> buildInlineKeyBoardButton ( "صفحه 3" , $url = "" , $callback_data = "news-clips3" ) ,
                    $telegram -> buildInlineKeyBoardButton ( "صفحه 2" , $url = "" , $callback_data = "news-clips2" ) ,
                    $telegram -> buildInlineKeyBoardButton ( "صفحه 1" , $url = "" , $callback_data = "news-clips1" ) ,
                ] ,
            ];
            $keyb = $telegram -> buildInlineKeyBoard ( $option );
            $telegram -> editMessageText ( [ 'chat_id' => $chat_id , 'message_id' => $callbackmessage_id , 'reply_markup' => $keyb , 'text' => "یکی از کلیپ ها رو انتخاب کنید صفحه " . $handler[ 1 ] ] );
        }
    }
    else if ( stristr ( $handler[ 1 ] , 'vt' ) == TRUE ) {
        $handler = explode ( "vt" , $handler[ 1 ] , 2 );
        $array = json_decode ( file_get_contents ( "https://dr905zevbmkvz.cloudfront.net/api/v1/publicrole/newsmodule/details?id=" . $handler[ 1 ] ) , TRUE );
        $authorName = $array[ 'details' ][ 'authorName' ];
        $Title = $array[ 'details' ][ 'newsTitle' ];
        $Description = "@BachehayeManoto\n" . "*" . $authorName . "*" . "\n" . $array[ 'details' ][ 'newsContent' ];
        $Description = strip_tags ( $Description );
        $ImgUrl = $array[ 'details' ][ 'landscapeImgIxUrl' ];
        $DownloadUrl = $array[ 'details' ][ 'videoDownloadUrl' ];

        $option = [
            [
                $telegram -> buildInlineKeyBoardButton ( "صفحه برنامه در سایت" , $url = "https://www.manototv.com/news" ) ,
                $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/news/article/" . $handler[ 1 ] ) ,
            ] ,
            [
                $telegram -> buildInlineKeyBoardButton ( 'دانلود' , $url = '' , $callback_data = "video=newsclip=" . $handler[ 1 ] ) ,
            ] ,
        ];

        $keyb = $telegram -> buildInlineKeyBoard ( $option );
        $telegram -> sendPhoto ( [ 'chat_id' => $chat_id , 'reply_markup' => $keyb , 'photo' => $ImgUrl , 'caption' => $Description , 'parse_mode' => 'markdown' ] );
    }
}
else if ( stristr ( $text , 'days' ) == TRUE )
{
    $handler = explode ( "-" , $text , 2 );
    if ( $handler[ 1 ] == "menu" )
    {
        $day0 = date_create ( date ( "Y-m-d" ) );
        date_add ( $day0 , date_interval_create_from_date_string ( "-1 days" ) );
        $Day0 = date_format ( $day0 , "Y-m-d" );
        $Parts0 = explode ( '-' , $Day0 , 3 );
        $TimeStamp0 = mktime ( 0 , 0 , 0 , $Parts0[ 1 ] , $Parts0[ 2 ] , $Parts0[ 0 ] );
        $dayharfi0 = jgetdate ( $TimeStamp0 );
        $dateharfi0 = tr_num ( ( $dayharfi0[ weekday ] . " " . $dayharfi0[ mday ] . " " . $dayharfi0[ month ] . " " . $dayharfi0[ year ] ) , 'fa' );

        $day1 = date_create ( date ( "Y-m-d" ) );
        date_add ( $day1 , date_interval_create_from_date_string ( "0 days" ) );
        $Day1 = date_format ( $day1 , "Y-m-d" );
        $Parts1 = explode ( '-' , $Day1 , 3 );
        $TimeStamp1 = mktime ( 0 , 0 , 0 , $Parts1[ 1 ] , $Parts1[ 2 ] , $Parts1[ 0 ] );
        $dayharfi1 = jgetdate ( $TimeStamp1 );
        $dateharfi1 = tr_num ( ( $dayharfi1[ weekday ] . " " . $dayharfi1[ mday ] . " " . $dayharfi1[ month ] . " " . $dayharfi1[ year ] ) , 'fa' );
        $dayfa1 = $dayharfi1[ year ] . "-" . $dayharfi1[ mon ] . "-" . $dayharfi1[ mday ];

        $day2 = date_create ( date ( "Y-m-d" ) );
        date_add ( $day2 , date_interval_create_from_date_string ( "1 days" ) );
        $Day2 = date_format ( $day2 , "Y-m-d" );
        $Parts2 = explode ( '-' , $Day2 , 3 );
        $TimeStamp2 = mktime ( 0 , 0 , 0 , $Parts2[ 1 ] , $Parts2[ 2 ] , $Parts2[ 0 ] );
        $dayharfi2 = jgetdate ( $TimeStamp2 );
        $dateharfi2 = tr_num ( ( $dayharfi2[ weekday ] . " " . $dayharfi2[ mday ] . " " . $dayharfi2[ month ] . " " . $dayharfi2[ year ] ) , 'fa' );

        $day3 = date_create ( date ( "Y-m-d" ) );
        date_add ( $day3 , date_interval_create_from_date_string ( "2 days" ) );
        $Day3 = date_format ( $day3 , "Y-m-d" );
        $Parts3 = explode ( '-' , $Day3 , 3 );
        $TimeStamp3 = mktime ( 0 , 0 , 0 , $Parts3[ 1 ] , $Parts3[ 2 ] , $Parts3[ 0 ] );
        $dayharfi3 = jgetdate ( $TimeStamp3 );
        $dateharfi3 = tr_num ( ( $dayharfi3[ weekday ] . " " . $dayharfi3[ mday ] . " " . $dayharfi3[ month ] . " " . $dayharfi3[ year ] ) , 'fa' );

        $day4 = date_create ( date ( "Y-m-d" ) );
        date_add ( $day4 , date_interval_create_from_date_string ( "3 days" ) );
        $Day4 = date_format ( $day4 , "Y-m-d" );
        $Parts4 = explode ( '-' , $Day4 , 3 );
        $TimeStamp4 = mktime ( 0 , 0 , 0 , $Parts4[ 1 ] , $Parts4[ 2 ] , $Parts4[ 0 ] );
        $dayharfi4 = jgetdate ( $TimeStamp4 );
        $dateharfi4 = tr_num ( ( $dayharfi4[ weekday ] . " " . $dayharfi4[ mday ] . " " . $dayharfi4[ month ] . " " . $dayharfi4[ year ] ) , 'fa' );

        $day5 = date_create ( date ( "Y-m-d" ) );
        date_add ( $day5 , date_interval_create_from_date_string ( "4 days" ) );
        $Day5 = date_format ( $day5 , "Y-m-d" );
        $Parts5 = explode ( '-' , $Day5 , 3 );
        $TimeStamp5 = mktime ( 0 , 0 , 0 , $Parts5[ 1 ] , $Parts5[ 2 ] , $Parts5[ 0 ] );
        $dayharfi5 = jgetdate ( $TimeStamp5 );
        $dateharfi5 = tr_num ( ( $dayharfi5[ weekday ] . " " . $dayharfi5[ mday ] . " " . $dayharfi5[ month ] . " " . $dayharfi5[ year ] ) , 'fa' );

        $day6 = date_create ( date ( "Y-m-d" ) );
        date_add ( $day6 , date_interval_create_from_date_string ( "5 days" ) );
        $Day6 = date_format ( $day6 , "Y-m-d" );
        $Parts6 = explode ( '-' , $Day6 , 3 );
        $TimeStamp6 = mktime ( 0 , 0 , 0 , $Parts6[ 1 ] , $Parts6[ 2 ] , $Parts6[ 0 ] );
        $dayharfi6 = jgetdate ( $TimeStamp6 );
        $dateharfi6 = tr_num ( ( $dayharfi6[ weekday ] . " " . $dayharfi6[ mday ] . " " . $dayharfi6[ month ] . " " . $dayharfi6[ year ] ) , 'fa' );

        $day7 = date_create ( date ( "Y-m-d" ) );
        date_add ( $day7 , date_interval_create_from_date_string ( "6 days" ) );
        $Day7 = date_format ( $day7 , "Y-m-d" );
        $Parts7 = explode ( '-' , $Day7 , 3 );
        $TimeStamp7 = mktime ( 0 , 0 , 0 , $Parts7[ 1 ] , $Parts7[ 2 ] , $Parts7[ 0 ] );
        $dayharfi7 = jgetdate ( $TimeStamp7 );
        $dateharfi7 = tr_num ( ( $dayharfi7[ weekday ] . " " . $dayharfi7[ mday ] . " " . $dayharfi7[ month ] . " " . $dayharfi7[ year ] ) , 'fa' );

        $day8 = date_create ( date ( "Y-m-d" ) );
        date_add ( $day8 , date_interval_create_from_date_string ( "7 days" ) );
        $Day8 = date_format ( $day8 , "Y-m-d" );
        $Parts8 = explode ( '-' , $Day8 , 3 );
        $TimeStamp8 = mktime ( 0 , 0 , 0 , $Parts8[ 1 ] , $Parts8[ 2 ] , $Parts8[ 0 ] );
        $dayharfi8 = jgetdate ( $TimeStamp8 );
        $dateharfi8 = tr_num ( ( $dayharfi8[ weekday ] . " " . $dayharfi8[ mday ] . " " . $dayharfi8[ month ] . " " . $dayharfi8[ year ] ) , 'fa' );


        $option = [
            [
                $telegram -> buildInlineKeyBoardButton ( "فردا\n$dayharfi2[weekday] ($dayharfi2[mday])" , $url = '' , $callback_data = "days-zaman" . $Day2 ) ,
                $telegram -> buildInlineKeyBoardButton ( "امروز\n$dayharfi1[weekday] ($dayharfi1[mday])" , $url = '' , $callback_data = "days-zaman" . $Day1 ) ,
                $telegram -> buildInlineKeyBoardButton ( "دیروز\n$dayharfi0[weekday] ($dayharfi0[mday])" , $url = '' , $callback_data = "days-zaman" . $Day0 ) ,
            ] ,
            [
                $telegram -> buildInlineKeyBoardButton ( "$dayharfi5[weekday] ($dayharfi5[mday])" , $url = '' , $callback_data = "days-zaman" . $Day5 ) ,
                $telegram -> buildInlineKeyBoardButton ( "$dayharfi4[weekday] ($dayharfi4[mday])" , $url = '' , $callback_data = "days-zaman" . $Day4 ) ,
                $telegram -> buildInlineKeyBoardButton ( "$dayharfi3[weekday] ($dayharfi3[mday])" , $url = '' , $callback_data = "days-zaman" . $Day3 ) ,
            ] ,
            [
                $telegram -> buildInlineKeyBoardButton ( "$dayharfi8[weekday] ($dayharfi8[mday])" , $url = '' , $callback_data = "days-zaman" . $Day8 ) ,
                $telegram -> buildInlineKeyBoardButton ( "$dayharfi7[weekday] ($dayharfi7[mday])" , $url = '' , $callback_data = "days-zaman" . $Day7 ) ,
                $telegram -> buildInlineKeyBoardButton ( "$dayharfi6[weekday] ($dayharfi6[mday])" , $url = '' , $callback_data = "days-zaman" . $Day6 ) ,
            ] ,
            [
                $telegram -> buildInlineKeyBoardButton ( "بازگشت به منوی اصلی" , $url = '' , $callback_data = 'startmenu' ) ,
            ] ,
        ];

        $keyb = $telegram -> buildInlineKeyBoard ( $option );
        if ( $dayharfi1[month] == $dayharfi8[month])
        {
            $telegram -> editMessageText ( [ 'chat_id' => $chat_id , 'message_id' => $callbackmessage_id , 'reply_markup' => $keyb , 'text' => "روز مورد نظر را انتخاب کنید  " . tr_num ( "$dayharfi1[month]  $dayharfi1[year]" , 'fa' ) ] );
        }
        else if ($dayharfi1[year] == $dayharfi8[year])
        {
            $telegram -> editMessageText ( [ 'chat_id' => $chat_id , 'message_id' => $callbackmessage_id , 'reply_markup' => $keyb , 'text' => "روز مورد نظر را انتخاب کنید  " . tr_num ( "$dayharfi1[month] - $dayharfi8[month]  $dayharfi1[year]" , 'fa' ) ] );
        }
        else
        {
            $telegram -> editMessageText ( [ 'chat_id' => $chat_id , 'message_id' => $callbackmessage_id , 'reply_markup' => $keyb , 'text' => "روز مورد نظر را انتخاب کنید  " . tr_num ( "$dayharfi1[month]  $dayharfi1[year] - $dayharfi8[month]  $dayharfi8[year]" , 'fa' ) ] );
        }
    }
    else if ( stristr ( $handler[ 1 ] , 'zaman' ) == TRUE )
    {
    $getDateEN = explode ( "zaman" , $text , 2 );
    $ENDATE = $getDateEN[ 1 ];

    $firstdate = date_create ( "$ENDATE" );
    date_add ( $firstdate , date_interval_create_from_date_string ( "-1 days" ) );
    $ENDATEPre = date_format ( $firstdate , "Y-m-d" );

    $Parts = explode ( '-' , $ENDATE , 3 );
    $TimeStamp = mktime ( 0 , 0 , 0 , $Parts[ 1 ] , $Parts[ 2 ] , $Parts[ 0 ] );
    $dayharfi = jgetdate ( $TimeStamp );
    $dateharfi = tr_num ( ( $dayharfi[ weekday ] . " " . $dayharfi[ mday ] . " " . $dayharfi[ month ] . " " . $dayharfi[ year ] ) , 'fa' );

    $array = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/schedulemodule/schedule?from=" . $ENDATEPre . "T20:30:00.000Z&to=" . $ENDATE . "T20:30:00.000Z" ) , TRUE );
    $scheduleItemID = $array[ 'details' ][ 'list' ][ '0' ][ 'scheduleItemID' ];

    if ( is_numeric ( $scheduleItemID ) == "1" ) {
        $Random = rand ();
        $FileName = "myFile" . $Random . ".txt";
        $FileHandle = fopen ( $FileName , 'a' ) or die( "can't open file" );
        $stringData = "بچه ﻫﺎی ﻣﻦ و ﺗﻮ @BachehayeManotoBot\nﺑﺮﻧﺎﻣﻪ ﻫﺎی من و تو در تاریخ " . '*' . $dateharfi . '*' . "\n\n";
        fwrite ( $FileHandle , $stringData );
        #fclose ( $FileHandle );
        $number = 0;
        do {

            $dateUTC = $array[ 'details' ][ 'list' ][ $number ][ 'dateUTCRoundedDownToFiveMinutes' ];
            $showTitle = $array[ 'details' ][ 'list' ][ $number ][ 'showTitle' ];
            $episodeNumberen = $array[ 'details' ][ 'list' ][ $number ][ 'episodeNumber' ];
            $seasonNumberen = $array[ 'details' ][ 'list' ][ $number ][ 'seasonNumber' ];
            $showID = $array[ 'details' ][ 'list' ][ $number ][ 'showID' ];
            $episodeID = $array[ 'details' ][ 'list' ][ $number ][ 'episodeID' ];
            #$currentHouseNumber = $array['details']['list'][$number]['currentHouseNumber'];
            #$ImgIxUrl = $array['details']['list'][$number]['portraitImgIxUrl'];

            $time1 = explode ( "T" , $dateUTC , 2 );
            $time = explode ( ":" , $time1[ 1 ] , 3 );
            $hour = $time[ 0 ];
            $minute = $time[ 1 ];

            $Snum = strlen ( $seasonNumberen );
            if ( $Snum < 1 == TRUE ) {
                $ses = "";
            }
            if ( $Snum > 0 == TRUE ) {
                $seasonNumber = tr_num ( $seasonNumberen , 'fa' );
                $ses = "ﻓﺼﻞ " . $seasonNumber;
            }

            $Enum = strlen ( $episodeNumberen );
            if ( $Enum < 1 == TRUE ) {
                $epi = " ";
            }
            if ( $Enum > 0 == TRUE ) {
                $episodeNumber = tr_num ( $episodeNumberen , 'fa' );
                $epi = "ﻗﺴﻤﺖ " . $episodeNumber;

            }

            $timestamp = mktime ( $hour , $minute , 00 , $Month , $Day , $Year );
            $newdate = $timestamp + 12600;
            $result = date ( "H:i" , $newdate );
            $TimeFA = tr_num ( $result , 'fa' );

            $Shownum = strlen ( $showTitle );
            if ( $Shownum < 1 == TRUE ) {
                $stringData = "";
            }
            if ( $Shownum > 0 == TRUE ) {
                $showlink = "https://www.manototv.com/show/" . $showID;
                $episodelink = "https://www.manototv.com/episode/" . $episodeID;
                $stringData = "*" . $TimeFA . "*" . "\t\t" . "[" . $showTitle . "](" . $showlink . ") " . "\t\t\t" . $ses . "\t\t\t" . "[" . $epi . "](" . $episodelink . ")\n";
            }

            #$FileName = "myFile" . $Random . ".txt";
            #$FileHandle = fopen ( $FileName , 'a' ) or die( "can't open file" );
            fwrite ( $FileHandle , $stringData );

            $number = $number + 1;
        } while ( $number < 30 );
        fclose ( $FileHandle );
        #$FileName = "myFile" . $Random . ".txt";
        $sch2send = file_get_contents ( $FileName );
        $telegram -> sendMessage ( [ 'chat_id' => $chat_id , 'text' => $sch2send , 'parse_mode' => 'Markdown' , 'disable_web_page_preview' => "true" ] );
        unlink ( $FileName );
    }
    else {
        $telegram -> answerCallbackQuery ( [ 'callback_query_id' => $telegram -> Callback_ID () , 'text' => "اطلاعات در دسترس نیست" , 'show_alert' => TRUE ] );
    }
    }
}
else if ( stristr ( $text , 'last' ) == TRUE ) {
    $handler = explode ( "-" , $text , 2 );
    if ( $handler[ 1 ] == "3" )
    {
        $array = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/homemodule/catchupepsiodes" ) , TRUE );

        $number = 0;
        do {
            $episodeNumber = $array[ 'details' ][ 'list' ][ $number ][ 'episodeNumber' ];
            $ImgIxUrl = $array[ 'details' ][ 'list' ][ $number ][ 'landscapeImgIxUrl' ];
            #copy ( $ImgIxUrl , "last.jpg" );
            #$lastjpg = new CURLFile( "last.jpg" );
            $id = $array[ 'details' ][ 'list' ][ $number ][ 'id' ];
            $showID = $array[ 'details' ][ 'list' ][ $number ][ 'showID' ];
            $episodeDateUTC = $array[ 'details' ][ 'list' ][ $number ][ 'episodeDateUTC' ];
            $getdate1 = explode ( "T" , $episodeDateUTC , 2 );
            $getdate2 = explode ( "-" , $getdate1 [ 0 ] , 3 );
            $showtime = gregorian_to_jalali ( $getdate2 [ 0 ] , $getdate2 [ 1 ] , $getdate2 [ 2 ] , '-' );
            $showtimefa = tr_num ( $showtime , 'fa' );
            $showon = explode ( "-" , $showtimefa , 3 );

            if ( $showID == "1059" or "2619" ) {
                $array2 = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/metadatamodule/pagetitle?url=https://www.manototv.com/episode/" . $id ) , TRUE );
                $formattedEpisodeTitle = $array2[ 'details' ][ 'pageTitle' ];
            }
            else {
                $formattedEpisodeTitle = $array[ 'details' ][ 'list' ][ $number ][ 'formattedEpisodeTitle' ];
            }

            $caption = ( "@BachehayeManotoBot\n" . tr_num ( $formattedEpisodeTitle , 'fa' ) . "\nتاریخ پخش  " . $showon [ 2 ] . " " . $showon [ 1 ] . " " . $showon [ 0 ] );
            $array3 = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/episodedetails?id=$id" ) , TRUE );
            $videoDownloadUrl = $array3[ 'details' ][ 'videoDownloadUrl' ];

            if ( stristr ( $videoDownloadUrl , 'http' ) == TRUE ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "صفحه برنامه در سایت" , $url = "https://www.manototv.com/show/" . $showID ) ,
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/episode/" . $id ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات برنامه' , $url = '' , $callback_data = "showdetail" ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات قسمت' , $url = '' , $callback_data = "episodedetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'دانلود' , $url = '' , $callback_data = "file=video=" . $id ) ,
                    ] ,
                ];
            }
            else {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "صفحه برنامه در سایت" , $url = "https://www.manototv.com/show/" . $showID ) ,
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/episode/" . $id ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات برنامه' , $url = '' , $callback_data = "showdetail" ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات قسمت' , $url = '' , $callback_data = "episodedetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'دانلود 5 دقیقه ابتدایی' , $url = '' , $callback_data = "video|hls|" . $id ) ,
                    ] ,
                ];
            }

            $keyb = $telegram -> buildInlineKeyBoard ( $option );
            $telegram -> sendPhoto ( [ 'chat_id' => $chat_id , 'reply_markup' => $keyb , 'photo' => $ImgIxUrl , 'caption' => $caption ] );
            #unlink ( "last.jpg" );
            $number = $number + 1;
        }
        while ( $number < 3 );
        $option = [
            [
                $telegram -> buildInlineKeyBoardButton ( 'برنامه های بیشتر...' , $url = '' , $callback_data = "last-20" ) ,
            ] ,
        ];

        $keyb = $telegram -> buildInlineKeyBoard ( $option );
        $telegram -> sendMessage ( [ 'chat_id' => $chat_id , 'reply_markup' => $keyb , 'text' => "ﺑﺮای دیدن ادامه ﺑﺮﻧﺎﻣﻪ ها دکمه زیر را ﻟﻤﺲ کنید" ] );
    }
    if ( $handler[ 1 ] == "20" )
    {
        $telegram -> deleteMessage ( [ 'chat_id' => $chat_id , 'message_id' => $message_id ] );
        $array = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/homemodule/catchupepsiodes" ) , TRUE );

        $number = 3;
        do {
            $episodeNumber = $array[ 'details' ][ 'list' ][ $number ][ 'episodeNumber' ];
            $ImgIxUrl = $array[ 'details' ][ 'list' ][ $number ][ 'landscapeImgIxUrl' ];
            #copy ( $ImgIxUrl , "last.jpg" );
            #$lastjpg = new CURLFile( "last.jpg" );
            $id = $array[ 'details' ][ 'list' ][ $number ][ 'id' ];
            $showID = $array[ 'details' ][ 'list' ][ $number ][ 'showID' ];
            $episodeDateUTC = $array[ 'details' ][ 'list' ][ $number ][ 'episodeDateUTC' ];
            $getdate1 = explode ( "T" , $episodeDateUTC , 2 );
            $getdate2 = explode ( "-" , $getdate1 [ 0 ] , 3 );
            $showtime = gregorian_to_jalali ( $getdate2 [ 0 ] , $getdate2 [ 1 ] , $getdate2 [ 2 ] , '-' );
            $showtimefa = tr_num ( $showtime , 'fa' );
            $showon = explode ( "-" , $showtimefa , 3 );

            if ( $showID == "1059" or "2619" ) {
                $array2 = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/metadatamodule/pagetitle?url=https://www.manototv.com/episode/" . $lastid ) , TRUE );
                $formattedEpisodeTitle = $array2[ 'details' ][ 'pageTitle' ];
            } else {
                $formattedEpisodeTitle = $array[ 'details' ][ 'list' ][ $number ][ 'formattedEpisodeTitle' ];
            }

            $caption = ( "@BachehayeManotoBot\n" . tr_num ( $formattedEpisodeTitle , 'fa' ) . "\nتاریخ پخش  " . $showon [ 2 ] . " " . $showon [ 1 ] . " " . $showon [ 0 ] );
            $array3 = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/episodedetails?id=$id" ) , TRUE );
            $videoDownloadUrl = $array3[ 'details' ][ 'videoDownloadUrl' ];

            if ( stristr ( $videoDownloadUrl , 'http' ) == TRUE ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "صفحه برنامه در سایت" , $url = "https://www.manototv.com/show/" . $showID ) ,
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/episode/" . $id ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات برنامه' , $url = '' , $callback_data = "showdetail" ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات قسمت' , $url = '' , $callback_data = "episodedetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'دانلود' , $url = '' , $callback_data = "file=video=" . $id ) ,
                    ] ,
                ];
            }
            else {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "صفحه برنامه در سایت" , $url = "https://www.manototv.com/show/" . $showID ) ,
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/episode/" . $id ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات برنامه' , $url = '' , $callback_data = "showdetail" ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات قسمت' , $url = '' , $callback_data = "episodedetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'دانلود 5 دقیقه ابتدایی' , $url = '' , $callback_data = "video|hls|" . $id ) ,
                    ] ,
                ];
            }

            $keyb = $telegram -> buildInlineKeyBoard ( $option );
            $telegram -> sendPhoto ( [ 'chat_id' => $chat_id , 'reply_markup' => $keyb , 'photo' => $ImgIxUrl , 'caption' => $caption ] );
            #unlink ( "last.jpg" );
            $number = $number + 1;
        }
        while ( $number < 20 );
    }
}
else if ( stristr ( $text , 'option' ) == TRUE )
{
    $handler = explode ( "-" , $text , 2 );
    if ( $handler[ 1 ] == "frequency" )
    {
        $filefre = new CURLFile( "Manotofrequency.jpg" );
        #$filefre = "AgACAgQAAxkBAAIU7V5PFnpf0aiNtDUYmaI6n199deNrAAI-sTEbIeZ4UmnbAzoTL6FTnZmgGwAEAQADAgADbQADPcYHAAEYBA";
        $telegram -> sendPhoto ( [ 'chat_id' => $chat_id , 'photo' => $filefre , 'caption' => "@BachehayeManotoBot" ] );
    }
    else if ( $handler[ 1 ] == "app" )
    {
        $option = [
            [
                $telegram -> buildInlineKeyBoardButton ( "لینک دانلود" , $url = 'https://d2ad2ahvvsgngk.cloudfront.net/30010020.apk' , $callback_data = '' ) ,
            ] ,
            [
                $telegram -> buildInlineKeyBoardButton ( "پلی استور" , $url = 'https://play.google.com/store/apps/details?id=com.mtn.manoto' , $callback_data = '' ) ,
                $telegram -> buildInlineKeyBoardButton ( "اپ استور" , $url = 'https://apps.apple.com/us/app/marjan-television-network/id1176187407?ls=1' , $callback_data = '' ) ,
            ] ,
            [
                $telegram -> buildInlineKeyBoardButton ( "بازگشت به منوی اصلی" , $url = '' , $callback_data = 'startmenu' ) ,
            ] ,
        ];
        $keyb = $telegram -> buildInlineKeyBoard ( $option );

        $telegram -> editMessageText ( [ 'chat_id' => $chat_id , 'message_id' => $callbackmessage_id , 'reply_markup' => $keyb , 'text' => "لینک های دسترسی به اپ منوتو" ] );
    }
    else if ( $handler[ 1 ] == "send2all" )
    {
        #$filetxt = new CURLFile( "users.txt" );
        #$tedaduser = count ( file ( $filetxt ) );
        $users = file_get_contents ( 'users.txt' );
        $user = explode ( "\n" , $users );
        $tedaduser = count ( $user );

        $number = 1;
        do {
            $userchatid = $user[ $number ];
            $option =
                [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "اینستاگرام بچه های من و تو" , $url = "https://Instagram.com/BachehayeManototv" ) ,
                    ] ,
                ];

            $keyb = $telegram -> buildInlineKeyBoard ( $option );
            $telegram -> sendPhoto ( [ 'chat_id' => $userchatid , 'reply_markup' => $keyb , 'photo' => $file_id , 'caption' => $msgcaptiom ] );

            $number = $number + 1;
        }
        while ( $number <= $tedaduser );
        $telegram -> sendMessage ( [ 'chat_id' => '122558527' , 'text' => "sent to " . $tedaduser . " Users" ] );
    }
    else if ( $handler[ 1 ] == "senduserdata" )
    {
        $filetxt = new CURLFile( "users.txt" );
        #$tedaduser = count ( file ( $filetxt ) );
        $users = file_get_contents ( 'users.txt' );
        $user = explode ( "\n" , $users );
        $tedaduser = count ( $user );

        $telegram -> sendMessage ( [ 'chat_id' => '122558527' , 'text' => $tedaduser . " Users" ] );
        $telegram -> sendDocument ( [ 'chat_id' => '122558527' , 'document' => $filetxt ] );
    }
}
else if ( stristr ( $text , 'genres' ) == TRUE )
{
    $handler = explode ( "-" , $text , 2 );
    if ( $handler[ 1 ] == "menu" )
    {
        #$array = json_decode(file_get_contents("https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/genres"), true);
        #$genre0 = $array['details']['list']['0']['title'];
        #$genre1 = $array['details']['list']['1']['title'];
        #$genre2 = $array['details']['list']['2']['title'];
        #$genre3 = $array['details']['list']['3']['title'];
        #$genre4 = $array['details']['list']['4']['title'];
        #$genre5 = $array['details']['list']['5']['title'];
        #$genre6 = $array['details']['list']['6']['title'];
        #$genre7 = $array['details']['list']['7']['title'];
        #$genre8 = $array['details']['list']['8']['title'];
        #$genre9 = $array['details']['list']['9']['title'];

        $option = [
            [
                $telegram -> buildInlineKeyBoardButton ( "Manoto Original" , $url = '' , $callback_data = "genres-Manoto+OriginalGNR1" ) ,
            ] ,
            [
                $telegram -> buildInlineKeyBoardButton ( "سرگرمی" , $url = '' , $callback_data = "genres-EntertainmentGNR1" ) ,
                $telegram -> buildInlineKeyBoardButton ( "سیاسی/اجتماعی" , $url = '' , $callback_data = "genres-Current+AffairsGNR1" ) ,
                $telegram -> buildInlineKeyBoardButton ( "کمدی" , $url = '' , $callback_data = "genres-ComedyGNR1" ) ,
            ] ,
            [
                $telegram -> buildInlineKeyBoardButton ( "تاریخی" , $url = '' , $callback_data = "genres-HistoryGNR1" ) ,
                $telegram -> buildInlineKeyBoardButton ( "سریال" , $url = '' , $callback_data = "genres-DramaGNR1" ) ,
                $telegram -> buildInlineKeyBoardButton ( "حیات وحش" , $url = '' , $callback_data = "genres-WildlifeGNR1" ) ,
            ] ,
            [
                $telegram -> buildInlineKeyBoardButton ( "فرهنگ و هنر" , $url = '' , $callback_data = "genres-Art+%26+CultureGNR1" ) ,
                $telegram -> buildInlineKeyBoardButton ( "علمی" , $url = '' , $callback_data = "genres-ScienceGNR1" ) ,
                $telegram -> buildInlineKeyBoardButton ( "ویژه برنامه" , $url = '' , $callback_data = "genres-Special+GNR1" ) ,
            ] ,
            [
                $telegram -> buildInlineKeyBoardButton ( "همه برنامه ها" , $url = '' , $callback_data = "genres-GNR1" ) ,
            ] ,
            [
                $telegram -> buildInlineKeyBoardButton ( "بازگشت به منوی اصلی" , $url = '' , $callback_data = 'startmenu' ) ,
            ] ,
        ];

        $keyb = $telegram -> buildInlineKeyBoard ( $option );
        $telegram -> editMessageText ( [ 'chat_id' => $chat_id , 'message_id' => $callbackmessage_id , 'reply_markup' => $keyb , 'text' => "ژانر مورد نظر رو انتخاب کنید" ] );
    }
    else if ( stristr ( $handler[ 1 ] , 'gnr' ) == TRUE ) # show show page
    {
        $gnr = explode ( 'gnr' , $handler[ 1 ] );
        $array = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/list?sortBy=latest&genre=" . $gnr[ 0 ] . "&pageNumber=" . $gnr[ 1 ] . "&pageSize=21" ) , TRUE );
        $resultsCount = $array['details']['resultsCount'];
        $TedadPage = intdiv($resultsCount,21);

        $id = [];
        $formattedShowTitle = [];

        for ( $NO = 0 ; $NO < 21 ; $NO ++ ) {
            $id[] = $array[ 'details' ][ 'list' ][ $NO ][ 'id' ];
            $formattedShowTitle[] = $array[ 'details' ][ 'list' ][ $NO ][ 'formattedShowTitle' ];
        }

        if ($TedadPage < 10)
        {
            $TedadPage = $TedadPage +1 ;
            if ($TedadPage == 1)
            {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[2] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[2] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[1] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[1] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[0] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[0] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[5] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[5] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[4] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[4] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[3] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[3] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[8] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[8] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[7] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[7] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[6] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[6] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[11] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[11] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[10] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[10] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[9] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[9] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[14] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[14] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[13] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[13] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[12] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[12] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[17] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[17] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[16] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[16] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[15] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[15] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[20] . " " , $url = '' , $callback_data = 'genres-showsid'. $id[20] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[19] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[19] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[18] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[18] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت به منوی اصلی" , $url = '' , $callback_data = 'startmenu' ) ,
                        $telegram -> buildInlineKeyBoardButton ( "ژانرها" , $url = '' , $callback_data = 'genres-menu' ) ,
                    ] ,
                ];
            }
            else if ($TedadPage == 2)
            {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[2] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[2] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[1] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[1] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[0] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[0] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[5] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[5] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[4] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[4] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[3] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[3] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[8] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[8] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[7] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[7] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[6] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[6] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[11] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[11] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[10] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[10] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[9] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[9] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[14] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[14] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[13] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[13] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[12] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[12] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[17] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[17] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[16] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[16] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[15] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[15] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[20] . " " , $url = '' , $callback_data = 'genres-showsid'. $id[20] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[19] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[19] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[18] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[18] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۲" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR2') ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۱" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR1' ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت به منوی اصلی" , $url = '' , $callback_data = 'startmenu' ) ,
                        $telegram -> buildInlineKeyBoardButton ( "ژانرها" , $url = '' , $callback_data = 'genres-menu' ) ,
                    ] ,
                ];
            }
            else if ($TedadPage == 3)
            {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[2] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[2] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[1] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[1] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[0] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[0] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[5] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[5] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[4] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[4] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[3] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[3] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[8] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[8] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[7] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[7] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[6] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[6] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[11] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[11] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[10] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[10] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[9] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[9] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[14] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[14] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[13] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[13] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[12] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[12] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[17] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[17] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[16] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[16] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[15] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[15] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[20] . " " , $url = '' , $callback_data = 'genres-showsid'. $id[20] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[19] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[19] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[18] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[18] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۳" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR3') ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۲" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR2') ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۱" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR1' ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت به منوی اصلی" , $url = '' , $callback_data = 'startmenu' ) ,
                        $telegram -> buildInlineKeyBoardButton ( "ژانرها" , $url = '' , $callback_data = 'genres-menu' ) ,
                    ] ,
                ];
            }
            else if ($TedadPage == 4)
            {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[2] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[2] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[1] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[1] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[0] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[0] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[5] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[5] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[4] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[4] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[3] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[3] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[8] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[8] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[7] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[7] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[6] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[6] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[11] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[11] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[10] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[10] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[9] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[9] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[14] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[14] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[13] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[13] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[12] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[12] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[17] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[17] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[16] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[16] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[15] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[15] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[20] . " " , $url = '' , $callback_data = 'genres-showsid'. $id[20] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[19] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[19] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[18] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[18] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۴" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR4') ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۳" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR3') ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۲" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR2') ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۱" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR1' ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت به منوی اصلی" , $url = '' , $callback_data = 'startmenu' ) ,
                        $telegram -> buildInlineKeyBoardButton ( "ژانرها" , $url = '' , $callback_data = 'genres-menu' ) ,
                    ] ,
                ];
            }
            else if ($TedadPage == 5)
            {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[2] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[2] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[1] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[1] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[0] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[0] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[5] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[5] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[4] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[4] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[3] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[3] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[8] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[8] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[7] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[7] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[6] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[6] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[11] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[11] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[10] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[10] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[9] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[9] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[14] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[14] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[13] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[13] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[12] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[12] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[17] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[17] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[16] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[16] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[15] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[15] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[20] . " " , $url = '' , $callback_data = 'genres-showsid'. $id[20] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[19] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[19] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[18] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[18] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۳" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR3') ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۲" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR2') ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۱" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR1' ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۵" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR5') ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۴" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR4') ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت به منوی اصلی" , $url = '' , $callback_data = 'startmenu' ) ,
                        $telegram -> buildInlineKeyBoardButton ( "ژانرها" , $url = '' , $callback_data = 'genres-menu' ) ,
                    ] ,
                ];
            }
            else if ($TedadPage == 6)
            {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[2] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[2] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[1] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[1] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[0] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[0] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[5] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[5] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[4] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[4] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[3] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[3] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[8] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[8] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[7] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[7] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[6] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[6] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[11] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[11] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[10] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[10] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[9] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[9] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[14] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[14] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[13] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[13] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[12] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[12] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[17] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[17] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[16] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[16] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[15] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[15] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[20] . " " , $url = '' , $callback_data = 'genres-showsid'. $id[20] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[19] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[19] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[18] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[18] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۳" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR3') ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۲" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR2') ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۱" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR1' ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۶" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR6') ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۵" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR5') ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۴" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR4') ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت به منوی اصلی" , $url = '' , $callback_data = 'startmenu' ) ,
                        $telegram -> buildInlineKeyBoardButton ( "ژانرها" , $url = '' , $callback_data = 'genres-menu' ) ,
                    ] ,
                ];
            }
            else if ($TedadPage == 7)
            {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[2] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[2] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[1] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[1] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[0] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[0] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[5] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[5] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[4] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[4] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[3] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[3] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[8] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[8] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[7] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[7] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[6] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[6] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[11] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[11] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[10] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[10] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[9] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[9] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[14] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[14] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[13] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[13] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[12] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[12] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[17] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[17] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[16] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[16] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[15] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[15] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[20] . " " , $url = '' , $callback_data = 'genres-showsid'. $id[20] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[19] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[19] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[18] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[18] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۴" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR4') ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۳" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR3') ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۲" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR2') ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۱" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR1' ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۷" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR7') ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۶" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR6') ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۵" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR5') ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت به منوی اصلی" , $url = '' , $callback_data = 'startmenu' ) ,
                        $telegram -> buildInlineKeyBoardButton ( "ژانرها" , $url = '' , $callback_data = 'genres-menu' ) ,
                    ] ,
                ];
            }
            else if ($TedadPage == 8)
            {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[2] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[2] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[1] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[1] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[0] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[0] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[5] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[5] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[4] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[4] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[3] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[3] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[8] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[8] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[7] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[7] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[6] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[6] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[11] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[11] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[10] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[10] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[9] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[9] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[14] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[14] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[13] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[13] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[12] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[12] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[17] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[17] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[16] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[16] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[15] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[15] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[20] . " " , $url = '' , $callback_data = 'genres-showsid'. $id[20] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[19] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[19] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[18] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[18] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۴" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR4') ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۳" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR3') ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۲" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR2') ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۱" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR1' ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۸" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR8' ) ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۷" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR7') ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۶" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR6') ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۵" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR5') ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت به منوی اصلی" , $url = '' , $callback_data = 'startmenu' ) ,
                        $telegram -> buildInlineKeyBoardButton ( "ژانرها" , $url = '' , $callback_data = 'genres-menu' ) ,
                    ] ,
                ];
            }
            else if ($TedadPage == 9)
            {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[2] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[2] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[1] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[1] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[0] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[0] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[5] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[5] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[4] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[4] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[3] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[3] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[8] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[8] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[7] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[7] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[6] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[6] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[11] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[11] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[10] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[10] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[9] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[9] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[14] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[14] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[13] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[13] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[12] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[12] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[17] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[17] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[16] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[16] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[15] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[15] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[20] . " " , $url = '' , $callback_data = 'genres-showsid'. $id[20] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[19] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[19] ) ,
                        $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[18] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[18] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۵" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR5') ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۴" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR4') ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۳" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR3') ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۲" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR2') ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۱" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR1' ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۹" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR9') ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۸" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR8' ) ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۷" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR7') ,
                        $telegram -> buildInlineKeyBoardButton ( "صفحه ۶" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR6') ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت به منوی اصلی" , $url = '' , $callback_data = 'startmenu' ) ,
                        $telegram -> buildInlineKeyBoardButton ( "ژانرها" , $url = '' , $callback_data = 'genres-menu' ) ,
                    ] ,
                ];
            }

        }
        else
        {
            $TedadPage = "10";
            $option = [
                [
                    $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[2] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[2] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[1] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[1] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[0] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[0] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[5] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[5] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[4] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[4] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[3] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[3] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[8] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[8] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[7] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[7] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[6] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[6] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[11] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[11] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[10] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[10] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[9] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[9] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[14] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[14] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[13] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[13] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[12] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[12] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[17] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[17] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[16] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[16] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[15] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[15] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[20] . " " , $url = '' , $callback_data = 'genres-showsid'. $id[20] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[19] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[19] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $formattedShowTitle[18] . " " , $url = '' , $callback_data = 'genres-showsid' . $id[18] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( "صفحه ۵" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR5') ,
                    $telegram -> buildInlineKeyBoardButton ( "صفحه ۴" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR4') ,
                    $telegram -> buildInlineKeyBoardButton ( "صفحه ۳" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR3') ,
                    $telegram -> buildInlineKeyBoardButton ( "صفحه ۲" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR2') ,
                    $telegram -> buildInlineKeyBoardButton ( "صفحه ۱" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR1' ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( "صفحه ۱۰" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR10') ,
                    $telegram -> buildInlineKeyBoardButton ( "صفحه ۹" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR9') ,
                    $telegram -> buildInlineKeyBoardButton ( "صفحه ۸" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR8' ) ,
                    $telegram -> buildInlineKeyBoardButton ( "صفحه ۷" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR7') ,
                    $telegram -> buildInlineKeyBoardButton ( "صفحه ۶" , $url = '' , $callback_data = 'genres-' . $gnr[ 0 ] . 'GNR6') ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( "بازگشت به منوی اصلی" , $url = '' , $callback_data = 'startmenu' ) ,
                    $telegram -> buildInlineKeyBoardButton ( "ژانرها" , $url = '' , $callback_data = 'genres-menu' ) ,
                ] ,
            ];
        }

        $PageNo = tr_num ( $gnr[ 1 ] , 'fa' );
        $keyb = $telegram -> buildInlineKeyBoard ( $option );
        $telegram -> editMessageText ( [ 'chat_id' => $chat_id , 'message_id' => $callbackmessage_id , 'reply_markup' => $keyb , 'text' => "برنامه موردنظرتون رو انتخاب کنید - صفحه " . $PageNo ] );
    }
    else if ( stristr ( $handler[ 1 ] , 'showsid' ) == TRUE ) {
        $showid = explode ( 'showsid' , $handler[ 1 ] );
        $array = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/details?id=" . $showid[ 1 ] ) , TRUE );
        $Title = $array[ 'details' ][ 'showTitle' ];
        $ImgIxUrl = $array[ 'details' ][ 'overlayImgIxUrl' ];
        $ShortDescription = $array[ 'details' ][ 'showShortDescription' ];
        $ShortDescription = strip_tags ( $ShortDescription );
        $ShortDescription = str_replace ( "&laquo;" , " " , $ShortDescription );
        $ShortDescription = str_replace ( "&zwnj;" , " " , $ShortDescription );
        $ShortDescription = str_replace ( "&raquo;" , " " , $ShortDescription );
        $ShortDescription = str_replace ( "&nbsp;" , " " , $ShortDescription );
        $caption = ( "@BachehayeManotoBot\n" . '<b>' . $Title . '</b>' . "\n" . $ShortDescription );

        $array2 = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/serieslist?id=" . $showid[ 1 ] ) , TRUE );
        $serieList = $array2[ 'details' ][ 'list' ];
        $tedadserie = count ( $serieList );
        $array3 = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/videocliplist?id=" . $showid[ 1 ] ) , TRUE );
        $vtsid = $array3[ 'details' ][ 'list' ][ '0' ][ 'id' ];
        $countserie = count ( $serieList );
        $serieTitle = [];
        $serieID = [];
        for ( $p = 0 ; $p < $countserie ; $p ++ ) {
            $serieTitle[] = $array2[ 'details' ][ 'list' ][ $p ][ 'displayTitle' ];
            $serieID[] = $array2[ 'details' ][ 'list' ][ $p ][ 'id' ];
        }
        if ( is_numeric ( $vtsid ) == "1" ) {
            if ( $tedadserie == 0 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/show/" . $showid[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات' , $url = '' , $callback_data = "showdetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش در هفت روز آینده' , $url = '' , $callback_data = "genres-playontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش و تکرار' , $url = '' , $callback_data = "genres-repeatontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "ویدیوهای کوتاه" , $url = '' , $callback_data = "genres-vts" . $showid[ 1 ] ) ,
                    ] ,
                ];
            }
            else if ( $tedadserie == 1 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/show/" . $showid[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات' , $url = '' , $callback_data = "showdetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش در هفت روز آینده' , $url = '' , $callback_data = "genres-playontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش و تکرار' , $url = '' , $callback_data = "genres-repeatontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[0]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 0 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "ویدیوهای کوتاه" , $url = '' , $callback_data = "genres-vts" . $showid[ 1 ] ) ,
                    ] ,
                ];
            }
            else if ( $tedadserie == 2 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/show/" . $showid[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات' , $url = '' , $callback_data = "showdetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش در هفت روز آینده' , $url = '' , $callback_data = "genres-playontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش و تکرار' , $url = '' , $callback_data = "genres-repeatontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[0]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 0 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[1]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "ویدیوهای کوتاه" , $url = '' , $callback_data = "genres-vts" . $showid[ 1 ] ) ,
                    ] ,
                ];
            }
            else if ( $tedadserie == 3 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/show/" . $showid[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات' , $url = '' , $callback_data = "showdetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش در هفت روز آینده' , $url = '' , $callback_data = "genres-playontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش و تکرار' , $url = '' , $callback_data = "genres-repeatontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[0]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 0 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[1]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[2]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 2 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "ویدیوهای کوتاه" , $url = '' , $callback_data = "genres-vts" . $showid[ 1 ] ) ,
                    ] ,
                ];
            }
            else if ( $tedadserie == 4 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/show/" . $showid[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات' , $url = '' , $callback_data = "showdetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش در هفت روز آینده' , $url = '' , $callback_data = "genres-playontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش و تکرار' , $url = '' , $callback_data = "genres-repeatontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[2]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 2 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[3]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 3 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[0]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 0 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[1]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "ویدیوهای کوتاه" , $url = '' , $callback_data = "genres-vts" . $showid[ 1 ] ) ,
                    ] ,
                ];
            }
            else if ( $tedadserie == 5 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/show/" . $showid[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات' , $url = '' , $callback_data = "showdetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش در هفت روز آینده' , $url = '' , $callback_data = "genres-playontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش و تکرار' , $url = '' , $callback_data = "genres-repeatontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[3]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 3 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[4]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 4 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[0]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 0 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[1]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[2]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 2 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "ویدیوهای کوتاه" , $url = '' , $callback_data = "genres-vts" . $showid[ 1 ] ) ,
                    ] ,
                ];
            }
            else if ( $tedadserie == 6 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/show/" . $showid[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات' , $url = '' , $callback_data = "showdetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش در هفت روز آینده' , $url = '' , $callback_data = "genres-playontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش و تکرار' , $url = '' , $callback_data = "genres-repeatontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[3]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 3 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[4]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 4 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[5]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 5 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[0]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 0 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[1]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[2]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 2 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "ویدیوهای کوتاه" , $url = '' , $callback_data = "genres-vts" . $showid[ 1 ] ) ,
                    ] ,
                ];
            }
            else if ( $tedadserie == 7 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/show/" . $showid[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات' , $url = '' , $callback_data = "showdetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش در هفت روز آینده' , $url = '' , $callback_data = "genres-playontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش و تکرار' , $url = '' , $callback_data = "genres-repeatontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[6]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 6 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[3]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 3 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[4]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 4 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[5]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 5 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[0]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 0 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[1]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[2]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 2 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "ویدیوهای کوتاه" , $url = '' , $callback_data = "genres-vts" . $showid[ 1 ] ) ,
                    ] ,
                ];
            }
            else if ( $tedadserie == 8 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/show/" . $showid[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات' , $url = '' , $callback_data = "showdetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش در هفت روز آینده' , $url = '' , $callback_data = "genres-playontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش و تکرار' , $url = '' , $callback_data = "genres-repeatontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[6]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 6 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[7]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 7 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[3]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 3 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[4]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 4 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[5]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 5 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[0]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 0 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[1]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[2]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 2 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "ویدیوهای کوتاه" , $url = '' , $callback_data = "genres-vts" . $showid[ 1 ] ) ,
                    ] ,
                ];
            }
            else if ( $tedadserie == 9 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/show/" . $showid[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات' , $url = '' , $callback_data = "showdetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش در هفت روز آینده' , $url = '' , $callback_data = "genres-playontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش و تکرار' , $url = '' , $callback_data = "genres-repeatontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[6]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 6 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[7]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 7 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[8]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 8 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[3]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 3 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[4]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 4 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[5]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 5 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[0]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 0 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[1]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[2]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 2 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "ویدیوهای کوتاه" , $url = '' , $callback_data = "genres-vts" . $showid[ 1 ] ) ,
                    ] ,
                ];
            }
            else if ( $tedadserie == 10 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/show/" . $showid[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات' , $url = '' , $callback_data = "showdetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش در هفت روز آینده' , $url = '' , $callback_data = "genres-playontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش و تکرار' , $url = '' , $callback_data = "genres-repeatontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[9]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 9 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[6]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 6 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[7]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 7 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[8]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 8 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[3]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 3 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[4]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 4 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[5]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 5 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[0]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 0 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[1]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[2]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 2 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "ویدیوهای کوتاه" , $url = '' , $callback_data = "genres-vts" . $showid[ 1 ] ) ,
                    ] ,
                ];
            }
            else if ( $tedadserie == 11 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/show/" . $showid[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات' , $url = '' , $callback_data = "showdetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش در هفت روز آینده' , $url = '' , $callback_data = "genres-playontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش و تکرار' , $url = '' , $callback_data = "genres-repeatontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[9]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 9 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[10]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 10 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[6]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 6 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[7]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 7 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[8]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 8 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[3]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 3 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[4]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 4 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[5]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 5 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[0]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 0 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[1]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[2]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 2 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "ویدیوهای کوتاه" , $url = '' , $callback_data = "genres-vts" . $showid[ 1 ] ) ,
                    ] ,
                ];
            }
            else if ( $tedadserie >= 12 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/show/" . $showid[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات' , $url = '' , $callback_data = "showdetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش در هفت روز آینده' , $url = '' , $callback_data = "genres-playontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش و تکرار' , $url = '' , $callback_data = "genres-repeatontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[9]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 9 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[10]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 10 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[11]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 11 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[6]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 6 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[7]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 7 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[8]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 8 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[3]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 3 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[4]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 4 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[5]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 5 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[0]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 0 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[1]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[2]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 2 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "ویدیوهای کوتاه" , $url = '' , $callback_data = "genres-vts" . $showid[ 1 ] ) ,
                    ] ,
                ];
            }

        }
        else {
            if ( $tedadserie == 0 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/show/" . $showid[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات' , $url = '' , $callback_data = "showdetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش در هفت روز آینده' , $url = '' , $callback_data = "genres-playontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش و تکرار' , $url = '' , $callback_data = "genres-repeatontv" . $showid[ 1 ] ) ,
                    ] ,
                ];
            }
            else if ( $tedadserie == 1 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/show/" . $showid[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات' , $url = '' , $callback_data = "showdetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش در هفت روز آینده' , $url = '' , $callback_data = "genres-playontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش و تکرار' , $url = '' , $callback_data = "genres-repeatontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[0]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 0 ] ) ,
                    ] ,
                ];
            }
            else if ( $tedadserie == 2 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/show/" . $showid[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات' , $url = '' , $callback_data = "showdetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش در هفت روز آینده' , $url = '' , $callback_data = "genres-playontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش و تکرار' , $url = '' , $callback_data = "genres-repeatontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[0]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 0 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[1]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 1 ] ) ,
                    ] ,
                ];
            }
            else if ( $tedadserie == 3 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/show/" . $showid[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات' , $url = '' , $callback_data = "showdetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش در هفت روز آینده' , $url = '' , $callback_data = "genres-playontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش و تکرار' , $url = '' , $callback_data = "genres-repeatontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[0]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 0 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[1]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[2]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 2 ] ) ,
                    ] ,
                ];
            }
            else if ( $tedadserie == 4 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/show/" . $showid[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات' , $url = '' , $callback_data = "showdetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش در هفت روز آینده' , $url = '' , $callback_data = "genres-playontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش و تکرار' , $url = '' , $callback_data = "genres-repeatontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[2]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 2 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[3]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 3 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[0]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 0 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[1]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 1 ] ) ,
                    ] ,
                ];
            }
            else if ( $tedadserie == 5 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/show/" . $showid[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات' , $url = '' , $callback_data = "showdetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش در هفت روز آینده' , $url = '' , $callback_data = "genres-playontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش و تکرار' , $url = '' , $callback_data = "genres-repeatontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[3]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 3 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[4]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 4 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[0]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 0 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[1]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[2]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 2 ] ) ,
                    ] ,
                ];
            }
            else if ( $tedadserie == 6 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/show/" . $showid[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات' , $url = '' , $callback_data = "showdetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش در هفت روز آینده' , $url = '' , $callback_data = "genres-playontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش و تکرار' , $url = '' , $callback_data = "genres-repeatontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[3]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 3 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[4]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 4 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[5]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 5 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[0]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 0 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[1]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[2]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 2 ] ) ,
                    ] ,
                ];
            }
            else if ( $tedadserie == 7 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/show/" . $showid[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات' , $url = '' , $callback_data = "showdetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش در هفت روز آینده' , $url = '' , $callback_data = "genres-playontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش و تکرار' , $url = '' , $callback_data = "genres-repeatontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[6]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 6 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[3]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 3 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[4]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 4 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[5]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 5 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[0]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 0 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[1]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[2]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 2 ] ) ,
                    ] ,
                ];
            }
            else if ( $tedadserie == 8 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/show/" . $showid[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات' , $url = '' , $callback_data = "showdetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش در هفت روز آینده' , $url = '' , $callback_data = "genres-playontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش و تکرار' , $url = '' , $callback_data = "genres-repeatontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[6]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 6 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[7]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 7 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[3]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 3 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[4]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 4 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[5]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 5 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[0]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 0 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[1]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[2]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 2 ] ) ,
                    ] ,
                ];
            }
            else if ( $tedadserie == 9 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/show/" . $showid[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات' , $url = '' , $callback_data = "showdetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش در هفت روز آینده' , $url = '' , $callback_data = "genres-playontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش و تکرار' , $url = '' , $callback_data = "genres-repeatontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[6]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 6 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[7]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 7 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[8]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 8 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[3]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 3 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[4]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 4 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[5]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 5 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[0]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 0 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[1]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[2]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 2 ] ) ,
                    ] ,
                ];
            }
            else if ( $tedadserie == 10 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/show/" . $showid[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات' , $url = '' , $callback_data = "showdetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش در هفت روز آینده' , $url = '' , $callback_data = "genres-playontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش و تکرار' , $url = '' , $callback_data = "genres-repeatontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[9]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 9 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[6]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 6 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[7]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 7 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[8]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 8 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[3]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 3 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[4]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 4 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[5]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 5 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[0]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 0 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[1]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[2]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 2 ] ) ,
                    ] ,
                ];
            }
            else if ( $tedadserie == 11 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/show/" . $showid[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات' , $url = '' , $callback_data = "showdetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش در هفت روز آینده' , $url = '' , $callback_data = "genres-playontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش و تکرار' , $url = '' , $callback_data = "genres-repeatontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[9]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 9 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[10]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 10 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[6]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 6 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[7]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 7 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[8]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 8 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[3]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 3 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[4]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 4 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[5]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 5 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[0]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 0 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[1]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[2]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 2 ] ) ,
                    ] ,
                ];
            }
            else if ( $tedadserie >= 12 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/show/" . $showid[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات' , $url = '' , $callback_data = "showdetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش در هفت روز آینده' , $url = '' , $callback_data = "genres-playontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'ساعت های پخش و تکرار' , $url = '' , $callback_data = "genres-repeatontv" . $showid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[9]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 9 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[10]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 10 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[11]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 11 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[6]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 6 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[7]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 7 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[8]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 8 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[3]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 3 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[4]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 4 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[5]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 5 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[0]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 0 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[1]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 1 ] ) ,
                        $telegram -> buildInlineKeyBoardButton ( "$serieTitle[2]" , $url = '' , $callback_data = "genres-Serielist" . $serieID[ 2 ] ) ,
                    ] ,
                ];
            }
        }
        $keyb = $telegram -> buildInlineKeyBoard ( $option );
        if ($showid[ 0 ] == "edit")
        {
            $telegram -> editMessageCaption ( [ 'chat_id' => $chat_id , 'reply_markup' => $keyb , 'caption' => $caption , 'message_id' => $message_id , 'parse_mode' => 'HTML' ] );
        }
        else
            {
                $telegram -> sendPhoto ( [ 'chat_id' => $chat_id , 'reply_markup' => $keyb , 'photo' => $ImgIxUrl , 'caption' => $caption , 'reply_to_message_id' => $callbackmessage_id , 'parse_mode' => 'HTML' ] );
            }
    }
    else if ( stristr ( $handler[ 1 ] , 'playontv' ) == TRUE ) {
        $showid = explode ( 'playontv' , $handler[ 1 ] );

        $day1 = date_create ( date ( "Y-m-d" ) );
        date_add ( $day1 , date_interval_create_from_date_string ( "-1 days" ) );
        $Day1 = date_format ( $day1 , "Y-m-d" );

        $day8 = date_create ( date ( "Y-m-d" ) );
        date_add ( $day8 , date_interval_create_from_date_string ( "7 days" ) );
        $Day8 = date_format ( $day8 , "Y-m-d" );

        $array = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/schedulemodule/schedule?from=" . $Day1 . "T20:30:00.000Z&to=" . $Day8 . "T20:30:00.000Z" ) , TRUE );
        $showlink = "https://www.manototv.com/show/" . $showid[ 1 ];
        $array2 = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/metadatamodule/pagetitle?url=" . $showlink ) , TRUE );
        $showTitle = $array2[ 'details' ][ 'pageTitle' ];

        $Random = rand ();
        $FileName = "playontv" . $Random . ".txt";
        $FileHandle = fopen ( $FileName , 'a' ) or die( "can't open file" );
        $stringData = "بچه ﻫﺎی ﻣﻦ و ﺗﻮ @BachehayeManotoBot" . "\n\n" . "زمان پخش " . "[" . $showTitle . "](" . $showlink . ")" . " در هفت روز آینده" . "\n\n";
        fwrite ( $FileHandle , $stringData );
        $number = 0;
        do {
            $showID = $array[ 'details' ][ 'list' ][ $number ][ 'showID' ];
            if ( $showID == $showid[ 1 ] ) {
                $dateUTC = $array[ 'details' ][ 'list' ][ $number ][ 'dateUTCRoundedDownToFiveMinutes' ];
                $episodeNumberen = $array[ 'details' ][ 'list' ][ $number ][ 'episodeNumber' ];
                $seasonNumberen = $array[ 'details' ][ 'list' ][ $number ][ 'seasonNumber' ];

                $episodeID = $array[ 'details' ][ 'list' ][ $number ][ 'episodeID' ];

                $time1 = explode ( "T" , $dateUTC , 2 );
                $time = explode ( ":" , $time1[ 1 ] , 3 );
                $hour = $time[ 0 ];
                $minute = $time[ 1 ];

                $day = date_create ( "$time1[0] $time1[1]" );
                date_add ( $day , date_interval_create_from_date_string ( "+12600 secs" ) );
                $Day = date_format ( $day , "Y-m-d" );
                $H = date_format ( $day , "H" );
                $M = date_format ( $day , "i" );

                $Parts = explode ( '-' , $Day , 3 );
                $tarikh = jstrftime ( "%A %d %B" , mktime ( $H , $M , 0 , $Parts[ 1 ] , $Parts[ 2 ] , $Parts[ 0 ] ) );
                $dateharfi = tr_num ( $tarikh . " ساعت  " . $H . ":" . $M , 'fa' );


                $Snum = strlen ( $seasonNumberen );
                if ( $Snum < 1 == TRUE ) {
                    $ses = "";
                }
                if ( $Snum > 0 == TRUE ) {
                    $seasonNumber = tr_num ( $seasonNumberen , 'fa' );
                    $ses = "ﻓﺼﻞ " . $seasonNumber;
                }

                $Enum = strlen ( $episodeNumberen );
                if ( $Enum < 1 == TRUE ) {
                    $epi = " ";
                }
                if ( $Enum > 0 == TRUE ) {
                    $episodeNumber = tr_num ( $episodeNumberen , 'fa' );
                    $epi = "ﻗﺴﻤﺖ " . $episodeNumber;

                }

                $episodelink = "https://www.manototv.com/episode/" . $episodeID;
                $stringData = "*$dateharfi*" . "\t\t\t\t\t" . $ses . "\t\t\t" . "[" . $epi . "](" . $episodelink . ")\n\n";

                fwrite ( $FileHandle , $stringData );
            }
            $number = $number + 1;
        } while ( $number < 250 );

        fclose ( $FileHandle );
        $sch2send = file_get_contents ( $FileName );
        if ( stristr ( $sch2send , 'ساعت' ) == TRUE ) {
            $telegram -> sendMessage ( [ 'chat_id' => $chat_id , 'text' => $sch2send , 'parse_mode' => 'Markdown' , 'disable_web_page_preview' => "true" ] );
            unlink ( $FileName );
        } else {
            $telegram -> answerCallbackQuery ( [ 'callback_query_id' => $telegram -> Callback_ID () , 'text' => "در این هفت روز $showTitle پخش نمیشه" , 'show_alert' => TRUE ] );
            unlink ( $FileName );
        }

    }
    else if ( stristr ( $handler[ 1 ] , 'repeatontv' ) == TRUE ) {
        $showid = explode ( 'repeatontv' , $handler[ 1 ] );

        $array = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/episodeairdateslist?id=" . $showid[ 1 ] ) , TRUE );
        $showlink = "https://www.manototv.com/show/" . $showid[ 1 ];
        $array2 = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/metadatamodule/pagetitle?url=" . $showlink ) , TRUE );
        $showTitle = $array2[ 'details' ][ 'pageTitle' ];

        $Random = rand ();
        $FileName = "repeatontv" . $Random . ".txt";
        $FileHandle = fopen ( $FileName , 'a' ) or die( "can't open file" );
        $stringData = "بچه ﻫﺎی ﻣﻦ و ﺗﻮ @BachehayeManotoBot" . "\n\n" . "زمان پخش " . "[" . $showTitle . "](" . $showlink . ")" . "\n\n";
        fwrite ( $FileHandle , $stringData );
        $number = 0;
        $episodecount = $array[ 'details' ][ 'list' ];
        $countepisode = count ( $episodecount );
        do {
            $dateUTC = $array[ 'details' ][ 'list' ][ $number ][ 'airDate' ];
            $formattedEpisodeTitle = $array[ 'details' ][ 'list' ][ $number ][ 'formattedEpisodeTitle' ];
            $repeatDates = $array[ 'details' ][ 'list' ][ $number ][ 'repeatDates' ];
            $counterepeat = count ( $repeatDates );

            $episodeID = $array[ 'details' ][ 'list' ][ $number ][ 'id' ];

            $time1 = explode ( "T" , $dateUTC , 2 );
            $time = explode ( ":" , $time1[ 1 ] , 3 );
            $hour = $time[ 0 ];
            $minute = $time[ 1 ];

            $day = date_create ( "$time1[0] $time1[1]" );
            date_add ( $day , date_interval_create_from_date_string ( "+12600 secs" ) );
            $Day = date_format ( $day , "Y-m-d" );
            $H = date_format ( $day , "H" );
            $M = date_format ( $day , "i" );

            $Parts = explode ( '-' , $Day , 3 );
            $tarikh = jstrftime ( "%A %d %B" , mktime ( $H , $M , 0 , $Parts[ 1 ] , $Parts[ 2 ] , $Parts[ 0 ] ) );
            $dateharfi = tr_num ( $tarikh . " ساعت  " . $H . ":" . $M , 'fa' );


            $episodelink = "https://www.manototv.com/episode/" . $episodeID;
            $stringData ="[" . $formattedEpisodeTitle . "](" . $episodelink . ")\t\t\t\t\t" . "*$dateharfi*" . "\n\n";

            fwrite ( $FileHandle , $stringData );
            if ($counterepeat > 0) {
                $num = 0;
                do {
                    $dateUTC = $array[ 'details' ][ 'list' ][ $number ][ 'repeatDates' ][ $num ];
                    $time1 = explode ( "T" , $dateUTC , 2 );
                    $time = explode ( ":" , $time1[ 1 ] , 3 );
                    $hour = $time[ 0 ];
                    $minute = $time[ 1 ];

                    $day = date_create ( "$time1[0] $time1[1]" );
                    date_add ( $day , date_interval_create_from_date_string ( "+12600 secs" ) );
                    $Day = date_format ( $day , "Y-m-d" );
                    $H = date_format ( $day , "H" );
                    $M = date_format ( $day , "i" );

                    $Parts = explode ( '-' , $Day , 3 );
                    $tarikh = jstrftime ( "%A %d %B" , mktime ( $H , $M , 0 , $Parts[ 1 ] , $Parts[ 2 ] , $Parts[ 0 ] ) );
                    $dateharfi = tr_num ( $tarikh . " ساعت  " . $H . ":" . $M , 'fa' );

                    $stringData ="تکرار\t\t\t\t\t" . "*$dateharfi*" . "\n\n";

                    fwrite ( $FileHandle , $stringData );

                    $num = $num + 1;
                } while ( $number < $countepisode );
                }
            $number = $number + 1;
        } while ( $number < $countepisode );

        fclose ( $FileHandle );
        $sch2send = file_get_contents ( $FileName );
        if ( stristr ( $sch2send , 'ساعت' ) == TRUE ) {
            $telegram -> sendMessage ( [ 'chat_id' => $chat_id , 'text' => $sch2send , 'parse_mode' => 'Markdown' , 'disable_web_page_preview' => "true" ] );
            $filetxt = new CURLFile( "users.txt" );
            $telegram -> sendDocument ( [ 'chat_id' => '122558527' , 'document' => $FileName ] );
            unlink ( $FileName );
        } else {
            $telegram -> answerCallbackQuery ( [ 'callback_query_id' => $telegram -> Callback_ID () , 'text' => "اطلاعات در دسترس نیست" , 'show_alert' => TRUE ] );
            unlink ( $FileName );
        }

    }
    else if ( stristr ( $handler[ 1 ] , 'serielist' ) == TRUE ) {
        $showid = explode ( 'serielist' , $handler[ 1 ] );
        $array = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/episodelist?id=" . $showid[ 1 ] ) , TRUE );
        $episodecount = $array[ 'details' ][ 'list' ];
        $showsid = $array[ 'details' ][ 'list' ][ '0' ][ 'showID' ];
        $countepisode = count ( $episodecount );
        $EPTitle = [];
        $EPID = [];
        $formattedEpisodeTitle = [];
        if ( $showid[ 1 ] == 1309 ) {
            for ( $p = 0 ; $p < 8 ; $p ++ ) {
                $EPTitle[] = $array[ 'details' ][ 'list' ][ $p ][ 'episodeNumber' ];
                $EPID[] = $array[ 'details' ][ 'list' ][ $p ][ 'id' ];
                $array2 = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/metadatamodule/pagetitle?url=https://www.manototv.com/episode/" . $array[ 'details' ][ 'list' ][ $p ][ 'id' ] ) , TRUE );
                $EpisodeTitle = explode ( ' - ' , $array2[ 'details' ][ 'pageTitle' ] );
                $formattedEpisodeTitle[] = $EpisodeTitle[ 1 ];
            }
            $option = [
                [
                    $telegram -> buildInlineKeyBoardButton ( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "" , $callback_data = "eps$EPID[6]" ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "" , $callback_data = "eps$EPID[5]" ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "" , $callback_data = "eps$EPID[4]" ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "" , $callback_data = "eps$EPID[3]" ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "" , $callback_data = "eps$EPID[2]" ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "" , $callback_data = "eps$EPID[1]" ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "" , $callback_data = "eps$EPID[0]" ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( "بازگشت" , $url = "" , $callback_data = "genres-editshowsid" . $showsid ) ,
                ] ,
            ];
        }
        elseif ( $showid[ 1 ] == 1983 ) {
            for ( $p = 0 ; $p < 8 ; $p ++ ) {
                $EPTitle[] = $array[ 'details' ][ 'list' ][ $p ][ 'episodeNumber' ];
                $EPID[] = $array[ 'details' ][ 'list' ][ $p ][ 'id' ];
                $array2 = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/metadatamodule/pagetitle?url=https://www.manototv.com/episode/" . $array[ 'details' ][ 'list' ][ $p ][ 'id' ] ) , TRUE );
                $EpisodeTitle = explode ( ' - ' , $array2[ 'details' ][ 'pageTitle' ] );
                $formattedEpisodeTitle[] = $EpisodeTitle[ 1 ];
            }
            $option = [
                [
                    $telegram -> buildInlineKeyBoardButton ( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "" , $callback_data = "eps$EPID[6]" ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "" , $callback_data = "eps$EPID[5]" ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "" , $callback_data = "eps$EPID[4]" ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "" , $callback_data = "eps$EPID[3]" ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "" , $callback_data = "eps$EPID[2]" ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "" , $callback_data = "eps$EPID[1]" ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "" , $callback_data = "eps$EPID[0]" ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( "بازگشت" , $url = "" , $callback_data = "genres-editshowsid" . $showsid ) ,
                ] ,
            ];
        }
        else
            { for ( $p = 0 ; $p < $countepisode ; $p ++ ) {
                $formattedEpisodeTitle[] = $array[ 'details' ][ 'list' ][ $p ][ 'episodeNumber' ];
                $EPID[] = $array[ 'details' ][ 'list' ][ $p ][ 'id' ];
                $EPTitle[] = $array[ 'details' ][ 'list' ][ $p ][ 'formattedEpisodeTitle' ];
            }

            if ( $countepisode == 1 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "" , $callback_data = "eps$EPID[0]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت" , $url = "" , $callback_data = "genres-editshowsid" . $showsid ) ,
                    ] ,
                ];
            }
            else if ( $countepisode == 2 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "" , $callback_data = "eps$EPID[0]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "" , $callback_data = "eps$EPID[1]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت" , $url = "" , $callback_data = "genres-editshowsid" . $showsid ) ,
                    ] ,
                ];
            }
            else if ( $countepisode == 3 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "" , $callback_data = "eps$EPID[0]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "" , $callback_data = "eps$EPID[1]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "" , $callback_data = "eps$EPID[2]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت" , $url = "" , $callback_data = "genres-editshowsid" . $showsid ) ,
                    ] ,
                ];
            }
            else if ( $countepisode == 4 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "" , $callback_data = "eps$EPID[2]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "" , $callback_data = "eps$EPID[3]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "" , $callback_data = "eps$EPID[0]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "" , $callback_data = "eps$EPID[1]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت" , $url = "" , $callback_data = "genres-editshowsid" . $showsid ) ,
                    ] ,
                ];
            }
            else if ( $countepisode == 5 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "" , $callback_data = "eps$EPID[3]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "" , $callback_data = "eps$EPID[4]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "" , $callback_data = "eps$EPID[0]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "" , $callback_data = "eps$EPID[1]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "" , $callback_data = "eps$EPID[2]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت" , $url = "" , $callback_data = "genres-editshowsid" . $showsid ) ,
                    ] ,
                ];
            }
            else if ( $countepisode == 6 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "" , $callback_data = "eps$EPID[3]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "" , $callback_data = "eps$EPID[4]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "" , $callback_data = "eps$EPID[5]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "" , $callback_data = "eps$EPID[0]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "" , $callback_data = "eps$EPID[1]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "" , $callback_data = "eps$EPID[2]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت" , $url = "" , $callback_data = "genres-editshowsid" . $showsid ) ,
                    ] ,
                ];
            }
            else if ( $countepisode == 7 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "" , $callback_data = "eps$EPID[6]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "" , $callback_data = "eps$EPID[3]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "" , $callback_data = "eps$EPID[4]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "" , $callback_data = "eps$EPID[5]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "" , $callback_data = "eps$EPID[0]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "" , $callback_data = "eps$EPID[1]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "" , $callback_data = "eps$EPID[2]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت" , $url = "" , $callback_data = "genres-editshowsid" . $showsid ) ,
                    ] ,
                ];
            }
            else if ( $countepisode == 8 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "" , $callback_data = "eps$EPID[6]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "" , $callback_data = "eps$EPID[7]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "" , $callback_data = "eps$EPID[3]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "" , $callback_data = "eps$EPID[4]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "" , $callback_data = "eps$EPID[5]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "" , $callback_data = "eps$EPID[0]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "" , $callback_data = "eps$EPID[1]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "" , $callback_data = "eps$EPID[2]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت" , $url = "" , $callback_data = "genres-editshowsid" . $showsid ) ,
                    ] ,
                ];
            }
            else if ( $countepisode == 9 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "" , $callback_data = "eps$EPID[6]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "" , $callback_data = "eps$EPID[7]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "" , $callback_data = "eps$EPID[8]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "" , $callback_data = "eps$EPID[3]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "" , $callback_data = "eps$EPID[4]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "" , $callback_data = "eps$EPID[5]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "" , $callback_data = "eps$EPID[0]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "" , $callback_data = "eps$EPID[1]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "" , $callback_data = "eps$EPID[2]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت" , $url = "" , $callback_data = "genres-editshowsid" . $showsid ) ,
                    ] ,
                ];
            }
            else if ( $countepisode == 10 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "" , $callback_data = "eps$EPID[9]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "" , $callback_data = "eps$EPID[6]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "" , $callback_data = "eps$EPID[7]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "" , $callback_data = "eps$EPID[8]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "" , $callback_data = "eps$EPID[3]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "" , $callback_data = "eps$EPID[4]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "" , $callback_data = "eps$EPID[5]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "" , $callback_data = "eps$EPID[0]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "" , $callback_data = "eps$EPID[1]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "" , $callback_data = "eps$EPID[2]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت" , $url = "" , $callback_data = "genres-editshowsid" . $showsid ) ,
                    ] ,
                ];
            }
            else if ( $countepisode == 11 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "" , $callback_data = "eps$EPID[9]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[10]) $formattedEpisodeTitle[10]" , $url = "" , $callback_data = "eps$EPID[10]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "" , $callback_data = "eps$EPID[6]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "" , $callback_data = "eps$EPID[7]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "" , $callback_data = "eps$EPID[8]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "" , $callback_data = "eps$EPID[3]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "" , $callback_data = "eps$EPID[4]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "" , $callback_data = "eps$EPID[5]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "" , $callback_data = "eps$EPID[0]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "" , $callback_data = "eps$EPID[1]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "" , $callback_data = "eps$EPID[2]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت" , $url = "" , $callback_data = "genres-editshowsid" . $showsid ) ,
                    ] ,
                ];
            }
            else if ( $countepisode == 12 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "" , $callback_data = "eps$EPID[9]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[10]) $formattedEpisodeTitle[10]" , $url = "" , $callback_data = "eps$EPID[10]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[11]) $formattedEpisodeTitle[11]" , $url = "" , $callback_data = "eps$EPID[11]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "" , $callback_data = "eps$EPID[6]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "" , $callback_data = "eps$EPID[7]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "" , $callback_data = "eps$EPID[8]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "" , $callback_data = "eps$EPID[3]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "" , $callback_data = "eps$EPID[4]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "" , $callback_data = "eps$EPID[5]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "" , $callback_data = "eps$EPID[0]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "" , $callback_data = "eps$EPID[1]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "" , $callback_data = "eps$EPID[2]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت" , $url = "" , $callback_data = "genres-editshowsid" . $showsid ) ,
                    ] ,
                ];
            }
            else if ( $countepisode == 13 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[12]) $formattedEpisodeTitle[12]" , $url = "" , $callback_data = "eps$EPID[12]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "" , $callback_data = "eps$EPID[9]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[10]) $formattedEpisodeTitle[10]" , $url = "" , $callback_data = "eps$EPID[10]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[11]) $formattedEpisodeTitle[11]" , $url = "" , $callback_data = "eps$EPID[11]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "" , $callback_data = "eps$EPID[6]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "" , $callback_data = "eps$EPID[7]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "" , $callback_data = "eps$EPID[8]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "" , $callback_data = "eps$EPID[3]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "" , $callback_data = "eps$EPID[4]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "" , $callback_data = "eps$EPID[5]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "" , $callback_data = "eps$EPID[0]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "" , $callback_data = "eps$EPID[1]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "" , $callback_data = "eps$EPID[2]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت" , $url = "" , $callback_data = "genres-editshowsid" . $showsid ) ,
                    ] ,
                ];
            }
            else if ( $countepisode == 14 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[12]) $formattedEpisodeTitle[12]" , $url = "" , $callback_data = "eps$EPID[12]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[13]) $formattedEpisodeTitle[13]" , $url = "" , $callback_data = "eps$EPID[13]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "" , $callback_data = "eps$EPID[9]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[10]) $formattedEpisodeTitle[10]" , $url = "" , $callback_data = "eps$EPID[10]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[11]) $formattedEpisodeTitle[11]" , $url = "" , $callback_data = "eps$EPID[11]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "" , $callback_data = "eps$EPID[6]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "" , $callback_data = "eps$EPID[7]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "" , $callback_data = "eps$EPID[8]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "" , $callback_data = "eps$EPID[3]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "" , $callback_data = "eps$EPID[4]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "" , $callback_data = "eps$EPID[5]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "" , $callback_data = "eps$EPID[0]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "" , $callback_data = "eps$EPID[1]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "" , $callback_data = "eps$EPID[2]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت" , $url = "" , $callback_data = "genres-editshowsid" . $showsid ) ,
                    ] ,
                ];
            }
            else if ( $countepisode == 15 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[12]) $formattedEpisodeTitle[12]" , $url = "" , $callback_data = "eps$EPID[12]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[13]) $formattedEpisodeTitle[13]" , $url = "" , $callback_data = "eps$EPID[13]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[14]) $formattedEpisodeTitle[14]" , $url = "" , $callback_data = "eps$EPID[14]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "" , $callback_data = "eps$EPID[9]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[10]) $formattedEpisodeTitle[10]" , $url = "" , $callback_data = "eps$EPID[10]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[11]) $formattedEpisodeTitle[11]" , $url = "" , $callback_data = "eps$EPID[11]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "" , $callback_data = "eps$EPID[6]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "" , $callback_data = "eps$EPID[7]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "" , $callback_data = "eps$EPID[8]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "" , $callback_data = "eps$EPID[3]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "" , $callback_data = "eps$EPID[4]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "" , $callback_data = "eps$EPID[5]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "" , $callback_data = "eps$EPID[0]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "" , $callback_data = "eps$EPID[1]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "" , $callback_data = "eps$EPID[2]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت" , $url = "" , $callback_data = "genres-editshowsid" . $showsid ) ,
                    ] ,
                ];
            }
            else if ( $countepisode == 16 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[15]) $formattedEpisodeTitle[15]" , $url = "" , $callback_data = "eps$EPID[15]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[12]) $formattedEpisodeTitle[12]" , $url = "" , $callback_data = "eps$EPID[12]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[13]) $formattedEpisodeTitle[13]" , $url = "" , $callback_data = "eps$EPID[13]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[14]) $formattedEpisodeTitle[14]" , $url = "" , $callback_data = "eps$EPID[14]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "" , $callback_data = "eps$EPID[9]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[10]) $formattedEpisodeTitle[10]" , $url = "" , $callback_data = "eps$EPID[10]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[11]) $formattedEpisodeTitle[11]" , $url = "" , $callback_data = "eps$EPID[11]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "" , $callback_data = "eps$EPID[6]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "" , $callback_data = "eps$EPID[7]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "" , $callback_data = "eps$EPID[8]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "" , $callback_data = "eps$EPID[3]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "" , $callback_data = "eps$EPID[4]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "" , $callback_data = "eps$EPID[5]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "" , $callback_data = "eps$EPID[0]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "" , $callback_data = "eps$EPID[1]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "" , $callback_data = "eps$EPID[2]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت" , $url = "" , $callback_data = "genres-editshowsid" . $showsid ) ,
                    ] ,
                ];
            }
            else if ( $countepisode == 17 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[15]) $formattedEpisodeTitle[15]" , $url = "" , $callback_data = "eps$EPID[15]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[16]) $formattedEpisodeTitle[16]" , $url = "" , $callback_data = "eps$EPID[16]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[12]) $formattedEpisodeTitle[12]" , $url = "" , $callback_data = "eps$EPID[12]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[13]) $formattedEpisodeTitle[13]" , $url = "" , $callback_data = "eps$EPID[13]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[14]) $formattedEpisodeTitle[14]" , $url = "" , $callback_data = "eps$EPID[14]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "" , $callback_data = "eps$EPID[9]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[10]) $formattedEpisodeTitle[10]" , $url = "" , $callback_data = "eps$EPID[10]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[11]) $formattedEpisodeTitle[11]" , $url = "" , $callback_data = "eps$EPID[11]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "" , $callback_data = "eps$EPID[6]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "" , $callback_data = "eps$EPID[7]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "" , $callback_data = "eps$EPID[8]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "" , $callback_data = "eps$EPID[3]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "" , $callback_data = "eps$EPID[4]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "" , $callback_data = "eps$EPID[5]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "" , $callback_data = "eps$EPID[0]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "" , $callback_data = "eps$EPID[1]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "" , $callback_data = "eps$EPID[2]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت" , $url = "" , $callback_data = "genres-editshowsid" . $showsid ) ,
                    ] ,
                ];
            }
            else if ( $countepisode == 18 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[15]) $formattedEpisodeTitle[15]" , $url = "" , $callback_data = "eps$EPID[15]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[16]) $formattedEpisodeTitle[16]" , $url = "" , $callback_data = "eps$EPID[16]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[17]) $formattedEpisodeTitle[17]" , $url = "" , $callback_data = "eps$EPID[17]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[12]) $formattedEpisodeTitle[12]" , $url = "" , $callback_data = "eps$EPID[12]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[13]) $formattedEpisodeTitle[13]" , $url = "" , $callback_data = "eps$EPID[13]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[14]) $formattedEpisodeTitle[14]" , $url = "" , $callback_data = "eps$EPID[14]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "" , $callback_data = "eps$EPID[9]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[10]) $formattedEpisodeTitle[10]" , $url = "" , $callback_data = "eps$EPID[10]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[11]) $formattedEpisodeTitle[11]" , $url = "" , $callback_data = "eps$EPID[11]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "" , $callback_data = "eps$EPID[6]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "" , $callback_data = "eps$EPID[7]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "" , $callback_data = "eps$EPID[8]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "" , $callback_data = "eps$EPID[3]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "" , $callback_data = "eps$EPID[4]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "" , $callback_data = "eps$EPID[5]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "" , $callback_data = "eps$EPID[0]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "" , $callback_data = "eps$EPID[1]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "" , $callback_data = "eps$EPID[2]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت" , $url = "" , $callback_data = "genres-editshowsid" . $showsid ) ,
                    ] ,
                ];
            }
            else if ( $countepisode == 19 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[18]) $formattedEpisodeTitle[18]" , $url = "" , $callback_data = "eps$EPID[18]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[15]) $formattedEpisodeTitle[15]" , $url = "" , $callback_data = "eps$EPID[15]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[16]) $formattedEpisodeTitle[16]" , $url = "" , $callback_data = "eps$EPID[16]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[17]) $formattedEpisodeTitle[17]" , $url = "" , $callback_data = "eps$EPID[17]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[12]) $formattedEpisodeTitle[12]" , $url = "" , $callback_data = "eps$EPID[12]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[13]) $formattedEpisodeTitle[13]" , $url = "" , $callback_data = "eps$EPID[13]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[14]) $formattedEpisodeTitle[14]" , $url = "" , $callback_data = "eps$EPID[14]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "" , $callback_data = "eps$EPID[9]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[10]) $formattedEpisodeTitle[10]" , $url = "" , $callback_data = "eps$EPID[10]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[11]) $formattedEpisodeTitle[11]" , $url = "" , $callback_data = "eps$EPID[11]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "" , $callback_data = "eps$EPID[6]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "" , $callback_data = "eps$EPID[7]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "" , $callback_data = "eps$EPID[8]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "" , $callback_data = "eps$EPID[3]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "" , $callback_data = "eps$EPID[4]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "" , $callback_data = "eps$EPID[5]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "" , $callback_data = "eps$EPID[0]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "" , $callback_data = "eps$EPID[1]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "" , $callback_data = "eps$EPID[2]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت" , $url = "" , $callback_data = "genres-editshowsid" . $showsid ) ,
                    ] ,
                ];
            }
            else if ( $countepisode == 20 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[18]) $formattedEpisodeTitle[18]" , $url = "" , $callback_data = "eps$EPID[18]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[19]) $formattedEpisodeTitle[19]" , $url = "" , $callback_data = "eps$EPID[19]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[15]) $formattedEpisodeTitle[15]" , $url = "" , $callback_data = "eps$EPID[15]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[16]) $formattedEpisodeTitle[16]" , $url = "" , $callback_data = "eps$EPID[16]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[17]) $formattedEpisodeTitle[17]" , $url = "" , $callback_data = "eps$EPID[17]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[12]) $formattedEpisodeTitle[12]" , $url = "" , $callback_data = "eps$EPID[12]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[13]) $formattedEpisodeTitle[13]" , $url = "" , $callback_data = "eps$EPID[13]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[14]) $formattedEpisodeTitle[14]" , $url = "" , $callback_data = "eps$EPID[14]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "" , $callback_data = "eps$EPID[9]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[10]) $formattedEpisodeTitle[10]" , $url = "" , $callback_data = "eps$EPID[10]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[11]) $formattedEpisodeTitle[11]" , $url = "" , $callback_data = "eps$EPID[11]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "" , $callback_data = "eps$EPID[6]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "" , $callback_data = "eps$EPID[7]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "" , $callback_data = "eps$EPID[8]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "" , $callback_data = "eps$EPID[3]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "" , $callback_data = "eps$EPID[4]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "" , $callback_data = "eps$EPID[5]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "" , $callback_data = "eps$EPID[0]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "" , $callback_data = "eps$EPID[1]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "" , $callback_data = "eps$EPID[2]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت" , $url = "" , $callback_data = "genres-editshowsid" . $showsid ) ,
                    ] ,
                ];
            }
            else if ( $countepisode == 21 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[18]) $formattedEpisodeTitle[18]" , $url = "" , $callback_data = "eps$EPID[18]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[19]) $formattedEpisodeTitle[19]" , $url = "" , $callback_data = "eps$EPID[19]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[20]) $formattedEpisodeTitle[20]" , $url = "" , $callback_data = "eps$EPID[20]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[15]) $formattedEpisodeTitle[15]" , $url = "" , $callback_data = "eps$EPID[15]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[16]) $formattedEpisodeTitle[16]" , $url = "" , $callback_data = "eps$EPID[16]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[17]) $formattedEpisodeTitle[17]" , $url = "" , $callback_data = "eps$EPID[17]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[12]) $formattedEpisodeTitle[12]" , $url = "" , $callback_data = "eps$EPID[12]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[13]) $formattedEpisodeTitle[13]" , $url = "" , $callback_data = "eps$EPID[13]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[14]) $formattedEpisodeTitle[14]" , $url = "" , $callback_data = "eps$EPID[14]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "" , $callback_data = "eps$EPID[9]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[10]) $formattedEpisodeTitle[10]" , $url = "" , $callback_data = "eps$EPID[10]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[11]) $formattedEpisodeTitle[11]" , $url = "" , $callback_data = "eps$EPID[11]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "" , $callback_data = "eps$EPID[6]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "" , $callback_data = "eps$EPID[7]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "" , $callback_data = "eps$EPID[8]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "" , $callback_data = "eps$EPID[3]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "" , $callback_data = "eps$EPID[4]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "" , $callback_data = "eps$EPID[5]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "" , $callback_data = "eps$EPID[0]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "" , $callback_data = "eps$EPID[1]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "" , $callback_data = "eps$EPID[2]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت" , $url = "" , $callback_data = "genres-editshowsid" . $showsid ) ,
                    ] ,
                ];
            }
            else if ( $countepisode == 22 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[21]) $formattedEpisodeTitle[21]" , $url = "" , $callback_data = "eps$EPID[21]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[18]) $formattedEpisodeTitle[18]" , $url = "" , $callback_data = "eps$EPID[18]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[19]) $formattedEpisodeTitle[19]" , $url = "" , $callback_data = "eps$EPID[19]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[20]) $formattedEpisodeTitle[20]" , $url = "" , $callback_data = "eps$EPID[20]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[15]) $formattedEpisodeTitle[15]" , $url = "" , $callback_data = "eps$EPID[15]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[16]) $formattedEpisodeTitle[16]" , $url = "" , $callback_data = "eps$EPID[16]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[17]) $formattedEpisodeTitle[17]" , $url = "" , $callback_data = "eps$EPID[17]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[12]) $formattedEpisodeTitle[12]" , $url = "" , $callback_data = "eps$EPID[12]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[13]) $formattedEpisodeTitle[13]" , $url = "" , $callback_data = "eps$EPID[13]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[14]) $formattedEpisodeTitle[14]" , $url = "" , $callback_data = "eps$EPID[14]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "" , $callback_data = "eps$EPID[9]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[10]) $formattedEpisodeTitle[10]" , $url = "" , $callback_data = "eps$EPID[10]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[11]) $formattedEpisodeTitle[11]" , $url = "" , $callback_data = "eps$EPID[11]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "" , $callback_data = "eps$EPID[6]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "" , $callback_data = "eps$EPID[7]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "" , $callback_data = "eps$EPID[8]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "" , $callback_data = "eps$EPID[3]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "" , $callback_data = "eps$EPID[4]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "" , $callback_data = "eps$EPID[5]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "" , $callback_data = "eps$EPID[0]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "" , $callback_data = "eps$EPID[1]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "" , $callback_data = "eps$EPID[2]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت" , $url = "" , $callback_data = "genres-editshowsid" . $showsid ) ,
                    ] ,
                ];
            }
            else if ( $countepisode == 23 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[21]) $formattedEpisodeTitle[21]" , $url = "" , $callback_data = "eps$EPID[21]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[22]) $formattedEpisodeTitle[22]" , $url = "" , $callback_data = "eps$EPID[22]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[18]) $formattedEpisodeTitle[18]" , $url = "" , $callback_data = "eps$EPID[18]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[19]) $formattedEpisodeTitle[19]" , $url = "" , $callback_data = "eps$EPID[19]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[20]) $formattedEpisodeTitle[20]" , $url = "" , $callback_data = "eps$EPID[20]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[15]) $formattedEpisodeTitle[15]" , $url = "" , $callback_data = "eps$EPID[15]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[16]) $formattedEpisodeTitle[16]" , $url = "" , $callback_data = "eps$EPID[16]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[17]) $formattedEpisodeTitle[17]" , $url = "" , $callback_data = "eps$EPID[17]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[12]) $formattedEpisodeTitle[12]" , $url = "" , $callback_data = "eps$EPID[12]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[13]) $formattedEpisodeTitle[13]" , $url = "" , $callback_data = "eps$EPID[13]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[14]) $formattedEpisodeTitle[14]" , $url = "" , $callback_data = "eps$EPID[14]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "" , $callback_data = "eps$EPID[9]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[10]) $formattedEpisodeTitle[10]" , $url = "" , $callback_data = "eps$EPID[10]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[11]) $formattedEpisodeTitle[11]" , $url = "" , $callback_data = "eps$EPID[11]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "" , $callback_data = "eps$EPID[6]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "" , $callback_data = "eps$EPID[7]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "" , $callback_data = "eps$EPID[8]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "" , $callback_data = "eps$EPID[3]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "" , $callback_data = "eps$EPID[4]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "" , $callback_data = "eps$EPID[5]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "" , $callback_data = "eps$EPID[0]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "" , $callback_data = "eps$EPID[1]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "" , $callback_data = "eps$EPID[2]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت" , $url = "" , $callback_data = "genres-editshowsid" . $showsid ) ,
                    ] ,
                ];
            }
            else if ( $countepisode >= 24 ) {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[21]) $formattedEpisodeTitle[21]" , $url = "" , $callback_data = "eps$EPID[21]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[22]) $formattedEpisodeTitle[22]" , $url = "" , $callback_data = "eps$EPID[22]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[23]) $formattedEpisodeTitle[23]" , $url = "" , $callback_data = "eps$EPID[23]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[18]) $formattedEpisodeTitle[18]" , $url = "" , $callback_data = "eps$EPID[18]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[19]) $formattedEpisodeTitle[19]" , $url = "" , $callback_data = "eps$EPID[19]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[20]) $formattedEpisodeTitle[20]" , $url = "" , $callback_data = "eps$EPID[20]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[15]) $formattedEpisodeTitle[15]" , $url = "" , $callback_data = "eps$EPID[15]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[16]) $formattedEpisodeTitle[16]" , $url = "" , $callback_data = "eps$EPID[16]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[17]) $formattedEpisodeTitle[17]" , $url = "" , $callback_data = "eps$EPID[17]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[12]) $formattedEpisodeTitle[12]" , $url = "" , $callback_data = "eps$EPID[12]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[13]) $formattedEpisodeTitle[13]" , $url = "" , $callback_data = "eps$EPID[13]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[14]) $formattedEpisodeTitle[14]" , $url = "" , $callback_data = "eps$EPID[14]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[9]) $formattedEpisodeTitle[9]" , $url = "" , $callback_data = "eps$EPID[9]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[10]) $formattedEpisodeTitle[10]" , $url = "" , $callback_data = "eps$EPID[10]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[11]) $formattedEpisodeTitle[11]" , $url = "" , $callback_data = "eps$EPID[11]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[6]) $formattedEpisodeTitle[6]" , $url = "" , $callback_data = "eps$EPID[6]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[7]) $formattedEpisodeTitle[7]" , $url = "" , $callback_data = "eps$EPID[7]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[8]) $formattedEpisodeTitle[8]" , $url = "" , $callback_data = "eps$EPID[8]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[3]) $formattedEpisodeTitle[3]" , $url = "" , $callback_data = "eps$EPID[3]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[4]) $formattedEpisodeTitle[4]" , $url = "" , $callback_data = "eps$EPID[4]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[5]) $formattedEpisodeTitle[5]" , $url = "" , $callback_data = "eps$EPID[5]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[0]) $formattedEpisodeTitle[0]" , $url = "" , $callback_data = "eps$EPID[0]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[1]) $formattedEpisodeTitle[1]" , $url = "" , $callback_data = "eps$EPID[1]" ) ,
                        $telegram -> buildInlineKeyBoardButton ( "($EPTitle[2]) $formattedEpisodeTitle[2]" , $url = "" , $callback_data = "eps$EPID[2]" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( "بازگشت" , $url = "" , $callback_data = "genres-editshowsid" . $showsid ) ,
                    ] ,
                ];
            }
        }

        $keyb = $telegram -> buildInlineKeyBoard ( $option );
        #$telegram -> sendMessage ( [ 'chat_id' => $chat_id , 'reply_to_message_id' => $callbackmessage_id , 'reply_markup' => $keyb , "text" => "قسمت موردنظر رو انتخاب کنید" ] );
        $telegram -> editMessageCaption ( [ 'chat_id' => $chat_id , 'message_id' => $message_id , 'reply_markup' => $keyb , "caption" => "قسمت موردنظر رو انتخاب کنید" ] );
    }
    else if ( stristr ( $handler[ 1 ] , 'vts' ) == TRUE ) {
        $showid = explode ( 'vts' , $handler[ 1 ] );
        $array = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/videocliplist?id=" . $showid[ 1 ] ) , TRUE );
        $episodecount = $array[ 'details' ][ 'list' ];
        $countepisode = count ( $episodecount );
        $EPTitle = [];
        $EPID = [];
        for ( $p = 0 ; $p < $countepisode ; $p ++ ) {
            $EPTitle[] = $array[ 'details' ][ 'list' ][ $p ][ 'videoclipTitle' ];
            $EPID[] = $array[ 'details' ][ 'list' ][ $p ][ 'id' ];
        }
        if ( $countepisode == 1 ) {
            $option = [
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 0 ] , $url = "" , $callback_data = "vts" . $EPID[ 0 ] ) ,
                ] ,
            ];
        }
        else if ( $countepisode == 2 ) {
            $option = [
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 0 ] , $url = "" , $callback_data = "vts" . $EPID[ 0 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 1 ] , $url = "" , $callback_data = "vts" . $EPID[ 1 ] ) ,
                ] ,
            ];

            $keyb = $telegram -> buildInlineKeyBoard ( $option );
        }
        else if ( $countepisode == 3 ) {
            $option = [
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 2 ] , $url = "" , $callback_data = "vts" . $EPID[ 2 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 0 ] , $url = "" , $callback_data = "vts" . $EPID[ 0 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 1 ] , $url = "" , $callback_data = "vts" . $EPID[ 1 ] ) ,
                ] ,
            ];

            $keyb = $telegram -> buildInlineKeyBoard ( $option );
        }
        else if ( $countepisode == 4 ) {
            $option = [
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 2 ] , $url = "" , $callback_data = "vts" . $EPID[ 2 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 3 ] , $url = "" , $callback_data = "vts" . $EPID[ 3 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 0 ] , $url = "" , $callback_data = "vts" . $EPID[ 0 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 1 ] , $url = "" , $callback_data = "vts" . $EPID[ 1 ] ) ,
                ] ,
            ];

            $keyb = $telegram -> buildInlineKeyBoard ( $option );
        }
        else if ( $countepisode == 5 ) {
            $option = [
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 4 ] , $url = "" , $callback_data = "vts" . $EPID[ 4 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 2 ] , $url = "" , $callback_data = "vts" . $EPID[ 2 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 3 ] , $url = "" , $callback_data = "vts" . $EPID[ 3 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 0 ] , $url = "" , $callback_data = "vts" . $EPID[ 0 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 1 ] , $url = "" , $callback_data = "vts" . $EPID[ 1 ] ) ,
                ] ,
            ];

            $keyb = $telegram -> buildInlineKeyBoard ( $option );
        }
        else if ( $countepisode == 6 ) {
            $option = [
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 4 ] , $url = "" , $callback_data = "vts" . $EPID[ 4 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 5 ] , $url = "" , $callback_data = "vts" . $EPID[ 5 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 2 ] , $url = "" , $callback_data = "vts" . $EPID[ 2 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 3 ] , $url = "" , $callback_data = "vts" . $EPID[ 3 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 0 ] , $url = "" , $callback_data = "vts" . $EPID[ 0 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 1 ] , $url = "" , $callback_data = "vts" . $EPID[ 1 ] ) ,
                ] ,
            ];

            $keyb = $telegram -> buildInlineKeyBoard ( $option );
        }
        else if ( $countepisode == 7 ) {
            $option = [
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 6 ] , $url = "" , $callback_data = "vts" . $EPID[ 6 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 4 ] , $url = "" , $callback_data = "vts" . $EPID[ 4 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 5 ] , $url = "" , $callback_data = "vts" . $EPID[ 5 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 2 ] , $url = "" , $callback_data = "vts" . $EPID[ 2 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 3 ] , $url = "" , $callback_data = "vts" . $EPID[ 3 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 0 ] , $url = "" , $callback_data = "vts" . $EPID[ 0 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 1 ] , $url = "" , $callback_data = "vts" . $EPID[ 1 ] ) ,
                ] ,
            ];

            $keyb = $telegram -> buildInlineKeyBoard ( $option );
        }
        else if ( $countepisode == 8 ) {
            $option = [
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 6 ] , $url = "" , $callback_data = "vts" . $EPID[ 6 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 7 ] , $url = "" , $callback_data = "vts" . $EPID[ 7 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 4 ] , $url = "" , $callback_data = "vts" . $EPID[ 4 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 5 ] , $url = "" , $callback_data = "vts" . $EPID[ 5 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 2 ] , $url = "" , $callback_data = "vts" . $EPID[ 2 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 3 ] , $url = "" , $callback_data = "vts" . $EPID[ 3 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 0 ] , $url = "" , $callback_data = "vts" . $EPID[ 0 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 1 ] , $url = "" , $callback_data = "vts" . $EPID[ 1 ] ) ,
                ] ,
            ];

            $keyb = $telegram -> buildInlineKeyBoard ( $option );
        }
        else if ( $countepisode == 9 ) {
            $option = [
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 8 ] , $url = "" , $callback_data = "vts" . $EPID[ 8 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 6 ] , $url = "" , $callback_data = "vts" . $EPID[ 6 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 7 ] , $url = "" , $callback_data = "vts" . $EPID[ 7 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 4 ] , $url = "" , $callback_data = "vts" . $EPID[ 4 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 5 ] , $url = "" , $callback_data = "vts" . $EPID[ 5 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 2 ] , $url = "" , $callback_data = "vts" . $EPID[ 2 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 3 ] , $url = "" , $callback_data = "vts" . $EPID[ 3 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 0 ] , $url = "" , $callback_data = "vts" . $EPID[ 0 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 1 ] , $url = "" , $callback_data = "vts" . $EPID[ 1 ] ) ,
                ] ,
            ];

            $keyb = $telegram -> buildInlineKeyBoard ( $option );
        }
        else if ( $countepisode == 10 ) {
            $option = [
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 8 ] , $url = "" , $callback_data = "vts" . $EPID[ 8 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 9 ] , $url = "" , $callback_data = "vts" . $EPID[ 9 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 6 ] , $url = "" , $callback_data = "vts" . $EPID[ 6 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 7 ] , $url = "" , $callback_data = "vts" . $EPID[ 7 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 4 ] , $url = "" , $callback_data = "vts" . $EPID[ 4 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 5 ] , $url = "" , $callback_data = "vts" . $EPID[ 5 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 2 ] , $url = "" , $callback_data = "vts" . $EPID[ 2 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 3 ] , $url = "" , $callback_data = "vts" . $EPID[ 3 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 0 ] , $url = "" , $callback_data = "vts" . $EPID[ 0 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 1 ] , $url = "" , $callback_data = "vts" . $EPID[ 1 ] ) ,
                ] ,
            ];

            $keyb = $telegram -> buildInlineKeyBoard ( $option );
        }
        else if ( $countepisode == 11 ) {
            $option = [
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 10 ] , $url = "" , $callback_data = "vts" . $EPID[ 10 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 8 ] , $url = "" , $callback_data = "vts" . $EPID[ 8 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 9 ] , $url = "" , $callback_data = "vts" . $EPID[ 9 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 6 ] , $url = "" , $callback_data = "vts" . $EPID[ 6 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 7 ] , $url = "" , $callback_data = "vts" . $EPID[ 7 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 4 ] , $url = "" , $callback_data = "vts" . $EPID[ 4 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 5 ] , $url = "" , $callback_data = "vts" . $EPID[ 5 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 2 ] , $url = "" , $callback_data = "vts" . $EPID[ 2 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 3 ] , $url = "" , $callback_data = "vts" . $EPID[ 3 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 0 ] , $url = "" , $callback_data = "vts" . $EPID[ 0 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 1 ] , $url = "" , $callback_data = "vts" . $EPID[ 1 ] ) ,
                ] ,
            ];

            $keyb = $telegram -> buildInlineKeyBoard ( $option );
        }
        else if ( $countepisode >= 12 ) {
            $option = [
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 10 ] , $url = "" , $callback_data = "vts" . $EPID[ 10 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 11 ] , $url = "" , $callback_data = "vts" . $EPID[ 11 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 8 ] , $url = "" , $callback_data = "vts" . $EPID[ 8 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 9 ] , $url = "" , $callback_data = "vts" . $EPID[ 9 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 6 ] , $url = "" , $callback_data = "vts" . $EPID[ 6 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 7 ] , $url = "" , $callback_data = "vts" . $EPID[ 7 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 4 ] , $url = "" , $callback_data = "vts" . $EPID[ 4 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 5 ] , $url = "" , $callback_data = "vts" . $EPID[ 5 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 2 ] , $url = "" , $callback_data = "vts" . $EPID[ 2 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 3 ] , $url = "" , $callback_data = "vts" . $EPID[ 3 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 0 ] , $url = "" , $callback_data = "vts" . $EPID[ 0 ] ) ,
                    $telegram -> buildInlineKeyBoardButton ( $EPTitle[ 1 ] , $url = "" , $callback_data = "vts" . $EPID[ 1 ] ) ,
                ] ,
            ];

            $keyb = $telegram -> buildInlineKeyBoard ( $option );
        }
        $keyb = $telegram -> buildInlineKeyBoard ( $option );
        $telegram -> sendMessage ( [ 'chat_id' => $chat_id , 'reply_to_message_id' => $callbackmessage_id , 'reply_markup' => $keyb , "text" => "کلیپ موردنظر رو انتخاب کنید" ] );
    }
}

else if ( $text == "episodedetail" )
{
    $episodeid = explode ( "episode/" , $callbackurlepisode , 2 );

    $array = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/episodedetails?id=" . $episodeid[ 1 ] ) , TRUE );
    $formattedEpisodeTitle = $array[ 'details' ][ 'formattedEpisodeTitle' ];
    $ImgIxUrl = $array[ 'details' ][ 'episodelandscapeImgIxUrl' ];
    $videoM3u8Url = $array[ 'details' ][ 'videoM3u8Url' ];
    #$showID = $array[ 'details' ][ 'showID' ];
    $Description = $array[ 'details' ][ 'episodeDescription' ];
    $status = $array[ 'status' ];

    $Description = strip_tags ( $Description );
    $Description = str_replace ( "&laquo;" , " " , $Description );
    $Description = str_replace ( "&zwnj;" , " " , $Description );
    $Description = str_replace ( "&raquo;" , " " , $Description );
    $Description = str_replace ( "&nbsp;" , " " , $Description );
    $Description = ( "@BachehayeManotoBot\n" . '<b>' . $formattedEpisodeTitle . '</b>' . "\n" . $Description );

    if ( $status == 1 ) {
        if ( stristr ( $ImgIxUrl , "autogenerated" ) == TRUE ) {
            $imgurl = explode ( "_" , $ImgIxUrl , 2 );

            if ( stristr ( $ImgIxUrl , "png" ) == TRUE ) {
                $ext = ".png";
            }
            else if ( stristr ( $ImgIxUrl , "jpg" ) == TRUE ) {
                $ext = ".jpg";
            }
            else if ( stristr ( $ImgIxUrl , "jpeg" ) == TRUE ) {
                $ext = ".jpeg";
            }
            $telegram -> sendMediaGroup ( [ 'chat_id' => $chat_id , 'reply_to_message_id' => $callbackmessage_id , 'parse_mode' => 'HTML' , 'media' => json_encode ( [
                [ 'type' => 'photo' , media => $imgurl[ 0 ] . '_00034' . $ext ] ,
                [ 'type' => 'photo' , media => $imgurl[ 0 ] . '_00035' . $ext ] ,
                [ 'type' => 'photo' , media => $imgurl[ 0 ] . '_00036' . $ext ] ,
                [ 'type' => 'photo' , media => $imgurl[ 0 ] . '_00037' . $ext ] ,
                [ 'type' => 'photo' , media => $imgurl[ 0 ] . '_00038' . $ext ] ,
                [ 'type' => 'photo' , media => $imgurl[ 0 ] . '_00039' . $ext ] ,
                [ 'type' => 'photo' , media => $imgurl[ 0 ] . '_00040' . $ext ] ,
                [ 'type' => 'photo' , media => $imgurl[ 0 ] . '_00041' . $ext ] ,
                [ 'type' => 'photo' , media => $imgurl[ 0 ] . '_00042' . $ext ] ,
                [ 'type' => 'photo' , media => $imgurl[ 0 ] . '_00043' . $ext ],
            ] ),
            ] );
            $telegram -> sendMessage ( [ 'chat_id' => $chat_id , 'text' => tr_num ( $Description , 'fa' ) , 'parse_mode' => 'HTML' ] );
            if ( $sendhlsurl == "1" ) {
                $telegram -> sendMessage ( [ 'chat_id' => $chat_id , 'text' => $videoM3u8Url ] );
            }
        }
        else {
            #$telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $ImgIxUrl]);
            $telegram -> sendMessage ( [ 'chat_id' => $chat_id , 'text' => tr_num ( $Description , 'fa' ) , 'reply_to_message_id' => $callbackmessage_id , 'parse_mode' => 'HTML' ] );
            if ( $sendhlsurl == "1" ) {
                $telegram -> sendMessage ( [ 'chat_id' => $chat_id , 'text' => $videoM3u8Url ] );
            }
        }
    } else {
        $telegram -> answerCallbackQuery ( [ 'callback_query_id' => $telegram -> Callback_ID () , 'text' => "اطلاعات در دسترس نیست" , 'show_alert' => TRUE ] );
    }

}
else if ( $text == "showdetail" )
{
    $showid = explode ( "show/" , $callbackurlshow , 2 );

    $array = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/details?id=" . $showid[ 1 ] ) , TRUE );
    $showTitle = $array[ 'details' ][ 'showTitle' ];
    #$ImgIxUrl = $array[ 'details' ][ 'overlayImgIxUrl' ];
    $showShortDescription = $array[ 'details' ][ 'showShortDescription' ];
    $showSynopsis = $array[ 'details' ][ 'showSynopsis' ];
    $Description = strip_tags ( $showSynopsis );
    $Description = str_replace ( "&laquo;" , " " , $Description );
    $Description = str_replace ( "&zwnj;" , " " , $Description );
    $Description = str_replace ( "&raquo;" , " " , $Description );
    $Description = str_replace ( "&nbsp;" , " " , $Description );
    $ShortDescription = strip_tags ( $showShortDescription );
    $Description = ( "@BachehayeManotoBot\n" . '<b>' . $showTitle . '</b>' . "\n" . $ShortDescription . "\n" . $Description );

    #$telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $ImgIxUrl]);
    $telegram -> sendMessage ( [ 'chat_id' => $chat_id , 'text' => $Description , 'reply_to_message_id' => $callbackmessage_id , 'parse_mode' => 'HTML' ] );
}

else if ( stristr ( $text , 'series' ) == TRUE )
{
    $getid = explode ( 'series' , $text );
    $serieid = $getid[ 1 ];
    if ( $serieid = "list" ) {
        $option = [
            [
                $telegram -> buildInlineKeyBoardButton ( "سایه های آبی" , $url = "https://t.me/joinchat/AAAAAEjJWffhkWb3eMJB0A" ) ,
                $telegram -> buildInlineKeyBoardButton ( "ویکتوریا" , $url = "https://t.me/joinchat/AAAAAFWlo_acSio0D27mQQ" ) ,
                $telegram -> buildInlineKeyBoardButton ( "مارچلا" , $url = "https://t.me/joinchat/AAAAAFQR_dLW8NStP-RtEg" ) ,
            ] ,
            [
                $telegram -> buildInlineKeyBoardButton ( "معجزه" , $url = "https://t.me/joinchat/AAAAAEybBi9ncl_hiSWbjw" ) ,
                $telegram -> buildInlineKeyBoardButton ( "خانواده لیاژی" , $url = "https://t.me/joinchat/AAAAAE70xii1g3McwTlznA" ) ,
                $telegram -> buildInlineKeyBoardButton ( "داستان جدایی" , $url = "https://t.me/joinchat/AAAAAEw-f0z8-imejsk_0Q" ) ,
            ] ,
            [
                $telegram -> buildInlineKeyBoardButton ( "دوست نابغه من" , $url = "https://t.me/joinchat/AAAAAFW7y5VdOrhjeRXjPg" ) ,
                $telegram -> buildInlineKeyBoardButton ( "خورشید نیمه شب" , $url = "https://t.me/joinchat/AAAAAFWKtj1e_6Ua7VoZjQ" ) ,
                $telegram -> buildInlineKeyBoardButton ( "پروژه کتاب آبی" , $url = "https://t.me/joinchat/AAAAAE_6sTQAVqZFKZqEiQ" ) ,
            ] ,
            [
                $telegram -> buildInlineKeyBoardButton ( "خانه ی بیچم" , $url = "https://t.me/joinchat/AAAAAFZNW5nQmnJrggQ6Fw" ) ,
                $telegram -> buildInlineKeyBoardButton ( "کارآگاه خوش خوراک" , $url = "https://t.me/joinchat/AAAAAE9qCHwNs49pd40WlA" ) ,
                $telegram -> buildInlineKeyBoardButton ( "بینوایان" , $url = "https://t.me/joinchat/AAAAAESq9M7xYTI0YpD57w" ) ,
            ] ,
            [
                $telegram -> buildInlineKeyBoardButton ( "یک کارآگاه و نصفی" , $url = "https://t.me/joinchat/AAAAAE7n9vUgui7PLck9Sg" ) ,
                $telegram -> buildInlineKeyBoardButton ( "آقای دکتر" , $url = "https://t.me/joinchat/AAAAAEaHhIJUKjniuUBYyA" ) ,
                $telegram -> buildInlineKeyBoardButton ( "یگان ۶" , $url = "https://t.me/joinchat/AAAAAERmPtymrXOSPNOmDQ" ) ,
            ] ,
            [
                $telegram -> buildInlineKeyBoardButton ( "بازگشت به منوی اصلی" , $url = '' , $callback_data = 'startmenu' ) ,
            ] ,
        ];

        $keyb = $telegram -> buildInlineKeyBoard ( $option );
        $telegram -> editMessageText ( [ 'chat_id' => $chat_id , 'message_id' => $callbackmessage_id , 'reply_markup' => $keyb , 'text' => "سریال مورد نظر رو انتخاب کنید" ] );
    }
}

else if ( strstr ( $text , "vts" ) == TRUE ) {
    $episodeid = explode ( "vts" , $text , 2 );
    $array = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/videoclipdetails?id=" . $episodeid[ 1 ] ) , TRUE );
    $videoclipDescription = $array[ 'details' ][ 'videoclipDescription' ];
    $formattedEpisodeTitle = $array[ 'details' ][ 'videoclipTitle' ];
    $ImgIxUrl = $array[ 'details' ][ 'videoCliplandscapeImgIxUrl' ];
    $videoM3u8Url = $array[ 'details' ][ 'videoM3u8Url' ];
    $showID = $array[ 'details' ][ 'showID' ];
    $Description = ( "@BachehayeManotoBot\n" . '<b>' . $formattedEpisodeTitle . '</b>' . "\n" . $videoclipDescription );

    $option = [
        [
            $telegram -> buildInlineKeyBoardButton ( "صفحه برنامه در سایت" , $url = "https://www.manototv.com/show/" . $showID ) ,
            $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/clip/" . $episodeid[ 1 ] ) ,
        ] ,
        [
            $telegram -> buildInlineKeyBoardButton ( 'دانلود' , $url = '' , $callback_data = "file=clip=" . $episodeid[ 1 ] ) ,
        ] ,
    ];

    $keyb = $telegram -> buildInlineKeyBoard ( $option );
    $telegram -> sendPhoto ( [ 'chat_id' => $chat_id , 'photo' => $ImgIxUrl , 'reply_markup' => $keyb , 'caption' => tr_num ( $Description , 'fa' ) , 'parse_mode' => 'HTML' ] );
    #$telegram->sendMessage(['chat_id' => $chat_id, 'text' => $videoM3u8Url]);
}
else if ( strstr ( $text , "eps" ) == TRUE ) {
    $episodeid = explode ( "eps" , $text , 2 );
    $array = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/episodedetails?id=" . $episodeid[ 1 ] ) , TRUE );
    $showID = $array[ 'details' ][ 'showID' ];
    $ImgIxUrl = $array[ 'details' ][ 'episodelandscapeImgIxUrl' ];
    $videoM3u8Url = $array[ 'details' ][ 'videoM3u8Url' ];
    $status = $array[ 'status' ];
    $videoDownloadUrl = $array[ 'details' ][ 'videoDownloadUrl' ];
    copy ( $ImgIxUrl , "epiphoto.jpg" );
    $epiphoto = new CURLFile( "epiphoto.jpg" );
    if ( $showID == "1059" or "2619" ) {
        $array2 = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/metadatamodule/pagetitle?url=https://www.manototv.com/episode/" . $episodeid[ 1 ] ) , TRUE );
        $formattedEpisodeTitle = $array2[ 'details' ][ 'pageTitle' ];
    } else {
        $formattedEpisodeTitle = $array[ 'details' ][ 'formattedEpisodeTitle' ];
    }
    $Description = "@BachehayeManotoBot \n" . "*$formattedEpisodeTitle*";


    if ( $status == "1" ) {
        if ( stristr ( $videoDownloadUrl , 'http' ) == TRUE ) {
            $option = [
                [
                    $telegram -> buildInlineKeyBoardButton ( "صفحه برنامه در سایت" , $url = "https://www.manototv.com/show/" . $showID ) ,
                    $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/episode/" . $episodeid[ 1 ] ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( 'توضیحات برنامه' , $url = '' , $callback_data = "showdetail" ) ,
                    $telegram -> buildInlineKeyBoardButton ( 'توضیحات قسمت' , $url = '' , $callback_data = "episodedetail" ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( 'صفحه برنامه' , $url = '' , $callback_data = 'genres-showsid' . $showID ) ,
                    $telegram -> buildInlineKeyBoardButton ( 'دانلود' , $url = '' , $callback_data = "file=video=" . $episodeid[ 1 ] ) ,
                ] ,
            ];
        }
        else {
            if ( $showID == "1228" )
            {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "صفحه برنامه در سایت" , $url = "https://www.manototv.com/show/" . $showID ) ,
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/episode/" . $episodeid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات برنامه' , $url = '' , $callback_data = "showdetail" ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات قسمت' , $url = '' , $callback_data = "episodedetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'دانلود' , $url = '' , $callback_data = "file|full|" . $episodeid[ 1 ] ) ,
                    ] ,
                ];
            }
            else
            {
                $option = [
                    [
                        $telegram -> buildInlineKeyBoardButton ( "صفحه برنامه در سایت" , $url = "https://www.manototv.com/show/" . $showID ) ,
                        $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/episode/" . $episodeid[ 1 ] ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات برنامه' , $url = '' , $callback_data = "showdetail" ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'توضیحات قسمت' , $url = '' , $callback_data = "episodedetail" ) ,
                    ] ,
                    [
                        $telegram -> buildInlineKeyBoardButton ( 'صفحه برنامه' , $url = '' , $callback_data = 'genres-showsid' . $showID ) ,
                        $telegram -> buildInlineKeyBoardButton ( 'دانلود پنج دقیقه ابتدایی' , $url = '' , $callback_data = "video|hls|" . $episodeid[ 1 ] ) ,
                    ] ,
                ];
            }
        }

        $keyb = $telegram -> buildInlineKeyBoard ( $option );
        $telegram -> sendPhoto ( [ 'chat_id' => $chat_id , 'reply_markup' => $keyb , 'photo' => $epiphoto , 'caption' => tr_num ( $Description , 'fa' ) , 'parse_mode' => 'markdown' ] );
        unlink ( "epiphoto.jpg" );
        if ( $sendhlsurl == "1" ) {
            $telegram -> sendMessage ( [ 'chat_id' => $chat_id , 'text' => $videoM3u8Url ] );
        }
    }

    if ( $status == "0" ) {
        $error = $array[ 'errors' ][ '0' ][ 'messageCode' ];
        $telegram -> sendMessage ( [ 'chat_id' => $chat_id , 'text' => $error . " EpisodeID" ] );
    }
}

else if ( strstr ( $text , '-' ) == TRUE ) {
    if ( stristr ( $text , " - " ) == TRUE ) {
        $scheduletext = explode ( " - " , $text , 2 );
    } else {
        $scheduletext = explode ( "-" , $text , 2 );
    }


    $dateinput = explode ( " " , $scheduletext[ 0 ] , 3 );
    $Y = "1399";
    $M = $dateinput[ 1 ];
    $D = $dateinput[ 0 ];
    $dateinputEN = jalali_to_gregorian ( $Y , $M , $D );
    $Year = $dateinputEN[ 0 ];
    $mo = $dateinputEN[ 1 ];
    $da = $dateinputEN[ 2 ];

    $timeinput = explode ( " " , $scheduletext[ 1 ] , 3 );
    $HO = $timeinput[ 0 ];
    $MI = $timeinput[ 1 ];

    $FADATE = date ( "Y-m-d H:i:s" , mktime ( $HO , $MI , 0 , $mo , $da , $Year ) );//تاریخ روز ورودی به میلادی
    $firstdate = date_create ( "$FADATE" );
    date_add ( $firstdate , date_interval_create_from_date_string ( "-12600 secs" ) );
    $ENDATE = date_format ( $firstdate , "Y-m-d" );
    $ENTIME = date_format ( $firstdate , "H" );

    if ( $MI < "30" and $MI !== "30" and $MI !== "00" ) {
        $minute = "30";
    }

    if ( $MI > "30" and $MI !== "30" and $MI !== "00" ) {
        $minute = "00";
    }

    if ( $MI == "30" ) {
        $minute = "00";
    }
    if ( $MI == "00" ) {
        $minute = "30";
    }

    $datein = date_create ( $ENTIME . ":" . $minute );
    date_add ( $datein , date_interval_create_from_date_string ( "60 minutes" ) );
    $hourplus = date_format ( $datein , "H:i" );

    $Scheduleurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/schedulemodule/schedule?from=" . $ENDATE . "T" . $ENTIME . ":" . $minute . ":00.000Z&to=" . $ENDATE . "T" . $hourplus . ":00.000Z";
    $userinputtime = ( $ENDATE . "T" . $ENTIME . ":" . $minute . ":00" );
    if ($ENTIME == "23")
    {
        $date23 = date_create ( $ENDATE );
        date_add ( $date23 , date_interval_create_from_date_string ( "+1 days" ) );
        $ENDATE2 = date_format ( $date23 , "Y-m-d" );
        $Scheduleurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/schedulemodule/schedule?from=" . $ENDATE . "T" . $ENTIME . ":" . $minute . ":00.000Z&to=" . $ENDATE2 . "T" . $hourplus . ":00.000Z";
    }

    $array = json_decode ( file_get_contents ( $Scheduleurl ) , TRUE );
    $dateUTCRoundedDownToFiveMinutes = $array[ 'details' ][ 'list' ][ '0' ][ 'dateUTCRoundedDownToFiveMinutes' ];
    $status = $array[ 'status' ];
    if ( $dateUTCRoundedDownToFiveMinutes == $userinputtime ) {
        $scheduleepisodeID0 = $array[ 'details' ][ 'list' ][ '0' ][ 'episodeID' ];
        $scheduleshowID0 = $array[ 'details' ][ 'list' ][ '0' ][ 'showID' ];
        $scheduleshowTitle0 = $array[ 'details' ][ 'list' ][ '0' ][ 'showTitle' ];
        $scheduleepisodeNumber0 = $array[ 'details' ][ 'list' ][ '0' ][ 'episodeNumber' ];
        $scheduleseasonNumber0 = $array[ 'details' ][ 'list' ][ '0' ][ 'seasonNumber' ];
        $schedulecurrentHouseNumber0 = $array[ 'details' ][ 'list' ][ '0' ][ 'currentHouseNumber' ];
        $scheduleportraitImgIxUrl0 = $array[ 'details' ][ 'list' ][ '0' ][ 'portraitImgIxUrl' ];
        $dateUTCRoundedDownToFiveMinutes0 = $array[ 'details' ][ 'list' ][ '0' ][ 'dateUTCRoundedDownToFiveMinutes' ];
    }

    if ( $dateUTCRoundedDownToFiveMinutes !== $userinputtime ) {
        $date1 = ( explode ( "T" , $dateUTCRoundedDownToFiveMinutes , 2 ) );
        $date2 = ( explode ( ":" , $date1[ 1 ] , 3 ) );
        $data3 = $date2[ 0 ];

        $datein = date_create ( $date1[ 1 ] );
        date_add ( $datein , date_interval_create_from_date_string ( "-60 minutes" ) );
        $houredited = date_format ( $datein , "H:i" );

        $array2 = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/schedulemodule/schedule?from=" . $ENDATE . "T" . $houredited . ":00.000Z&to=" . $ENDATE . "T" . $hourplus . ":00.000Z" ) , TRUE );

        $scheduleepisodeID0 = $array2[ 'details' ][ 'list' ][ '0' ][ 'episodeID' ];
        $scheduleshowID0 = $array2[ 'details' ][ 'list' ][ '0' ][ 'showID' ];
        $scheduleshowTitle0 = $array2[ 'details' ][ 'list' ][ '0' ][ 'showTitle' ];
        $scheduleepisodeNumber0 = $array2[ 'details' ][ 'list' ][ '0' ][ 'episodeNumber' ];
        $scheduleseasonNumber0 = $array2[ 'details' ][ 'list' ][ '0' ][ 'seasonNumber' ];
        $schedulecurrentHouseNumber0 = $array2[ 'details' ][ 'list' ][ '0' ][ 'currentHouseNumber' ];
        $scheduleportraitImgIxUrl0 = $array2[ 'details' ][ 'list' ][ '0' ][ 'portraitImgIxUrl' ];
        $dateUTCRoundedDownToFiveMinutes0 = $array2[ 'details' ][ 'list' ][ '0' ][ 'dateUTCRoundedDownToFiveMinutes' ];

        $scheduleepisodeID1 = $array2[ 'details' ][ 'list' ][ '1' ][ 'episodeID' ];
        $scheduleshowID1 = $array2[ 'details' ][ 'list' ][ '1' ][ 'showID' ];
        $scheduleshowTitle1 = $array2[ 'details' ][ 'list' ][ '1' ][ 'showTitle' ];
        $scheduleepisodeNumber1 = $array2[ 'details' ][ 'list' ][ '1' ][ 'episodeNumber' ];
        $scheduleseasonNumber1 = $array2[ 'details' ][ 'list' ][ '1' ][ 'seasonNumber' ];
        $schedulecurrentHouseNumber1 = $array2[ 'details' ][ 'list' ][ '1' ][ 'currentHouseNumber' ];
        $scheduleportraitImgIxUrl1 = $array2[ 'details' ][ 'list' ][ '1' ][ 'portraitImgIxUrl' ];
        $dateUTCRoundedDownToFiveMinutes1 = $array2[ 'details' ][ 'list' ][ '1' ][ 'dateUTCRoundedDownToFiveMinutes' ];
    }

    $datea = ( explode ( "T" , $dateUTCRoundedDownToFiveMinutes , 2 ) );
    $dateb = ( explode ( ":" , $datea[ 1 ] , 3 ) );

    if ( $dateb[ 1 ] == "30" ) {
        $minute2 = "00";
    }

    if ( $dateb[ 1 ] == "00" ) {
        $minute2 = "30";
    }

    $epsodelistgetdate1 = explode ( "T" , $dateUTCRoundedDownToFiveMinutes , 2 );
    $epsodelistgetdate2 = explode ( "-" , $epsodelistgetdate1[ 0 ] , 3 );

    if ($datea[ 1 ] == "21:00:00" or "21:30:00"or "22:00:00"or "22:30:00"or "23:00:00"or "23:30:00")
    {
        $epsodelistgetdate2[ 2 ] == $epsodelistgetdate2[ 2 ] +1;
    }
    $epsodelistShowon = gregorian_to_jalali ( $epsodelistgetdate2[ 0 ] , $epsodelistgetdate2[ 1 ] , $epsodelistgetdate2[ 2 ] , '-' );
    $epsodelistShowonfa = tr_num ( $epsodelistShowon , 'fa' );
    $showon = explode ( "-" , $epsodelistShowonfa , 3 );

    $dateround0 = explode ( "T" , $dateUTCRoundedDownToFiveMinutes0 , 2 );
    $dateroundin0 = date_create ( $dateround0[ 1 ] );
    date_add ( $dateroundin0 , date_interval_create_from_date_string ( "12600 secs" ) );
    $hourround0 = date_format ( $dateroundin0 , "H:i" );
    $HI0 = explode ( ":" , $hourround0 , 2 );
    $hofa0 = tr_num ( $HI0[ 0 ] , 'fa' );
    $mifa0 = tr_num ( $HI0[ 1 ] , 'fa' );

    $dateround1 = explode ( "T" , $dateUTCRoundedDownToFiveMinutes1 , 2 );
    $dateroundin1 = date_create ( $dateround1[ 1 ] );
    date_add ( $dateroundin1 , date_interval_create_from_date_string ( "12600 secs" ) );
    $hourround1 = date_format ( $dateroundin1 , "H:i" );
    $HI1 = explode ( ":" , $hourround1 , 2 );
    $hofa1 = tr_num ( $HI1[ 0 ] , 'fa' );
    $mifa1 = tr_num ( $HI1[ 1 ] , 'fa' );

    if ( $status == "1" ) {
        $scheduleCaption0 = "زمان پخش     " . $showon[ 2 ] . " " . $showon[ 1 ] . " " . $showon[ 0 ] . "   -   " . $mifa0 . " : " . $hofa0 . "\n" . $scheduleshowTitle0 . "\nS" . $scheduleseasonNumber0 . "     E" . $scheduleepisodeNumber0 . "\nhttps://d2rwmwucnr0d10.cloudfront.net/vod/" . $schedulecurrentHouseNumber0 . ".m3u8";

        $option0 = [
            [
                $telegram -> buildInlineKeyBoardButton ( "صفحه برنامه در سایت" , $url = "https://www.manototv.com/show/" . $scheduleshowID0 ) ,
                $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/episode/" . $scheduleepisodeID0 ) ,
            ] ,
            [
                $telegram -> buildInlineKeyBoardButton ( 'توضیحات برنامه' , $url = '' , $callback_data = "showdetail" ) ,
                $telegram -> buildInlineKeyBoardButton ( "توضیحات قسمت" , $url = '' , $callback_data = "episodedetail" ) ,
            ] ,
            [
                $telegram -> buildInlineKeyBoardButton ( 'صفحه برنامه' , $url = '' , $callback_data = 'genres-showsid' . $scheduleshowID0 ) ,
            ] ,
        ];

        $keyb0 = $telegram -> buildInlineKeyBoard ( $option0 );
        $telegram -> sendPhoto ( [ 'chat_id' => $chat_id , 'reply_markup' => $keyb0 , 'photo' => $scheduleportraitImgIxUrl0 , 'caption' => $scheduleCaption0 ] );

        $scheduleCaption1 = "پخش شده در     " . $showon[ 2 ] . " " . $showon[ 1 ] . " " . $showon[ 0 ] . "   -   " . $mifa1 . " : " . $hofa1 . "\n" . $scheduleshowTitle1 . "\nS" . $scheduleseasonNumber1 . "     E" . $scheduleepisodeNumber1 . "\nhttps://d2rwmwucnr0d10.cloudfront.net/vod/" . $schedulecurrentHouseNumber1 . ".m3u8";

        $option1 = [
            [
                $telegram -> buildInlineKeyBoardButton ( "صفحه برنامه در سایت" , $url = "https://www.manototv.com/show/" . $scheduleshowID1 ) ,
                $telegram -> buildInlineKeyBoardButton ( "دیدن در سایت" , $url = "https://www.manototv.com/episode/" . $scheduleepisodeID1 ) ,
            ] ,
            [
                $telegram -> buildInlineKeyBoardButton ( 'توضیحات برنامه' , $url = '' , $callback_data = "showdetail" ) ,
                $telegram -> buildInlineKeyBoardButton ( "توضیحات قسمت" , $url = '' , $callback_data = "episodedetail" ) ,
            ] ,
            [
                $telegram -> buildInlineKeyBoardButton ( 'صفحه برنامه' , $url = '' , $callback_data = 'genres-showsid' . $scheduleshowID1 ) ,
            ] ,

        ];

        $keyb1 = $telegram -> buildInlineKeyBoard ( $option1 );
        $telegram -> sendPhoto ( [ 'chat_id' => $chat_id , 'reply_markup' => $keyb1 , 'photo' => $scheduleportraitImgIxUrl1 , 'caption' => $scheduleCaption1 ] );

    } else if ( $status == "0" ) {
        $error = $array[ 'errors' ][ '0' ][ 'messageCode' ];
        $telegram -> sendMessage ( [ 'chat_id' => $chat_id , 'text' => $error . " ScheduleID" ] );
    }
}

else if ( $msgType == 'photo' ) {
    if ( $chat_id == '122558527' ) {

        $option =
            [
                [
                    $telegram -> buildInlineKeyBoardButton ( "اینستاگرام بچه های من و تو" , $url = "https://Instagram.com/BachehayeManototv" ) ,
                ] ,
                [
                    $telegram -> buildInlineKeyBoardButton ( "ارسال برای همه" , $url = '' , $callback_data = "option-send2all" ) ,
                    $telegram -> buildInlineKeyBoardButton ( "ارسال لیست اعضا" , $url = '' , $callback_data = "option-senduserdata" ) ,
                ] ,
            ];

        $keyb = $telegram -> buildInlineKeyBoard ( $option );
        $telegram -> sendPhoto ( [ 'chat_id' => "122558527" , 'reply_markup' => $keyb , 'photo' => $file_id , 'caption' => $msgcaptiom ] );
    }
}

else if ( $msgType == 'inline_query' ) {
    if ( ! empty( $inline_query_text ) ) {
        if ( $inline_query_text == "l" ) {
            $results = [];
            $p = 0;
            $array = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/homemodule/catchupepsiodes" ) , TRUE );
            for ( $p = 0 ; $p <= 19 ; $p ++ ) {
                $episodeDateUTC = $array[ 'details' ][ 'list' ][ $p ][ 'episodeDateUTC' ];
                $getdate1 = explode ( "T" , $episodeDateUTC , 2 );
                $getdate2 = explode ( "-" , $getdate1[ 0 ] , 3 );
                $showtime = gregorian_to_jalali ( $getdate2[ 0 ] , $getdate2[ 1 ] , $getdate2[ 2 ] , '-' );
                $showtimefa = tr_num ( $showtime , 'fa' );
                $showon = explode ( "-" , $showtimefa , 3 );
                $Pakhsh = "زمان پخش " . $showon[ 2 ] . " " . $showon[ 1 ] . " " . $showon[ 0 ];
                $showID = $array[ 'details' ][ 'list' ][ $p ][ 'showID' ];
                if ( $showID == "1059" or "2619" )  {
                    $array2 = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/metadatamodule/pagetitle?url=https://www.manototv.com/episode/" . $array[ 'details' ][ 'list' ][ $p ][ 'id' ] ) , TRUE );
                    $formattedEpisodeTitle = $array2[ 'details' ][ 'pageTitle' ];
                }
                else {
                    $formattedEpisodeTitle = $array[ 'details' ][ 'list' ][ $p ][ 'formattedEpisodeTitle' ];
                }

                $results[] = [
                    'type' => 'article' ,
                    'id' => base64_encode ( rand () ) ,
                    'title' => $formattedEpisodeTitle ,
                    'message_text' => "eps" . $array[ 'details' ][ 'list' ][ $p ][ 'id' ] ,
                    'description' => $Pakhsh ,
                    'thumb_url' => $array[ 'details' ][ 'list' ][ $p ][ 'landscapeImgIxUrl' ] ,
                ];
            }
            $telegram -> answerInlineQuery ( [ 'inline_query_id' => $inline_query_id , 'results' => json_encode ( $results ) ] );
        }
        else if ( stristr ( $inline_query_text , "t" ) == TRUE ){
            if ( stristr ( $inline_query_text , "+" ) == TRUE )
            {
                $handler = explode ( "+" , $inline_query_text , 2 );
                #$ENDATE = date ( "Y-m-d" );
                $HO = "17";
                $MI = "30";

                $FADATE = date ( "H:i:s" , mktime ( $HO , $MI , 0 ) );//تاریخ روز ورودی به میلادی
                $firstdate = date_create ( "$FADATE" );
                date_add ( $firstdate , date_interval_create_from_date_string ( "-12600 secs" ) );
                $ENH = date_format ( $firstdate , "H" );
                $ENHP = $ENH + 6;
                $ENS = date_format ( $firstdate , "i" );

                $ENDATE = date_create ( "$FADATE" );
                date_add ( $ENDATE , date_interval_create_from_date_string ( "$handler[1] days" ) );
                $ENDATE = date_format ( $ENDATE , "Y-m-d" );

                $nextweek = date_create ( "$ENDATE" );
                date_add ( $nextweek , date_interval_create_from_date_string ( "7 days" ) );
                $nextweekENDATE = date_format ( $nextweek , "Y-m-d" );

                $array = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/schedulemodule/schedule?from=" . $ENDATE . "T" . $ENH . ":" . $ENS . ":00.000Z&to=" . $ENDATE . "T" . $ENHP . ":" . $ENS . ":00.000Z" ) , TRUE );
                $tedad = count ( $array[ 'details' ][ 'list' ] );
                $nextweekarray = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/schedulemodule/schedule?from=" . $nextweekENDATE . "T" . $ENH . ":" . $ENS . ":00.000Z&to=" . $nextweekENDATE . "T" . $ENHP . ":" . $ENS . ":00.000Z" ) , TRUE );
                for ( $p = 0 ; $p < $tedad ; $p ++ ) {
                    $schedulecurrentHouseNumber = $array[ 'details' ][ 'list' ][ "$p" ][ 'currentHouseNumber' ];
                    $portraitImgIxUrl = $array[ 'details' ][ 'list' ][ "$p" ][ 'portraitImgIxUrl' ];
                    $episodeNumberen = $array[ 'details' ][ 'list' ][ "$p" ][ 'episodeNumber' ];
                    $seasonNumberen = $array[ 'details' ][ 'list' ][ "$p" ][ 'seasonNumber' ];
                    $showTitle = $array[ 'details' ][ 'list' ][ "$p" ][ 'showTitle' ];
                    $showID = $array[ 'details' ][ 'list' ][ "$p" ][ 'showID' ];
                    $nextweekshowID = $nextweekarray[ 'details' ][ 'list' ][ "$p" ][ 'showID' ];
                    $nextweekshowTitle = $nextweekarray[ 'details' ][ 'list' ][ "$p" ][ 'showTitle' ];
                    $dateUTCRoundedDownToFiveMinutes = $array[ 'details' ][ 'list' ][ "$p" ][ 'dateUTCRoundedDownToFiveMinutes' ];
                    $nextweekdateUTCRoundedDownToFiveMinutes = $nextweekarray[ 'details' ][ 'list' ][ "$p" ][ 'dateUTCRoundedDownToFiveMinutes' ];

                    $timeA = explode ( "T" , $dateUTCRoundedDownToFiveMinutes , 2 );
                    $timeB = explode ( "T" , $nextweekdateUTCRoundedDownToFiveMinutes , 2 );

                    $Snum = strlen ( $seasonNumberen );
                    if ( $Snum < 1 == TRUE ) {
                        $ses = "";
                    }
                    if ( $Snum > 0 == TRUE ) {
                        $seasonNumber = tr_num ( $seasonNumberen , 'fa' );
                        $ses = "ﻓﺼﻞ " . $seasonNumber;
                    }

                    $Enum = strlen ( $episodeNumberen );
                    if ( $Enum < 1 == TRUE ) {
                        $epi = " ";
                    }
                    if ( $Enum > 0 == TRUE ) {
                        $episodeNumber = tr_num ( $episodeNumberen , 'fa' );
                        $epi = "ﻗﺴﻤﺖ " . $episodeNumber;
                    }

                    if ( ( $showID == $nextweekshowID ) == true)
                    {
                        $description = $schedulecurrentHouseNumber;
                    }
                    else if ( ( $showID != $nextweekshowID ) == true)
                    {
                        if ( ( $timeA[1] == $timeB[1] ) == true)
                        {
                            $description = $schedulecurrentHouseNumber . " " . "( هفته بعد $nextweekshowTitle )";
                        }
                        else
                        {
                            $description = $schedulecurrentHouseNumber;
                        }
                    }

                    $stringData = $showTitle . "  " . $ses . "  " . $epi;

                    $results[] = [
                        'type' => 'article' ,
                        'id' => base64_encode ( rand () ) ,
                        'title' => $stringData ,
                        'message_text' => "https://d2rwmwucnr0d10.cloudfront.net/vod/" . $schedulecurrentHouseNumber . ".m3u8" ,
                        'description' => $description ,
                        'thumb_url' => $portraitImgIxUrl ,
                    ];
                }
                $telegram -> answerInlineQuery ( [ 'inline_query_id' => $inline_query_id , 'results' => json_encode ( $results ) , 'cache_time' => "30" ] );
            }
            else
            {
                $ENDATE = date ( "Y-m-d" );
                #$timeinput = explode ( " " , $inline_query_text , 2 );
                $HO = "17";
                $MI = "30";

                $FADATE = date ( "H:i:s" , mktime ( $HO , $MI , 0 ) );//تاریخ روز ورودی به میلادی
                $firstdate = date_create ( "$FADATE" );
                date_add ( $firstdate , date_interval_create_from_date_string ( "-12600 secs" ) );
                $ENH = date_format ( $firstdate , "H" );
                $ENHP = $ENH + 6;
                $ENS = date_format ( $firstdate , "i" );

                $nextweek = date_create ( "$FADATE" );
                date_add ( $nextweek , date_interval_create_from_date_string ( "7 days" ) );
                $nextweekENDATE = date_format ( $nextweek , "Y-m-d" );

                $array = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/schedulemodule/schedule?from=" . $ENDATE . "T" . $ENH . ":" . $ENS . ":00.000Z&to=" . $ENDATE . "T" . $ENHP . ":" . $ENS . ":00.000Z" ) , TRUE );
                $tedad = count ( $array[ 'details' ][ 'list' ] );
                $nextweekarray = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/schedulemodule/schedule?from=" . $nextweekENDATE . "T" . $ENH . ":" . $ENS . ":00.000Z&to=" . $nextweekENDATE . "T" . $ENHP . ":" . $ENS . ":00.000Z" ) , TRUE );
                for ( $p = 0 ; $p < $tedad ; $p ++ ) {
                    $schedulecurrentHouseNumber = $array[ 'details' ][ 'list' ][ "$p" ][ 'currentHouseNumber' ];
                    $portraitImgIxUrl = $array[ 'details' ][ 'list' ][ "$p" ][ 'portraitImgIxUrl' ];
                    $episodeNumberen = $array[ 'details' ][ 'list' ][ "$p" ][ 'episodeNumber' ];
                    $seasonNumberen = $array[ 'details' ][ 'list' ][ "$p" ][ 'seasonNumber' ];
                    $showTitle = $array[ 'details' ][ 'list' ][ "$p" ][ 'showTitle' ];
                    $showID = $array[ 'details' ][ 'list' ][ "$p" ][ 'showID' ];
                    $nextweekshowID = $nextweekarray[ 'details' ][ 'list' ][ "$p" ][ 'showID' ];
                    $nextweekshowTitle = $nextweekarray[ 'details' ][ 'list' ][ "$p" ][ 'showTitle' ];
                    $dateUTCRoundedDownToFiveMinutes = $array[ 'details' ][ 'list' ][ "$p" ][ 'dateUTCRoundedDownToFiveMinutes' ];
                    $nextweekdateUTCRoundedDownToFiveMinutes = $nextweekarray[ 'details' ][ 'list' ][ "$p" ][ 'dateUTCRoundedDownToFiveMinutes' ];

                    $timeA = explode ( "T" , $dateUTCRoundedDownToFiveMinutes , 2 );
                    $timeB = explode ( "T" , $nextweekdateUTCRoundedDownToFiveMinutes , 2 );

                    $Snum = strlen ( $seasonNumberen );
                    if ( $Snum < 1 == TRUE ) {
                        $ses = "";
                    }
                    if ( $Snum > 0 == TRUE ) {
                        $seasonNumber = tr_num ( $seasonNumberen , 'fa' );
                        $ses = "ﻓﺼﻞ " . $seasonNumber;
                    }

                    $Enum = strlen ( $episodeNumberen );
                    if ( $Enum < 1 == TRUE ) {
                        $epi = " ";
                    }
                    if ( $Enum > 0 == TRUE ) {
                        $episodeNumber = tr_num ( $episodeNumberen , 'fa' );
                        $epi = "ﻗﺴﻤﺖ " . $episodeNumber;
                    }

                    if ( ( $showID == $nextweekshowID ) == true)
                    {
                        $description = $schedulecurrentHouseNumber;
                    }
                    else if ( ( $showID != $nextweekshowID ) == true)
                    {
                        if ( ( $timeA[1] == $timeB[1] ) == true)
                        {
                            $description = $schedulecurrentHouseNumber . " " . "( هفته بعد $nextweekshowTitle )";
                        }
                        else
                        {
                            $description = $schedulecurrentHouseNumber;
                        }
                    }

                    $stringData = $showTitle . "  " . $ses . "  " . $epi;

                    $results[] = [
                        'type' => 'article' ,
                        'id' => base64_encode ( rand () ) ,
                        'title' => $stringData ,
                        'message_text' => "https://d2rwmwucnr0d10.cloudfront.net/vod/" . $schedulecurrentHouseNumber . ".m3u8" ,
                        'description' => $description ,
                        'thumb_url' => $portraitImgIxUrl ,
                    ];
                }
                $telegram -> answerInlineQuery ( [ 'inline_query_id' => $inline_query_id , 'results' => json_encode ( $results ) , 'cache_time' => "30" ] );
            }
            }
        else {
            $array = json_decode ( file_get_contents ( "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/list?sortBy=latest&genre=&pageNumber=1&pageSize=350" ) , TRUE );
            $tedad = $array[ 'details' ][ 'resultsCount' ];
            for ( $p = 0 ; $p < $tedad ; $p ++ ) {
                $formattedShowTitle = $array[ 'details' ][ 'list' ][ "$p" ][ 'formattedShowTitle' ];
                $portraitImgIxUrl = $array[ 'details' ][ 'list' ][ "$p" ][ 'portraitImgIxUrl' ];
                $showID = $array[ 'details' ][ 'list' ][ "$p" ][ 'id' ];

                if ( stristr ( $formattedShowTitle , $inline_query_text ) == TRUE ) {
                    $ShowTitle = $formattedShowTitle;

                $results[] = [
                    'type' => 'article' ,
                    'id' => base64_encode ( rand () ) ,
                    'title' => $ShowTitle ,
                    'message_text' => "genres-showsid" . $showID ,
                    'description' => $showID ,
                    'thumb_url' => $portraitImgIxUrl ,
                ];
                    }
            }
        }
            $telegram -> answerInlineQuery ( [ 'inline_query_id' => $inline_query_id , 'results' => json_encode ( $results ) , 'cache_time' => "30" ] );
                }
}

else {
    $one = "1";
    #$telegram->sendMessage(['chat_id' => $chat_id, 'text' => "Invalid Input"]);
}
