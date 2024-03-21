<?php

namespace Model;

use Model\Twit;

class TwitCollection
{
    private array $twits=[];

    //метод отображающий все твиты (создает генератор из массива твитов)
    public function getGenerator(): \Generator
    {
        foreach ($this->twits as $value){
            yield $value->id => $value->twit;
        }
    }
    //функция добавляющая новый твит в обьект коллекции
    public function addTwit(Twit $twit)
    {
        $this->twits[] = $twit;
    }
}