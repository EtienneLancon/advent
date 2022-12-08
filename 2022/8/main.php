<?php

    set_include_path(__DIR__);

    require './classes/tree.php';

    $map = file('./data');

    $listTree = array();

    for($i = 0; $i < count($map); $i++)
    {
        $treerange = trim($map[$i]);
        $listTree[$i] = array();

        $treerow = str_split($treerange);

        for($j = 0; $j < count($treerow); $j++)
        {
            $listTree[$i][$j] = new Tree(intval($treerow[$j]));
        }
    }

    for($i = 0; $i < count($listTree); $i++)
    {
        for($j = 0; $j < count($listTree[$i]); $j++)
        {
            $listTree[$i][$j]->right = isset($listTree[$i][$j+1]) ? $listTree[$i][$j+1] : null;
            $listTree[$i][$j]->left = isset($listTree[$i][$j-1]) ? $listTree[$i][$j-1] : null;
            $listTree[$i][$j]->bottom = isset($listTree[$i+1][$j]) ? $listTree[$i+1][$j] : null;
            $listTree[$i][$j]->top = isset($listTree[$i-1][$j]) ? $listTree[$i-1][$j] : null;
        }
    }

    //data initied

    $visiblecount = 0;

    for($i = 0; $i < count($listTree); $i++)
    {
        for($j = 0; $j < count($listTree[$i]); $j++)
        {
            $sees = $listTree[$i][$j]->isVisible();
            if($visiblecount < $sees)
            {
                $visiblecount = $sees;
            }
        }
    }

    echo $visiblecount;