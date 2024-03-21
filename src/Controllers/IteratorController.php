<?php

namespace Controllers;

use App\Core\Controller;
use App\DB;
use Controllers\Debug;
use Faker\Core\DateTime;
use Iterator;
use JetBrains\PhpStorm\Internal\TentativeType;
use Model\StaffCollection;


class IteratorController extends Controller
{
    //выводим информацию из коллекции при помощи итератора (созданного в модели StaffCollection)
    public static function iterate()
    {
        $collection1 = new StaffCollection();
        echo $collection1->current().'<br>';
        echo $collection1->next().'<br>';
        echo $collection1->valid().'<br>';
        echo $collection1->key().'<br>';
        //foreach ($collection1 as $col){print_r($col);}

    }

}


