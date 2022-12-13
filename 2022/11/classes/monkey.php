<?php

    class Monkey
    {
        public array $items = [];
        public int $inspections = 0;
        private Closure $fun;
        private $onTrueThrowTo;
        private $onFalseThrowTo;
        private GMP $divisionTest;

        public function __construct($divisionTest, $onTrueThrowTo, $onFalseThrowTo)
        {
            $this->divisionTest = gmp_init($divisionTest);
            $this->onTrueThrowTo = $onTrueThrowTo;
            $this->onFalseThrowTo = $onFalseThrowTo;
        }

        public function readFunction(string $function): void
        {
            $inmembers = explode(' ', $function);

            $this->fun = function(GMP $old) use ($inmembers) {
                $members = $inmembers;

                $var1 = ($members[0] == 'old') ? $old : intval($members[0]);
                $var2 = ($members[2] == 'old') ? $old : intval($members[2]);

                if($members[1] == '+')
                    return gmp_add($var1, $var2);
                
                if($members[1] == '*')
                    return gmp_mul($var1, $var2);
            };
        }

        public function doRound()
        {
            while(count($this->items) > 0)
            {
                $this->inspections++;

                // $this->items[0]->pushFunction($this->fun);

                //if(bcmod($this->items[0]->getWorryness(), $this->divisionTest) == '0')
                if(gmp_intval(gmp_mod($this->items[0]->applyFunction($this->fun), $this->divisionTest)) == 0)
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