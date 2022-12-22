<?php

    set_include_path(__DIR__);

    require './classes/node.php';

    $data = file('./data');

    $nodes = array();

    $debut = (new DateTime())->format('Y-m-d H:i:s');

    $index = 0;

    $height = count($data);

    $start = 0;
    $end = 0;

    for($i = 0; $i < $height; $i++)
    {
        $row = str_split(trim($data[$i]));
        $width = count($row);

        for($j = 0; $j < $width; $j++)
        {
            if($data[$i][$j] == 'S')
            {
                $nodes[$index] = new Node(0);
                $start = $index;
            }
            elseif($data[$i][$j] == 'E')
            {
                $nodes[$index] = new Node(ord('z')+1);
                $end = $index;
            }
            else
                $nodes[$index] = new Node(ord($data[$i][$j]));

            $index++;
        }
    }

    for($i = 0; $i < count($nodes); $i++)
    {
        $nodes[$i]->left = $nodes[$i-1] ?? null;
        $nodes[$i]->right = $nodes[$i+1] ?? null;
        $nodes[$i]->top = $nodes[$i-$width] ?? null;
        $nodes[$i]->bottom = $nodes[$i+$width] ?? null;
    }

    echo $nodes[$end]->findPathToStart()."\n";

    echo $debut."\n";
    echo (new DateTime())->format('Y-m-d H:i:s');