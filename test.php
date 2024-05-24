<?php

function test(callable $callable): void
{
    $a = 10;
    $b = 20;

    echo $callable($a, $b) . PHP_EOL;
}

test(function ($z, $x) {
    $afterZ = $z + 1;
    $afterX = $x + 1;
    return "Before: " . $z . " After: " . $afterZ . PHP_EOL .
        "Before: " . $x . " After: " . $afterX;
});



