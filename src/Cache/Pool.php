<?php

namespace App\Cache;

use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Cache\InvalidArgumentException;

class Pool implements CacheItemPoolInterface {

    //возвращяет закэшированный обьект из файла
    public function getItem(string $key): CacheItemInterface
    {
        $filename = __DIR__.'/../../db/cache/'.$key;
        //echo $filename.'<br>';
        if (file_exists($filename)) {
            return unserialize(file_get_contents($filename));
        } else {
            //тк не хорошо возвращять null возвращяем пустой обьект
            return new Item(0, null);
        }
    }

    //принимает закэшированный обьект и закэширует сразу же в файл в папке web/db/cache
    //часто используется
    public function save(CacheItemInterface $item): bool
    {
        $filename = __DIR__.'../../../db/cache/'.$item->getKey();
        return (bool) file_put_contents($filename, serialize($item));
    }

    //закэшировать обьект попозже (только сохраняет его где-то в памяти)
    //кэширование обьекта происходит в момент исполнения метода  commit()
    public function saveDeferred(\Psr\Cache\CacheItemInterface $item): bool
    {
    }

    //дает комманду закешировать обьект см выше
    public function commit(): bool
    {

    }

    //вернуть все закэшированные обьекты
    public function getItems(array $keys = []): iterable
    {

    }

    //проверяет наличие обьекта по его айди $key
    public function hasItem(string $key): bool
    {

    }

    //очищает весь кэш
    public function clear(): bool
    {

    }
    //удаляет один элемент кэша по айди $key
    public function deleteItem(string $key): bool
    {

    }
    //удаляет все элементы по ключам в массиве $keys
    public function deleteItems(array $keys): bool
    {

    }

}