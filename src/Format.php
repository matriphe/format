<?php namespace Matriphe\Format;

class Format {

	public function number($num,$sep=0,$decimal=',',$thousand='.')
	{
		return number_format($num,$sep,$decimal,$thousand);
	}

	public function bytes($num, $precision = 1)
	{
		if ($num >= 1000000000000000)
		{
			$num = round($num / (1024 * 1024 * 1024 * 1024 * 1024), $precision);
			$unit = 'PB';
		}
		elseif ($num >= 1000000000000)
		{
			$num = round($num / (1024 * 1024 * 1024 * 1024), $precision);
			$unit = 'TB';
		}
		elseif ($num >= 1000000000)
		{
			$num = round($num / (1024 * 1024 * 1024), $precision);
			$unit = 'GB';
		}
		elseif ($num >= 1000000)
		{
			$num = round($num / (1024 * 1024), $precision);
			$unit = 'MB';
		}
		elseif ($num >= 1000)
		{
			$num = round($num / 1024, $precision);
			$unit = 'kB';
		}
		else
		{
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
    switch(strtoupper($sSuffix)){
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

	public function phone($phone,$countrycode='+62')
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

}