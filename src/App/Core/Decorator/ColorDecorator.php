<?php

namespace App\Core\Decorator;
use App\Core\Decorator\StrategyDecorator;
use App\Core\Strategy\StrategyDTO;

class ColorDecorator extends StrategyDecorator
{
public function run(): StrategyDTO
{
    $tags = 'h2';
    $strategyDTO = parent::run();
    $body = $strategyDTO->getBody();
    return new StrategyDTO("<span class='text-red-600'>$body</span>" );



}

}