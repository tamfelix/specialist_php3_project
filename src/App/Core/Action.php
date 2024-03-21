<?php

namespace App\Core;
use App\Core\Strategy\Strategy;
use Psr\Http\Message\{ServerRequestInterface, ResponseInterface};
use Psr\Http\Server\RequestHandlerInterface;
//use App\Core\Request;
//use App\Core\Response;

//метод который логирует и открывает админ панель
abstract class Action implements RequestHandlerInterface {

    protected $strategy;
    /*
     * метод конструктор
    */
    //ч
    public function __construct(Strategy $strategy = null){
        $this->strategy = $strategy;
    }

    abstract public function handle(ServerRequestInterface $request): ResponseInterface;
}