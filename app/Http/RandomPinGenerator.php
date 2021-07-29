<?php

namespace App\Http;


use App\Models\Code;

class RandomPinGenerator
{

    /**
     * @var
     */
    protected $model;

    /**
     * RandomPinGenerator constructor.
     * @param $model
     */
    function __construct($model) {
        $this->model = $model;
    }


    /**
     * @return int
     */
    public function generate()
    {
        $matchedPins =  0 ;
        $currentPins = Code::count();
        $key = 0;


        if ($currentPins <= $matchedPins) {
            while ($currentPins <= $matchedPins)
            {
                $key = $this->getRandomInteger(1000,9999);

                if ($this->checkUniqueCode($key)) continue;

                $this->storeKey($key);

                break;
            }

        }
        else {
            $key = $this->getRandomInteger(1000,9999);

            $this->storeKey($key);
        }

        return $key;
    }

    /**
     * @param $code
     * @return mixed
     */
    protected function checkUniqueCode($code)
    {
        return $this->model->where('code',$code)->exists();
    }

    /**
     * @param $code
     * @return mixed
     */
    protected function storeKey($code)
    {
        return  $this->model->create(['code'=>$code]);
    }


    /**
     * @param int $min
     * @param int $max
     * @return int
     */
    protected function getRandomInteger($min, $max)
    {
        $range = ($max - $min);

        if ($range < 0) {
            // Not so random...
            return $min;
        }

        $log = log($range, 2);

        // Length in bytes.
        $bytes = (int) ($log / 8) + 1;

        // Length in bits.
        $bits = (int) $log + 1;

        // Set all lower bits to 1.
        $filter = (int) (1 << $bits) - 1;

        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));

            // Discard irrelevant bits.
            $rnd = $rnd & $filter;

        } while ($rnd >= $range);

        return ($min + $rnd);
    }

}
