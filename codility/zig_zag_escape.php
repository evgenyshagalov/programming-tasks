<?php

// My n^2 solution for ZigZagEscape task (https://app.codility.com/programmers/task/zig_zag_escape/)

function zigZagEscape(array $H)
{
    $module = 1000000007;

    asort($H);
    $result = 0;
    $n = count($H);
    $h = array_keys($H);
    for ($i=$n-2; $i>=0; --$i) {
        $ownIndex = $h[$i];
        $sum = $sumLess = $sumGreater = $less = $greater = $previous = 0;
        for ($j=$n-1; $j>$i; --$j) {
            $curIndex  = $h[$j];
            $isGreater = $ownIndex < $curIndex;
            if ($isGreater) {
                if ($previous !== $isGreater) {
                    $greater = ($sumLess + 1) % $module;
                }

                $sumGreater = ($sumGreater + $greater) % $module;
                $sum = ($sum + $greater) % $module;
            } else {
                if ($previous !== $isGreater) {
                    $less = ($sumGreater + 1) % $module;
                }

                $sumLess = ($sumLess + $less) % $module;
                $sum = ($sum + $less) % $module;
            }
            $previous = $isGreater;
        }
        $result = ($result + $sum) % $module;
    }
    return ($result + $n) % $module;
}