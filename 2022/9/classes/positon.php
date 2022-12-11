<?php

    class Position
    {
        public int $x;
        public int $y;

        public function __construct($x, $y)
        {
            $this->x = $x;
            $this->y = $y;
        }

        public function __toString()
        {
            return $this->x.'_'.$this->y;
        }
    }