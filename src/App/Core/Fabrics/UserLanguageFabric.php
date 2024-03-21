<?php
namespace App\Core\Fabrics;

use App\Core\DefineUserLanguage;
use App\Core\Controllers\BlogAction;
use App\Core\Strategy\{RuStrategy, EnStrategy, DeStrategy};

class UserLanguageFabric
{
    //фабрика создает и отдает новую стратегию в зависимости от языка пользователя в $request
    public function create($request){
        $lang = DefineUserLanguage::selectLanguageController($request);
        $strategy = 'App\\Core\\Strategy\\'.ucfirst($lang->getReasonPhrase()).'Strategy';
        return new $strategy;
    }

}