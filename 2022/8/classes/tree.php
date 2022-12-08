<?php

    class Tree
    {
        private int $height;
        public ?Tree $left = null;
        public ?Tree $right = null;
        public ?Tree $top = null;
        public ?Tree $bottom = null;

        public function __construct(int $height)
        {
            $this->height = $height;
        }

        public function isVisible(): int
        {
            $seesleft = $this->isVisibleByLeft($this->height, true, 0);
            $seesright = $this->isVisibleByRight($this->height, true, 0);
            $seesbottom = $this->isVisibleByBottom($this->height, true, 0);
            $seestop = $this->isVisibleByTop($this->height, true, 0);

            return $seesleft*$seesright*$seesbottom*$seestop;
        }

        private function isVisibleByLeft(int $limit, bool $start, int $sees): int
        {
            if(isset($this->left))
                $sees++;

            if(!$start && $this->height >= $limit)
            {
                $sees--;
                return $sees;
            }

            return ($this->left) ? $this->left->isVisibleByLeft($limit, false, $sees) : $sees;
        }

        private function isVisibleByRight(int $limit, bool $start, int $sees): int
        {
            if(isset($this->right))
                $sees++;

            if(!$start && $this->height >= $limit)
            {
                $sees--;
                return $sees;
            }

            return ($this->right) ? $this->right->isVisibleByRight($limit, false, $sees) : $sees;
        }

        private function isVisibleByBottom(int $limit, bool $start, int $sees): int
        {
            if(isset($this->bottom))
                $sees++;

            if(!$start && $this->height >= $limit)
            {
                $sees--;
                return $sees;
            }

            return ($this->bottom) ? $this->bottom->isVisibleByBottom($limit, false, $sees) : $sees;
        }

        private function isVisibleByTop(int $limit, bool $start, int $sees): int
        {
            if(isset($this->top))
                $sees++;

            if(!$start && $this->height >= $limit)
            {
                $sees--;
                return $sees;
            }

            return ($this->top) ? $this->top->isVisibleByTop($limit, false, $sees) : $sees;
        }
    }