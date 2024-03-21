<?php

namespace Controllers;


use App\Core\Controller;
use App\DB;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Support\Debug;
use Faker\Core\DateTime;


class AdminController extends Controller
{

    public static function index()
    {
        echo 'admin page';
    }


    public static function handle(ServerRequestInterface $request): ResponseInterface
    {
        // TODO: Implement handle() method.
    }
}









?>