<?php

    class Monkey
    {
        public array $items = [];
        public int $inspections = 0;
        private string $fun;
        private $onTrueThrowTo;
        private $onFalseThrowTo;
        private int $divisionTest;

        public function __construct(int $divisionTest, $onTrueThrowTo, $onFalseThrowTo, string $function)
        {
            $this->divisionTest = $divisionTest;
            $this->onTrueThrowTo = $onTrueThrowTo;
            $this->onFalseThrowTo = $onFalseThrowTo;
            $this->fun = $function;
        }

        public function doRound()
        {
            while(count($this->items) > 0)
            {
                $this->inspections++;

                // $this->items[0]->applyFunction($this->fun);

                // if(count($this->items[0]->worrynessValues) == 3 && intval($this->items[0]->worrynessValues[2].$this->items[0]->worrynessValues[1].$this->items[0]->worrynessValues[0]) % $this->divisionTest == 9)
                // {
                //     echo $this->fun."\n";

                //     echo PHP_INT_MAX."\n";
                //     echo "division test : ".$this->divisionTest."\n";
                //     echo "modulo : ".(strval(intval($this->items[0]->worrynessValues[2].$this->items[0]->worrynessValues[1].$this->items[0]->worrynessValues[0]) % $this->divisionTest))."\n";
                //     echo "my modulo ".$this->items[0]->doMod($this->divisionTest)."\n";
                //     var_dump($this->items[0]->worrynessValues);
                //     // var_dump($this->items[0]->beforeSquare);
                //     // var_dump($this->items[0]->afterSquare);
                    
                //     exit;
    
                // }


                if($this->items[0]->applyFunction($this->fun)->doMod($this->divisionTest) == 0)
                    $this->onTrueThrowTo->push(array_shift($this->items));
                else
                    $this->onFalseThrowTo->push(array_shift($this->items));
            }
        }

        public function push(Item $item)
        {
            $this->items[] = $item;
        }

        public function updateThrowTo(array $monkeys)
        {
            $this->onFalseThrowTo = $monkeys[$this->onFalseThrowTo];
            $this->onTrueThrowTo = $monkeys[$this->onTrueThrowTo];
        }
    }