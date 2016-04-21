<?php

namespace Noah\Library\Features\Users;

use File;
use Carbon\Carbon;

class Invitation {

    /**
     * Invitation codes file path.
     */
    const INVI_CODES_PATH = 'invicodes.json';

    /**
     * If the code file exists.
     * 
     * @return bool
     * @author Cali
     */
    public static function hasCodes()
    {
        return File::exists(public_path(self::INVI_CODES_PATH));    
    }

    /**
     * Get all the codes.
     * 
     * @return array
     * @author Cali
     */
    public static function getCodes()
    {
        return static::hasCodes() ? json_decode(File::get(public_path(self::INVI_CODES_PATH))) : [];
    }
    
    /**
     * Generate invitation codes.
     * 
     * @param $quantity
     * @author Cali
     */
    public static function generateCodes($quantity)
    {
        $codes = [];
        for ($i = 0; $i < $quantity; $i++) {
            array_push($codes, [
                'code' => str_random(18), 'date' => Carbon::now()->toDateTimeString()
            ]);
        }

        if (! File::exists(public_path(self::INVI_CODES_PATH))) {
            File::put(public_path(self::INVI_CODES_PATH), json_encode($codes));
        } else {
            $content = json_decode(File::get(public_path(self::INVI_CODES_PATH)));
            File::put(public_path(self::INVI_CODES_PATH), json_encode(array_merge($content, $codes)));
        }
    }

    /**
     * Validates a invitation code.
     * 
     * @param $code
     * @return bool
     * 
     * @author Cali
     */
    public static function validatesCode($code)
    {
        if (! File::exists(public_path(self::INVI_CODES_PATH)))
            return false;
        
        $codes = json_decode(File::get(public_path(self::INVI_CODES_PATH)));
        foreach ($codes as $c) {
            if ($c->code == $code)
                return true;
        }
        
        return false;
    }
}