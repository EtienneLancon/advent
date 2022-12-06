<?php

    class Grid
    {
        public array $possibilities = [];
        static private $width = 5;
        static private $height = 5;

        public function __construct(string $csvnumbers)
        {
            $numbers = explode(';', $csvnumbers);

            for($h = 0; $h < self::$height; $h++)
            {
                $row = [];
                for($w = 0; $w < self::$width; $w++)
                {
                    $row[] = $numbers[($h*self::$width)+$w];
                }

                $this->possibilities[] = new Possibility($row);
            }

            for($w = 0; $w < self::$width; $w++)
            {
                $column = [];
                for($h = 0; $h < self::$height; $h++)
                {
                    $column[] = $numbers[($h*self::$width)+$w];
                }

                $this->possibilities[] = new Possibility($column);
            }
        }

        public function play(int $number): bool
        {
            foreach($this->possibilities as $possibility)
            {
                if($possibility->play($number) === true)
                {
                    return true;
                }
            }

            return false;
        }

        public function getScore(int $number): string
        {
            $score = 0;

            for($w = 0; $w < self::$width; $w++)
            {
                $score += $this->possibilities[$w]->getScore();
            }

            return strval($score*$number);
        }
    }