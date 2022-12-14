<?php

    set_include_path(__DIR__);

    require './bootstrap.php';

    $consoleInputs = file('./data');

    $root = new Folder('root');

    array_shift($consoleInputs);

    $root->readContent($consoleInputs);

    $spaceToFree = 30000000 - (70000000 - $root->size);

    echo $root->getSmallestGreaterThan($spaceToFree);