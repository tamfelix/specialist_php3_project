<?php

namespace App\Core\Controllers;

use App\Core\Action;
use Psr\Http\Message\{ResponseInterface, ServerRequestInterface};
use ReflectionClass;
use Slim\Psr7\Factory\{ResponseFactory, StreamFactory};

/**
 * //класс для создания документации проекта
 **/

class ReflectionAction extends Action
{
    /**
        * @param ServerRequestInterface $request as per psr-7 interface
        * @return ResponseInterface
     * @secret (метод не запускается без авторизации)

     **/
    //метод для начальной страницы
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        //создаем отображение класса который хотим исследовать (переменная это исследуемый класс)
        $reflection = new ReflectionClass(ReflectionAction::class);
        //сохраняем комментарии на класс в  $body
        $body = $reflection->getDocComment().'<br>';
        //сохраняем названия всех методы в $methods ($methods возвращает коллекцию по которой мы проходим  foreachóm  )
        $methods = $reflection->getMethods();
        foreach ($methods as $method){
            $body .= 'method title: '.$method->getName().'<br>';
            $body .= 'method comments: '.$method->getDocComment().'<br>';
            $args = $method->getParameters(); //возвращяет коллекцию параметров
            foreach ($args as $arg){
                $body .= 'method arguments: '.$arg->getName().'<br>';
            }
        }

        $factory = new ResponseFactory();
        $response = $factory->createResponse(200);
        $stream = (new StreamFactory())->createStream($body);
        return $response->withBody($stream);


    }
}