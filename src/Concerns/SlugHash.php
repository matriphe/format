<?php

namespace Matriphe\Format\Concerns;

use Hashids\Hashids;
use Jenssegers\Date\Date;

trait SlugHash
{
    protected $alphabet = '_zaq1OUJM2WSXcde34RFVbgt5CZAQ6YHNmju78IKlo90PLBGTED-';

    public function slugHash(int $id, $timestamp = null, string $alphabet = null, int $length = 6)
    {
        if (empty($timestamp)) {
            $timestamp = Date::now();
        }
        $salt = $id.'-'.$this->convertToDate($timestamp)->timestamp;

        if (empty($alphabet)) {
            $alphabet = $this->alphabet;
        }

        $hashids = new Hashids($salt, $length, $alphabet);

        return $hashids->encode($id);
    }
}
