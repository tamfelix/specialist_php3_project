<?php

namespace Controllers;
use App\Cache\Item;
use App\Cache\Pool;
use App\Core\Controller;
use App\Core\View;
use App\DB;
use Phar;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Cache\CacheItemInterface;
use Support\Debug;


class FilesController extends Controller {

    public static function index(){
        $vars = [];
        echo View::render('files', 'admin', $vars);
    }


//сжатие и подгрузка файлов c потоками
    public static function compressFile(){

        //открываем поток (первый параметр - поток, второй параметр режим mode)
        //тип данных=ресурс
        $file = fopen('compress.zlib://file1.txt.gz', 'w', );
        //записываем из потока
        fwrite($file, 'image comp');
            //$_FILES['upload']);
        //закрываем поток
        fclose($file);
    }

    //протестировать зип
    public static function zipFile(){
    //
    }


    public static function archiveFile(){
        //phpinfo();
        //указываем имя будущего архива
        $stream = new Phar('archive.phar');
//        //добавляем в этот поток файлы
        $stream['file1.txt'] = 'file1.txt';
        $stream['index'] = '<?php phpinfo();?>';
        //закрыть поток
        $stream->stopBuffering();


    }
//подключение файлов из архива фар
    public static function includePhar(){
        include 'phar://archive.phar/some.txt';
    }

    public static function uploadFile(){
        $file = $_FILES['upload'];
       print_r($file);
    }

    public static function testCache(){
    $item = new Item(1);
    $item->set('some file here');
    echo $item->getKey().'<br>';
    echo 'value: '.$item->get().'<br>';

    $pull = new Pool();
    //кэшируем первый $item
    $pull->save($item);
    $pull->getItem($item->getKey('ID640088c3a79e2'));
    }


    public static function testCacheGet(){
        $pool = new Pool();
        $item = $pool->getItem('ID64008f09dcd19');
        //print_r($item);

        if($item->isHit()){
            (new Debug($pool->getItem('ID64008f09dcd19')))(1);
        }else{
            echo 'cache not found';
        }


    }


}





?>