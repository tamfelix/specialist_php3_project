<?php

namespace App\Core\Controllers;

use App\Core\Action;
use App\Core\Middleware\AuthMiddleware;
use Psr\Http\Message\{ResponseInterface, ServerRequestInterface};
use ReflectionClass;
use Slim\Psr7\Factory\{ResponseFactory, StreamFactory};

/**
 * //класс для создания документации проекта
 **/

class ReflectionAction1 extends Action
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
        $reflection = new ReflectionClass(AuthMiddleware::class);

        $body = 'info: ';
        //создаем коллекцию файлов в папке мидлвары
        $middlewareDirectory = new \DirectoryIterator($request->getServerParams()['DOCUMENT_ROOT'] . '/web/src/App/Core/Middleware');

        foreach ($middlewareDirectory as $mw){
            if($mw->isDot()){ continue; }
            //получаем имена файлов в папке  мидлвары
            $filename = 'App\Core\Middleware\\'.str_replace('.php', '', $mw->getFilename());
            //создаем отражение и записываем коментарии на класс в боди
            $classReflection = new ReflectionClass($filename);
            //сохраняем комментарии на класс в  $body
            $info  = 'CLASSES:  <br>';
            $info .= '&nbsp;&nbsp; class comments:'.$classReflection->getDocComment().'<br>';
            $info .= '&nbsp;&nbsp; class namespace: '.$classReflection->getNamespaceName().'<br>';

            //сохраняем названия всех методы в $methods ($methods возвращает коллекцию по которой мы проходим  foreachóm  )
            $methods = $classReflection->getMethods();
            $variables = 'class переменные: '.implode($classReflection->getProperties());
            foreach ($methods as $method){
                $info .= 'METHODS: <br>';
                $info .= str_repeat('&nbsp;', 2).' method title: '.$method->getName().'<br>';
                $info .= '&nbsp;&nbsp; method comments: '.$method->getDocComment().'<br>';
                $args = $method->getParameters(); //возвращяет коллекцию параметров
                $info .= '&nbsp;&nbsp; method arguments: <br>';
                foreach ($args as $arg){
                    $info .= '&nbsp;&nbsp;&nbsp;&nbsp;  '.$arg->getName().'<br>';

                }
            $body .= $info.'<hr>';
        }



        }

        $factory = new ResponseFactory();
        $response = $factory->createResponse(200);
        $stream = (new StreamFactory())->createStream($body);
        return $response->withBody($stream);


    }
}