<?php
#include 'vendor/autoload.php'; #for heroku deploy
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
$callback_query = $telegram->Callback_Query();
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

elseif ($callback_query !== null && $callback_query != '') {
        if ($text == 'start') {
            $option = [
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

            $telegram->editMessageText(array('chat_id' => $chat_id, 'message_id' => $callbackmessage_id, 'reply_markup' => $keyb, 'text' => "ربات بچه های من و تو\n\nیکی از گزینه ها رو انتخاب کنید"));
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
            if (stristr($search, $UserstringData) == true) {
                fclose($UserFileHandle);
            } elseif (stristr($search, $UserstringData) == false) {
                fwrite($UserFileHandle, $UserstringData);
                fclose($UserFileHandle);
            }
        }
        elseif ($text == 'month') # show month
        {
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton("خرداد", $url = '', $callback_data = 'maha03'),
                    $telegram->buildInlineKeyBoardButton("اردیبهشت", $url = '', $callback_data = 'maha02'),
                    $telegram->buildInlineKeyBoardButton("فروردین", $url = '', $callback_data = 'maha01'),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("شهریور", $url = '', $callback_data = 'maha06'),
                    $telegram->buildInlineKeyBoardButton("مرداد", $url = '', $callback_data = 'maha05'),
                    $telegram->buildInlineKeyBoardButton("تیر", $url = '', $callback_data = 'maha04'),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("آذر", $url = '', $callback_data = 'mahb09'),
                    $telegram->buildInlineKeyBoardButton("آبان", $url = '', $callback_data = 'mahb08'),
                    $telegram->buildInlineKeyBoardButton("مهر", $url = '', $callback_data = 'mahb07'),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("اسفند", $url = '', $callback_data = 'mahc12'),
                    $telegram->buildInlineKeyBoardButton("بهمن", $url = '', $callback_data = 'mahb11'),
                    $telegram->buildInlineKeyBoardButton("دی", $url = '', $callback_data = 'mahb10'),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("بازگشت به منوی اصلی", $url = '', $callback_data = 'start'),
                ],
            ];

            $keyb = $telegram->buildInlineKeyBoard($option);
            $telegram->editMessageText(array('chat_id' => $chat_id, 'message_id' => $callbackmessage_id, 'reply_markup' => $keyb, 'text' => 'ماه مورد نظر را انتخاب کنید'));
        }
        elseif (stristr($text, 'maha') == true) # show dates of month
        {
            $M = explode('maha', $text);
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton("5", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-05'),
                    $telegram->buildInlineKeyBoardButton("4", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-04'),
                    $telegram->buildInlineKeyBoardButton("3", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-03'),
                    $telegram->buildInlineKeyBoardButton("2", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-02'),
                    $telegram->buildInlineKeyBoardButton("1", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-01'),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("10", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-10'),
                    $telegram->buildInlineKeyBoardButton("9", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-09'),
                    $telegram->buildInlineKeyBoardButton("8", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-08'),
                    $telegram->buildInlineKeyBoardButton("7", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-07'),
                    $telegram->buildInlineKeyBoardButton("6", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-06'),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("15", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-15'),
                    $telegram->buildInlineKeyBoardButton("14", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-14'),
                    $telegram->buildInlineKeyBoardButton("13", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-13'),
                    $telegram->buildInlineKeyBoardButton("12", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-12'),
                    $telegram->buildInlineKeyBoardButton("11", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-11'),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("20", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-20'),
                    $telegram->buildInlineKeyBoardButton("19", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-19'),
                    $telegram->buildInlineKeyBoardButton("18", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-18'),
                    $telegram->buildInlineKeyBoardButton("17", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-17'),
                    $telegram->buildInlineKeyBoardButton("16", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-16'),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("25", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-25'),
                    $telegram->buildInlineKeyBoardButton("24", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-24'),
                    $telegram->buildInlineKeyBoardButton("23", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-23'),
                    $telegram->buildInlineKeyBoardButton("22", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-22'),
                    $telegram->buildInlineKeyBoardButton("21", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-21'),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("30", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-30'),
                    $telegram->buildInlineKeyBoardButton("29", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-29'),
                    $telegram->buildInlineKeyBoardButton("28", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-28'),
                    $telegram->buildInlineKeyBoardButton("27", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-27'),
                    $telegram->buildInlineKeyBoardButton("26", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-26'),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("انتخاب ماه", $url = '', $callback_data = 'month'),
                    $telegram->buildInlineKeyBoardButton("31", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-31'),
                ],
            ];
            if (($M[1] <= "01") == true) {
                $moname = 'فروردین';
            } elseif (($M[1] <= "02") == true) {
                $moname = 'اردیبهشت';
            } elseif (($M[1] <= "03") == true) {
                $moname = 'خرداد';
            } elseif (($M[1] <= "04") == true) {
                $moname = 'تیر';
            } elseif (($M[1] <= "05") == true) {
                $moname = 'مرداد';
            } elseif (($M[1] <= "06") == true) {
                $moname = 'شهریور';
            }
            $keyb = $telegram->buildInlineKeyBoard($option);
            $telegram->editMessageText(array('chat_id' => $chat_id, 'message_id' => $callbackmessage_id, 'reply_markup' => $keyb, 'text' => "روز مورد نظر را انتخاب کنید (" . $moname . ")"));
        }
        elseif (stristr($text, 'mahb') == true) # show dates of month
        {
            $M = explode('mahb', $text);
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton("5", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-05'),
                    $telegram->buildInlineKeyBoardButton("4", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-04'),
                    $telegram->buildInlineKeyBoardButton("3", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-03'),
                    $telegram->buildInlineKeyBoardButton("2", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-02'),
                    $telegram->buildInlineKeyBoardButton("1", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-01'),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("10", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-10'),
                    $telegram->buildInlineKeyBoardButton("9", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-09'),
                    $telegram->buildInlineKeyBoardButton("8", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-08'),
                    $telegram->buildInlineKeyBoardButton("7", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-07'),
                    $telegram->buildInlineKeyBoardButton("6", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-06'),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("15", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-15'),
                    $telegram->buildInlineKeyBoardButton("14", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-14'),
                    $telegram->buildInlineKeyBoardButton("13", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-13'),
                    $telegram->buildInlineKeyBoardButton("12", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-12'),
                    $telegram->buildInlineKeyBoardButton("11", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-11'),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("20", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-20'),
                    $telegram->buildInlineKeyBoardButton("19", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-19'),
                    $telegram->buildInlineKeyBoardButton("18", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-18'),
                    $telegram->buildInlineKeyBoardButton("17", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-17'),
                    $telegram->buildInlineKeyBoardButton("16", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-16'),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("25", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-25'),
                    $telegram->buildInlineKeyBoardButton("24", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-24'),
                    $telegram->buildInlineKeyBoardButton("23", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-23'),
                    $telegram->buildInlineKeyBoardButton("22", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-22'),
                    $telegram->buildInlineKeyBoardButton("21", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-21'),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("30", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-30'),
                    $telegram->buildInlineKeyBoardButton("29", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-29'),
                    $telegram->buildInlineKeyBoardButton("28", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-28'),
                    $telegram->buildInlineKeyBoardButton("27", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-27'),
                    $telegram->buildInlineKeyBoardButton("26", $url = '', $callback_data = 'zaman1399-' . $M[1] . '-26'),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("انتخاب ماه", $url = '', $callback_data = 'month'),
                ],
            ];
            if (($M[1] <= "07") == true) {
                $moname = 'مهر';
            } elseif (($M[1] <= "08") == true) {
                $moname = 'آبان';
            } elseif (($M[1] <= "09") == true) {
                $moname = 'آذر';
            } elseif (($M[1] <= "10") == true) {
                $moname = 'دی';
            } elseif (($M[1] <= "11") == true) {
                $moname = 'بهمن';
            }
            $keyb = $telegram->buildInlineKeyBoard($option);
            $telegram->editMessageText(array('chat_id' => $chat_id, 'message_id' => $callbackmessage_id, 'reply_markup' => $keyb, 'text' => "روز مورد نظر را انتخاب کنید (" . $moname . ")"));
        }
        elseif (stristr($text, 'mahc') == true) # show dates of month
        {
            $M = explode('mahc', $text);
            $option = [
                [
                    $telegram->buildInlineKeyBoardButton("5", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-05'),
                    $telegram->buildInlineKeyBoardButton("4", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-04'),
                    $telegram->buildInlineKeyBoardButton("3", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-03'),
                    $telegram->buildInlineKeyBoardButton("2", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-02'),
                    $telegram->buildInlineKeyBoardButton("1", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-01'),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("10", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-10'),
                    $telegram->buildInlineKeyBoardButton("9", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-09'),
                    $telegram->buildInlineKeyBoardButton("8", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-08'),
                    $telegram->buildInlineKeyBoardButton("7", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-07'),
                    $telegram->buildInlineKeyBoardButton("6", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-06'),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("15", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-15'),
                    $telegram->buildInlineKeyBoardButton("14", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-14'),
                    $telegram->buildInlineKeyBoardButton("13", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-13'),
                    $telegram->buildInlineKeyBoardButton("12", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-12'),
                    $telegram->buildInlineKeyBoardButton("11", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-11'),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("20", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-20'),
                    $telegram->buildInlineKeyBoardButton("19", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-19'),
                    $telegram->buildInlineKeyBoardButton("18", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-18'),
                    $telegram->buildInlineKeyBoardButton("17", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-17'),
                    $telegram->buildInlineKeyBoardButton("16", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-16'),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("25", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-25'),
                    $telegram->buildInlineKeyBoardButton("24", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-24'),
                    $telegram->buildInlineKeyBoardButton("23", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-23'),
                    $telegram->buildInlineKeyBoardButton("22", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-22'),
                    $telegram->buildInlineKeyBoardButton("21", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-21'),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("29", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-29'),
                    $telegram->buildInlineKeyBoardButton("28", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-28'),
                    $telegram->buildInlineKeyBoardButton("27", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-27'),
                    $telegram->buildInlineKeyBoardButton("26", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-26'),
                ],
                [
                    $telegram->buildInlineKeyBoardButton("انتخاب ماه", $url = '', $callback_data = 'month'),
                ],
            ];

            $keyb = $telegram->buildInlineKeyBoard($option);
            $telegram->editMessageText(array('chat_id' => $chat_id, 'message_id' => $callbackmessage_id, 'reply_markup' => $keyb, 'text' => "روز مورد نظر را انتخاب کنید (اسفند)"));
        }
        elseif (stristr($text, 'zaman') == true) {
            $datefa1 = explode("zaman", $callback_data, 2);
            $datefa = explode("-", $datefa1[1], 3);
            $Y = $datefa[0];
            $M = $datefa[1];
            $D = $datefa[2];
            $dateen = jalali_to_gregorian($Y, $M, $D);//تاریخ روز ورودی به میلادی

            $Year = $dateen[0];
            $mo = $dateen[1];
            $da = $dateen[2] - 1;

            $dateenno = jdate("$Y-$M-$D");// 1398-11-30 به فارسی
            $datefano = tr_num($dateenno, 'fa');
            $datefano2 = explode('-', $datefano, 3);
            $day2fa = $datefano2[2];
            $month2fa = $datefano2[1];
            $year2fa = $datefano2[0];

            $intimestamp = jmktime('0','0','0',$M,$D,$Y);
            $dayharfi = jgetdate($intimestamp);

            $dateharfi = $dayharfi[weekday] . " " . $day2fa . " " . $dayharfi[month] . " " . $year2fa;


            if (($da !== 1) == true) //ﺩﻮﺒﻧ 1 یﺩﻻیﻡ ﺯﻭﺭ ﻩگا
            {

                $daycont = strlen($da); // ﺯﻭﺭ ﺮﺗکاﺭاک ﺵﺭﺎﻤﺷ
                $moncont = strlen($mo); // ﻩﺎﻣ ﺮﺗکﺭاک ﺵﺭﺎﻤﺷ
                $daypre = $da - 1;
                $dayprecont = strlen($daypre);

                if (($moncont == 1) == true) {
                    $Month = '0' . $mo;
                } elseif (($moncont == 2) == true) {
                    $Month = $mo;
                }

                if (($daycont < 2) == true) {
                    $Day = '0' . $da;
                    $dayplus = $da + 1;
                    $NextDay = '0' . $dayplus;
                }

                if (($daycont == 2) == true) {
                    if (($dayprecont < 2) == true) {
                        $Day = '0' . $daypre;
                        $NextDay = $da;
                    } elseif (($dayprecont = 2) == true) {
                        $Day = $daypre;
                        $NextDay = $da;
                    }
                }


                $scheduleurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/schedulemodule/schedule?from=" . $Year . "-" . $Month . "-" . $Day . "T20:30:00.000Z&to=" . $Year . "-" . $Month . "-" . $NextDay . "T20:30:00.000Z";
            } elseif (($dateen[2] = 1) == true) //ﺩﻮﺑ 1 یﺩﻻیﻡ ﺯﻭﺭ ﻩگاﺩ
            {
                $Dpre = $D - 1;
                $dateenpre = jalali_to_gregorian($Y, $M, $Dpre);
                $Year = $dateenpre[0];
                $Month = $dateenpre[1];
                $Day = $dateenpre[2];
                $NextDay = "0" . $dateen[2];

                $monthcont = strlen($Month);
                if (($monthcont < 2) == true) {
                    $Month = '0' . $Month;
                    $Monthplus = $Month + 1;
                    $nextMonth = '0' . $Monthplus;
                } elseif (($monthcont == 2) == true) {
                    $monthpluscont = strlen($mo);
                    if (($monthpluscont < 2) == true) {
                        $Month = '0' . $Month;
                        $Monthplus = $Month + 1;
                        $nextMonth = '0' . $Monthplus;
                    } elseif (($monthpluscont == 2) == true) {
                        $Month = $Month;
                        $Monthplus = $Month + 1;
                    }

                }

                $scheduleurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/schedulemodule/schedule?from=" . $Year . "-" . $Month . "-" . $Day . "T20:30:00.000Z&to=" . $Year . "-" . $nextMonth . "-" . $NextDay . "T20:30:00.000Z";
            }

            $schedulerequest = file_get_contents($scheduleurl);
            $schedulearrayMessage = json_decode($schedulerequest, true);
            $scheduleItemID = $schedulearrayMessage['details']['list']['0']['scheduleItemID'];

            if (is_numeric($scheduleItemID)) {
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
                    #$episodeID = $schedulearrayMessage['details']['list'][$number]['episodeID'];
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
                        $epi = "";
                    }
                    if ($Enum > 0 == true) {
                        $episodeNumber = tr_num($episodeNumberen, 'fa');
                        $epi = "ﻗﺴﻤﺖ " . $episodeNumber;
                    }

                    $timestamp = mktime($hour, $minute, 00, $Month, $Day, $Year);
                    $newdate = $timestamp + 12600;
                    $result = date("H:i", $newdate);
                    $TimeFA = tr_num($result, 'fa');

                      $Shownum = strlen($showTitle);
                    if ($Shownum < 1 == true) {
                        $stringData = "";
                    }
                    if ($Shownum > 0 == true) {
                        $showlink = "https://www.manototv.com/show/" . $showID;
                        $stringData ="*" . $TimeFA . "*" . "\t\t" . "[" . $showTitle . "](" . $showlink . ") " . "\t\t\t" . $ses . "\t\t\t"  . $epi . "\n";
                    }

                    $FileName = "myFile" . $chat_id . ".txt";
                    $FileHandle = fopen($FileName, 'a') or die("can't open file");
                    fwrite($FileHandle, $stringData);
                    fclose($FileHandle);

                    $number = $number + 1;
                } while ($number < 30);

                $FileName = "myFile" . $chat_id . ".txt";
                $sch2send = file_get_contents($FileName);
                $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $sch2send, 'parse_mode' => 'Markdownv2', 'disable_web_page_preview' => "true"]);
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
                $lastcaption = ("@BachehayeManotoBot\n" . $lastformattedEpisodeTitle . "\nپخش شده در تاریخ  " . $showon[2] . " " . $showon[1] . " " . $showon[0]);
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

                $keyb = $telegram->buildInlineKeyBoard($option);
                $telegram->sendPhoto(['chat_id' => $chat_id, 'reply_markup' => $keyb, 'photo' => $lastlandscapeImgIxUrl, 'caption' => $lastcaption]);
                #$send4getmsgid = ('https://api.telegram.org/bot' . $bot_id . '/SendPhoto?chat_id=' . $chat_id . '&reply_markup= {"inline_keyboard":[[{"text":"Episode on site (' . $lastid . ')","url":"https:\/\/www.manototv.com\/episode\/' . $lastid . '"},{"text":"Show on site (' . $lastshowID . ')","url":"https:\/\/www.manototv.com\/show\/' . $lastshowID . '"}],[{"text":"Episode Details","' . $one . '":"lastid' . $message_id . '"},{"text":"Show Details","callback_data":"' . $two . '' . $message_id . '"}]]}&photo=' . $lastlandscapeImgIxUrl . '&caption=' . $lastcaption . '');

                #$getmsgid = file_get_contents($send4getmsgid);
                #$getmsgidlastarrayMessage = json_decode($getmsgid, true);
                #$getmsgidbotsentmedia = $getmsgidlastarrayMessage['result']['message_id'];

                #file_put_contents("EID" . $getmsgidbotsentmedia . ".txt", $lastid);
                #file_put_contents("SID" . $getmsgidbotsentmedia . ".txt", $lastshowID);

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
                $lastcaption = ("@BachehayeManotoBot" . $lastformattedEpisodeTitle . "\nپخش شده در تاریخ  " . $showon[2] . " " . $showon[1] . " " . $showon[0]);
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

                $keyb = $telegram->buildInlineKeyBoard($option);
                $telegram->sendPhoto(['chat_id' => $chat_id, 'reply_markup' => $keyb, 'photo' => $lastlandscapeImgIxUrl, 'caption' => $lastcaption]);

                $number = $number + 1;
            } while ($number < 20);
        }
        elseif ($text == 'news') {
            $newsapi = "https://dr905zevbmkvz.cloudfront.net/api/v1/publicrole/newsmodule/banner";
            $newsrequest = file_get_contents($newsapi);
            $newsarrayMessage = json_decode($newsrequest, true);
            $newsstrapline1 = $newsarrayMessage['details']['strapline1'];
            $newslandscapeImgIxUrl = $newsarrayMessage['details']['landscapeImgIxUrl'];

            copy($newslandscapeImgIxUrl, "newsbanner.jpeg");
            $filejpeg = new CURLFile("newsbanner.jpeg");

            $telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $filejpeg, 'caption' => "@BachehayeManotoBot\n" . $newsstrapline1]);
            unlink("newsbanner.jpeg");

            $newsvideoapi = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/newsmodule/newsvideo";
            $newsvideorequest = file_get_contents($newsvideoapi);
            $newsvideoarrayMessage = json_decode($newsvideorequest, true);
            $newsvideoDownloadUrl = $newsvideoarrayMessage['details']['videoDownloadUrl'];
            $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $newsvideoDownloadUrl]);
        }
        elseif ($text == 'frequency') {
            $file = new CURLFile("Manotofrequency.jpg");
            #$file = "AgACAgQAAxkBAAIU7V5PFnpf0aiNtDUYmaI6n199deNrAAI-sTEbIeZ4UmnbAzoTL6FTnZmgGwAEAQADAgADbQADPcYHAAEYBA";
            $telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $file, 'caption' => "@BachehayeManotoBot"]);

        }
        elseif ($callback_data == "episodedetail") # Episode Detail
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
            $Description1 = strip_tags($episodeDescription);
            $Description2 = str_replace("&laquo;", "", $Description1);
            $Description3 = str_replace("&zwnj;", " ", $Description2);
            $Description4 = str_replace("&raquo;", "", $Description3);
            $Description5 = str_replace("&nbsp;", " ", $Description4);
            $Description = ("@BachehayeManotoBot\n" . '<b>' . $episodeformattedEpisodeTitle . '</b>' . "\n" . $Description5);

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
        elseif ($callback_data == "showdetail") # Show Detail
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
        elseif ($callback_data == "lastep5") # 5 More Episode
        {
            $getshowid = explode("show/", $callbackurlshow, 2);

            $serieurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/serieslist?id=" . $getshowid[1];
            $serierequests = file_get_contents($serieurl);
            $seriearrayMessage = json_decode($serierequests, true);
            $serieid = $seriearrayMessage['details']['list']['0']['id'];

            $epsodelisturl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/episodelist?id=" . $serieid;;
            $epsodelistrequest = file_get_contents($epsodelisturl);
            $epsodelistarrayMessage = json_decode($epsodelistrequest, true);

            $number = 0;
            do {

                $epsodelistid = $epsodelistarrayMessage['details']['list'][$number]['id'];
                $epsodelistTitle = $epsodelistarrayMessage['details']['list'][$number]['episodeTitle'];
                $formattedepsodelistTitle = $epsodelistarrayMessage['details']['list'][$number]['formattedEpisodeTitle'];
                $epsodelistformattedShowTitle = $epsodelistarrayMessage['details']['list'][$number]['formattedShowTitle'];
                $epsodelistlandscapeImgIxUrl = $epsodelistarrayMessage['details']['list'][$number]['landscapeImgIxUrl'];
                $epsodelistDateUTC = $epsodelistarrayMessage['details']['list'][$number]['episodeDateUTC'];
                $epsodelistgetdate1 = explode("T", $epsodelistDateUTC, 2);
                $epsodelistgetdate2 = explode("-", $epsodelistgetdate1[0], 3);

                $epsodelistShowon = gregorian_to_jalali($epsodelistgetdate2[0], $epsodelistgetdate2[1], $epsodelistgetdate2[2], '-');
                $epsodelistShowonfa = tr_num($epsodelistShowon, 'fa');
                $showon = explode("-", $epsodelistShowonfa, 3);
                $epsodelistcaption = ("@BachehayeManotoBot\n" . $epsodelistformattedShowTitle . " " . $formattedepsodelistTitle . "\n" . $epsodelistTitle . "\nپخش شده در تاریخ " . $showon[2] . " " . $showon[1] . " " . $showon[0]);

                $option = [
                    [
                        $telegram->buildInlineKeyBoardButton("توضیحات قسمت", $url = '', $callback_data = "episodedetail"),
                        $telegram->buildInlineKeyBoardButton("دیدن در سایت", $url = "https://www.manototv.com/episode/" . $epsodelistid),
                    ],
                ];

                $keyb = $telegram->buildInlineKeyBoard($option);
                $telegram->sendPhoto(['chat_id' => $chat_id, 'reply_markup' => $keyb, 'photo' => $epsodelistlandscapeImgIxUrl, 'reply_to_message_id' => $callbackmessage_id, 'parse_mode' => 'HTML', 'caption' => $epsodelistcaption]);

                $number = $number + 1;
            } while ($number < 5);
        }
        elseif (stristr($text, 'gnr') == true) # show show page
        {
            $gnr = explode('gnr', $text);
            $url = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/list?sortBy=latest&genre=" . $gnr[0] . "&pageNumber=" . $gnr[1] . "&pageSize=20";
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
            $number = $number + 1;

            $option = [
                [
                    $telegram->buildInlineKeyBoardButton($formattedShowTitle1 . " ", $url = '', $callback_data = $id1 . 'showsid'),
                    $telegram->buildInlineKeyBoardButton($formattedShowTitle0 . " ", $url = '', $callback_data = $id0 . 'showsid'),
                ],
                [
                    $telegram->buildInlineKeyBoardButton($formattedShowTitle4 . " ", $url = '', $callback_data = $id4 . 'showsid'),
                    $telegram->buildInlineKeyBoardButton($formattedShowTitle3 . " ", $url = '', $callback_data = $id3 . 'showsid'),
                    $telegram->buildInlineKeyBoardButton($formattedShowTitle2 . " ", $url = '', $callback_data = $id2 . 'showsid'),
                ],
                [
                    $telegram->buildInlineKeyBoardButton($formattedShowTitle7 . " ", $url = '', $callback_data = $id7 . 'showsid'),
                    $telegram->buildInlineKeyBoardButton($formattedShowTitle6 . " ", $url = '', $callback_data = $id6 . 'showsid'),
                    $telegram->buildInlineKeyBoardButton($formattedShowTitle5 . " ", $url = '', $callback_data = $id5 . 'showsid'),
                ],
                [
                    $telegram->buildInlineKeyBoardButton($formattedShowTitle10 . " ", $url = '', $callback_data = $id10 . 'showsid'),
                    $telegram->buildInlineKeyBoardButton($formattedShowTitle9 . " ", $url = '', $callback_data = $id9 . 'showsid'),
                    $telegram->buildInlineKeyBoardButton($formattedShowTitle8 . " ", $url = '', $callback_data = $id8 . 'showsid'),
                ],
                [
                    $telegram->buildInlineKeyBoardButton($formattedShowTitle13 . " ", $url = '', $callback_data = $id13 . 'showsid'),
                    $telegram->buildInlineKeyBoardButton($formattedShowTitle12 . " ", $url = '', $callback_data = $id12 . 'showsid'),
                    $telegram->buildInlineKeyBoardButton($formattedShowTitle11 . " ", $url = '', $callback_data = $id11 . 'showsid'),
                ],
                [
                    $telegram->buildInlineKeyBoardButton($formattedShowTitle16 . " ", $url = '', $callback_data = $id16 . 'showsid'),
                    $telegram->buildInlineKeyBoardButton($formattedShowTitle15 . " ", $url = '', $callback_data = $id15 . 'showsid'),
                    $telegram->buildInlineKeyBoardButton($formattedShowTitle14 . " ", $url = '', $callback_data = $id14 . 'showsid'),
                ],
                [
                    $telegram->buildInlineKeyBoardButton($formattedShowTitle19 . " ", $url = '', $callback_data = $id19 . 'showsid'),
                    $telegram->buildInlineKeyBoardButton($formattedShowTitle18 . " ", $url = '', $callback_data = $id18 . 'showsid'),
                    $telegram->buildInlineKeyBoardButton($formattedShowTitle17 . " ", $url = '', $callback_data = $id17 . 'showsid'),
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
                    $telegram->buildInlineKeyBoardButton("بازگشت به منوی اصلی", $url = '', $callback_data = 'start'),
                    $telegram->buildInlineKeyBoardButton("ژانرها", $url = '', $callback_data = 'genres'),
                ],
            ];
            $P = $N + 1;
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

            $option = [
                [
                    $telegram->buildInlineKeyBoardButton("دیدن در سایت", $url = "https://www.manototv.com/show/" . $getshowid[0]),
                ],
                [
                    $telegram->buildInlineKeyBoardButton('توضیحات', $url = '', $callback_data = "showdetail"),
                    $telegram->buildInlineKeyBoardButton('پنج قسمت اخیر', $url = '', $callback_data = "lastep5"),
                ],
            ];

            $keyb = $telegram->buildInlineKeyBoard($option);
            $telegram->sendPhoto(['chat_id' => $chat_id, 'reply_markup' => $keyb, 'photo' => $showoverlayImgIxUrl, 'caption' => $caption, 'reply_to_message_id' => $callbackmessage_id, 'parse_mode' => 'HTML']);

        }
        elseif ($callback_data == "genres") # Show Show inline
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
                    $telegram->buildInlineKeyBoardButton("تاریخی‌", $url = '', $callback_data = "HistoryGNR1"),
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
                    $telegram->buildInlineKeyBoardButton("بازگشت به منوی اصلی", $url = '', $callback_data = 'start'),
                ],
            ];

            $keyb = $telegram->buildInlineKeyBoard($option);
            $telegram->editMessageText(array('chat_id' => $chat_id, 'message_id' => $callbackmessage_id, 'reply_markup' => $keyb, 'text' => "ژانر مورد نظر رو انتخاب کنید"));
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
            $users = file_get_contents('users.txt');
            $user = explode('-', $users);
            $tedaduser = count($user);
            $filetxt = new CURLFile("users.txt");

            $telegram->sendMessage(['chat_id' => '122558527', 'text' =>  $tedaduser . " Users"]);
            $telegram->sendDocument(['chat_id' => '122558527', 'document' =>  $filetxt]);
        }
}

elseif (strstr($text, "ephls") == true) {
    $getepisodeid = explode("ephls", $text, 2);
    $episodeurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/episodedetails?id=" . $getepisodeid[1];
    $episoderequest = file_get_contents($episodeurl);
    $episodearrayMessage = json_decode($episoderequest, true);

    $status = $episodearrayMessage['status'];

    if ($status == "1") {
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


    if ($status == "0") {
        $error = $episodearrayMessage['errors']['0']['messageCode'];
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $error . " EpisodeID"]);
    }
}

elseif (strstr($text, "shhls") == true) {
    $getshowid = explode("shhls", $text, 2);
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
    $telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $showoverlayImgIxUrl]);
    $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $Description6]);

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

elseif (strstr($text, '-') == true) {
    if (stristr($text, " - ") == true) {
        $scheduletext = explode(" - ", $text, 2);
    } else {
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
    if (($dateinputMonth == 1) == true) {
        $zero = "0";
        $Month = $zero . $dateinput2FA[1];
    } elseif (($dateinputMonth == 2) == true) {
        $Month = $dateinput2FA[1];
    } else {
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => "Invalid_Date"]);
    }


    $dateinputDay = strlen($dateinput2FA[2]);
    if (($dateinputDay == 1) == true) {
        $zero = "0";
        $Day = $zero . $dateinput2FA[2];
    } elseif (($dateinputDay == 2) == true) {
        $Day = $dateinput2FA[2];
    } else {
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => "Invalid_Date"]);
    }


    $dateinputYear = strlen($dateinput2FA[0]);
    if (($dateinputYear == 2) == true) {
        $twenty = "20";
        $Year = $twenty . $dateinput2FA[0];
    } elseif (($dateinputYear == 4) == true) {
        $Year = $dateinput2FA[0];
    } else {
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => "Invalid_Date"]);
    }

    $DateMiladi = ($Year . "-" . $Month . "-" . $Day);

    $timeinput = explode(" ", $scheduletext[1], 2);

    $userTimezone = new DateTimeZone('Asia/Tehran');
    $gmtTimezone = new DateTimeZone('GMT');
    $myDateTime = new DateTime("$DateMiladi $timeinput[0]:$timeinput[1]", $gmtTimezone);
    $offset = $userTimezone->getOffset($myDateTime);
    $myInterval = DateInterval::createFromDateString((string)"-12600" . 'seconds');
    $myDateTime->add($myInterval);
    $result = $myDateTime->format('Y-m-d H:i:s');
    $datetime = explode(" ", $result, 2);
    $time = explode(":", $datetime[1], 3);
    $hour = $time[0];
    $hourplus = $hour + 1;
    $min = $time[1];


    if ($timeinput[1] < "30" and $timeinput[1] !== "30" and $timeinput[1] !== "00") {
        $minute = "30";
    }

    if ($timeinput[1] > "30" and $timeinput[1] !== "30" and $timeinput[1] !== "00") {
        $minute = "00";
    }

    if ($timeinput[1] == "30") {
        $minute = "00";
    }
    if ($timeinput[1] == "00") {
        $minute = "30";
    }
    $scheduleurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/schedulemodule/schedule?from=" . $DateMiladi . "T" . $hour . ":" . $minute . ":00.000Z&to=" . $DateMiladi . "T" . $hourplus . ":" . $minute . ":00.000Z";

    $schedulerequest = file_get_contents($scheduleurl);
    $schedulearrayMessage = json_decode($schedulerequest, true);
    $dateUTCRoundedDownToFiveMinutes = $schedulearrayMessage['details']['list']['0']['dateUTCRoundedDownToFiveMinutes'];
    $userinputtime = ($DateMiladi . "T" . $hour . ":" . $minute . ":00");

    if ($dateUTCRoundedDownToFiveMinutes == $userinputtime) {
        $scheduleepisodeID = $schedulearrayMessage['details']['list']['0']['episodeID'];
        $scheduleshowID = $schedulearrayMessage['details']['list']['0']['showID'];
        $scheduleshowTitle = $schedulearrayMessage['details']['list']['0']['showTitle'];
        $scheduleepisodeNumber = $schedulearrayMessage['details']['list']['0']['episodeNumber'];
        $scheduleseasonNumber = $schedulearrayMessage['details']['list']['0']['seasonNumber'];
        $schedulecurrentHouseNumber = $schedulearrayMessage['details']['list']['0']['currentHouseNumber'];
        $scheduleportraitImgIxUrl = $schedulearrayMessage['details']['list']['0']['portraitImgIxUrl'];
    }

    if ($dateUTCRoundedDownToFiveMinutes !== $userinputtime) {
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

    if ($dateb[1] == "30") {
        $minute2 = "00";
    }

    if ($dateb[1] == "00") {
        $minute2 = "30";
    }

    $status = $schedulearrayMessage['status'];

    if ($status == "1") {
        $scheduleCaption = "live on >>> " . $timeinput[0] . ":" . $minute2 . "\nSHOW ID >>> " . $scheduleshowID . "\nEP ID >>> " . $scheduleepisodeID . "\n" . $scheduleshowTitle . "\nS" . $scheduleseasonNumber . "\nE" . $scheduleepisodeNumber . "\nhttps://d2rwmwucnr0d10.cloudfront.net/vod/" . $schedulecurrentHouseNumber . ".m3u8";
        $telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $scheduleportraitImgIxUrl, 'caption' => $scheduleCaption]);

        $option0 = [
            [$telegram->buildInlineKeyBoardButton('Episode Details', $url = 'tg://resolve?domain=manotoapibot&start=/news', $callback_data = "1"),
                $telegram->buildInlineKeyBoardButton('Show Details', $url = '', $callback_data = "2"),
            ],
        ];

        $keyb0 = $telegram->buildInlineKeyBoard($option0);
        $telegram->sendPhoto(['chat_id' => $chat_id, 'reply_markup' => $keyb0, 'photo' => $scheduleportraitImgIxUrl, 'caption' => $scheduleCaption]);

    } elseif ($status == "0") {
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

else
{
    $telegram->sendMessage(['chat_id' => $chat_id, 'text' => "Invalid Input"]);
}
