<?php

    class Shape
    {
        public int $score;
        public string $name;
        public Shape $winsAgainst;
        public Shape $loosesAgainst;

        public function __construct(int $score, string $name)
        {
            $this->score = $score;
            $this->name = $name;
        }

        public function setWinsAgainst(Shape $shape)
        {
            $this->winsAgainst = $shape;
        }

        public function setLoosesAgainst(Shape $shape)
        {
            $this->loosesAgainst = $shape;
        }
    }