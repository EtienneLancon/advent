<?php

    set_include_path(__DIR__);

    require('./classes/shape.php');

    $rock = new Shape(1, 'rock');
    $paper = new Shape(2, 'paper');
    $scissors = new Shape(3, 'scissors');

    $rock->setWinsAgainst($scissors);
    $paper->setWinsAgainst($rock);
    $scissors->setWinsAgainst($paper);

    $rock->setLoosesAgainst($paper);
    $paper->setLoosesAgainst($scissors);
    $scissors->setLoosesAgainst($rock);

    $shapes = ['A' => $rock, 'B' => $paper, 'C' => $scissors];
    $actions = ['X' => 'loose', 'Y' => 'draw', 'Z' => 'win'];


    $result = 0;

    foreach(file('./data.csv') as $round)
    {
        $plays = explode(';', trim($round));

        $shape = $shapes[$plays[0]];
        $action = $actions[$plays[1]];

        switch($action)
        {
            case 'loose':
                $result += $shape->winsAgainst->score;
                break;
            case 'draw':
                $result += $shape->score + 3;
                break;
            case 'win';
                $result += $shape->loosesAgainst->score + 6;
                break;
        }
    }

    echo $result;