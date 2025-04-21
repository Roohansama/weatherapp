<?php

if (!function_exists('wind_direction')) {
function wind_direction($deg) {
$dirs = ['N', 'NE', 'E', 'SE', 'S', 'SW', 'W', 'NW'];
return $dirs[round($deg / 45) % 8];
}

}

if (!function_exists('getWindCategory')) {
    function getWindCategory($speed)
    {
        return match (true) {
            $speed < 0.3 => 'Calm',
            $speed < 1.6 => 'Light Air',
            $speed < 3.4 => 'Light Breeze',
            $speed < 5.5 => 'Gentle Breeze',
            $speed < 8.0 => 'Moderate Breeze',
            $speed < 10.8 => 'Fresh Breeze',
            $speed < 13.9 => 'Strong Breeze',
            $speed < 17.2 => 'Near Gale',
            $speed < 20.8 => 'Gale',
            $speed < 24.5 => 'Strong Gale',
            $speed < 28.5 => 'Storm',
            $speed < 32.7 => 'Violent Storm',
            default       => 'Hurricane Force',
        };
    }
}

if(!function_exists('getAqiFromPm10')){
    function getAqiFromPm10($pm10){

        $breakpoints =[
            ['Clow' => 0,   'Chigh' => 54,  'Ilow' => 0,   'Ihigh' => 50],
            ['Clow' => 55,  'Chigh' => 154, 'Ilow' => 51,  'Ihigh' => 100],
            ['Clow' => 155, 'Chigh' => 254, 'Ilow' => 101, 'Ihigh' => 150],
            ['Clow' => 255, 'Chigh' => 354, 'Ilow' => 151, 'Ihigh' => 200],
            ['Clow' => 355, 'Chigh' => 424, 'Ilow' => 201, 'Ihigh' => 300],
            ['Clow' => 425, 'Chigh' => 504, 'Ilow' => 301, 'Ihigh' => 400],
            ['Clow' => 505, 'Chigh' => 604, 'Ilow' => 401, 'Ihigh' => 500],
        ];


        foreach ($breakpoints as $bp) {
            if ($pm10 >= $bp['Clow'] && $pm10 <= $bp['Chigh']) {
                // AQI formula with pm10 value
                $aqi = (($bp['Ihigh'] - $bp['Ilow']) / ($bp['Chigh'] - $bp['Clow']))
                    * ($pm10 - $bp['Clow']) + $bp['Ilow'];
                return round($aqi);
            }
        }

        return null;

    }
}
