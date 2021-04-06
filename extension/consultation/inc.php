<?php

/**
 * Календарь
 */
class Calendar {

    /**
     * Вывод календаря на один месяц.
     */
    public static function getMonth($month, $year, $events = array()) {
        $months = array(
            1 => 'Январь',
            2 => 'Февраль',
            3 => 'Март',
            4 => 'Апрель',
            5 => 'Май',
            6 => 'Июнь',
            7 => 'Июль',
            8 => 'Август',
            9 => 'Сентябрь',
            10 => 'Октябрь',
            11 => 'Ноябрь',
            12 => 'Декабрь'
        );

        $month = intval($month);
        $out = '
		<div class="calendar-item">
			<div class="calendar-head">' . $months[$month] . ' ' . $year . '</div>
			<table>
				<tr>
					<th>Пн</th>
					<th>Вт</th>
					<th>Ср</th>
					<th>Чт</th>
					<th>Пт</th>
					<th>Сб</th>
					<th>Вс</th>
				</tr>';


        $day_week = date('N', mktime(0, 0, 0, $month, 1, $year));
        $day_week--;

        $out .= '<tr>';

        for ($x = 0; $x < $day_week; $x++) {
            $out .= '<td></td>';
        }

        $days_counter = 0;


        $days_month = date('t', mktime(0, 0, 0, $month, 1, $year));

        /* За сколько дней можно записаться */
        $max_day = 30;
        for ($day = 1; $day <= $days_month; $day++) {

            if (date('j.n.Y') == $day . '.' . $month . '.' . $year) {
                $class = 'today';
            } elseif (time() > strtotime($day . '.' . $month . '.' . $year)) {
                $class = 'last';
            } else {
                $class = 'calendar_day_active';
                $max_day--;
            }
            if ($max_day <= 0) {
                $class = 'last';
            }

            if ($day_week == 6 || $day_week == 5) {
                $class = 'last';
            }

            // Форматирование
            $month_format = $month;
            if (strlen($month) == 1) {
                $month_format = '0' . $month;
            }
            $day_format = $day;
            if (strlen($day) == 1) {
                $day_format = '0' . $day;
            }


            // События
            $event_show = false;
            $event_text = array();
            if (!empty($events)) {
                foreach ($events as $date => $text) {
                    $date = explode('.', $date);
                    if (count($date) == 3) {
                        $y = explode(' ', $date[2]);
                        if (count($y) == 2) {
                            $date[2] = $y[0];
                        }

                        if ($day == intval($date[0]) && $month == intval($date[1]) && $year == $date[2]) {
                            $event_show = true;
                            $event_text[] = $text;
                        }
                    } elseif (count($date) == 2) {
                        if ($day == intval($date[0]) && $month == intval($date[1])) {
                            $event_show = true;
                            $event_text[] = $text;
                        }
                    } elseif ($day == intval($date[0])) {
                        $event_show = true;
                        $event_text[] = $text;
                    }
                }
            }

            if ($event_show) {
                $out .= '<td class="calendar-day ' . $class . ' event">' . $day;
                if (!empty($event_text)) {
                    $out .= '<div class="calendar-popup">' . implode('<br>', $event_text) . '</div>';
                }
                $out .= '</td>';
            } else {
                $out .= '<td class="calendar-day ' . $class . '" date="' . $day_format . '.' . $month_format . '.' . $year . '"><div><span>' . $day . ' ' . $days_week_counter . '</span></div></td>';
            }

            if ($day_week == 6) {
                $out .= '</tr>';
                if (($days_counter + 1) != $days_month) {
                    $out .= '<tr>';
                }
                $day_week = -1;
            }

            $day_week++;
            $days_counter++;
        }

        $out .= '</tr></table></div>';
        return $out;
    }

    /**
     * Вывод календаря на несколько месяцев.
     */
    public static function getInterval($start, $end, $events = array()) {
        $curent = explode('.', $start);
        $curent[0] = intval($curent[0]);

        $end = explode('.', $end);
        $end[0] = intval($end[0]);

        $begin = true;
        $out = '<div class="calendar-wrp">';
        do {
            $out .= self::getMonth($curent[0], $curent[1], $events);

            if ($curent[0] == $end[0] && $curent[1] == $end[1]) {
                $begin = false;
            }

            $curent[0]++;
            if ($curent[0] == 13) {
                $curent[0] = 1;
                $curent[1]++;
            }
        } while ($begin == true);

        $out .= '<div class="">';
        return $out;
    }

}
