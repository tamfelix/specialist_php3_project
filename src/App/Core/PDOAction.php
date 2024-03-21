<?php

namespace App\Core;

use App\DBmysql;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Psr7\Factory\StreamFactory;
use Model\Car;


class PDOAction extends Action
{

    public function handle(ServerRequestInterface $request): ResponseInterface
    {   //проверяем вызов по id
        $car = Car::getById(2);
        $body = print_r($car,true);

        $car->setColor('red');
        $car->save();







        $factory = new ResponseFactory();
        $response = $factory->createResponse(200);
        $stream = (new StreamFactory())->createStream($body);
        return $response->withBody($stream);

    }
}