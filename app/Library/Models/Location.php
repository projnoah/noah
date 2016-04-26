<?php

namespace Noah\Library\Models;

use File;
use Stevebauman\Location\Location as BaseLocation;

class Location extends BaseLocation {

    /**
     * Cities.json file path.
     */
    const CITIES_FILE_PATH = 'cities.json';

    /**
     * Get city name by pinyin.
     *
     * @param $pinyin
     * @return mixed
     *
     * @author Cali
     */
    public static function cityName($pinyin)
    {
        $cities = json_decode(File::get(database_path(self::CITIES_FILE_PATH)));
        $city = array_where($cities, function ($key, $value) use ($pinyin) {
            return strtolower($value->pinyin) === strtolower($pinyin);
        });

        return is_null($city) || count($city) === 0 ? $pinyin : array_values($city)[0]->name;
    }
}