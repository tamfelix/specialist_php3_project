<?php

namespace App\Core\Strategy;
use App\Core\Strategy\StrategyDTO;

class DeStrategy extends Strategy
{

    public function run():StrategyDTO
    {
        return new StrategyDTO('dass sind blogs') ;
    }

}