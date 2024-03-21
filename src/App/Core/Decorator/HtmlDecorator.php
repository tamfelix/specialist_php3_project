<?php

namespace App\Core\Decorator;
use App\Core\Decorator\StrategyDecorator;
use App\Core\Strategy\StrategyDTO;

class HtmlDecorator extends StrategyDecorator
{
public function run(): StrategyDTO
{
    $tags = 'h2';
    $strategyDTO = parent::run();
    $body = $strategyDTO->getBody();
    return new StrategyDTO('<'.$tags.'>'.$body .'</'.$tags.'>');



}

}