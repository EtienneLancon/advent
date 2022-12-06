<?php

    class Possibility
    {
        private array $boxes = [];

        public function __construct(array $numbers)
        {
            foreach($numbers as $number)
            {
                $this->boxes[] = new Box(intval($number));
            }
        }

        public function play(int $number): bool
        {
            $win = true;

            foreach($this->boxes as $box)
            {
                if($box->number === $number)
                    $box->checked = true;

                if($box->checked !== true)
                    $win = false;
            }

            return $win;
        }

        public function getScore(): int
        {
            $score = 0;

            foreach($this->boxes as $box)
            {
                if($box->checked === false)
                {
                    $score += $box->number;
                }
            }

            return $score;
        }
    }