<?php


namespace Controllers;


use App\Core\Controller;
use App\DB;
use Support\Debug;



class ClosureController extends Controller{

    public static function closure()
    {
        $a = 4;
        $b = 5;
        $anonymousFunction = function()use($a, $b){
            echo $a.$b;
        };
        //(new Debug($anonymousFunction))();

        //запустить анонимную функцию
        $anonymousFunction();
    }
    //physical access control system
    public static function pacs(){
        //массив руководителей (из бд)
        $leads = [
            'John Connor',
            'Karl Lensberg',
            'Alex Lincoln',
        ];

        $LateArrivedStaff = [
            'Sven Anderson',
            'Ken Buldogger',
            'Lens Karlson',
            'Alex Lincoln'
        ];

        //выборка опоздавших за исключением руководителей
        $finedPersonnel = array_filter($LateArrivedStaff, function($element)use($leads){
            return !in_array($element, $leads);
        });
        print_r($finedPersonnel);
//        foreach($LateArrivedStaff as $employee){
//            if (!in_array($employee, $leads)){
//                $salary = 1000-100;
//            echo $employee." salary is".$salary.'<br>';


        }


}