<?php

    set_include_path(__DIR__);

    $ressource = fopen('./data.csv', 'r');

    $overlaps = 0;

    while(($assignments = fgetcsv($ressource)) !== false)
    {
        $tmp = explode('-', $assignments[0]);

        $elf0['min'] = $tmp[0];
        $elf0['max'] = $tmp[1];

        $tmp = explode('-', $assignments[1]);

        $elf1['min'] = $tmp[0];
        $elf1['max'] = $tmp[1];

        if(!($elf0['min'] > $elf1['max'] || $elf1['min'] > $elf0['max']))
        {
            $overlaps++;
        }
    }

    echo $overlaps;