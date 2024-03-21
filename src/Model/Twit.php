<?php


namespace Model;


use App\DB;

class Twit{

    public string $twit;
    public int $id;

    public function __construct($id, $twit)

    {
        $this->validateTwit($twit);
        $this->twit = $twit;
        $this->id = $id;
    }

    public function validateTwit($twit):void
    {
        if (mb_strlen($twit)>140){
            throw new \Exception('twit too long');
        }
    }


    public function save(): bool
    {

    }

    public static function getAll(): array
    {

    }

    public static function createTable()
    {

    }



}
