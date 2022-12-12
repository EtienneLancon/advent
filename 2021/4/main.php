<?php

    set_include_path(__DIR__);

    require ('bootstrap.php');

    $listGrid = array();
    

    foreach(file(__DIR__.'/data/grids.csv') as $grid)
    {
        $listGrid[] = new Grid($grid);
    }

    foreach(include('./data/numbers.php') as $number)
    {
        foreach($listGrid as $key => $grid)
        {
            if($grid->play($number) === true)
            {
                if(count($listGrid) > 1)
                {
                    unset($listGrid[$key]);
                }
                else
                {
                    echo $grid->getScore($number);
    
                    break 2;
                }
            }
        }
    }