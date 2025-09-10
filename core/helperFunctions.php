<?php
function limit_words($string, $word_limit = 128)
{
    $words = explode(" ", $string);
    if (count($words) > $word_limit) {
        $short = implode(" ", array_slice($words, 0, $word_limit)) . "...";
        return [$short, $string];
    }
    return [$string, $string];
}
