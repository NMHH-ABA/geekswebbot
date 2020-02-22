<?php
include 'vendor/autoload.php';
include 'vendor/Telegram.php';
include_once 'vendor/jdf.php';
date_default_timezone_set("asia/tehran");
// Set the bot TOKEN
$bot_id = "436243035:AAHoZhqLSlMa0Aku0iqftijx7gOFjbiwcas";
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
            $telegram->buildInlineKeyBoardButton("برنامه های اخیر", $url = '', $callback_data = 'last'),
            $telegram->buildInlineKeyBoardButton("زمان پخش برنامه ها", $url = '', $callback_data = 'month'),
        ],
        [
            $telegram->buildInlineKeyBoardButton("برنامه ها", $url = '', $callback_data = 'showsp1'),
            $telegram->buildInlineKeyBoardButton("اتاق خبر", $url = '', $callback_data = 'news'),
            $telegram->buildInlineKeyBoardButton("فرکانس", $url = '', $callback_data = 'frequency'),
        ],
    ];

    $keyb = $telegram->buildInlineKeyBoard($option);
    $telegram->sendMessage(array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "ربات بچه های من و تو\n\nیکی از گزینه ها رو انتخاب کنید"));
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
}

elseif ($text == 'month') # show month
{
    $option =   [
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
    ];

    $keyb = $telegram->buildInlineKeyBoard($option);
    $telegram->editMessageText(array('chat_id' => $chat_id, 'message_id' => $callbackmessage_id, 'reply_markup' => $keyb, 'text' => 'ماه را انتخاب کنید'));
}
elseif (stristr($text, 'maha') == true) # show dates of month
{
    $M = explode('maha', $text);
    $option =   [
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
            $telegram->buildInlineKeyBoardButton("30", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-30'),
            $telegram->buildInlineKeyBoardButton("29", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-29'),
            $telegram->buildInlineKeyBoardButton("28", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-28'),
            $telegram->buildInlineKeyBoardButton("27", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-27'),
            $telegram->buildInlineKeyBoardButton("26", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-26'),
        ],
        [
            $telegram->buildInlineKeyBoardButton("انتخاب ماه", $url = '', $callback_data = 'month'),
            $telegram->buildInlineKeyBoardButton("31", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-31'),
        ],
    ];

    $keyb = $telegram->buildInlineKeyBoard($option);
    $telegram->editMessageText(array('chat_id' => $chat_id, 'message_id' => $callbackmessage_id, 'reply_markup' => $keyb, 'text' => "روز را انتخاب کنید"));
}
elseif (stristr($text, 'mahb') == true) # show dates of month
{
    $M = explode('mahb', $text);
    $option =   [
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
            $telegram->buildInlineKeyBoardButton("30", $url = '', $callback_data = 'zaman1398-' . $M[1] . '-30'),
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
    $telegram->editMessageText(array('chat_id' => $chat_id, 'message_id' => $callbackmessage_id, 'reply_markup' => $keyb, 'text' => "روز را انتخاب کنید"));
}
elseif (stristr($text, 'mahc') == true) # show dates of month
{
    $M = explode('mahc', $text);
    $option =   [
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
    $telegram->editMessageText(array('chat_id' => $chat_id, 'message_id' => $callbackmessage_id, 'reply_markup' => $keyb, 'text' => "روز را انتخاب کنید"));
}
elseif (stristr($text, 'zaman') == true)
{
    $datefa1 = explode("zaman", $callback_data, 2);
    $datefa = explode("-", $datefa1[1], 3);
    $Y = $datefa[0];
    $M = $datefa[1];
    $D = $datefa[2];
    $dateen = jalali_to_gregorian($Y, $M, $D); //یﺩﻻیﻡ ﻪﺑ یﺩﻭﺭﻭ ﺯﻭﺭ ﺥیﺭﺎﺗ

    $Year = $dateen[0];
    $mo = $dateen[1];
    $da = $dateen[2];

    $dateenno = jdate("$Y-$M-$D");// 1398-11-30 به فارسی
    $datefano = tr_num($dateenno,'fa');
    $datefano2 = explode ('-', $datefano, 3);
    $day2fa = $datefano2[2];
    $month2fa = $datefano2[1];
    $year2fa = $datefano2[0];

    $intimestamp = jmktime ($M,$D,$Y);
    #$dayharfi = jgetdate($intimestamp);

    $input11 = $Year.$mo.$da;
    $input12 = $Y.$M.$D;

    $dayOfWeekfa =  jdate('w', strtotime($input12));
    $dayOfWeek = tr_num($dayOfWeekfa,'en');

    if (($dayOfWeek <= "0") == true)
    {
        $dayName = 'پنجشنبه';
    }
    elseif (($dayOfWeek <= "1") == true)
    {
        $dayName = 'جمعه';
    }
    elseif (($dayOfWeek <= "2") == true)
    {
        $dayName = 'شنبه';
    }
    elseif (($dayOfWeek <= "3") == true)
    {
        $dayName = 'یکشنبه';
    }
    elseif (($dayOfWeek <= "4") == true)
    {
        $dayName = 'دوشنبه';
    }
    elseif (($dayOfWeek <= "5") == true)
    {
        $dayName = 'سه شنبه';
    }
    elseif (($dayOfWeek <= "6") == true)
    {
        $dayName = 'چهارشنبه';
    }

    #$NoOfMonthFa =  jdate('m', strtotime($input12));
    #$MonthFa = tr_num($NoOfMonthFa,'en');

    if (($M <= '01') == true)
    {
        $Monthname = 'فروردین';
    }
    elseif (($M <= "02") == true)
    {
        $Monthname =  'اردیبهشت';
    }
    elseif (($M <= "03") == true)
    {
        $Monthname = 'خرداد';
    }
    elseif (($M <= "04") == true)
    {
        $Monthname = 'تیر';
    }
    elseif (($M <= "05") == true)
    {
        $Monthname = 'مرداد';
    }
    elseif (($M <= "06") == true)
    {
        $Monthname = 'شهریور';
    }
    elseif (($M <= "07") == true)
    {
        $Monthname = 'مهر';
    }
    elseif (($M <= "08") == true)
    {
        $Monthname = 'آبان';
    }
    elseif (($M <= "09") == true)
    {
        $Monthname = 'آذر';
    }
    elseif (($M <= "10") == true)
    {
        $Monthname = 'دی';
    }
    elseif (($M <= "11") == true)
    {
        $Monthname = 'بهمن';
    }
    elseif (($M <= "12") == true)
    {
        $Monthname = 'اسفند';
    }

    $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $Monthname]);

    $dateharfi = $dayName . " " . $day2fa . " " . $Monthname . " " . $year2fa;



    if (($da !== 1) == true) //ﺩﻮﺒﻧ 1 یﺩﻻیﻡ ﺯﻭﺭ ﻩگا
    {

        $daycont = strlen($da); // ﺯﻭﺭ ﺮﺗکاﺭاک ﺵﺭﺎﻤﺷ
        $moncont = strlen($mo); // ﻩﺎﻣ ﺮﺗکﺭاک ﺵﺭﺎﻤﺷ
        $daypre = $da - 1;
        $dayprecont = strlen($daypre);

        if (($moncont == 1) == true )
        {
            $Month = '0' . $mo;
        }

        elseif (($moncont == 2) == true )
        {
            $Month = $mo;
        }

        if (($daycont < 2) == true )
        {
            $Day = '0' . $da;
            $dayplus = $da + 1;
            $NextDay =  '0' . $dayplus;
        }

        if (($daycont == 2) == true )
        {
            if (($dayprecont < 2) == true )
            {
                $Day = '0' . $daypre;
                $NextDay = $da;
            }
            elseif (($dayprecont = 2) == true )
            {
                $Day = $daypre;
                $NextDay =$da;
            }
        }


        $scheduleurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/schedulemodule/schedule?from=" . $Year . "-" . $Month . "-" . $Day . "T20:30:00.000Z&to=" . $Year . "-" . $Month . "-" . $NextDay . "T20:30:00.000Z";
    }

    elseif (($dateen[2] = 1) == true) //ﺩﻮﺑ 1 یﺩﻻیﻡ ﺯﻭﺭ ﻩگاﺩ
    {
        $Dpre = $D - 1;
        $dateenpre = jalali_to_gregorian($Y, $M, $Dpre);
        $Year = $dateenpre[0];
        $Month = $dateenpre[1];
        $Day = $dateenpre[2];
        $NextDay = "0" . $dateen[2];

        $monthcont = strlen($Month);
        if (($monthcont < 2) == true)
        {
            $Month = '0' . $Month;
            $Monthplus = $Month + 1;
            $nextMonth = '0' . $Monthplus;
        }

        elseif (($monthcont == 2) == true)
        {
            $monthpluscont = strlen($mo);
            if (($monthpluscont < 2) == true)
            {
                $Month = '0' . $Month;
                $Monthplus = $Month + 1;
                $nextMonth = '0' . $Monthplus;
            }
            elseif (($monthpluscont == 2) == true)
            {
                $Month = $Month;
                $Monthplus = $Month + 1;
            }

        }

        $scheduleurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/schedulemodule/schedule?from=" . $Year . "-" . $Month . "-" . $Day . "T20:30:00.000Z&to=" . $Year . "-" . $nextMonth . "-" . $NextDay . "T20:30:00.000Z";
    }

    $schedulerequest = file_get_contents($scheduleurl);
    $schedulearrayMessage = json_decode($schedulerequest, true);
    $scheduleItemID = $schedulearrayMessage['details']['list']['0']['scheduleItemID'];

    if (is_numeric($scheduleItemID))
    {
        $FileName = "myFile" . $chat_id . ".txt";
        $FileHandle = fopen($FileName, 'a') or die("can't open file");
        $stringData = "بچه ﻫﺎی ﻣﻦ ﻭ  ﺗﻮ @BachehayeManoto\nﺑﺮﻧﺎﻣﻪ ﻫﺎی ﻣﻦ ﻭﺗﻮ ﺩﺭ ﺗﺎﺭیخ " . '<b>'. $dateharfi .'</b>' . "\n\n";
        fwrite($FileHandle, $stringData);
        fclose($FileHandle);
        $number = 0;
        do {

            $dateUTC = $schedulearrayMessage['details']['list'][$number]['dateUTCRoundedDownToFiveMinutes'];
            $showTitle = $schedulearrayMessage['details']['list'][$number]['showTitle'];
            $episodeNumberen = $schedulearrayMessage['details']['list'][$number]['episodeNumber'];
            $seasonNumberen = $schedulearrayMessage['details']['list'][$number]['seasonNumber'];
            #$showID = $schedulearrayMessage['details']['list'][$number]['showID'];
            #$episodeID = $schedulearrayMessage['details']['list'][$number]['episodeID'];
            #$schedulecurrentHouseNumber = $schedulearrayMessage['details']['list'][$number]['currentHouseNumber'];
            #$portraitImgIxUrl = $schedulearrayMessage['details']['list'][$number]['portraitImgIxUrl'];

            $time1 = explode("T", $dateUTC, 2);
            $time = explode(":", $time1[1], 3);
            $hour = $time[0];
            $minute = $time[1];

            $Snum = strlen($seasonNumberen);
            if ( $Snum < 1 == true)
            {
                $ses = "";
            }
            if ( $Snum > 0 == true)
            {
                $seasonNumber = tr_num($seasonNumberen,'fa');
                $ses = "ﻓﺼﻞ " . $seasonNumber;
            }

            $Enum = strlen($episodeNumberen);
            if ($Enum < 1 == true)
            {
                $epi = "";
            }
            if ($Enum > 0 == true)
            {
                $episodeNumber = tr_num($episodeNumberen,'fa');
                $epi = "ﻗﺴﻤﺖ " . $episodeNumber;
            }

            $timestamp = mktime($hour, $minute, 00, $$Month, $Day, $$Year);
            $newdate = $timestamp + 12600;
            $resulten = date("H:i", $newdate);
            $result = tr_num($resulten,'fa');


            $Shownum = strlen($showTitle);
            if ($Shownum < 1 == true)
            {
                $stringData = "";
            }
            if ($Shownum > 0 == true)
            {
                $stringData = $result . " " . '<b>'. $showTitle .'</b>' . " " . $ses . " " . $epi . "\n";
            }

            $FileName = "myFile" . $chat_id . ".txt";
            $FileHandle = fopen($FileName, 'a') or die("can't open file");
            fwrite($FileHandle, $stringData);
            fclose($FileHandle);

            $number = $number + 1;
        }
        while ($number < 30);

        $FileName = "myFile" . $chat_id . ".txt";
        $sch2send = file_get_contents($FileName);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $sch2send, 'parse_mode' => 'HTML']);
        unlink($FileName);
    }

    else
    {
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => "اطلاعات در دسترس نیست"]);
    }

}

elseif ($text == 'last')
{
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
        $lastshowtimefa = tr_num($lastshowtime,'fa');
        $lastcaption = ("@BachehayeManotoBot\n" . $lastformattedEpisodeTitle. "\nپخش شده در تاریخ  " . $lastshowtimefa);
        $option =   [
            [
                $telegram->buildInlineKeyBoardButton("Show on Site" , $url = "https://www.manototv.com/show/" . $lastshowID),
                $telegram->buildInlineKeyBoardButton("Episode on Site", $url = "https://www.manototv.com/episode/" . $lastid),
            ],
            [
                $telegram->buildInlineKeyBoardButton('Show Details', $url = '', $callback_data = "showdetail"),
                $telegram->buildInlineKeyBoardButton('Episode Details', $url = '', $callback_data = "episodedetail"),
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
    }
    while ($number < 3);
    $option1 =  [
        [
            $telegram->buildInlineKeyBoardButton('View More', $url = '', $callback_data = "last20"),
        ],
    ];

    $keyb1 = $telegram->buildInlineKeyBoard($option1);
    $telegram->sendMessage(['chat_id' => $chat_id, 'reply_markup' => $keyb1, 'text' => "ﺑﺮای ﺩیﺩﻥ 20 ﺑﺮﻧﺎﻣﻪ اﺥیﺭ ﺩکﻣﻪ ﺯیﺭ ﺭا ﻟﻤﺲ کﻥیﺩ"]);
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
        $lastshowtimefa = tr_num($lastshowtime,'fa');
        $lastcaption = ("@BachehayeManotoBot" . $lastformattedEpisodeTitle. "\nپخش شده در تاریخ  " . $lastshowtimefa);
        $option =   [
            [
                $telegram->buildInlineKeyBoardButton("Show on Site" , $url = "https://www.manototv.com/show/" . $lastshowID),
                $telegram->buildInlineKeyBoardButton("Episode on Site", $url = "https://www.manototv.com/episode/" . $lastid),
            ],
            [
                $telegram->buildInlineKeyBoardButton('Show Details', $url = '', $callback_data = "showdetail"),
                $telegram->buildInlineKeyBoardButton('Episode Details', $url = '', $callback_data = "episodedetail"),
            ],
        ];

        $keyb = $telegram->buildInlineKeyBoard($option);
        $telegram->sendPhoto(['chat_id' => $chat_id, 'reply_markup' => $keyb, 'photo' => $lastlandscapeImgIxUrl, 'caption' => $lastcaption]);

        $number = $number + 1;
    }
    while ($number < 20);
}

elseif ($text == 'news')
{
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

elseif ($text == 'frequency')
{
    #$file = new CURLFile("Manotofrequency.jpg");
    $file = "AgACAgQAAxkBAAIU7V5PFnpf0aiNtDUYmaI6n199deNrAAI-sTEbIeZ4UmnbAzoTL6FTnZmgGwAEAQADAgADbQADPcYHAAEYBA";
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
    $Description = ("@BachehayeManotoBot\n" . '<b>'. $episodeformattedEpisodeTitle .'</b>' . "\n" . $Description5);

    if (stristr($episodelandscapeImgIxUrl,"autogenerated") == true)
    {
        $imgurl = explode("_", $episodelandscapeImgIxUrl, 2);

        if (stristr($episodelandscapeImgIxUrl,"png") == true)
        {
            $ext=".png";
        }

        elseif (stristr($episodelandscapeImgIxUrl,"jpg") == true)
        {
            $ext=".jpg";
        }

        elseif (stristr($episodelandscapeImgIxUrl,"jpeg") == true)
        {
            $ext=".jpeg";
        }
        $telegram->sendMediaGroup(array('chat_id' => $chat_id, 'reply_to_message_id' => $callbackmessage_id, 'parse_mode' => 'HTML', 'media' => json_encode([
            ['type' => 'photo',media => $imgurl[0] . '_00034' . $ext],
            ['type' => 'photo',media => $imgurl[0] . '_00035' . $ext],
            ['type' => 'photo',media => $imgurl[0] . '_00036' . $ext],
            ['type' => 'photo',media => $imgurl[0] . '_00037' . $ext],
            ['type' => 'photo',media => $imgurl[0] . '_00038' . $ext],
            ['type' => 'photo',media => $imgurl[0] . '_00039' . $ext],
            ['type' => 'photo',media => $imgurl[0] . '_00040' . $ext],
            ['type' => 'photo',media => $imgurl[0] . '_00041' . $ext],
            ['type' => 'photo',media => $imgurl[0] . '_00042' . $ext],
            ['type' => 'photo',media => $imgurl[0] . '_00043' . $ext]
        ])
        ));
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $Description, 'parse_mode' => 'HTML']);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $episodevideoM3u8Url, 'parse_mode' => 'HTML']);
    }

    else
    {
        #$telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $episodelandscapeImgIxUrl]);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $Description, 'reply_to_message_id' => $callbackmessage_id, 'parse_mode' => 'HTML']);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $episodevideoM3u8Url]);
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
    $Description = ("@BachehayeManotoBot\n" . '<b>'. $showTitle .'</b>' . "\n" . $Description6 . "\n" . $Description5);

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
        $epsodelistShowonfa = tr_num($epsodelistShowon,'fa');
        $epsodelistcaption = ("@BachehayeManotoBot\n" . $epsodelistformattedShowTitle . " " . $formattedepsodelistTitle . "\n" . $epsodelistTitle . "\nپخش شده در تاریخ " . $epsodelistShowonfa);

        $option =   [
            [
                $telegram->buildInlineKeyBoardButton("توضیحات", $url = '', $callback_data = "episodedetail"),
                $telegram->buildInlineKeyBoardButton("دیدن در سایت" , $url = "https://www.manototv.com/episode/" . $epsodelistid),
            ],
        ];

        $keyb = $telegram->buildInlineKeyBoard($option);
        $telegram->sendPhoto(['chat_id' => $chat_id, 'reply_markup' => $keyb, 'photo' => $epsodelistlandscapeImgIxUrl, 'reply_to_message_id' => $callbackmessage_id, 'parse_mode' => 'HTML', 'caption' => $epsodelistcaption]);

        $number = $number + 1;
    }
    while ($number < 5);
}

