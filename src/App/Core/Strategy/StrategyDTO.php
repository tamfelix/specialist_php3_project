<?php

namespace App\Core\Strategy;

class StrategyDTO

{
    private string $body;


    public function __construct(string $body)
    {
        $this->body = $body;
    }

    public function getBody():string
    {
        return $this->body;
    }

}