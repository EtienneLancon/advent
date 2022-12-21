<?php

    //algo first part ok, but without by 3 division : 90228 with 20 iterations


    //already guessed
    // 27525223458
    // 27550113160
    // 27538132122
    // 16237878648



    set_include_path(__DIR__);

    require './classes/item.php';
    require './classes/monkey.php';

    $csv = fopen('./data.csv', 'r');

    $monkeys = array();

    while(($row = fgetcsv($csv, 0, ';')) !== false)
    {
        $monkeys[$row[0]] = new Monkey(intval($row[3]), $row[4], $row[5], $row[2]);

        foreach(explode(', ', $row[1]) as $item)
        {
            $monkeys[$row[0]]->push(new Item(intval($item)));
        }

       // $monkeys[$row[0]]->readFunction($row[2]);
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
        echo $monkey->inspections."\n";

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

    echo $greatest[1] * $greatest[0]."\n";