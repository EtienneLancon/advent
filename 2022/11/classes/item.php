<?php

    class Item
    {
        public GMP $worryness;

        public function __construct($worryness)
        {
            $this->worryness = gmp_init($worryness);
        }

        public function applyFunction(Closure $fun)
        {
            $this->worryness = $fun($this->worryness);
            return $this->worryness;
        }

        // public function pushFunction(Closure $fun)
        // {
        //     $this->functions[] = $fun;
        // }

        // public function getWorryness(): string
        // {
        //     $worryness = $this->worryness;

        //     foreach($this->functions as $function)
        //     {
        //         $worryness = $function($worryness) / 10;
        //     }

        //     $worrystr = strval($worryness);

        //     $dot = explode('.', $worrystr);

        //     for($i = 0; $i < count($this->functions); $i++)
        //     {
                
        //     }
        //     exit;

        //     return bcmul(strval($worryness), bcpow('10', strval(count($this->functions))));
        // }
    }