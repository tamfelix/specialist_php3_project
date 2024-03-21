<?php


namespace Controllers;


use App\Core\Controller;
use App\DB;
use Support\Debug;
use \DateTime;


class DateController extends Controller{

    public static function getDate()
    {
        //echo date('H:i:s');
        $dateTime = new \DateTime('2 days ago', new \DateTimeZone('EUROPE/Moscow'));
        //echo $dateTime->format(\DateTime::COOKIE);
        //echo $dateTime->format(\DateTime::ATOM);
        //кастомный формат
        echo $dateTime->format('Y-m');
    }

    public static function getPeriod()
    {

        $startPeriod = new \DateTime('now');
        $endPeriod = new \DateTime('tomorrow');
        $difference = $startPeriod->diff($endPeriod);
        //echo $difference->format('s');
        //вызываем обьект как функцию (автоматически вызывается магич метод __invoke)
        //(new Debug($difference))(1);
        echo $difference->h.'<br>';

        //добавляем интервал к начальной дате
        echo $startPeriod->format('h').'<br>';
        echo $startPeriod->add(new \DateInterval('PT2H'))->format('h').'<br>';
        echo $startPeriod->sub(new \DateInterval('PT2H'))->format('h').'<br>';
        echo $endPeriod->getTimestamp();
    }
}