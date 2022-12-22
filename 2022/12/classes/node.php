<?php

    class Node
    {
        private int $value;
        public int $x;
        public int $y;
        public ?Node $left;
        public ?Node $right;
        public ?Node $top;
        public ?Node $bottom;
        public int $minLength = 1000000000;

        public function __construct(int $charvalue)
        {
            $this->value = $charvalue;
        }

        public function findPathToStart(): int
        {
            return $this->getSmallestAvailablePath(); 
        }

        private function getSmallestAvailablePath(array $wentThroughNodes = []): ?int
        {
            $length = count($wentThroughNodes);

            $this->minLength = $length;

            echo count($wentThroughNodes)."---".$this->minLength."\n";

            if($this->value === 0)
                return count($wentThroughNodes);

            $paths = array();
            if(($hash = $this->getAvailableHash($this->left, $wentThroughNodes, $length)) !== null)
            {
                if(($tmp = $this->left->getSmallestAvailablePath([...$wentThroughNodes, $hash]) !== null))
                    $paths[] = $tmp;
            }

            if(($hash = $this->getAvailableHash($this->top, $wentThroughNodes, $length)) !== null)
            {
                if(($tmp = $this->top->getSmallestAvailablePath([...$wentThroughNodes, $hash]) !== null))
                    $paths[] = $tmp;
            }

            if(($hash = $this->getAvailableHash($this->bottom, $wentThroughNodes, $length)) !== null)
            {
                if(($tmp = $this->bottom->getSmallestAvailablePath([...$wentThroughNodes, $hash]) !== null))
                    $paths[] = $tmp;
            }

            if(($hash = $this->getAvailableHash($this->right, $wentThroughNodes, $length)) !== null)
            {
                if(($tmp = $this->right->getSmallestAvailablePath([...$wentThroughNodes, $hash]) !== null))
                    $paths[] = $tmp;
            }

            $i = 0;

            while($i < count($paths)-1)
            {
                if($paths[$i] > $paths[$i+1])
                {
                    $tmp = $paths[$i];
                    $paths[$i] = $paths[$i+1];
                    $paths[$i+1] = $tmp;
                    $i = 0;
                }
                $i++;
            }

            return $paths[0] ?? null;
        }

        private function getAvailableHash(?Node $node, array $wentThroughNodes, int $length): ?string
        {
            return ($node
                && $node->minLength > $length 
                && $this->value - $node->value <= 1 
                && !in_array(($hash = spl_object_hash($node)), $wentThroughNodes)) 
                ? $hash : null;
        }

        public function getValue(): int
        {
            return $this->value;
        }
    }