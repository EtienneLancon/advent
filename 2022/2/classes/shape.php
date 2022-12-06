<?php

    class Shape
    {
        private int $score;
        public string $name;
        private Shape $winsAgainst;

        public function __construct(int $score, string $name)
        {
            $this->score = $score;
            $this->name = $name;
        }

        public function setWinsAgainst(Shape $shape)
        {
            $this->winsAgainst = $shape;
        }

        public function scoreAgainst(Shape $shape)
        {
            if($shape->name == $this->name) 
                return $this->score + 3;

            if($shape->name == $this->winsAgainst->name)
                return $this->score + 6;

            return $this->score;
        }
    }