<?php

namespace App\Core;

use App\Core\View;
use App\Core\Controller;
use Controllers\PagesController;
use Controllers\AuthController;
//use App\Core\Request;
use Psr\Http\Message\{RequestInterface, ServerRequestInterface, ResponseInterface};

class Route
{
    public $address;
    public $method;
    public $url;
    private static $request;

    public function __construct()
    {}
    //middleware
    public static function setRequest(RequestInterface $request)
    {
        self::$request = $request;
    }
    //принимает $url  и матчит его с контроллером
    public static function match(string $uri, $action)
    {
        $uriClean = self::$request->getUri()->getPath();
        if ($uri == $uriClean) {
            call_user_func("Controllers\\$action");
        }
    }

    //на уроке
    public static function handle(string $uri, $match)
    {
        //uriClean  очищаем uri от запроса ?a=5
        //$uriClean = explode('?',$_SERVER['REQUEST_URI'])[0];
        //call_user_func("Controllers\\$text");
        $uriClean = self::$request->getUri()->getPath();

        if ($uri == $uriClean) {
            $response = $match();
            //получаем заголовки и отправляем их пользователю
            $headers = $response->getHeaders();
            foreach($headers as $name => $value){
                //задаем  заголовок пришедший из $response
                header($name .' : '. implode(';', $value));
            }
            //в боди ответа возвращяем текст html
            echo $response->getBody();
        }
    }
    public static function resource()
    {
    }
}

