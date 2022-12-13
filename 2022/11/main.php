<?php

    set_include_path(__DIR__);

    require './classes/item.php';
    require './classes/monkey.php';

    $csv = fopen('./data.csv', 'r');

    $monkeys = array();

    while(($row = fgetcsv($csv, 0, ';')) !== false)
    {
        $monkeys[$row[0]] = new Monkey($row[3], $row[4], $row[5]);

        foreach(explode(', ', $row[1]) as $item)
        {
            $monkeys[$row[0]]->push(new Item($item));
        }

        $monkeys[$row[0]]->readFunction($row[2]);
    }

    foreach($monkeys as $monkey)
    {
        $monkey->updateThrowTo($monkeys);
    }

    //data initied

    $t = time();

    for($i = 0; $i < 10000; $i++)
    {
        echo $i.' temps : '.strval(time() - $t)."\n";

        foreach($monkeys as &$monkey)
        {
            $monkey->doRound();
        }
    }

    $greatest = [0, 0];
    foreach($monkeys as $monkey)
    {
        $i = 0;
        while($monkey->inspections > $greatest[$i])
        {
            if($i == 1)
            {
                $tmp = $greatest[1];
                $greatest[1] = $monkey->inspections;
                $greatest[0] = $tmp;
                break;
            }
            else
            {
                $greatest[0] = $monkey->inspections;
            }
            $i++;
        }
    }

    echo "\n RESULT \n\n";

    echo $greatest[1]."\n";
    echo $greatest[0]."\n\n";

    echo gmp_strval(gmp_mul($greatest[1], $greatest[0]))."\n";