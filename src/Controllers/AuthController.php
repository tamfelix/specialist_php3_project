<?php

namespace Controllers;
include __DIR__.'../../../db/jwtConst.php';
use App\Core\Controller;
use App\DB;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use App\Core\View;
use Slim\Psr7\Factory\ResponseFactory;
use Psr\Http\Message\{ResponseInterface, ServerRequestInterface};
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Response;


class AuthController extends Controller {

    //запрос на сторонний сайт на basic аутентификацию
    public static function externalAuthRequest (){
        //мы можем посылать запросы на сайт используя функцию filegetcontents() и ее 3ю переменую

        //склеиваем логин и пароль при помощи двоеточие и закодируем строку
        $auth = base64_encode(CORRECT_USER.":".CORRECT_PW);

        //cоздаем переменную контекста для filegetcontents() и вставляем закодированный $auth в заголовок
        $context = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => "Content-Type: application/json \r\n"."Authorization: Basic $auth",
                'content' => '{"query": "query { echo( message: \"Hello World\") }" }',

            ]
        ]);
        //header('Content-Type:Text/plain; charset=UTF-8');

        //отправляем запрос на сайт при помощи filegetcontents() указывая контекст при помощи 3й переменной
        echo file_get_contents('http://localhost/db/auth.php', false, $context);
    }

    //проверка на правильный пароль и логин на сайте
    public static function authorizationCheck(){
        //echo 'auth';

        if($_SERVER['REQUEST_METHOD']=='POST'){
            $name = $_SERVER['PHP_AUTH_USER'];
            $pass = $_SERVER['PHP_AUTH_PW'];
            if($name == CORRECT_USER && $pass == CORRECT_PW){
                //выдать сообщение что пользователь авторизирован
                $token = self::issueToken();
                $message = $name. '  авторизован/a';
                $vars = [
                    'message' => $message,
                    'token' => $token,
                ];

                echo View::render('dashboard', 'admin',$vars);
            }else{echo 'user not authorised';}
        }else{
            header( 'HTTP/1.1 400 Bad Request');
        }
    }
    //метод создающий токен
    public static function issueToken(){
        //создаем массив тела токена
        $payload = [
            'iss' => SERVER_HOST,
            'aud' => SERVER_HOST,
            'iat' => time(),
            'nbf' => time(),
            'exp' => time()+TOKENLIFE
        ];

        //кодируем токен
        $jwt = JWT::encode($payload, SECRET_KEY, ALGORITHM);

        return $jwt;
        //$decoded = JWT::decode($jwt, new Key(SECRET_KEY, 'HS256'));
        //echo '<pre>';
        //print_r($decoded);
    }

    //проверяет токен на валидность
    public static function сheckToken(){
        //$jwt = $_POST['token'];
        $jwt = $_COOKIE['tokencookie'];

            //'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L3dlYiIsImF1ZCI6Imh0dHA6Ly9sb2NhbGhvc3Qvd2ViIiwiaWF0IjoxNjc2NDU0NTE5LCJuYmYiOjE2NzY0NTQ1MTksImV4cCI6MTY3NjQ1NTQxOX0.iB9FCZBnPIKwDylY6jA5JYHoB554So3d13NZvKX-zvc';
//файл для проверки токена и его распечатки
        try{

            $decoded = (array) JWT::decode($jwt, new Key(SECRET_KEY, ALGORITHM));

            echo View::render('checktoken','admin', $decoded);

            //распечатать ip  пользователя
            //print_r($decoded['ip']);
        }
        catch (ExpiredException $exception){die('токен протух, залогинтесь заново');

        }

    }
    public static function login(){

        $vars=[];
        echo View::render('login', 'default', $vars);
        //$body = (new StreamFactory())->createStream(View::render('login', 'default', $vars));
        //return (new ResponseFactory())->createResponse()->withBody($body);
    }

    public static function loggedin(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if($_POST['login']==CORRECT_USER && $_POST['password']==CORRECT_PW){
                $name = CORRECT_USER;
                $token = self::issueToken();
                //в жизни токен записывается в куки
                setcookie('tokencookie', $token);

                $args = ['message'=>"welcome,  $name", 'token' =>$token,];
                echo View::render('main','admin', $args);
            }else{
                $args = ['message'=>"some information is incorrect"];
                echo View::render('dashboard','admin', $args);
            }
        }else{
            header('Content-type: HTTP/1.1 400 Bad Request');
        }
    }

    public static function signin(ServerRequestInterface $request) : ResponseInterface
    {

            $token = self::issueToken();
            $args = ['message'=>"welcome", 'token' =>$token,];
            $body = (new StreamFactory())->createStream(View::render('dashboard','admin', $args));
            //возвращаем response
            $response = (new ResponseFactory)->createResponse(200);
            return $response->withBody($body);

    }

    public static function handle(ServerRequestInterface $request): ResponseInterface
    {
        // TODO: Implement handle() method.
    }
}





?>