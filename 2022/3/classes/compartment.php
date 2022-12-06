<?php

    class Compartment
    {
        public Items $items;   

        public function __construct()
        {
            $this->items = new Items();
        }

        public function push(string $letter)
        {
            $this->items->push($letter);
        }
    }