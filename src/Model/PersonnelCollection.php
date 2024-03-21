<?php
namespace Model;

//коллекции используются когда выводится много данных из бд и их кладут в коллекцию а потом итерируют чтобы вывести на экран
class PersonnelCollection{

    private array $users =  [
        '5674574' =>'Vasia',
        '34563456' => 'lena',
        '4563465' =>'stas',
    ];
    private $first = 'benya';
    private $second = 'kosia';


    //метод создающий и возвращающий итератор-генератор из коллекции
    public function getGenerator():\Generator
    {
//        for ($i=0; $i<2; $i++){
//            if($i == 0){
//                yield 'primo: ' => $this->first;
//            } else{
//                yield 'secondo: ' => $this->second;
//            }
//        }

        foreach ($this->users as $key => $value){
            //реализуем контроль доступа к данным
            if ($value === 'Vasia'){
                yield 'user is unknown: ' => 'you dont have access';
            } else {

                //создаем итератор для коллекции PersonnelCollection
                //yield это магическое слово создающее итератор
                //yield $key => $value;
                yield "id: ".$key => "name: ".$value;
            }
        }
    }

}