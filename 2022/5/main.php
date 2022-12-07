<?php

    set_include_path(__DIR__);

    require './classes/crate.php';
    require './classes/stack.php';

    $listStack = [];

    $stackscsv = fopen('./data/stacks.csv', 'r');

    $i = 1;

    while(($rowstack = fgetcsv($stackscsv)) !== false)
    {
        $stack = new Stack();

        foreach($rowstack as $crate)
        {
            $stack->push(new Crate($crate));
        }

        $listStack[$i] = $stack;

        $i++;
    }

    // data initied

    $movescsv = fopen('./data/moves.csv', 'r');

    while(($moves = fgetcsv($movescsv)) !== false)
    {
        $crateNumberToMove = $moves[0];
        $fromStackIndex = $moves[1];
        $toStackIndex = $moves[2];

        $listStack[$toStackIndex]->put($listStack[$fromStackIndex]->take($crateNumberToMove));
    }

    foreach($listStack as $stack)
    {
        $stack->draw();
    }