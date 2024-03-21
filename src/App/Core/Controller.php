<?php

namespace App\Core;
use Psr\Http\Message\{ServerRequestInterface, ResponseInterface};

 abstract class Controller{

     abstract public static function handle(ServerRequestInterface $request): ResponseInterface;


 }