elseif ($text == 'showsp1') # show show page 1
{
    $url = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/list?sortBy=latest&genre=&pageNumber=1&pageSize=200";
    $request = file_get_contents($url);
    $arrayMessage = json_decode($request, true);

    $resultsCount = $arrayMessage['details']['resultsCount'];

    $id0 = $arrayMessage['details']['list']['0']['id'];
    $id1 = $arrayMessage['details']['list']['1']['id'];
    $id2 = $arrayMessage['details']['list']['2']['id'];
    $id3 = $arrayMessage['details']['list']['1']['id'];
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
    $formattedShowTitle3 = $arrayMessage['details']['list']['1']['formattedShowTitle'];
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


    $option =   [
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle0."\nID".$id0, $url = '', $callback_data = 'showsid0-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle1."\nID".$id1, $url = '', $callback_data = 'showsid0-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle2."\nID".$id2, $url = '', $callback_data = 'showsid0-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle3."\nID".$id3, $url = '', $callback_data = 'showsid0-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle4."\nID".$id4, $url = '', $callback_data = 'showsid1-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle5."\nID".$id5, $url = '', $callback_data = 'showsid1-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle6."\nID".$id6, $url = '', $callback_data = 'showsid1-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle7."\nID".$id7, $url = '', $callback_data = 'showsid1-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle8."\nID".$id8, $url = '', $callback_data = 'showsid2-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle9."\nID".$id9, $url = '', $callback_data = 'showsid2-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle10."\nID".$id10, $url = '', $callback_data = 'showsid2-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle11."\nID".$id11, $url = '', $callback_data = 'showsid2-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle12."\nID".$id12, $url = '', $callback_data = 'showsid3-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle13."\nID".$id13, $url = '', $callback_data = 'showsid3-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle14."\nID".$id14, $url = '', $callback_data = 'showsid3-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle15."\nID".$id15, $url = '', $callback_data = 'showsid3-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle16."\nID".$id16, $url = '', $callback_data = 'showsid4-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle17."\nID".$id17, $url = '', $callback_data = 'showsid4-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle18."\nID".$id18, $url = '', $callback_data = 'showsid4-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle19."\nID".$id19, $url = '', $callback_data = 'showsid4-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton("صفحه ۵", $url = '', $callback_data = 'showsp5'),
            $telegram->buildInlineKeyBoardButton("صفحه ۴", $url = '', $callback_data = 'showsp4'),
            $telegram->buildInlineKeyBoardButton("صفحه ۳", $url = '', $callback_data = 'showsp3'),
            $telegram->buildInlineKeyBoardButton("صفحه ۲", $url = '', $callback_data = 'showsp2'),
            $telegram->buildInlineKeyBoardButton("(صفحه ۱)", $url = '', $callback_data = 'showsp1'),
        ],
        [
            $telegram->buildInlineKeyBoardButton("صفحه ۱۰", $url = '', $callback_data = 'showsp10'),
            $telegram->buildInlineKeyBoardButton("صفحه ۹", $url = '', $callback_data = 'showsp9'),
            $telegram->buildInlineKeyBoardButton("صفحه ۸", $url = '', $callback_data = 'showsp8'),
            $telegram->buildInlineKeyBoardButton("صفحه ۷", $url = '', $callback_data = 'showsp7'),
            $telegram->buildInlineKeyBoardButton("صفحه ۶", $url = '', $callback_data = 'showsp6'),
        ],
    ];

    $keyb = $telegram->buildInlineKeyBoard($option);
    $telegram->editMessageText(array('chat_id' => $chat_id, 'message_id' => $callbackmessage_id, 'reply_markup' => $keyb, 'text' => "برنامه موردنظرتون رو انتخاب کنید - صفحه ۱"));

}
elseif ($text == 'showsp2') # show show page 2
{
    $url = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/list?sortBy=latest&genre=&pageNumber=1&pageSize=200";
    $request = file_get_contents($url);
    $arrayMessage = json_decode($request, true);

    $resultsCount = $arrayMessage['details']['resultsCount'];


    $id0 = $arrayMessage['details']['list']['20']['id'];
    $id1 = $arrayMessage['details']['list']['21']['id'];
    $id2 = $arrayMessage['details']['list']['22']['id'];
    $id3 = $arrayMessage['details']['list']['23']['id'];
    $id4 = $arrayMessage['details']['list']['24']['id'];
    $id5 = $arrayMessage['details']['list']['25']['id'];
    $id6 = $arrayMessage['details']['list']['26']['id'];
    $id7 = $arrayMessage['details']['list']['27']['id'];
    $id8 = $arrayMessage['details']['list']['28']['id'];
    $id9 = $arrayMessage['details']['list']['29']['id'];
    $id10 = $arrayMessage['details']['list']['30']['id'];
    $id11 = $arrayMessage['details']['list']['31']['id'];
    $id12 = $arrayMessage['details']['list']['32']['id'];
    $id13 = $arrayMessage['details']['list']['33']['id'];
    $id14 = $arrayMessage['details']['list']['34']['id'];
    $id15 = $arrayMessage['details']['list']['35']['id'];
    $id16 = $arrayMessage['details']['list']['36']['id'];
    $id17 = $arrayMessage['details']['list']['37']['id'];
    $id18 = $arrayMessage['details']['list']['38']['id'];
    $id19 = $arrayMessage['details']['list']['39']['id'];


    $formattedShowTitle0 = $arrayMessage['details']['list']['20']['formattedShowTitle'];
    $formattedShowTitle1 = $arrayMessage['details']['list']['21']['formattedShowTitle'];
    $formattedShowTitle2 = $arrayMessage['details']['list']['22']['formattedShowTitle'];
    $formattedShowTitle3 = $arrayMessage['details']['list']['23']['formattedShowTitle'];
    $formattedShowTitle4 = $arrayMessage['details']['list']['24']['formattedShowTitle'];
    $formattedShowTitle5 = $arrayMessage['details']['list']['25']['formattedShowTitle'];
    $formattedShowTitle6 = $arrayMessage['details']['list']['26']['formattedShowTitle'];
    $formattedShowTitle7 = $arrayMessage['details']['list']['27']['formattedShowTitle'];
    $formattedShowTitle8 = $arrayMessage['details']['list']['28']['formattedShowTitle'];
    $formattedShowTitle9 = $arrayMessage['details']['list']['29']['formattedShowTitle'];
    $formattedShowTitle10 = $arrayMessage['details']['list']['30']['formattedShowTitle'];
    $formattedShowTitle11 = $arrayMessage['details']['list']['31']['formattedShowTitle'];
    $formattedShowTitle12 = $arrayMessage['details']['list']['32']['formattedShowTitle'];
    $formattedShowTitle13 = $arrayMessage['details']['list']['33']['formattedShowTitle'];
    $formattedShowTitle14 = $arrayMessage['details']['list']['34']['formattedShowTitle'];
    $formattedShowTitle15 = $arrayMessage['details']['list']['35']['formattedShowTitle'];
    $formattedShowTitle16 = $arrayMessage['details']['list']['36']['formattedShowTitle'];
    $formattedShowTitle17 = $arrayMessage['details']['list']['37']['formattedShowTitle'];
    $formattedShowTitle18 = $arrayMessage['details']['list']['38']['formattedShowTitle'];
    $formattedShowTitle19 = $arrayMessage['details']['list']['39']['formattedShowTitle'];


    $option =   [
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle0."\nID".$id0, $url = '', $callback_data = 'showsid0-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle1."\nID".$id1, $url = '', $callback_data = 'showsid0-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle2."\nID".$id2, $url = '', $callback_data = 'showsid0-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle3."\nID".$id3, $url = '', $callback_data = 'showsid0-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle4."\nID".$id4, $url = '', $callback_data = 'showsid1-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle5."\nID".$id5, $url = '', $callback_data = 'showsid1-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle6."\nID".$id6, $url = '', $callback_data = 'showsid1-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle7."\nID".$id7, $url = '', $callback_data = 'showsid1-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle8."\nID".$id8, $url = '', $callback_data = 'showsid2-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle9."\nID".$id9, $url = '', $callback_data = 'showsid2-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle10."\nID".$id10, $url = '', $callback_data = 'showsid2-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle11."\nID".$id11, $url = '', $callback_data = 'showsid2-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle12."\nID".$id12, $url = '', $callback_data = 'showsid3-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle13."\nID".$id13, $url = '', $callback_data = 'showsid3-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle14."\nID".$id14, $url = '', $callback_data = 'showsid3-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle15."\nID".$id15, $url = '', $callback_data = 'showsid3-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle16."\nID".$id16, $url = '', $callback_data = 'showsid4-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle17."\nID".$id17, $url = '', $callback_data = 'showsid4-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle18."\nID".$id18, $url = '', $callback_data = 'showsid4-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle19."\nID".$id19, $url = '', $callback_data = 'showsid4-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton("صفحه ۵", $url = '', $callback_data = 'showsp5'),
            $telegram->buildInlineKeyBoardButton("صفحه ۴", $url = '', $callback_data = 'showsp4'),
            $telegram->buildInlineKeyBoardButton("صفحه ۳", $url = '', $callback_data = 'showsp3'),
            $telegram->buildInlineKeyBoardButton("(صفحه ۲)", $url = '', $callback_data = 'showsp2'),
            $telegram->buildInlineKeyBoardButton("صفحه ۱", $url = '', $callback_data = 'showsp1'),
        ],
        [
            $telegram->buildInlineKeyBoardButton("صفحه ۱۰", $url = '', $callback_data = 'showsp10'),
            $telegram->buildInlineKeyBoardButton("صفحه ۹", $url = '', $callback_data = 'showsp9'),
            $telegram->buildInlineKeyBoardButton("صفحه ۸", $url = '', $callback_data = 'showsp8'),
            $telegram->buildInlineKeyBoardButton("صفحه ۷", $url = '', $callback_data = 'showsp7'),
            $telegram->buildInlineKeyBoardButton("صفحه ۶", $url = '', $callback_data = 'showsp6'),
        ],
    ];

    $keyb = $telegram->buildInlineKeyBoard($option);
    $telegram->editMessageText(array('chat_id' => $chat_id, 'message_id' => $callbackmessage_id, 'reply_markup' => $keyb, 'text' => "برنامه موردنظرتون رو انتخاب کنید - صفحه ۲"));

}
elseif ($text == 'showsp3') # show show page 3
{
    $url = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/list?sortBy=latest&genre=&pageNumber=1&pageSize=200";
    $request = file_get_contents($url);
    $arrayMessage = json_decode($request, true);

    $resultsCount = $arrayMessage['details']['resultsCount'];


    $id0 = $arrayMessage['details']['list']['40']['id'];
    $id1 = $arrayMessage['details']['list']['41']['id'];
    $id2 = $arrayMessage['details']['list']['42']['id'];
    $id3 = $arrayMessage['details']['list']['43']['id'];
    $id4 = $arrayMessage['details']['list']['44']['id'];
    $id5 = $arrayMessage['details']['list']['45']['id'];
    $id6 = $arrayMessage['details']['list']['46']['id'];
    $id7 = $arrayMessage['details']['list']['47']['id'];
    $id8 = $arrayMessage['details']['list']['48']['id'];
    $id9 = $arrayMessage['details']['list']['49']['id'];
    $id10 = $arrayMessage['details']['list']['50']['id'];
    $id11 = $arrayMessage['details']['list']['51']['id'];
    $id12 = $arrayMessage['details']['list']['52']['id'];
    $id13 = $arrayMessage['details']['list']['53']['id'];
    $id14 = $arrayMessage['details']['list']['54']['id'];
    $id15 = $arrayMessage['details']['list']['55']['id'];
    $id16 = $arrayMessage['details']['list']['56']['id'];
    $id17 = $arrayMessage['details']['list']['57']['id'];
    $id18 = $arrayMessage['details']['list']['58']['id'];
    $id19 = $arrayMessage['details']['list']['59']['id'];


    $formattedShowTitle0 = $arrayMessage['details']['list']['40']['formattedShowTitle'];
    $formattedShowTitle1 = $arrayMessage['details']['list']['41']['formattedShowTitle'];
    $formattedShowTitle2 = $arrayMessage['details']['list']['42']['formattedShowTitle'];
    $formattedShowTitle3 = $arrayMessage['details']['list']['43']['formattedShowTitle'];
    $formattedShowTitle4 = $arrayMessage['details']['list']['44']['formattedShowTitle'];
    $formattedShowTitle5 = $arrayMessage['details']['list']['45']['formattedShowTitle'];
    $formattedShowTitle6 = $arrayMessage['details']['list']['46']['formattedShowTitle'];
    $formattedShowTitle7 = $arrayMessage['details']['list']['47']['formattedShowTitle'];
    $formattedShowTitle8 = $arrayMessage['details']['list']['48']['formattedShowTitle'];
    $formattedShowTitle9 = $arrayMessage['details']['list']['49']['formattedShowTitle'];
    $formattedShowTitle10 = $arrayMessage['details']['list']['50']['formattedShowTitle'];
    $formattedShowTitle11 = $arrayMessage['details']['list']['51']['formattedShowTitle'];
    $formattedShowTitle12 = $arrayMessage['details']['list']['52']['formattedShowTitle'];
    $formattedShowTitle13 = $arrayMessage['details']['list']['53']['formattedShowTitle'];
    $formattedShowTitle14 = $arrayMessage['details']['list']['54']['formattedShowTitle'];
    $formattedShowTitle15 = $arrayMessage['details']['list']['55']['formattedShowTitle'];
    $formattedShowTitle16 = $arrayMessage['details']['list']['56']['formattedShowTitle'];
    $formattedShowTitle17 = $arrayMessage['details']['list']['57']['formattedShowTitle'];
    $formattedShowTitle18 = $arrayMessage['details']['list']['58']['formattedShowTitle'];
    $formattedShowTitle19 = $arrayMessage['details']['list']['59']['formattedShowTitle'];


    $option =   [
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle0."\nID".$id0, $url = '', $callback_data = 'showsid0-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle1."\nID".$id1, $url = '', $callback_data = 'showsid0-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle2."\nID".$id2, $url = '', $callback_data = 'showsid0-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle3."\nID".$id3, $url = '', $callback_data = 'showsid0-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle4."\nID".$id4, $url = '', $callback_data = 'showsid1-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle5."\nID".$id5, $url = '', $callback_data = 'showsid1-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle6."\nID".$id6, $url = '', $callback_data = 'showsid1-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle7."\nID".$id7, $url = '', $callback_data = 'showsid1-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle8."\nID".$id8, $url = '', $callback_data = 'showsid2-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle9."\nID".$id9, $url = '', $callback_data = 'showsid2-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle10."\nID".$id10, $url = '', $callback_data = 'showsid2-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle11."\nID".$id11, $url = '', $callback_data = 'showsid2-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle12."\nID".$id12, $url = '', $callback_data = 'showsid3-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle13."\nID".$id13, $url = '', $callback_data = 'showsid3-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle14."\nID".$id14, $url = '', $callback_data = 'showsid3-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle15."\nID".$id15, $url = '', $callback_data = 'showsid3-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle16."\nID".$id16, $url = '', $callback_data = 'showsid4-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle17."\nID".$id17, $url = '', $callback_data = 'showsid4-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle18."\nID".$id18, $url = '', $callback_data = 'showsid4-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle19."\nID".$id19, $url = '', $callback_data = 'showsid4-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton("صفحه ۵", $url = '', $callback_data = 'showsp5'),
            $telegram->buildInlineKeyBoardButton("صفحه ۴", $url = '', $callback_data = 'showsp4'),
            $telegram->buildInlineKeyBoardButton("(صفحه ۳)", $url = '', $callback_data = 'showsp3'),
            $telegram->buildInlineKeyBoardButton("صفحه ۲", $url = '', $callback_data = 'showsp2'),
            $telegram->buildInlineKeyBoardButton("صفحه ۱", $url = '', $callback_data = 'showsp1'),
        ],
        [
            $telegram->buildInlineKeyBoardButton("صفحه ۱۰", $url = '', $callback_data = 'showsp10'),
            $telegram->buildInlineKeyBoardButton("صفحه ۹", $url = '', $callback_data = 'showsp9'),
            $telegram->buildInlineKeyBoardButton("صفحه ۸", $url = '', $callback_data = 'showsp8'),
            $telegram->buildInlineKeyBoardButton("صفحه ۷", $url = '', $callback_data = 'showsp7'),
            $telegram->buildInlineKeyBoardButton("صفحه ۶", $url = '', $callback_data = 'showsp6'),
        ],
    ];

    $keyb = $telegram->buildInlineKeyBoard($option);
    $telegram->editMessageText(array('chat_id' => $chat_id, 'message_id' => $callbackmessage_id, 'reply_markup' => $keyb, 'text' => "برنامه موردنظرتون رو انتخاب کنید - صفحه ۳"));

}
elseif ($text == 'showsp4') # show show page 4
{
    $url = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/list?sortBy=latest&genre=&pageNumber=1&pageSize=200";
    $request = file_get_contents($url);
    $arrayMessage = json_decode($request, true);

    $resultsCount = $arrayMessage['details']['resultsCount'];


    $id0 = $arrayMessage['details']['list']['60']['id'];
    $id1 = $arrayMessage['details']['list']['61']['id'];
    $id2 = $arrayMessage['details']['list']['62']['id'];
    $id3 = $arrayMessage['details']['list']['63']['id'];
    $id4 = $arrayMessage['details']['list']['64']['id'];
    $id5 = $arrayMessage['details']['list']['65']['id'];
    $id6 = $arrayMessage['details']['list']['66']['id'];
    $id7 = $arrayMessage['details']['list']['67']['id'];
    $id8 = $arrayMessage['details']['list']['68']['id'];
    $id9 = $arrayMessage['details']['list']['69']['id'];
    $id10 = $arrayMessage['details']['list']['70']['id'];
    $id11 = $arrayMessage['details']['list']['71']['id'];
    $id12 = $arrayMessage['details']['list']['72']['id'];
    $id13 = $arrayMessage['details']['list']['73']['id'];
    $id14 = $arrayMessage['details']['list']['74']['id'];
    $id15 = $arrayMessage['details']['list']['75']['id'];
    $id16 = $arrayMessage['details']['list']['76']['id'];
    $id17 = $arrayMessage['details']['list']['77']['id'];
    $id18 = $arrayMessage['details']['list']['78']['id'];
    $id19 = $arrayMessage['details']['list']['79']['id'];


    $formattedShowTitle0 = $arrayMessage['details']['list']['60']['formattedShowTitle'];
    $formattedShowTitle1 = $arrayMessage['details']['list']['61']['formattedShowTitle'];
    $formattedShowTitle2 = $arrayMessage['details']['list']['62']['formattedShowTitle'];
    $formattedShowTitle3 = $arrayMessage['details']['list']['63']['formattedShowTitle'];
    $formattedShowTitle4 = $arrayMessage['details']['list']['64']['formattedShowTitle'];
    $formattedShowTitle5 = $arrayMessage['details']['list']['65']['formattedShowTitle'];
    $formattedShowTitle6 = $arrayMessage['details']['list']['66']['formattedShowTitle'];
    $formattedShowTitle7 = $arrayMessage['details']['list']['67']['formattedShowTitle'];
    $formattedShowTitle8 = $arrayMessage['details']['list']['68']['formattedShowTitle'];
    $formattedShowTitle9 = $arrayMessage['details']['list']['69']['formattedShowTitle'];
    $formattedShowTitle10 = $arrayMessage['details']['list']['70']['formattedShowTitle'];
    $formattedShowTitle11 = $arrayMessage['details']['list']['71']['formattedShowTitle'];
    $formattedShowTitle12 = $arrayMessage['details']['list']['72']['formattedShowTitle'];
    $formattedShowTitle13 = $arrayMessage['details']['list']['73']['formattedShowTitle'];
    $formattedShowTitle14 = $arrayMessage['details']['list']['74']['formattedShowTitle'];
    $formattedShowTitle15 = $arrayMessage['details']['list']['75']['formattedShowTitle'];
    $formattedShowTitle16 = $arrayMessage['details']['list']['76']['formattedShowTitle'];
    $formattedShowTitle17 = $arrayMessage['details']['list']['77']['formattedShowTitle'];
    $formattedShowTitle18 = $arrayMessage['details']['list']['78']['formattedShowTitle'];
    $formattedShowTitle19 = $arrayMessage['details']['list']['79']['formattedShowTitle'];

    $option =   [
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle0."\nID".$id0, $url = '', $callback_data = 'showsid0-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle1."\nID".$id1, $url = '', $callback_data = 'showsid0-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle2."\nID".$id2, $url = '', $callback_data = 'showsid0-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle3."\nID".$id3, $url = '', $callback_data = 'showsid0-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle4."\nID".$id4, $url = '', $callback_data = 'showsid1-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle5."\nID".$id5, $url = '', $callback_data = 'showsid1-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle6."\nID".$id6, $url = '', $callback_data = 'showsid1-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle7."\nID".$id7, $url = '', $callback_data = 'showsid1-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle8."\nID".$id8, $url = '', $callback_data = 'showsid2-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle9."\nID".$id9, $url = '', $callback_data = 'showsid2-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle10."\nID".$id10, $url = '', $callback_data = 'showsid2-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle11."\nID".$id11, $url = '', $callback_data = 'showsid2-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle12."\nID".$id12, $url = '', $callback_data = 'showsid3-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle13."\nID".$id13, $url = '', $callback_data = 'showsid3-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle14."\nID".$id14, $url = '', $callback_data = 'showsid3-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle15."\nID".$id15, $url = '', $callback_data = 'showsid3-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle16."\nID".$id16, $url = '', $callback_data = 'showsid4-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle17."\nID".$id17, $url = '', $callback_data = 'showsid4-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle18."\nID".$id18, $url = '', $callback_data = 'showsid4-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle19."\nID".$id19, $url = '', $callback_data = 'showsid4-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton("صفحه ۵", $url = '', $callback_data = 'showsp5'),
            $telegram->buildInlineKeyBoardButton("(صفحه ۴)", $url = '', $callback_data = 'showsp4'),
            $telegram->buildInlineKeyBoardButton("صفحه ۳", $url = '', $callback_data = 'showsp3'),
            $telegram->buildInlineKeyBoardButton("صفحه ۲", $url = '', $callback_data = 'showsp2'),
            $telegram->buildInlineKeyBoardButton("صفحه ۱", $url = '', $callback_data = 'showsp1'),
        ],
        [
            $telegram->buildInlineKeyBoardButton("صفحه ۱۰", $url = '', $callback_data = 'showsp10'),
            $telegram->buildInlineKeyBoardButton("صفحه ۹", $url = '', $callback_data = 'showsp9'),
            $telegram->buildInlineKeyBoardButton("صفحه ۸", $url = '', $callback_data = 'showsp8'),
            $telegram->buildInlineKeyBoardButton("صفحه ۷", $url = '', $callback_data = 'showsp7'),
            $telegram->buildInlineKeyBoardButton("صفحه ۶", $url = '', $callback_data = 'showsp6'),
        ],
    ];

    $keyb = $telegram->buildInlineKeyBoard($option);
    $telegram->editMessageText(array('chat_id' => $chat_id, 'message_id' => $callbackmessage_id, 'reply_markup' => $keyb, 'text' => "برنامه موردنظرتون رو انتخاب کنید - صفحه ۴"));

}
elseif ($text == 'showsp5') # show show page 5
{
    $url = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/list?sortBy=latest&genre=&pageNumber=1&pageSize=200";
    $request = file_get_contents($url);
    $arrayMessage = json_decode($request, true);

    $resultsCount = $arrayMessage['details']['resultsCount'];


    $id0 = $arrayMessage['details']['list']['80']['id'];
    $id1 = $arrayMessage['details']['list']['81']['id'];
    $id2 = $arrayMessage['details']['list']['82']['id'];
    $id3 = $arrayMessage['details']['list']['83']['id'];
    $id4 = $arrayMessage['details']['list']['84']['id'];
    $id5 = $arrayMessage['details']['list']['85']['id'];
    $id6 = $arrayMessage['details']['list']['86']['id'];
    $id7 = $arrayMessage['details']['list']['87']['id'];
    $id8 = $arrayMessage['details']['list']['88']['id'];
    $id9 = $arrayMessage['details']['list']['89']['id'];
    $id10 = $arrayMessage['details']['list']['90']['id'];
    $id11 = $arrayMessage['details']['list']['91']['id'];
    $id12 = $arrayMessage['details']['list']['92']['id'];
    $id13 = $arrayMessage['details']['list']['93']['id'];
    $id14 = $arrayMessage['details']['list']['94']['id'];
    $id15 = $arrayMessage['details']['list']['95']['id'];
    $id16 = $arrayMessage['details']['list']['96']['id'];
    $id17 = $arrayMessage['details']['list']['97']['id'];
    $id18 = $arrayMessage['details']['list']['98']['id'];
    $id19 = $arrayMessage['details']['list']['99']['id'];


    $formattedShowTitle0 = $arrayMessage['details']['list']['80']['formattedShowTitle'];
    $formattedShowTitle1 = $arrayMessage['details']['list']['81']['formattedShowTitle'];
    $formattedShowTitle2 = $arrayMessage['details']['list']['82']['formattedShowTitle'];
    $formattedShowTitle3 = $arrayMessage['details']['list']['83']['formattedShowTitle'];
    $formattedShowTitle4 = $arrayMessage['details']['list']['84']['formattedShowTitle'];
    $formattedShowTitle5 = $arrayMessage['details']['list']['85']['formattedShowTitle'];
    $formattedShowTitle6 = $arrayMessage['details']['list']['86']['formattedShowTitle'];
    $formattedShowTitle7 = $arrayMessage['details']['list']['87']['formattedShowTitle'];
    $formattedShowTitle8 = $arrayMessage['details']['list']['88']['formattedShowTitle'];
    $formattedShowTitle9 = $arrayMessage['details']['list']['89']['formattedShowTitle'];
    $formattedShowTitle10 = $arrayMessage['details']['list']['90']['formattedShowTitle'];
    $formattedShowTitle11 = $arrayMessage['details']['list']['91']['formattedShowTitle'];
    $formattedShowTitle12 = $arrayMessage['details']['list']['92']['formattedShowTitle'];
    $formattedShowTitle13 = $arrayMessage['details']['list']['93']['formattedShowTitle'];
    $formattedShowTitle14 = $arrayMessage['details']['list']['94']['formattedShowTitle'];
    $formattedShowTitle15 = $arrayMessage['details']['list']['95']['formattedShowTitle'];
    $formattedShowTitle16 = $arrayMessage['details']['list']['96']['formattedShowTitle'];
    $formattedShowTitle17 = $arrayMessage['details']['list']['97']['formattedShowTitle'];
    $formattedShowTitle18 = $arrayMessage['details']['list']['98']['formattedShowTitle'];
    $formattedShowTitle19 = $arrayMessage['details']['list']['99']['formattedShowTitle'];

    $option =   [
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle0."\nID".$id0, $url = '', $callback_data = 'showsid0-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle1."\nID".$id1, $url = '', $callback_data = 'showsid0-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle2."\nID".$id2, $url = '', $callback_data = 'showsid0-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle3."\nID".$id3, $url = '', $callback_data = 'showsid0-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle4."\nID".$id4, $url = '', $callback_data = 'showsid1-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle5."\nID".$id5, $url = '', $callback_data = 'showsid1-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle6."\nID".$id6, $url = '', $callback_data = 'showsid1-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle7."\nID".$id7, $url = '', $callback_data = 'showsid1-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle8."\nID".$id8, $url = '', $callback_data = 'showsid2-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle9."\nID".$id9, $url = '', $callback_data = 'showsid2-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle10."\nID".$id10, $url = '', $callback_data = 'showsid2-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle11."\nID".$id11, $url = '', $callback_data = 'showsid2-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle12."\nID".$id12, $url = '', $callback_data = 'showsid3-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle13."\nID".$id13, $url = '', $callback_data = 'showsid3-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle14."\nID".$id14, $url = '', $callback_data = 'showsid3-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle15."\nID".$id15, $url = '', $callback_data = 'showsid3-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle16."\nID".$id16, $url = '', $callback_data = 'showsid4-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle17."\nID".$id17, $url = '', $callback_data = 'showsid4-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle18."\nID".$id18, $url = '', $callback_data = 'showsid4-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle19."\nID".$id19, $url = '', $callback_data = 'showsid4-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton("(صفحه ۵)", $url = '', $callback_data = 'showsp5'),
            $telegram->buildInlineKeyBoardButton("صفحه ۴", $url = '', $callback_data = 'showsp4'),
            $telegram->buildInlineKeyBoardButton("صفحه ۳", $url = '', $callback_data = 'showsp3'),
            $telegram->buildInlineKeyBoardButton("صفحه ۲", $url = '', $callback_data = 'showsp2'),
            $telegram->buildInlineKeyBoardButton("صفحه ۱", $url = '', $callback_data = 'showsp1'),
        ],
        [
            $telegram->buildInlineKeyBoardButton("صفحه ۱۰", $url = '', $callback_data = 'showsp10'),
            $telegram->buildInlineKeyBoardButton("صفحه ۹", $url = '', $callback_data = 'showsp9'),
            $telegram->buildInlineKeyBoardButton("صفحه ۸", $url = '', $callback_data = 'showsp8'),
            $telegram->buildInlineKeyBoardButton("صفحه ۷", $url = '', $callback_data = 'showsp7'),
            $telegram->buildInlineKeyBoardButton("صفحه ۶", $url = '', $callback_data = 'showsp6'),
        ],
    ];

    $keyb = $telegram->buildInlineKeyBoard($option);
    $telegram->editMessageText(array('chat_id' => $chat_id, 'message_id' => $callbackmessage_id, 'reply_markup' => $keyb, 'text' => "برنامه موردنظرتون رو انتخاب کنید - صفحه ۵"));

}
elseif ($text == 'showsp6') # show show page 6
{
    $url = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/list?sortBy=latest&genre=&pageNumber=1&pageSize=200";
    $request = file_get_contents($url);
    $arrayMessage = json_decode($request, true);

    $resultsCount = $arrayMessage['details']['resultsCount'];


    $id0 = $arrayMessage['details']['list']['100']['id'];
    $id1 = $arrayMessage['details']['list']['101']['id'];
    $id2 = $arrayMessage['details']['list']['102']['id'];
    $id3 = $arrayMessage['details']['list']['103']['id'];
    $id4 = $arrayMessage['details']['list']['104']['id'];
    $id5 = $arrayMessage['details']['list']['105']['id'];
    $id6 = $arrayMessage['details']['list']['106']['id'];
    $id7 = $arrayMessage['details']['list']['107']['id'];
    $id8 = $arrayMessage['details']['list']['108']['id'];
    $id9 = $arrayMessage['details']['list']['109']['id'];
    $id10 = $arrayMessage['details']['list']['110']['id'];
    $id11 = $arrayMessage['details']['list']['111']['id'];
    $id12 = $arrayMessage['details']['list']['112']['id'];
    $id13 = $arrayMessage['details']['list']['113']['id'];
    $id14 = $arrayMessage['details']['list']['114']['id'];
    $id15 = $arrayMessage['details']['list']['115']['id'];
    $id16 = $arrayMessage['details']['list']['116']['id'];
    $id17 = $arrayMessage['details']['list']['117']['id'];
    $id18 = $arrayMessage['details']['list']['118']['id'];
    $id19 = $arrayMessage['details']['list']['119']['id'];


    $formattedShowTitle0 = $arrayMessage['details']['list']['100']['formattedShowTitle'];
    $formattedShowTitle1 = $arrayMessage['details']['list']['101']['formattedShowTitle'];
    $formattedShowTitle2 = $arrayMessage['details']['list']['102']['formattedShowTitle'];
    $formattedShowTitle3 = $arrayMessage['details']['list']['103']['formattedShowTitle'];
    $formattedShowTitle4 = $arrayMessage['details']['list']['104']['formattedShowTitle'];
    $formattedShowTitle5 = $arrayMessage['details']['list']['105']['formattedShowTitle'];
    $formattedShowTitle6 = $arrayMessage['details']['list']['106']['formattedShowTitle'];
    $formattedShowTitle7 = $arrayMessage['details']['list']['107']['formattedShowTitle'];
    $formattedShowTitle8 = $arrayMessage['details']['list']['108']['formattedShowTitle'];
    $formattedShowTitle9 = $arrayMessage['details']['list']['109']['formattedShowTitle'];
    $formattedShowTitle10 = $arrayMessage['details']['list']['110']['formattedShowTitle'];
    $formattedShowTitle11 = $arrayMessage['details']['list']['111']['formattedShowTitle'];
    $formattedShowTitle12 = $arrayMessage['details']['list']['112']['formattedShowTitle'];
    $formattedShowTitle13 = $arrayMessage['details']['list']['113']['formattedShowTitle'];
    $formattedShowTitle14 = $arrayMessage['details']['list']['114']['formattedShowTitle'];
    $formattedShowTitle15 = $arrayMessage['details']['list']['115']['formattedShowTitle'];
    $formattedShowTitle16 = $arrayMessage['details']['list']['116']['formattedShowTitle'];
    $formattedShowTitle17 = $arrayMessage['details']['list']['117']['formattedShowTitle'];
    $formattedShowTitle18 = $arrayMessage['details']['list']['118']['formattedShowTitle'];
    $formattedShowTitle19 = $arrayMessage['details']['list']['119']['formattedShowTitle'];

    $option =   [
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle0."\nID".$id0, $url = '', $callback_data = 'showsid0-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle1."\nID".$id1, $url = '', $callback_data = 'showsid0-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle2."\nID".$id2, $url = '', $callback_data = 'showsid0-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle3."\nID".$id3, $url = '', $callback_data = 'showsid0-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle4."\nID".$id4, $url = '', $callback_data = 'showsid1-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle5."\nID".$id5, $url = '', $callback_data = 'showsid1-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle6."\nID".$id6, $url = '', $callback_data = 'showsid1-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle7."\nID".$id7, $url = '', $callback_data = 'showsid1-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle8."\nID".$id8, $url = '', $callback_data = 'showsid2-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle9."\nID".$id9, $url = '', $callback_data = 'showsid2-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle10."\nID".$id10, $url = '', $callback_data = 'showsid2-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle11."\nID".$id11, $url = '', $callback_data = 'showsid2-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle12."\nID".$id12, $url = '', $callback_data = 'showsid3-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle13."\nID".$id13, $url = '', $callback_data = 'showsid3-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle14."\nID".$id14, $url = '', $callback_data = 'showsid3-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle15."\nID".$id15, $url = '', $callback_data = 'showsid3-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle16."\nID".$id16, $url = '', $callback_data = 'showsid4-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle17."\nID".$id17, $url = '', $callback_data = 'showsid4-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle18."\nID".$id18, $url = '', $callback_data = 'showsid4-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle19."\nID".$id19, $url = '', $callback_data = 'showsid4-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton("صفحه ۵", $url = '', $callback_data = 'showsp5'),
            $telegram->buildInlineKeyBoardButton("صفحه ۴", $url = '', $callback_data = 'showsp4'),
            $telegram->buildInlineKeyBoardButton("صفحه ۳", $url = '', $callback_data = 'showsp3'),
            $telegram->buildInlineKeyBoardButton("صفحه ۲", $url = '', $callback_data = 'showsp2'),
            $telegram->buildInlineKeyBoardButton("صفحه ۱", $url = '', $callback_data = 'showsp1'),
        ],
        [
            $telegram->buildInlineKeyBoardButton("صفحه ۱۰", $url = '', $callback_data = 'showsp10'),
            $telegram->buildInlineKeyBoardButton("صفحه ۹", $url = '', $callback_data = 'showsp9'),
            $telegram->buildInlineKeyBoardButton("صفحه ۸", $url = '', $callback_data = 'showsp8'),
            $telegram->buildInlineKeyBoardButton("صفحه ۷", $url = '', $callback_data = 'showsp7'),
            $telegram->buildInlineKeyBoardButton("(صفحه ۶)", $url = '', $callback_data = 'showsp6'),
        ],
    ];

    $keyb = $telegram->buildInlineKeyBoard($option);
    $telegram->editMessageText(array('chat_id' => $chat_id, 'message_id' => $callbackmessage_id, 'reply_markup' => $keyb, 'text' => "برنامه موردنظرتون رو انتخاب کنید - صفحه ۶"));

}
elseif ($text == 'showsp7') # show show page 7
{
    $url = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/list?sortBy=latest&genre=&pageNumber=1&pageSize=200";
    $request = file_get_contents($url);
    $arrayMessage = json_decode($request, true);

    $resultsCount = $arrayMessage['details']['resultsCount'];


    $id0 = $arrayMessage['details']['list']['120']['id'];
    $id1 = $arrayMessage['details']['list']['121']['id'];
    $id2 = $arrayMessage['details']['list']['122']['id'];
    $id3 = $arrayMessage['details']['list']['123']['id'];
    $id4 = $arrayMessage['details']['list']['124']['id'];
    $id5 = $arrayMessage['details']['list']['125']['id'];
    $id6 = $arrayMessage['details']['list']['126']['id'];
    $id7 = $arrayMessage['details']['list']['127']['id'];
    $id8 = $arrayMessage['details']['list']['128']['id'];
    $id9 = $arrayMessage['details']['list']['129']['id'];
    $id10 = $arrayMessage['details']['list']['130']['id'];
    $id11 = $arrayMessage['details']['list']['131']['id'];
    $id12 = $arrayMessage['details']['list']['132']['id'];
    $id13 = $arrayMessage['details']['list']['133']['id'];
    $id14 = $arrayMessage['details']['list']['134']['id'];
    $id15 = $arrayMessage['details']['list']['135']['id'];
    $id16 = $arrayMessage['details']['list']['136']['id'];
    $id17 = $arrayMessage['details']['list']['137']['id'];
    $id18 = $arrayMessage['details']['list']['138']['id'];
    $id19 = $arrayMessage['details']['list']['139']['id'];


    $formattedShowTitle0 = $arrayMessage['details']['list']['120']['formattedShowTitle'];
    $formattedShowTitle1 = $arrayMessage['details']['list']['121']['formattedShowTitle'];
    $formattedShowTitle2 = $arrayMessage['details']['list']['122']['formattedShowTitle'];
    $formattedShowTitle3 = $arrayMessage['details']['list']['123']['formattedShowTitle'];
    $formattedShowTitle4 = $arrayMessage['details']['list']['124']['formattedShowTitle'];
    $formattedShowTitle5 = $arrayMessage['details']['list']['125']['formattedShowTitle'];
    $formattedShowTitle6 = $arrayMessage['details']['list']['126']['formattedShowTitle'];
    $formattedShowTitle7 = $arrayMessage['details']['list']['127']['formattedShowTitle'];
    $formattedShowTitle8 = $arrayMessage['details']['list']['128']['formattedShowTitle'];
    $formattedShowTitle9 = $arrayMessage['details']['list']['129']['formattedShowTitle'];
    $formattedShowTitle10 = $arrayMessage['details']['list']['130']['formattedShowTitle'];
    $formattedShowTitle11 = $arrayMessage['details']['list']['131']['formattedShowTitle'];
    $formattedShowTitle12 = $arrayMessage['details']['list']['132']['formattedShowTitle'];
    $formattedShowTitle13 = $arrayMessage['details']['list']['133']['formattedShowTitle'];
    $formattedShowTitle14 = $arrayMessage['details']['list']['134']['formattedShowTitle'];
    $formattedShowTitle15 = $arrayMessage['details']['list']['135']['formattedShowTitle'];
    $formattedShowTitle16 = $arrayMessage['details']['list']['136']['formattedShowTitle'];
    $formattedShowTitle17 = $arrayMessage['details']['list']['137']['formattedShowTitle'];
    $formattedShowTitle18 = $arrayMessage['details']['list']['138']['formattedShowTitle'];
    $formattedShowTitle19 = $arrayMessage['details']['list']['139']['formattedShowTitle'];

    $option =   [
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle0."\nID".$id0, $url = '', $callback_data = 'showsid0-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle1."\nID".$id1, $url = '', $callback_data = 'showsid0-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle2."\nID".$id2, $url = '', $callback_data = 'showsid0-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle3."\nID".$id3, $url = '', $callback_data = 'showsid0-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle4."\nID".$id4, $url = '', $callback_data = 'showsid1-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle5."\nID".$id5, $url = '', $callback_data = 'showsid1-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle6."\nID".$id6, $url = '', $callback_data = 'showsid1-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle7."\nID".$id7, $url = '', $callback_data = 'showsid1-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle8."\nID".$id8, $url = '', $callback_data = 'showsid2-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle9."\nID".$id9, $url = '', $callback_data = 'showsid2-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle10."\nID".$id10, $url = '', $callback_data = 'showsid2-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle11."\nID".$id11, $url = '', $callback_data = 'showsid2-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle12."\nID".$id12, $url = '', $callback_data = 'showsid3-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle13."\nID".$id13, $url = '', $callback_data = 'showsid3-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle14."\nID".$id14, $url = '', $callback_data = 'showsid3-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle15."\nID".$id15, $url = '', $callback_data = 'showsid3-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle16."\nID".$id16, $url = '', $callback_data = 'showsid4-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle17."\nID".$id17, $url = '', $callback_data = 'showsid4-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle18."\nID".$id18, $url = '', $callback_data = 'showsid4-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle19."\nID".$id19, $url = '', $callback_data = 'showsid4-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton("صفحه ۵", $url = '', $callback_data = 'showsp5'),
            $telegram->buildInlineKeyBoardButton("صفحه ۴", $url = '', $callback_data = 'showsp4'),
            $telegram->buildInlineKeyBoardButton("صفحه ۳", $url = '', $callback_data = 'showsp3'),
            $telegram->buildInlineKeyBoardButton("صفحه ۲", $url = '', $callback_data = 'showsp2'),
            $telegram->buildInlineKeyBoardButton("صفحه ۱", $url = '', $callback_data = 'showsp1'),
        ],
        [
            $telegram->buildInlineKeyBoardButton("صفحه ۱۰", $url = '', $callback_data = 'showsp10'),
            $telegram->buildInlineKeyBoardButton("صفحه ۹", $url = '', $callback_data = 'showsp9'),
            $telegram->buildInlineKeyBoardButton("(صفحه ۸)", $url = '', $callback_data = 'showsp8'),
            $telegram->buildInlineKeyBoardButton("صفحه ۷", $url = '', $callback_data = 'showsp7'),
            $telegram->buildInlineKeyBoardButton("صفحه ۶", $url = '', $callback_data = 'showsp6'),
        ],
    ];

    $keyb = $telegram->buildInlineKeyBoard($option);
    $telegram->editMessageText(array('chat_id' => $chat_id, 'message_id' => $callbackmessage_id, 'reply_markup' => $keyb, 'text' => "برنامه موردنظرتون رو انتخاب کنید - صفحه ۸"));

}
elseif ($text == 'showsp8') # show show page 8
{
    $url = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/list?sortBy=latest&genre=&pageNumber=1&pageSize=200";
    $request = file_get_contents($url);
    $arrayMessage = json_decode($request, true);

    $resultsCount = $arrayMessage['details']['resultsCount'];


    $id0 = $arrayMessage['details']['list']['140']['id'];
    $id1 = $arrayMessage['details']['list']['141']['id'];
    $id2 = $arrayMessage['details']['list']['142']['id'];
    $id3 = $arrayMessage['details']['list']['143']['id'];
    $id4 = $arrayMessage['details']['list']['144']['id'];
    $id5 = $arrayMessage['details']['list']['145']['id'];
    $id6 = $arrayMessage['details']['list']['146']['id'];
    $id7 = $arrayMessage['details']['list']['147']['id'];
    $id8 = $arrayMessage['details']['list']['148']['id'];
    $id9 = $arrayMessage['details']['list']['149']['id'];
    $id10 = $arrayMessage['details']['list']['150']['id'];
    $id11 = $arrayMessage['details']['list']['151']['id'];
    $id12 = $arrayMessage['details']['list']['152']['id'];
    $id13 = $arrayMessage['details']['list']['153']['id'];
    $id14 = $arrayMessage['details']['list']['154']['id'];
    $id15 = $arrayMessage['details']['list']['155']['id'];
    $id16 = $arrayMessage['details']['list']['156']['id'];
    $id17 = $arrayMessage['details']['list']['157']['id'];
    $id18 = $arrayMessage['details']['list']['158']['id'];
    $id19 = $arrayMessage['details']['list']['159']['id'];


    $formattedShowTitle0 = $arrayMessage['details']['list']['140']['formattedShowTitle'];
    $formattedShowTitle1 = $arrayMessage['details']['list']['141']['formattedShowTitle'];
    $formattedShowTitle2 = $arrayMessage['details']['list']['142']['formattedShowTitle'];
    $formattedShowTitle3 = $arrayMessage['details']['list']['143']['formattedShowTitle'];
    $formattedShowTitle4 = $arrayMessage['details']['list']['144']['formattedShowTitle'];
    $formattedShowTitle5 = $arrayMessage['details']['list']['145']['formattedShowTitle'];
    $formattedShowTitle6 = $arrayMessage['details']['list']['146']['formattedShowTitle'];
    $formattedShowTitle7 = $arrayMessage['details']['list']['147']['formattedShowTitle'];
    $formattedShowTitle8 = $arrayMessage['details']['list']['148']['formattedShowTitle'];
    $formattedShowTitle9 = $arrayMessage['details']['list']['149']['formattedShowTitle'];
    $formattedShowTitle10 = $arrayMessage['details']['list']['150']['formattedShowTitle'];
    $formattedShowTitle11 = $arrayMessage['details']['list']['151']['formattedShowTitle'];
    $formattedShowTitle12 = $arrayMessage['details']['list']['152']['formattedShowTitle'];
    $formattedShowTitle13 = $arrayMessage['details']['list']['153']['formattedShowTitle'];
    $formattedShowTitle14 = $arrayMessage['details']['list']['154']['formattedShowTitle'];
    $formattedShowTitle15 = $arrayMessage['details']['list']['155']['formattedShowTitle'];
    $formattedShowTitle16 = $arrayMessage['details']['list']['156']['formattedShowTitle'];
    $formattedShowTitle17 = $arrayMessage['details']['list']['157']['formattedShowTitle'];
    $formattedShowTitle18 = $arrayMessage['details']['list']['158']['formattedShowTitle'];
    $formattedShowTitle19 = $arrayMessage['details']['list']['159']['formattedShowTitle'];

    $option =   [
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle0."\nID".$id0, $url = '', $callback_data = 'showsid0-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle1."\nID".$id1, $url = '', $callback_data = 'showsid0-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle2."\nID".$id2, $url = '', $callback_data = 'showsid0-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle3."\nID".$id3, $url = '', $callback_data = 'showsid0-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle4."\nID".$id4, $url = '', $callback_data = 'showsid1-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle5."\nID".$id5, $url = '', $callback_data = 'showsid1-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle6."\nID".$id6, $url = '', $callback_data = 'showsid1-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle7."\nID".$id7, $url = '', $callback_data = 'showsid1-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle8."\nID".$id8, $url = '', $callback_data = 'showsid2-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle9."\nID".$id9, $url = '', $callback_data = 'showsid2-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle10."\nID".$id10, $url = '', $callback_data = 'showsid2-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle11."\nID".$id11, $url = '', $callback_data = 'showsid2-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle12."\nID".$id12, $url = '', $callback_data = 'showsid3-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle13."\nID".$id13, $url = '', $callback_data = 'showsid3-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle14."\nID".$id14, $url = '', $callback_data = 'showsid3-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle15."\nID".$id15, $url = '', $callback_data = 'showsid3-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle16."\nID".$id16, $url = '', $callback_data = 'showsid4-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle17."\nID".$id17, $url = '', $callback_data = 'showsid4-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle18."\nID".$id18, $url = '', $callback_data = 'showsid4-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle19."\nID".$id19, $url = '', $callback_data = 'showsid4-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton("صفحه ۵", $url = '', $callback_data = 'showsp5'),
            $telegram->buildInlineKeyBoardButton("صفحه ۴", $url = '', $callback_data = 'showsp4'),
            $telegram->buildInlineKeyBoardButton("صفحه ۳", $url = '', $callback_data = 'showsp3'),
            $telegram->buildInlineKeyBoardButton("صفحه ۲", $url = '', $callback_data = 'showsp2'),
            $telegram->buildInlineKeyBoardButton("صفحه ۱", $url = '', $callback_data = 'showsp1'),
        ],
        [
            $telegram->buildInlineKeyBoardButton("صفحه ۱۰", $url = '', $callback_data = 'showsp10'),
            $telegram->buildInlineKeyBoardButton("صفحه ۹", $url = '', $callback_data = 'showsp9'),
            $telegram->buildInlineKeyBoardButton("(صفحه ۸)", $url = '', $callback_data = 'showsp8'),
            $telegram->buildInlineKeyBoardButton("صفحه ۷", $url = '', $callback_data = 'showsp7'),
            $telegram->buildInlineKeyBoardButton("صفحه ۶", $url = '', $callback_data = 'showsp6'),
        ],
    ];

    $keyb = $telegram->buildInlineKeyBoard($option);
    $telegram->editMessageText(array('chat_id' => $chat_id, 'message_id' => $callbackmessage_id, 'reply_markup' => $keyb, 'text' => "برنامه موردنظرتون رو انتخاب کنید - صفحه ۸"));

}
elseif ($text == 'showsp9') # show show page 9
{
    $url = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/list?sortBy=latest&genre=&pageNumber=1&pageSize=200";
    $request = file_get_contents($url);
    $arrayMessage = json_decode($request, true);

    $resultsCount = $arrayMessage['details']['resultsCount'];


    $id0 = $arrayMessage['details']['list']['160']['id'];
    $id1 = $arrayMessage['details']['list']['161']['id'];
    $id2 = $arrayMessage['details']['list']['162']['id'];
    $id3 = $arrayMessage['details']['list']['163']['id'];
    $id4 = $arrayMessage['details']['list']['164']['id'];
    $id5 = $arrayMessage['details']['list']['165']['id'];
    $id6 = $arrayMessage['details']['list']['166']['id'];
    $id7 = $arrayMessage['details']['list']['167']['id'];
    $id8 = $arrayMessage['details']['list']['168']['id'];
    $id9 = $arrayMessage['details']['list']['169']['id'];
    $id10 = $arrayMessage['details']['list']['170']['id'];
    $id11 = $arrayMessage['details']['list']['171']['id'];
    $id12 = $arrayMessage['details']['list']['172']['id'];
    $id13 = $arrayMessage['details']['list']['173']['id'];
    $id14 = $arrayMessage['details']['list']['174']['id'];
    $id15 = $arrayMessage['details']['list']['175']['id'];
    $id16 = $arrayMessage['details']['list']['176']['id'];
    $id17 = $arrayMessage['details']['list']['177']['id'];
    $id18 = $arrayMessage['details']['list']['178']['id'];
    $id19 = $arrayMessage['details']['list']['179']['id'];


    $formattedShowTitle0 = $arrayMessage['details']['list']['160']['formattedShowTitle'];
    $formattedShowTitle1 = $arrayMessage['details']['list']['161']['formattedShowTitle'];
    $formattedShowTitle2 = $arrayMessage['details']['list']['162']['formattedShowTitle'];
    $formattedShowTitle3 = $arrayMessage['details']['list']['163']['formattedShowTitle'];
    $formattedShowTitle4 = $arrayMessage['details']['list']['164']['formattedShowTitle'];
    $formattedShowTitle5 = $arrayMessage['details']['list']['165']['formattedShowTitle'];
    $formattedShowTitle6 = $arrayMessage['details']['list']['166']['formattedShowTitle'];
    $formattedShowTitle7 = $arrayMessage['details']['list']['167']['formattedShowTitle'];
    $formattedShowTitle8 = $arrayMessage['details']['list']['168']['formattedShowTitle'];
    $formattedShowTitle9 = $arrayMessage['details']['list']['169']['formattedShowTitle'];
    $formattedShowTitle10 = $arrayMessage['details']['list']['170']['formattedShowTitle'];
    $formattedShowTitle11 = $arrayMessage['details']['list']['171']['formattedShowTitle'];
    $formattedShowTitle12 = $arrayMessage['details']['list']['172']['formattedShowTitle'];
    $formattedShowTitle13 = $arrayMessage['details']['list']['173']['formattedShowTitle'];
    $formattedShowTitle14 = $arrayMessage['details']['list']['174']['formattedShowTitle'];
    $formattedShowTitle15 = $arrayMessage['details']['list']['175']['formattedShowTitle'];
    $formattedShowTitle16 = $arrayMessage['details']['list']['176']['formattedShowTitle'];
    $formattedShowTitle17 = $arrayMessage['details']['list']['177']['formattedShowTitle'];
    $formattedShowTitle18 = $arrayMessage['details']['list']['178']['formattedShowTitle'];
    $formattedShowTitle19 = $arrayMessage['details']['list']['179']['formattedShowTitle'];

    $option =   [
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle0."\nID".$id0, $url = '', $callback_data = 'showsid0-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle1."\nID".$id1, $url = '', $callback_data = 'showsid0-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle2."\nID".$id2, $url = '', $callback_data = 'showsid0-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle3."\nID".$id3, $url = '', $callback_data = 'showsid0-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle4."\nID".$id4, $url = '', $callback_data = 'showsid1-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle5."\nID".$id5, $url = '', $callback_data = 'showsid1-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle6."\nID".$id6, $url = '', $callback_data = 'showsid1-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle7."\nID".$id7, $url = '', $callback_data = 'showsid1-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle8."\nID".$id8, $url = '', $callback_data = 'showsid2-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle9."\nID".$id9, $url = '', $callback_data = 'showsid2-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle10."\nID".$id10, $url = '', $callback_data = 'showsid2-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle11."\nID".$id11, $url = '', $callback_data = 'showsid2-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle12."\nID".$id12, $url = '', $callback_data = 'showsid3-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle13."\nID".$id13, $url = '', $callback_data = 'showsid3-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle14."\nID".$id14, $url = '', $callback_data = 'showsid3-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle15."\nID".$id15, $url = '', $callback_data = 'showsid3-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle16."\nID".$id16, $url = '', $callback_data = 'showsid4-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle17."\nID".$id17, $url = '', $callback_data = 'showsid4-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle18."\nID".$id18, $url = '', $callback_data = 'showsid4-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle19."\nID".$id19, $url = '', $callback_data = 'showsid4-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton("صفحه ۵", $url = '', $callback_data = 'showsp5'),
            $telegram->buildInlineKeyBoardButton("صفحه ۴", $url = '', $callback_data = 'showsp4'),
            $telegram->buildInlineKeyBoardButton("صفحه ۳", $url = '', $callback_data = 'showsp3'),
            $telegram->buildInlineKeyBoardButton("صفحه ۲", $url = '', $callback_data = 'showsp2'),
            $telegram->buildInlineKeyBoardButton("صفحه ۱", $url = '', $callback_data = 'showsp1'),
        ],
        [
            $telegram->buildInlineKeyBoardButton("صفحه ۱۰", $url = '', $callback_data = 'showsp10'),
            $telegram->buildInlineKeyBoardButton("(صفحه ۹)", $url = '', $callback_data = 'showsp9'),
            $telegram->buildInlineKeyBoardButton("صفحه ۸", $url = '', $callback_data = 'showsp8'),
            $telegram->buildInlineKeyBoardButton("صفحه ۷", $url = '', $callback_data = 'showsp7'),
            $telegram->buildInlineKeyBoardButton("صفحه ۶", $url = '', $callback_data = 'showsp6'),
        ],
    ];

    $keyb = $telegram->buildInlineKeyBoard($option);
    $telegram->editMessageText(array('chat_id' => $chat_id, 'message_id' => $callbackmessage_id, 'reply_markup' => $keyb, 'text' => "برنامه موردنظرتون رو انتخاب کنید - صفحه ۹"));

}
elseif ($text == 'showsp10') # show show page 10
{
    $url = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/list?sortBy=latest&genre=&pageNumber=1&pageSize=200";
    $request = file_get_contents($url);
    $arrayMessage = json_decode($request, true);

    $resultsCount = $arrayMessage['details']['resultsCount'];


    $id0 = $arrayMessage['details']['list']['180']['id'];
    $id1 = $arrayMessage['details']['list']['181']['id'];
    $id2 = $arrayMessage['details']['list']['182']['id'];
    $id3 = $arrayMessage['details']['list']['183']['id'];
    $id4 = $arrayMessage['details']['list']['184']['id'];
    $id5 = $arrayMessage['details']['list']['185']['id'];
    $id6 = $arrayMessage['details']['list']['186']['id'];
    $id7 = $arrayMessage['details']['list']['187']['id'];
    $id8 = $arrayMessage['details']['list']['188']['id'];
    $id9 = $arrayMessage['details']['list']['189']['id'];
    $id10 = $arrayMessage['details']['list']['190']['id'];
    $id11 = $arrayMessage['details']['list']['191']['id'];
    $id12 = $arrayMessage['details']['list']['192']['id'];
    $id13 = $arrayMessage['details']['list']['193']['id'];
    $id14 = $arrayMessage['details']['list']['194']['id'];
    $id15 = $arrayMessage['details']['list']['195']['id'];
    $id16 = $arrayMessage['details']['list']['196']['id'];
    $id17 = $arrayMessage['details']['list']['197']['id'];
    $id18 = $arrayMessage['details']['list']['198']['id'];
    $id19 = $arrayMessage['details']['list']['199']['id'];


    $formattedShowTitle0 = $arrayMessage['details']['list']['180']['formattedShowTitle'];
    $formattedShowTitle1 = $arrayMessage['details']['list']['181']['formattedShowTitle'];
    $formattedShowTitle2 = $arrayMessage['details']['list']['182']['formattedShowTitle'];
    $formattedShowTitle3 = $arrayMessage['details']['list']['183']['formattedShowTitle'];
    $formattedShowTitle4 = $arrayMessage['details']['list']['184']['formattedShowTitle'];
    $formattedShowTitle5 = $arrayMessage['details']['list']['185']['formattedShowTitle'];
    $formattedShowTitle6 = $arrayMessage['details']['list']['186']['formattedShowTitle'];
    $formattedShowTitle7 = $arrayMessage['details']['list']['187']['formattedShowTitle'];
    $formattedShowTitle8 = $arrayMessage['details']['list']['188']['formattedShowTitle'];
    $formattedShowTitle9 = $arrayMessage['details']['list']['189']['formattedShowTitle'];
    $formattedShowTitle10 = $arrayMessage['details']['list']['190']['formattedShowTitle'];
    $formattedShowTitle11 = $arrayMessage['details']['list']['191']['formattedShowTitle'];
    $formattedShowTitle12 = $arrayMessage['details']['list']['192']['formattedShowTitle'];
    $formattedShowTitle13 = $arrayMessage['details']['list']['193']['formattedShowTitle'];
    $formattedShowTitle14 = $arrayMessage['details']['list']['194']['formattedShowTitle'];
    $formattedShowTitle15 = $arrayMessage['details']['list']['195']['formattedShowTitle'];
    $formattedShowTitle16 = $arrayMessage['details']['list']['196']['formattedShowTitle'];
    $formattedShowTitle17 = $arrayMessage['details']['list']['197']['formattedShowTitle'];
    $formattedShowTitle18 = $arrayMessage['details']['list']['198']['formattedShowTitle'];
    $formattedShowTitle19 = $arrayMessage['details']['list']['199']['formattedShowTitle'];

    $option =   [
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle0."\nID".$id0, $url = '', $callback_data = 'showsid0-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle1."\nID".$id1, $url = '', $callback_data = 'showsid0-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle2."\nID".$id2, $url = '', $callback_data = 'showsid0-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle3."\nID".$id3, $url = '', $callback_data = 'showsid0-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle4."\nID".$id4, $url = '', $callback_data = 'showsid1-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle5."\nID".$id5, $url = '', $callback_data = 'showsid1-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle6."\nID".$id6, $url = '', $callback_data = 'showsid1-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle7."\nID".$id7, $url = '', $callback_data = 'showsid1-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle8."\nID".$id8, $url = '', $callback_data = 'showsid2-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle9."\nID".$id9, $url = '', $callback_data = 'showsid2-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle10."\nID".$id10, $url = '', $callback_data = 'showsid2-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle11."\nID".$id11, $url = '', $callback_data = 'showsid2-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle12."\nID".$id12, $url = '', $callback_data = 'showsid3-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle13."\nID".$id13, $url = '', $callback_data = 'showsid3-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle14."\nID".$id14, $url = '', $callback_data = 'showsid3-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle15."\nID".$id15, $url = '', $callback_data = 'showsid3-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton($formattedShowTitle16."\nID".$id16, $url = '', $callback_data = 'showsid4-0'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle17."\nID".$id17, $url = '', $callback_data = 'showsid4-1'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle18."\nID".$id18, $url = '', $callback_data = 'showsid4-2'),
            $telegram->buildInlineKeyBoardButton($formattedShowTitle19."\nID".$id19, $url = '', $callback_data = 'showsid4-3'),
        ],
        [
            $telegram->buildInlineKeyBoardButton("صفحه ۵", $url = '', $callback_data = 'showsp5'),
            $telegram->buildInlineKeyBoardButton("صفحه ۴", $url = '', $callback_data = 'showsp4'),
            $telegram->buildInlineKeyBoardButton("صفحه ۳", $url = '', $callback_data = 'showsp3'),
            $telegram->buildInlineKeyBoardButton("صفحه ۲", $url = '', $callback_data = 'showsp2'),
            $telegram->buildInlineKeyBoardButton("صفحه ۱", $url = '', $callback_data = 'showsp1'),
        ],
        [
            $telegram->buildInlineKeyBoardButton("(صفحه ۱۰)", $url = '', $callback_data = 'showsp10'),
            $telegram->buildInlineKeyBoardButton("صفحه ۹", $url = '', $callback_data = 'showsp9'),
            $telegram->buildInlineKeyBoardButton("صفحه ۸", $url = '', $callback_data = 'showsp8'),
            $telegram->buildInlineKeyBoardButton("صفحه ۷", $url = '', $callback_data = 'showsp7'),
            $telegram->buildInlineKeyBoardButton("صفحه ۶", $url = '', $callback_data = 'showsp6'),
        ],
    ];

    $keyb = $telegram->buildInlineKeyBoard($option);
    $telegram->editMessageText(array('chat_id' => $chat_id, 'message_id' => $callbackmessage_id, 'reply_markup' => $keyb, 'text' => "برنامه موردنظرتون رو انتخاب کنید - صفحه ۱۰"));

}

