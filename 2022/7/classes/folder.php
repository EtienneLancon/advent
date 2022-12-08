<?php

    class Folder extends Item implements \Iterator
    {
        private array $items = [];
        private int $index = 0;
        private int $lessThanTenThousandSum = 0;
        static private ?int $currentNearest = null;

        public function __construct(string $name)
        {
            $this->name = $name;
        }
    
        public function next(): void
        {
            $this->index++;
        }

        public function prev(): void
        {
            $this->index--;
        }

        public function rewind(): void
        {
            $this->index = 0;
        }

        public function current()
        {
            return $this->items[$this->index];
        }

        public function key()
        {
            return $this->index;
        }

        public function valid(): bool
        {
            return isset($this->items[$this->index]);
        }

        public function push(Item $item)
        {
            $this->next();
            $this->items[$this->index] = $item;

            $this->size += $item->size;

            if($item instanceof Folder)
            {
                $this->lessThanTenThousandSum += $item->lessThanTenThousandSum;
            }
        }

        public function readContent(array &$consoleInputs): void
        {
            $input = array_shift($consoleInputs);

            if($input === null)
                return;
            
            $input = trim($input);

            if(strpos($input, '$') === 0)
            {
                $input = explode(' ', $input);
                $command = $input[1];

                if($command == 'cd')
                {
                    $dir = $input[2];

                    if($dir == '..')
                    {
                        return;   
                    }
                    else
                    {
                        $newdir = new Folder($dir);
                        $newdir->readContent($consoleInputs);

                        if($newdir->size <= 100000)
                            $this->lessThanTenThousandSum += $newdir->size;

                        $this->push($newdir);
                    }
                }
            }
            else
            {
                if(strpos($input, 'dir') === false)
                {
                    $item = explode(' ', $input);
                    $this->push(new File($item[1], $item[0]));
                }                
            }

            $this->readContent($consoleInputs);
        }

        public function getLessThanTenThousand(): int
        {
            return $this->lessThanTenThousandSum;
        }

        public function getSmallestGreaterThan(int $lowerlimit): int
        {
            foreach($this->items as $current)
            {
                if($current instanceof Folder)
                {
                    if(($current->size > $lowerlimit && $current->size < self::$currentNearest) || self::$currentNearest === null)
                    {
                        self::$currentNearest = $current->size;
                    }

                    $current->getSmallestGreaterThan($lowerlimit);
                }
            }

            return self::$currentNearest;
        }
    }