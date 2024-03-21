<?php

namespace Controllers;
use App\Core\Action;
use App\Core\Controller;
use Psr\Http\Message\{ServerRequestInterface, ResponseInterface};
use App\DB;
use App\Core\View;
use App\Core\DefineUserLanguage;
use Slim\Psr7\{Request, Response};
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Psr7\Factory\StreamFactory;
//use App\Core\{Request, Response};



class PagesController extends Controller {

    //метод для определения языка пользователя
    //в typehinting указываем интерфейсы а не Request чтобы с библиотеки slim можно было легко
    // перейти на другую библиотеку
    public static function handle(ServerRequestInterface $request): ResponseInterface
    {
        $userLanguage = DefineUserLanguage::selectLanguageController($request)->getReasonPhrase();
        //echo $userLanguage;
        $args=[];
        //кладем в поток имя метода
        $body = (new StreamFactory())->createStream(View::render('main', 'default', $args));
        if($userLanguage == 'ru'){
            //возвращаем response с боди в котором лежит html страница
            $response = (new ResponseFactory)->createResponse(200);
            return $response->withBody($body);
        }else {
            //кладем а поток имя метода
            $body = (new StreamFactory())->createStream(View::render('contact', 'default', $args));
            //возвращаем response с боди в котором лежит html страница
            $response = (new ResponseFactory)->createResponse(200);
            return $response->withBody($body);
        }

    }

    public static function index(){
        $args=[];
        //echo 'main';
        echo View::render('main', 'default', $args);
    }

    public static function contact(){
        //echo 'c';
        $args=[];
        echo View::render('contact', 'default', $args);
    }

    public static function cart(){
        $args=[];
        echo View::render('cart', 'default', $args);
    }
    public static function about(){
        //echo 'a';
        $args=[];
        echo View::render('about', 'default', $args);
    }

}





?>