elseif (stristr($text, 'showsid') == true)
{
    $sno = explode('showsid', $text);
    $N = explode('-', $sno[1]);
    $request = file_get_contents("php://input");
    $arrayMessage = json_decode($request, true);
    $Buttontext = $arrayMessage['callback_query']['message']['reply_markup']['inline_keyboard'][$N[0]][$N[1]]['text'];

    $getshowid = explode("ID", $Buttontext, 2);
    $showurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/details?id=" . $getshowid[1];
    $showrequest = file_get_contents($showurl);
    $showarrayMessage = json_decode($showrequest, true);
    $showTitle = $showarrayMessage['details']['showTitle'];
    $showoverlayImgIxUrl = $showarrayMessage['details']['overlayImgIxUrl'];
    $showShortDescription = $showarrayMessage['details']['showShortDescription'];
    $ShortDescription = strip_tags($showShortDescription);
    $caption = ("@BachehayeManotoBot\n" . '<b>'. $showTitle .'</b>' . "\n" . $ShortDescription);

    $option =   [
        [
            $telegram->buildInlineKeyBoardButton("دیدن در سایت" , $url = "https://www.manototv.com/show/" . $getshowid[1]),
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
    $genreurl = "https://dak1vd5vmi7x6.cloudfront.net/api/v1/publicrole/showmodule/genres";
    $genrerequest = file_get_contents($genreurl);
    $genrearrayMessage = json_decode($genrerequest, true);
    $genre0 = $genrearrayMessage['details']['list']['0']['title'];
    $genre1 = $genrearrayMessage['details']['list']['1']['title'];
    $genre2 = $genrearrayMessage['details']['list']['2']['title'];
    $genre3 = $genrearrayMessage['details']['list']['3']['title'];
    $genre4 = $genrearrayMessage['details']['list']['4']['title'];
    $genre5 = $genrearrayMessage['details']['list']['5']['title'];
    $genre6 = $genrearrayMessage['details']['list']['6']['title'];
    $genre7 = $genrearrayMessage['details']['list']['7']['title'];
    $genre8 = $genrearrayMessage['details']['list']['8']['title'];
    $genre9 = $genrearrayMessage['details']['list']['9']['title'];

    $option =   [
        [
            $telegram->buildInlineKeyBoardButton($genre0, $url = '', $callback_data = "genre0"),
        ],
        [
            $telegram->buildInlineKeyBoardButton($genre1, $url = '', $callback_data = "genre1"),
            $telegram->buildInlineKeyBoardButton($genre5, $url = '', $callback_data = "genre5"),
            $telegram->buildInlineKeyBoardButton($genre3, $url = '', $callback_data = "genre3"),
        ],
        [
            $telegram->buildInlineKeyBoardButton($genre4, $url = '', $callback_data = "genre4"),
            $telegram->buildInlineKeyBoardButton($genre2, $url = '', $callback_data = "genre2"),
            $telegram->buildInlineKeyBoardButton($genre6, $url = '', $callback_data = "genre6"),
        ],
        [
            $telegram->buildInlineKeyBoardButton($genre7, $url = '', $callback_data = "genre7"),
            $telegram->buildInlineKeyBoardButton($genre8, $url = '', $callback_data = "genre8"),
            $telegram->buildInlineKeyBoardButton($genre9, $url = '', $callback_data = "genre9"),
        ],
    ];

    $keyb = $telegram->buildInlineKeyBoard($option);
    $telegram->editMessageText(array('chat_id' => $chat_id, 'message_id' => $callbackmessage_id, 'reply_markup' => $keyb, 'text' => "ژاﻧﺮ ﺑﺮﻧﺎﻣﻪ ﺭﻭ اﻧﺘﺨﺎﺏ کنید"));
}

elseif (strstr($text, "ep") == true)
{
    $getepisodeid = explode("ep", $text, 2);
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

elseif (strstr($text, "sh") == true)
{
    $getshowid = explode("sp", $text, 2);
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

elseif (strstr($text, '-') == true)
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

elseif($msgType == 'photo')
{
    if($chat_id == '122558527')
    {

        $option =
            [
            [
                $telegram->buildInlineKeyBoardButton("اینستاگرام بچه های من و تو" , $url = "https://Instagram.com/BachehayeManototv"),
            ],
            [
            $telegram->buildInlineKeyBoardButton("ارسال برای همه", $url = '', $callback_data = "send2all"),
            ],
            ];

        $keyb = $telegram->buildInlineKeyBoard($option);
        $telegram->sendPhoto(['chat_id' => "122558527", 'reply_markup' => $keyb, 'photo' => $file_id, 'caption' => $msgcaptiom]);
    }
}
elseif ($text == 'send2all')
{
    $users = file_get_contents('users.txt');
    $user = explode('-',$users);
    $tedaduser = count($user);

    $number = 1;
    do {
        $userchatid = $user[$number];
        $option =
            [
            [
                $telegram->buildInlineKeyBoardButton("اینستاگرام بچه های من و تو" , $url = "https://Instagram.com/BachehayeManototv"),
            ],
            ];

        $keyb = $telegram->buildInlineKeyBoard($option);
        $telegram->sendPhoto(['chat_id' => $userchatid, 'reply_markup' => $keyb, 'photo' => $file_id, 'caption' => $msgcaptiom]);

        $number = $number + 1;
    }
    while ($number <= $tedaduser);
    $telegram->sendMessage(['chat_id' => '122558527', 'text' => "sent to " . $tedaduser . " Users"]);
}

else
{
    $telegram->sendMessage(['chat_id' => $chat_id, 'text' => "Invalid Input"]);
}
