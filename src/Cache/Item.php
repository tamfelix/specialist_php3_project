<?php

namespace App\Cache;
use Psr\Cache\CacheItemInterface;
use DateTimeInterface;

class Item implements CacheItemInterface
{
    private ?string $key;
    const PREFIX = 'ID';
    public $value;
    private ?DateTimeInterface $expiresAt = null ;

    public function __construct(bool $createKey, $key = null)
    {
        if($createKey){
            $this->key = uniqid(self::PREFIX);
        }else{$this->key = $key;}
    }

//    //метод сериализирующий коллекцию (представить класс как строку)
//    public function __serialize():array
//    {
//
//    }
//
//    // из строки сделать класс коллекции
//    public function __unserialize(array $data): void
//    {
//
//    }

    //Key это уникальный идентификатор кэша
    //генерируется в этом методе или пользователем
    public function getKey(): string
    {
        //создаем ключ (айди) обьекта в конструкторе
        return $this->key;
    }
    // возвращает сам закэшированный обьект
    public function get(): mixed
    {
        return $this->value;
    }
    //возвращает закэширован айтем или кэш уже expired
    public function isHit(): bool
    {
        //проверка не нулевой ли ключ
        if(is_null($this->key)){
            return false;
        }
        //проверка на expiration cache
        if(is_null($this->expiresAt)){
            return 1;
        }
        return $this->expiresAt->getTimestamp() > time();
    }
    //устанавливаем значение и сохраняем в переменной
    public function set(mixed $value)
    {
        $this->value = $value;
        //return $this->$value;
    }

    //функция устанавливает когда кэш должен закончится и обьект надо будет заново кэшировать
    //(это время указывается во время процесса кэширования)
    //старый файл кэша удаляется
    //$expiration дата 12.00
    public function expiresAt(?\DateTimeInterface $expiration): static
    {
        $this->expiresAt = $expiration;
    }
    //указывает сколько времени должно пройти до expiration закэшированного файла
    //$time= колличество секунд
    //дз
    public function expiresAfter(\DateInterval|int|null $time): static
    {
    }
}