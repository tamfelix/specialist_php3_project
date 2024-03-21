<?php

namespace App\Core\Middleware;

use Controllers\PagesController;
use Psr\Http\Server\{MiddlewareInterface, RequestHandlerInterface};
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Factory\ResponseFactory;

/**  класс AuthMiddleware
 * метод который проверяет логин и пароль (по basic авторизация)
 */

class AuthMiddleware implements MiddlewareInterface {

    //проверяет пароль и логин
    //принимает обьект RequestHandlerInterface из action.php
    // $callback нужен чтобы подключить вторую миддлвару в index.php
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler, $callback = null): ResponseInterface
    {
        //получаем пароли
        $realUser = 'specialist';
        $realPwd = 'pass';
        $user = $request->getServerParams()['PHP_AUTH_USER'] ?? null;
        $pwd = $request->getServerParams()['PHP_AUTH_PW'] ?? null;

        //исполняем $callback если он не пустой
        if(!is_null($callback)){
            return $callback($request, $handler);
        }

        //если неправильный пароль вернуть ошибку
        if (
            $user !== $realUser
            && $pwd !== $realPwd
        ) {
            $response = (new ResponseFactory())->createResponse(401);
            $response = $response->withHeader('WWW-Authentificate', 'Basic realm=Need Password');
            return $response;

        }
        //если правильный пароль вернуть RequestHandlerInterface $handler
        else{
            //вызываем $handler который возвращает response
            return $handler->handle($request);
        }
    }


}

