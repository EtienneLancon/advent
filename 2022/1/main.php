<?php

    set_include_path(__DIR__);
    
    $highest = [0, 0, 0];

    foreach(file(__DIR__.'/data.csv') as $csvnumbers)
    {
        $sum = 0;

        foreach(explode(';', trim($csvnumbers)) as $number)
        {
            $sum += intval($number);
        }

        $i = 0;

        for($i = 0; $i < 3; $i++)
        {
            if($sum > $highest[$i])
            {
                if($i > 0)
                    $highest[$i-1] = $highest[$i];
    
                $highest[$i] = $sum;
            }
        }


    }


    echo $highest[0]+$highest[1]+$highest[2];