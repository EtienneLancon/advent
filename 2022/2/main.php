<?php

    set_include_path(__DIR__);

    require('./classes/shape.php');

    $rock = new Shape(1, 'rock');
    $paper = new Shape(2, 'paper');
    $scissors = new Shape(3, 'scissors');

    $rock->setWinsAgainst($scissors);
    $paper->setWinsAgainst($rock);
    $scissors->setWinsAgainst($paper);

    $shapes = ['A' => $rock, 'B' => $paper, 'C' => $scissors, 'X' => $rock, 'Y' => $paper, 'Z' => $scissors];

    $result = 0;

    foreach(file('./data.csv') as $round)
    {
        $plays = explode(';', trim($round));

        $opponent = $plays[0];
        $me = $plays[1];

        $result += $shapes[$me]->scoreAgainst($shapes[$opponent]);
    }

    echo $result;