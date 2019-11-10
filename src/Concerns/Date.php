<?php

namespace Matriphe\Format\Concerns;

trait Date
{
    public function dateRange($date1, $date2 = null, $long = true, $locale = null)
    {
        var_dump(['dateRange' => $locale]);
        
        $date1 = $this->convertToDate($date1, $locale);
        $date2 = $this->convertToDate($date2, $locale);

        $format = ($long ? 'j F Y' : 'j M y');

        if (empty($date1) && ! empty($date2)) {
            return $this->carbon->parse($date2->toDateString())->format($format);
        }

        if (! empty($date1) && empty($date2)) {
            return $this->carbon->parse($date1->toDateString())->format($format);
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
                $this->carbon->parse($date1->toDateString())->format($format),
                '-',
                $this->carbon->parse($date2->toDateString())->format($format),
            ]);
        }

        $format2 = ($long ? 'j F' : 'j M');

        if ($date1->month != $date2->month) {
            return implode(' ', [
                $this->carbon->parse($date1->toDateString())->format($format2),
                '-',
                $this->carbon->parse($date2->toDateString())->format($format2),
                $this->carbon->parse($date2->toDateString())->format($long ? 'Y' : 'y'),
            ]);
        }

        if ($date1->day != $date2->day) {
            return implode('', [
                $this->carbon->parse($date1->toDateString())->format('j'),
                '-',
                $this->carbon->parse($date2->toDateString())->format($format),
            ]);
        }

        return $this->carbon->parse($date1->toDateString())->format($format);
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

        return $this->carbon
            ->parse($date1->toDatetimeString())
            ->timespan($this->carbon->parse($date2->toDatetimeString()), true);
    }
}
