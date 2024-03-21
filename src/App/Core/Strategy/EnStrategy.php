<?php

namespace App\Core\Strategy;
use App\Core\Strategy\StrategyDTO;

class EnStrategy extends Strategy
{

    public function run(): StrategyDTO
    {
        return new StrategyDTO('hi these are blogs') ;
    }

}