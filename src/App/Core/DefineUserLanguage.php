<?php

namespace App\Core;

use Psr\Http\Message\{ServerRequestInterface, ResponseInterface};
use Slim\Psr7\{Factory\ResponseFactory, Request, Response};

//use App\Core\{Request,Response};

class DefineUserLanguage {

    private string $userLanguage;

    public function __construct()
    {}

    public static function selectLanguageController(ServerRequestInterface $request):ResponseInterface
    {
        $langHeader = $request->getHeader('Accept-Language');

        $langFromHeader = substr($langHeader[0], 0, 2);

            $userLanguage =  $request->getQueryParams()['lang']
            ?? $request->getParsedBody['lang']
            ?? $request->getCookieParams['lang']
            ?? $langFromHeader
            ?? 'en';
        $response = (new ResponseFactory)->createResponse(200, $userLanguage);
        return $response;
    }










}