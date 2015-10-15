<?php namespace Matriphe\Format;

class Format {

	public function number($num, $sep = 0, $decimal = ',', $thousand = '.')
	{
		return number_format(intval($num), $sep, $decimal, $thousand);
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

	public function duration($date1, $date2, $showsecond = false)
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
			if ($seconds > 0 && (($days == 0 && $hours == 0 && $minutes == 0) || $showsecond == true)) {
    			$result .= $this->number($seconds).' '.($seconds == 1 ? 'second' : 'seconds').' ';
			}

			$result = trim($result);
        }

        return $result;
	}

	public function removeNewLine($string)
	{
    	return trim(preg_replace('/\s+/', ' ', $string));
	}

	public function wpautop($pee, $br = true)
	{
		$pre_tags = array();

		if ( trim($pee) === '' )
			return '';

		$pee = $pee . "\n"; // just to make things a little easier, pad the end

		if ( strpos($pee, '<pre') !== false ) {
			$pee_parts = explode( '</pre>', $pee );
			$last_pee = array_pop($pee_parts);
			$pee = '';
			$i = 0;

			foreach ( $pee_parts as $pee_part ) {
				$start = strpos($pee_part, '<pre');

				// Malformed html?
				if ( $start === false ) {
					$pee .= $pee_part;
					continue;
				}

				$name = "<pre wp-pre-tag-$i></pre>";
				$pre_tags[$name] = substr( $pee_part, $start ) . '</pre>';

				$pee .= substr( $pee_part, 0, $start ) . $name;
				$i++;
			}

			$pee .= $last_pee;
		}

		$pee = preg_replace('|<br />\s*<br />|', "\n\n", $pee);
		// Space things out a little
		$allblocks = '(?:table|thead|tfoot|caption|col|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|select|option|form|map|area|blockquote|address|math|style|p|h[1-6]|hr|fieldset|noscript|legend|section|article|aside|hgroup|header|footer|nav|figure|figcaption|details|menu|summary)';
		$pee = preg_replace('!(<' . $allblocks . '[^>]*>)!', "\n$1", $pee);
		$pee = preg_replace('!(</' . $allblocks . '>)!', "$1\n\n", $pee);
		$pee = str_replace(array("\r\n", "\r"), "\n", $pee); // cross-platform newlines
		if ( strpos($pee, '<object') !== false ) {
			$pee = preg_replace('|\s*<param([^>]*)>\s*|', "<param$1>", $pee); // no pee inside object/embed
			$pee = preg_replace('|\s*</embed>\s*|', '</embed>', $pee);
		}
		$pee = preg_replace("/\n\n+/", "\n\n", $pee); // take care of duplicates
		// make paragraphs, including one at the end
		$pees = preg_split('/\n\s*\n/', $pee, -1, PREG_SPLIT_NO_EMPTY);
		$pee = '';
		foreach ( $pees as $tinkle )
			$pee .= '<p>' . trim($tinkle, "\n") . "</p>\n";
		$pee = preg_replace('|<p>\s*</p>|', '', $pee); // under certain strange conditions it could create a P of entirely whitespace
		$pee = preg_replace('!<p>([^<]+)</(div|address|form)>!', "<p>$1</p></$2>", $pee);
		$pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee); // don't pee all over a tag
		$pee = preg_replace("|<p>(<li.+?)</p>|", "$1", $pee); // problem with nested lists
		$pee = preg_replace('|<p><blockquote([^>]*)>|i', "<blockquote$1><p>", $pee);
		$pee = str_replace('</blockquote></p>', '</p></blockquote>', $pee);
		$pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)!', "$1", $pee);
		$pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee);
		if ( $br ) {
			$pee = str_replace("\n", "<WPPreserveNewline />", $pee);
			//$pee = preg_replace_callback('/<(script|style).*?<\/\\1>/s', $this->_autop_newline_preservation_helper, $pee);
			$pee = $this->removeNewLine($pee);
			$pee = preg_replace('/<(script|style).*?<\/\\1>/s', '<WPPreserveNewline />', $pee);
			$pee = preg_replace('|(?<!<br />)\s*\n|', "<br />\n", $pee); // optionally make line breaks
			$pee = str_replace('<WPPreserveNewline />', "\n", $pee);
		}
		$pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*<br />!', "$1", $pee);
		$pee = preg_replace('!<br />(\s*</?(?:p|li|div|dl|dd|dt|th|pre|td|ul|ol)[^>]*>)!', '$1', $pee);
		$pee = preg_replace( "|\n</p>$|", '</p>', $pee );

		if ( !empty($pre_tags) )
			$pee = str_replace(array_keys($pre_tags), array_values($pre_tags), $pee);

		return $pee;
	}

	private function _autop_newline_preservation_helper( $matches ) {
		return str_replace("\n", "<WPPreserveNewline />", $matches[0]);
	}

}