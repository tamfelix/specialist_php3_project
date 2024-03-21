<?php

namespace App\Core\Controllers;



use App\Core\Action;
use App\Core\DefineUserLanguage;
use App\Core\View;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Psr7\Factory\StreamFactory;

class PrivateAction extends Action
{

    //определяет язык пользователя
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $userLanguage = DefineUserLanguage::selectLanguageController($request)->getReasonPhrase();
        //echo $userLanguage;
        $args = [];
        //кладем в поток имя метода
        $body = (new StreamFactory())->createStream(View::render('main', 'default', $args));
        if ($userLanguage == 'ru') {
            //возвращаем response с боди в котором лежит html страница
            $response = (new ResponseFactory)->createResponse(200);
            return $response->withBody($body);
        } else {
            //кладем а поток имя метода
            $body = (new StreamFactory())->createStream(View::render('contact', 'default', $args));
            //возвращаем response с боди в котором лежит html страница
            $response = (new ResponseFactory)->createResponse(200);
            return $response->withBody($body);
        }

    }
}
