<?php

/**
 * @param $value
 * @param $precision
 * @return string
 */
function round_up($value, $precision): string
{
    $pow = pow(10, $precision);
    return (ceil($pow * $value) + ceil($pow * $value - ceil($pow * $value))) / $pow;
}
