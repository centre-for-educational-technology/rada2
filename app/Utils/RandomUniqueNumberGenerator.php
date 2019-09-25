<?php

namespace App\Utils;

class RandomUniqueNumberGenerator
{

    protected static $numbers = [
        [3, 7, 9, 1, 4, 2, 6, 8, 0, 5],
        [7, 9, 1, 4, 2, 6, 8, 0, 5, 3],
        [9, 1, 4, 2, 6, 8, 0, 5, 3, 7],
        [1, 4, 2, 6, 8, 0, 5, 3, 7, 9],
        [4, 2, 6, 8, 0, 5, 3, 7, 9, 1],
        [2, 6, 8, 0, 5, 3, 7, 9, 1, 4],
        [6, 8, 0, 5, 3, 7, 9, 1, 4, 2],
        [8, 0, 5, 3, 7, 9, 1, 4, 2, 6],
        [0, 5, 3, 7, 9, 1, 4, 2, 6, 8],
        [5, 3, 7, 9, 1, 4, 2, 6, 8, 0]
    ];

    /**
     * @param int $id
     * @param int $length
     * @return string
     */
    public static function generate(int $id, int $length): string
    {
        $longId = sprintf('%0'.$length.'d', $id);
        $numbers = str_split($longId);
        $number = '';
        $lastNumber = $numbers[$length-1];
        foreach ($numbers as $key => $value) {
            $index = $key + $lastNumber;
            if ($index > 9) {
                $index -= 10;
            }
            $number .= static::$numbers[$index][$value];
        }

        return $number;
    }
}