<?php

    set_include_path(__DIR__);

    require './classes/positon.php';
    require './classes/knot.php';

    $file = fopen('./data.csv', 'r');

    $startposition = new Position(0, 0);

    $head = new Knot($startposition);

    $tail = array();

    for($i = 1; $i <= 9; $i++)
    {
        $tails[$i] = new Knot(clone($startposition));
    }

    $listVisited = [];

    while(($move = fgetcsv($file)) !== false)
    {
        $direction = $move[0];
        $length = $move[1];

        for($i = 1; $i <= $length; $i++)
        {
            $position = $head->move($direction);
            foreach($tails as $tail)
            {
                $position = $tail->follow($position);
            }
            
            if(in_array($position->__toString(), $listVisited) === false)
                    $listVisited[] = $position->__toString();
        }
    }

    echo count($listVisited)."\n";
    
