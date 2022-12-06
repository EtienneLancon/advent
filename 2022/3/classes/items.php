<?php

    class Items
    {
        private array $list;

        public function push(string $letter)
        {
            $ord = ord($letter)-96;
            $ord += ($ord < 0) ? 58 : 0;

            $this->list[$ord] = $letter;
        }

        public function exists(string $letter): ?int
        {
            if(($key = array_search($letter, $this->list)) !== false)
            {
                return $key;
            }

            return null;
        }

        public function hasIn(array $letters): array
        {
            return array_intersect_assoc($this->list, $letters);
        }

        public function getList(): array
        {
            return $this->list;
        }
    }