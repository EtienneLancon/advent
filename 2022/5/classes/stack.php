<?php

    class Stack implements \Iterator
    {
        public array $crates = [];
        public $index = 0;

        public function rewind(): void
        {
            $this->index = 0;
        }

        public function current()
        {
            return $this->crates[$this->index];
        }

        public function key()
        {
            return $this->index;
        }

        public function next(): void
        {
            $this->index++;
        }

        public function prev(): void
        {
            $this->index--;
        }

        public function valid(): bool
        {
            return isset($this->array[$this->index]);
        }

        public function push(Crate $crate): void
        {
            $this->next();
            $this->crates[$this->index] = $crate;
        }

        public function pop(): Crate
        {
            $this->prev();
            return array_pop($this->crates);
        }

        public function draw(): void
        {
            echo $this->crates[$this->index]->letter;
        }

        public function take(int $nb): array
        {
            $outcrates = [];

            for($i = $nb; $i >= 1; $i--)
            {
                $outcrates[$i] = $this->pop();
            }

            return $outcrates;
        }

        public function put(array $incrates): void
        {
            for($i = 1; $i <= count($incrates); $i++)
            {
                $this->push($incrates[$i]);
            }
        }
    }