<?php


namespace App\Core\Controllers;
use App\Core\Action;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Psr7\Factory\ServerRequestFactory;
use Slim\Psr7\Factory\StreamFactory;
use App\Core\Strategy;
use App\Core\Decorator\HtmlDecorator;

class BlogAction extends Action {

    public $strategy;

    //принимаем в конструкторе стратегию для языка и запускаем ее
//    public function __construct($strategy){
//        $this->strategy = $strategy;
//
//    }

    public function handle( ServerRequestInterface $request): ResponseInterface
    {
        //стратегия для ру возвращает русский текст
        $body = 'empty';
        if(!is_null($this->strategy)){
        $strategyDTO = ( $this->strategy)->run();
        }


        $factory = new ResponseFactory();
        $response = $factory->createResponse(200);
        $streamFactory = new StreamFactory();
        $stream = $streamFactory->createStream($strategyDTO->getBody());
        return $response->withBody($stream);

    }
}
