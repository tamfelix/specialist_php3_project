<?php

return [
'dashboard'=> 'AuthController::loggedin',
'login' =>'AuthController::login',
'contact' => 'PagesController::contact',
'about' => 'PagesController::about',
'cart' => 'PagesController::cart',
'loggedin' =>'AuthController::loggedin',
'checktoken' =>'AuthController::сheckToken',
'uploads' => 'FilesController::index',
'compress'=> 'FilesController::compressFile',
'zip' => 'FilesController::zipFile',
'loadfile'=> 'FilesController::uploadFile',
'archive'=> 'FilesController::archiveFile',
'include'=> 'FilesController::includePhar',
'getdate'=> 'DateController::getDate',
'period'=> 'DateController::getPeriod',
'closure'=> 'ClosureController::closure',
'skud'=> 'ClosureController::pacs',
'iterate'=> 'IteratorController::iterate',
'generate'=> 'GeneratorController::generate',
'newtwit'=> 'TwitController::writeTwit',
'twits'=> 'TwitController::getTwits',
'/' => 'PagesController::index',
'index' =>   'PagesController::index',
'testcache' =>   'FilesController::testCache',
'getcache' =>   'FilesController::testCacheGet',
]

?>