<?php

/**
 * Функция выводит количество определенных дней недели в заданном временном промежутке
 * 
 * @param integer $day_num   - порядковый номер дня недели. 0 - воскресенье
 * @param string  $date_from - формат YYYY-MM-DD
 * @param string  $date_to   - формат YYYY-MM-DD
 *
 * @return integer
 */
function getWeekdayCount(int $day_num, string $date_from, string $date_to) : int
{
    if (preg_match('#[^-0-9]#u', $date_from) || preg_match('#[^-0-9]#u', $date_to)) {
        throw new Exception("Один из GET параметов содержит недопустимые символы", 1);
    }

    $date_from__unix = strtotime($date_from);
    $date_to__unix = strtotime($date_to);

    if (!$date_from__unix || !$date_to__unix) {
        throw new Exception("Один из GET параметов не прошел валидацию", 2);
    }

    $date_from__daynum = (int)date('w', $date_from__unix);
    $date_to__daynum = (int)date('w', $date_to__unix);

    $weeks = (($date_to__unix - $date_from__unix) / (60 * 60 * 24)) / 7;

    $is_int = is_int($weeks);

    $weeks = floor($weeks);

    if ($weeks > 0) {
        if ($date_from__daynum === $day_num) {
            $weeks += 1;
        } else {
            if (!$is_int) {
                if ($date_from__daynum <= $day_num) {
                    $weeks += 1;
                }

                if ($date_to__daynum >= $day_num) {
                    $weeks += 1;
                }
            }
        }
    } else {
        if ($date_from__daynum <= $day_num && $date_to__daynum >= $day_n) {
            $weeks += 1;
        }
    }

    return $weeks;
}

$date_from = '';
$date_to = '';

if (isset($_GET['date_from']) && $_GET['date_from']) {
    $date_from = trim($_GET['date_from']);
}

if (isset($_GET['date_to']) && $_GET['date_to']) {
    $date_to = trim($_GET['date_to']);
}

if ($date_from && $date_to) {
    // 2 - вторник
    print "Вторников за данный период: " . getWeekdayCount(2, $date_from, $date_to);
} else {
    print "Один из необходимых параметров не заполнен";
}

