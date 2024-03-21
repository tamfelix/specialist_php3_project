<?php

namespace App\Core\Decorator;

use App\Core\Strategy\Strategy;
use App\Core\Strategy\StrategyDTO;


//всегда наследует от того класса который он декорирует
// (чтобы подходить по типу данных которые он отдает)
abstract class StrategyDecorator extends Strategy

//оборачивает в тэги и возвращает как DTO data transfer object
{
    private $decorator;

    //декорирует вызов $getBody
    //примет обьект strategyDTO
    public function __construct( Strategy $decorator)
    {
        $this->decorator = $decorator;
    }


    public function run(): StrategyDTO
    {

        return $this->decorator->run();
    }


}