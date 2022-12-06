<?php

    set_include_path(__DIR__);

    require 'bootstrap.php';

    $priorities = 0;
    $rucksack = array();
    $i = 0;


    foreach(file('./data') as $csvcompartment)
    {
        
        $i++;
        $rucksack[$i] = new Rucksack(trim($csvcompartment));

        if($i % 3 == 0)
        {
            $letters = $rucksack[1]->hasIn($rucksack[2]->hasIn($rucksack[3]->items->getList()));

            if(count($letters) !== 1)
                throw('too many letters found or none');

            $priorities += key($letters);

            $i = 0;
        }
    }

    echo "\npriorities : ".$priorities."\n";
