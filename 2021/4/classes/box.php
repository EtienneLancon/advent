<?php

    class Box
    {
        public int $number;
        public bool $checked;

        public function __construct(int $number)
        {
            $this->number = $number;
            $this->checked = false;
        }
    }