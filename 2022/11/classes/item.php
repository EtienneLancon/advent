<?php

    class Item
    {
        public array $worrynessValues;

        // public array $beforeSquare;
        // public array $afterSquare;

        const base = 100000;

        public function __construct(int $worryness)
        {
            $this->worrynessValues = [$worryness];
        }


        public function applyFunction(string $function)
        {
            $inmembers = explode(' ', $function);
            $members = $inmembers;

            $var1 = $inmembers[0] == 'old' ? $this->worrynessValues : [intval($inmembers[0])];
            $var2 = $inmembers[2] == 'old' ? $this->worrynessValues : [intval($inmembers[2])];
            $tmp1 = is_object ($var1) ? clone $var1 : $var1;
            $tmp2 = is_object ($var2) ? clone $var2 : $var2;

            if($inmembers[0] == 'old' && $inmembers[2] == 'old' && $inmembers[1] == '*')
            {
                // echo "SQUARE\n";
                // var_dump($this->worrynessValues);
                $this->doSquare();

                // var_dump($this->worrynessValues);

                // var_dump($var1[0]*$var1[0]);



                return $this;
            }

            if($members[1] == '+')
            {
                // echo "ADD\n";
                // var_dump($this->worrynessValues);
                $this->worrynessValues = $this->doAdd($var1, $var2);
                // var_dump($this->worrynessValues);
                // if($tmp1[0]+$tmp2[0] != $this->worrynessValues[0])
                // {
                //     echo "stopped on add\n";
                //     var_dump($tmp1);
                //     var_dump($tmp2);
                //     var_dump($tmp1+$tmp2);
                //     var_dump($this->worrynessValues);
                // }
            }
            
            if($members[1] == '*')
            {
                // echo "MUL\n";
                // var_dump($this->worrynessValues);

                //$this->beforeSquare = $this->worrynessValues;
                $this->worrynessValues = $this->doMul($var1, $var2);
                // var_dump($this->worrynessValues);
                //$this->afterSquare = $this->worrynessValues;
                // if($tmp1[0]*$tmp2[0] != $this->worrynessValues[0])
                // {
                //     echo "stopped on mul\n";
                //     var_dump($tmp1);
                //     var_dump($tmp2);
                //     var_dump($tmp1[0]*$tmp2[0]);
                //     var_dump($this->worrynessValues);
                // }
            }

            return $this;
        }

        private function doHold(array &$target, int $index)
        {
            // if(!isset($target[$index]))
            // {
            //     print_r(debug_backtrace());
            //     exit;
            // }
            while(isset($target[$index]) && $target[$index] >= self::base)
            {
                $floor = intval(floor($target[$index] / self::base));

                if(isset($target[$index+1]))
                {
                    $target[$index+1] += $floor;
                }
                else
                {
                    $target[] = $floor;
                }
                
                $target[$index] -= $floor * self::base;

                $index++;
            }
            // if(!isset($target[$index]))
            // {
            //     exit;
            // }
        }

        private function doSquare()
        {
            $result = array();

            // $result[0] = $this->worrynessValues[0] * $this->worrynessValues[0];

            // $this->doHold($result, 0);

            // $count = count($this->worrynessValues);

            // if($count > 1)
            // {
            //     for($i = 1; $i < $count; $i++)
            //     {
            //         if(isset($result[$i]))
            //             $result[$i] += $this->worrynessValues[$i] * $this->worrynessValues[$i-1] * 2;
            //         else
            //             $result[] = $this->worrynessValues[$i] * $this->worrynessValues[$i-1];

            //         $this->doHold($result, $i);
            //     }

            //     if(isset($result[$count]))
            //         $result[$count] += $this->worrynessValues[$count-1] * $this->worrynessValues[$count-1];
            //     else
            //         $result[] = $this->worrynessValues[$count-1] * $this->worrynessValues[$count-1];
                
            //     $this->doHold($result, $count);
            // }

            $count = count($this->worrynessValues)-1;

            for($i = 0; $i < $count; $i++)
            {
                $reverse = $count - $i;
                

            }

            $this->worrynessValues = $result;
        }

        private function doAdd(array $values1, array $values2): array
        {
            for($i = 0; $i < count($values2); $i++)
            {
                $values1[$i] += $values2[$i];

                $this->doHold($values1, $i);
            }

            return $values1;
        }

        private function doMul(array $values1, array $values2): array
        {
            $result = [];

            for($i = 0; $i < count($values1); $i++)
            {
                for($j = 0; $j < count($values2); $j++)
                {
                    $result[$i+$j] = (isset($result[$i+$j]) ? $result[$i+$j] : 0) + ($values1[$i]*$values2[$j]);

                    $this->doHold($result, $i+$j);
                }
            }

            // if(count($result) == 3 && $values2[0] == 13)
            // {
            //     echo "ENTREE\n";
            //     var_dump($values1);
            //     var_dump($values2);
            //     echo "RESULT MUL\n";
            //     var_dump($result);

            // }

            return $result;
        }

        public function doMod(int $divider): int
        {
            $remainders = array();

            for($i = 0; $i < count($this->worrynessValues); $i++)
            {
                $remainders[] = $this->worrynessValues[$i] % $divider;
            }

            for($i = count($remainders)-1; $i > 0; $i--)
            {
                $remainders[$i-1] += self::base * ($remainders[$i] % $divider);
            }

            return $remainders[0] % $divider;
        }
    }