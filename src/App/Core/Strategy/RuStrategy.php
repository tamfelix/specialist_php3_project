<?php

namespace App\Core\Strategy;
use App\Core\Strategy\StrategyDTO;

class RuStrategy extends Strategy
{

    public function run(): StrategyDTO
    {
        return new StrategyDTO('privet eto blogs') ;
    }

}