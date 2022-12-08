<?php

    set_include_path(__DIR__);

    $string = str_split(file('./data')[0]);

    for($i = 14; $i <= count($string); $i++)
    {
        $tempArray = [];

        for($j = 0; $j <= 13; $j++)
        {
            $tempArray[$j] = $string[$i-$j];
        }

        $inarray = false;

        for($j = 0; $j <= 13; $j++)
        {
            $searchArray = [];
            
            foreach($tempArray as $key => $temp)
            {
                if($key != $j)
                    $searchArray[] = $temp;
            }

            if(in_array($string[$i-$j], $searchArray))
            {
                $inarray = true;
            }
        }

        if(!$inarray)
        {
            echo $i+1;
            break;
        }
        
    }

