<?php

    set_include_path(__DIR__);

    require 'bootstrap.php';

    $priorities = 0;
    foreach(file('./data') as $csvcompartment)
    {
        $ruckstack = new Rucksack(trim($csvcompartment));
        $priorities += $ruckstack->priority;
    }

    echo "\npriorities : ".$priorities."\n";
