<?php

    class File extends Item
    {
        public function __construct(string $name, int $size)
        {
            $this->name = $name;
            $this->size = $size;
        }
    }