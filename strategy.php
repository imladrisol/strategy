<?php

class Context
{
    private $strategy;

    public function __construct(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function setStrategy(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function doSortArray(): void
    {
        $result = $this->strategy->doAlgorithm([1,3,2,8,5,7,4,0]);
        echo implode(",", $result) . "\n";
    }
}

interface Strategy
{
    public function doAlgorithm(array $data): array;
}

class BubbleSortStrategy implements Strategy
{
    public function doAlgorithm(array $arr): array
    {
        $size = count($arr)-1;
        for ($i=0; $i<$size; $i++) {
            for ($j=0; $j<$size-$i; $j++) {
                $k = $j+1;
                if ($arr[$k] < $arr[$j]) {
                    // Swap elements at indices: $j, $k
                    list($arr[$j], $arr[$k]) = array($arr[$k], $arr[$j]);
                }
            }
        }

        return $arr;
    }
}

class QuickSortStrategy implements Strategy
{
    public function doAlgorithm(array $my_array): array
    {
        $loe = $gt = array();
        if(count($my_array) < 2)
        {
            return $my_array;
        }
        $pivot_key = key($my_array);
        $pivot = array_shift($my_array);
        foreach($my_array as $val)
        {
            if($val <= $pivot)
            {
                $loe[] = $val;
            }elseif ($val > $pivot)
            {
                $gt[] = $val;
            }
        }
        return array_merge($this->doAlgorithm($loe),array($pivot_key=>$pivot),$this->doAlgorithm($gt));
    }
}

$context = new Context(new BubbleSortStrategy);
echo "Bubble sort strategy.\n";
$context->doSortArray();

echo "\n";

echo "Quick sort strategy.\n";
$context->setStrategy(new QuickSortStrategy);
$context->doSortArray();