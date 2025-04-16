<?php

if (!function_exists('wind_direction')) {
function wind_direction($deg) {
$dirs = ['N', 'NE', 'E', 'SE', 'S', 'SW', 'W', 'NW'];
return $dirs[round($deg / 45) % 8];
}
}
