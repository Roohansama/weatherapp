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
