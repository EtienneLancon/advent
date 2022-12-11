<?php

    set_include_path(__DIR__);

    $file = fopen('./data.csv', 'r');

    $cycles = 0;
    $x = 0;
    $result = 0;

    //hi i'm ugly

    while(($row = fgetcsv($file)) !== false)
    {
        if($row[0] != 'noop')
        {
            for($i = 1; $i <= 2; $i++)
            {                    
                $cycles++;

                if($cycles == 40)
                {
                    $cycles = 0;
                    echo "\n";
                }

                if($i == 2)
                    $x += intval($row[1]);
                    
                if($cycles >= $x && $cycles < $x+3)
                    echo '#';
                else
                    echo '.';

            }
        }
        else
        {
            $cycles++;

            if($cycles == 40)
            {
                $cycles = 0;
                echo "\n";
            }

                    
            if($cycles >= $x && $cycles < $x+3)
                echo '#';
            else
                echo '.';
        }
    }