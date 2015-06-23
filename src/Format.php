<?php namespace Matriphe\Format;

class Format {

	public function number($num, $sep = 0, $decimal = ',', $thousand = '.')
	{
		return number_format($num, $sep, $decimal, $thousand);
	}

	public function bytes($num, $precision = 1)
	{
		if ($num >= 1000000000000000) {
			$num = round($num / (1024 * 1024 * 1024 * 1024 * 1024), $precision);
			$unit = 'PB';
		} elseif ($num >= 1000000000000) {
			$num = round($num / (1024 * 1024 * 1024 * 1024), $precision);
			$unit = 'TB';
		} elseif ($num >= 1000000000) {
			$num = round($num / (1024 * 1024 * 1024), $precision);
			$unit = 'GB';
		} elseif ($num >= 1000000) {
			$num = round($num / (1024 * 1024), $precision);
			$unit = 'MB';
		} elseif ($num >= 1000) {
			$num = round($num / 1024, $precision);
			$unit = 'kB';
		} else {
			$unit = 'B';
			return $this->number($num).' '.$unit;
		}

		return $this->number($num, $precision).' '.$unit;
	}

	public function toBytes($sSize)
	{
        $sSize = str_replace(' ', '', $sSize);
        //This function transforms the php.ini notation for numbers (like '2M') to an integer (2*1024*1024 in this case)
        $sSuffix = substr($sSize, -1);
        $iValue = substr($sSize, 0, -1);
        switch(strtoupper($sSuffix)) {
            case 'P':
                $iValue *= 1024;
            case 'T':
                $iValue *= 1024;
            case 'G':
                $iValue *= 1024;
            case 'M':
                $iValue *= 1024;
            case 'K':
            case 'k':
                $iValue *= 1024;
                break;
            default:
            	$iValue = intval($sSize);
        }
        return $iValue;
	}

	public function phone($phone, $countrycode='+62')
	{
		$phone = trim($phone);
		//$phone = str_replace($countrycode, '', $phone);
		$phone = str_replace(' ', '', $phone);
		$phone = str_replace('-', '', $phone);
		$phone = str_replace('(', '', $phone);
		$phone = str_replace(')', '', $phone);
		//$phone = str_replace('+', '', $phone);
		$phone = str_replace($countrycode, '0', $phone);
		$phone = preg_replace('/^[0](\d*)/', $countrycode."$1", $phone);

		return $phone;
	}

	public function dateRange($date1, $date2 = null, $long = true)
	{
        if (!empty($date1) && !empty($date2) && $date1 != '0000-00-00 00:00:00' && $date2 != '0000-00-00 00:00:00') {
			$date1 = strtotime($date1);
			$date2 = strtotime($date2);

			if ($date1 <= $date2) {
				$start = $date1;
				$end = $date2;
			} else {
				$start = $date2;
				$end = $date1;
			}

			$start_year = ($long ? date('Y',$start) : date('y',$start));
			$end_year = ($long ? date('Y',$end) : date('y',$end));

			$start_month = (int) date('m',$start);
			$end_month = (int) date('m',$end);

			$start_date = (int) date('j',$start);
			$end_date = (int) date('j',$end);


			if ($start_year == $end_year) {
				if ($start_month == $end_month) {
					if ($start_date == $end_date) {
						$result = $start_date.' '.($long ? date('F',$start) : date('M',$start));
					} else {
						$result = $start_date.'-'.$end_date.' '.($long ? date('F',$start) : date('M',$start));
					}
				} else {
					$result = $start_date.' '.($long ? date('F',$start) : date('M',$start)).' - '.$end_date.' '.($long ? date('F',$end) : date('M',$end));
				}

				$result .= ' '.$start_year;
			} else {
				$result = $start_date.' '.($long ? date('F',$start) : date('M',$start)).' '.$start_year.' - '.$end_date.' '.($long ? date('F',$end) : date('M',$end)).' '.$end_year;
			}
		} elseif (!empty($date1) && $date1 != '0000-00-00 00:00:00') {
			$timestamp = strtotime($date1);
			$date = (int) date('j',$timestamp);
			$month = (string) ($long ? date('F',$timestamp) : date('M',$timestamp));
			$year = ($long ? date('Y',$timestamp) : date('y',$timestamp));
			$result = $date.' '.$month.' '.$year;
		} elseif (!empty($date2) && $date2 != '0000-00-00 00:00:00') {
			$timestamp = strtotime($date2);
			$date = (int) date('j',$timestamp);
			$month = (string) ($long ? date('F',$timestamp) : date('M',$timestamp));
			$year = ($long ? date('Y',$timestamp) : date('y',$timestamp));
			$result = $date.' '.$month.' '.$year;
		} else {
			$result = '';
		}

		return $result;
	}
	
	public function slugHash($id, $timestamp = null)
	{
		$alphabet = '_zaq1OUJM2WSXcde34RFVbgt5CZAQ6YHNmju78IKlo90PLBGTED-';
		
		$base_count = strlen($alphabet);
		
		$encoded = '';
		
		$id = (!empty($timestamp) && is_int($timestamp) ? $timestamp : strtotime('now')).$id;
		
		while ($id >= $base_count) {
			$div = $id/$base_count;
			$mod = ($id-($base_count*intval($div)));
			$encoded .= $alphabet[$mod];
			$id = intval($div);
		}
		
		if ($id) $encoded .= $alphabet[$id];
		
		return $encoded;
	}
	
	public function duration($date1, $date2)
	{
		$result = '';
		
		if (!empty($date1) && !empty($date2) && $date1 != '0000-00-00 00:00:00' && $date2 != '0000-00-00 00:00:00') {
            $date1 = strtotime($date1);
			$date2 = strtotime($date2);
			
			$diffs = abs($date2 - $date1);
			
			$days = floor($diffs / (24 * 60 * 60));
			if ($days > 0) {
    			$result .= $this->number($days).' '.($days == 1 ? 'day' : 'days').' ';
    			$diffs = ($diffs - ($days * 24 * 60 * 60));
			}
			
			$hours = floor($diffs / (60 * 60));
			if ($hours > 0) {
    			$result .= $this->number($hours).' '.($hours == 1 ? 'hour' : 'hours').' ';
    			$diffs = ($diffs - ($hours * 60 * 60));
			}
			
			$minutes = floor($diffs / (60));
			if ($minutes > 0) {
    			$result .= $this->number($minutes).' '.($minutes == 1 ? 'minute' : 'minutes').' ';
    			$diffs = ($diffs - ($minutes * 60));
			}
			
			$seconds = $diffs;
			if ($seconds > 0 && $days == 0 && $hours == 0 && $minutes == 0) {
    			$result .= ' '.$this->number($seconds).' '.($seconds == 1 ? 'second' : 'seconds').' ';
			}
			
			$result = trim($result);
        }
        
        return $result;
	}
	
	public function removeNewLine($string)
	{
    	return trim(preg_replace('/\s+/', ' ', $string));
	}

}