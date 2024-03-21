<?php

namespace Support;

class Debug
{
    private object $object;
    public function __construct(object $object)
    {
        $this->object = $object;


    }

    //магический метод чтобы не создавать новаго обьекта класса
    public function __invoke()
    {
        $this->print();
    }

    public function print():void
    {
        echo '<pre>';
        print_r($this->object);
    }

    public function dump(bool $dumb = false):void
    {
        if($dumb == true){
        echo '<pre>';
        var_dump($this->object);
        }else{
            echo '<pre>';
            print_r($this->object);
        }
    }



}