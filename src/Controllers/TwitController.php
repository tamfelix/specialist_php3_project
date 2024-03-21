<?php


namespace Controllers;


use App\Core\Controller;
use App\DB;
use Controllers\Debug;
use Faker\Core\DateTime;
use Model\Twit;
use Model\TwitCollection;

class TwitController extends Controller{

    //функция сохраняющая новый твит
    public static function writeTwit(){
        try{
        $id = intval($_POST['id']);
        $twit = $_POST['twit'];
        $twit1 = new Twit($id, $twit);
            $collection = new TwitCollection();
            $collection->addTwit($twit1);
            //print_r($collection);
            self::getTwits($collection);


        }
        catch (\Exception $exception){echo 'tweet too long';}
        //создаем новый обьект коллекции чтобы сохранить в нее твит


    }


    //распечатывает массив $twits из обьекта коллекции
    public static function getTwits(object $collection){
        foreach ($collection->getGenerator() as $key => $value)
        {
                echo "ID is: $key; " ."tweet is: $value".'<br>';
        }


    }






}



