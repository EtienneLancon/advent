<?php

    class Knot
    {
        private Position $position;

        public function __construct(Position $position)
        {
            $this->position = $position;
        }

        public function follow(Position $position): Position
        {
            $absx = abs($position->x - $this->position->x);
            $absy = abs($position->y - $this->position->y);

            $this->position->y = ($absy <= 1 && $absx < 2) ? $this->position->y : $this->position->y + ($position->y <=> $this->position->y);
            $this->position->x = ($absx <= 1 && $absy < 2) ? $this->position->x : $this->position->x + ($position->x <=> $this->position->x);


            return $this->position;
        }

        public function move(string $direction): Position
        {
            switch($direction)
            {
                case 'U':
                    $this->position->y++;
                    break;
                case 'D':
                    $this->position->y--;
                    break;
                case 'R':
                    $this->position->x++;
                    break;
                case 'L':
                    $this->position->x--;
                    break;
            }
            
            return $this->position;
        }
    }