<?php

    class Rucksack
    {
        public Compartment $compartment1;
        public Compartment $compartment2;
        public Items $items;
        private string $content;
        public ?int $priority;

        public function __construct(string $content)
        {
            $compartment1 = new Compartment();
            $compartment2 = new Compartment();
            $this->items = new Items();
            $this->content = $content;

            for($i = 0; $i < strlen($content)/2; $i++)
            {
                $letter = $this->getLetter($i);
                $compartment1->push($letter);
                $this->items->push($letter);
            }

            for($i = strlen($content)/2; $i < strlen($content); $i++)
            {
                $letter = $this->getLetter($i);
                $compartment2->push($letter);
                $this->items->push($letter);
            }
        }

        public function hasIn(array $letters): array
        {
            return $this->items->hasIn($letters);
        }

        private function getLetter(int $i): string
        {
            return substr($this->content, $i, 1);
        }

        public function getPriority(string $letter): ?int
        {
            $this->priority = $this->items->exists($letter);
            return $this->priority;
        }
    }