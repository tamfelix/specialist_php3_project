<?php


namespace Controllers;


use App\Core\Controller;
use App\DB;
use Controllers\Debug;
use Faker\Core\DateTime;
use Iterator;
use Model\PersonnelCollection;



class GeneratorController extends Controller
{
    //распечатывает генератор из коллекции (сам генератор-итератор создан в модели в методе getGenerator())
 public static function generate()
    {
        $collection1 = new PersonnelCollection;
        foreach($collection1->getGenerator() as $key => $value){
            echo $key.$value."<br>";
        };
    }




}