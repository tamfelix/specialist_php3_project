<?php


namespace App\Core\Strategy;

use App\Core\Strategy\StrategyDTO;

abstract class Strategy{



    abstract public function run(): StrategyDTO;
}

