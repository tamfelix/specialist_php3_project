<?php


namespace App\Core\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use DateTime;
use DateTimeZone;

/**
 * class LoggingMiddleware
 * пишет логи по информации о логинах
 */

class LoggingMiddleware implements MiddlewareInterface {

    //место хранения логов
    const LOG_FILE_PATH =  '/web/logs/log.txt';

    // $callback нужен чтобы подключить вторую миддлвару в index.php
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler, $callback = null): ResponseInterface
    {
        //место хранения лога
        $filePath = $request->getServerParams()['DOCUMENT_ROOT'] . self::LOG_FILE_PATH;

        //записываем в лог время,  адрес cтраницы на которой пользователь и his IP
        $time = new DateTime('now', new DateTimeZone('Europe/Berlin'));
        $time = $time->format(DATE_ATOM);
        $url = $request->getUri()->getPath();
        $userIP = $request->getServerParams()['REMOTE_ADDR'];
        $logBody = "$time $url $userIP".PHP_EOL;
            //записываем лог из $requestа
        file_put_contents($filePath, $logBody, FILE_APPEND);
        //исполняем $callback если он не пустой
        if(!is_null($callback)){
            return $callback($request, $handler);
        }
        //вызываем $handler который возвращает response
        return $handler->handle($request);
    }
}
