<?php

namespace Matriphe\Format\Concerns;

use Jenssegers\Date\Date as IntlDate;

trait Date
{
    public function dateRange($date1, $date2 = null, $long = true, $locale = null)
    {
        $date1 = $this->convertToDate($date1, $locale);
        $date2 = $this->convertToDate($date2, $locale);

        $format = ($long ? 'j F Y' : 'j M y');

        IntlDate::setLocale($this->switchLocale($locale));

        if (empty($date1) && ! empty($date2)) {
            return IntlDate::parse($date2->toDateString())->format($format);
        }

        if (! empty($date1) && empty($date2)) {
            return IntlDate::parse($date1->toDateString())->format($format);
        }

        if (empty($date1) && empty($date2)) {
            return null;
        }

        if ($date2->lt($date1)) {
            $tmp = $date1;
            $date1 = $date2;
            $date2 = $tmp;
        }

        if ($date1->year != $date2->year) {
            return implode(' ', [
                IntlDate::parse($date1->toDateString())->format($format),
                '-',
                IntlDate::parse($date2->toDateString())->format($format),
            ]);
        }

        $format2 = ($long ? 'j F' : 'j M');

        if ($date1->month != $date2->month) {
            return implode(' ', [
                IntlDate::parse($date1->toDateString())->format($format2),
                '-',
                IntlDate::parse($date2->toDateString())->format($format2),
                IntlDate::parse($date2->toDateString())->format($long ? 'Y' : 'y'),
            ]);
        }

        if ($date1->day != $date2->day) {
            return implode('', [
                IntlDate::parse($date1->toDateString())->format('j'),
                '-',
                IntlDate::parse($date2->toDateString())->format($format),
            ]);
        }

        return IntlDate::parse($date1->toDateString())->format($format);
    }

    public function duration($date1, $date2, $locale = null)
    {
        if (empty($date1) || empty($date2)) {
            return null;
        }

        $date1 = $this->convertToDate($date1, $locale);
        $date2 = $this->convertToDate($date2, $locale);

        if ($date2->lt($date1)) {
            $tmp = $date1;
            $date1 = $date2;
            $date2 = $tmp;
        }

        IntlDate::setLocale($this->switchLocale($locale));

        return IntlDate::parse($date1->toDatetimeString())
            ->timespan(
                IntlDate::parse($date2->toDatetimeString()),
                true
            );
    }
}
