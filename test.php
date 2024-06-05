<?php

function bmi($weight, $height)
{
    $categories = [
        '18.5'          => "Underweight",
        '25.0'          => "Normal",
        '30.0'          => "Overweight",
        PHP_INT_MAX => "Obese"
    ];

    $res = $weight / ($height * $height);

    foreach($categories as $threshold => $category) {
        if($res <= (float) $threshold) {
            return $category;
        }
    }
}

echo bmi(110, 1.80);