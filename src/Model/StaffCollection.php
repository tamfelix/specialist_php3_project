<?php

namespace Model;

class StaffCollection implements \Iterator
{
    private array $users = [
        '5674574' => 'Vasia',
        '34563456' => 'lena',
        '4563465' => 'stas',
    ];

    private int $position = 0;
    /**
     * @var int[]|string[]
     */
    private array $keys;
    /**
     * @var array|string[]
     */
    private array $values;

    public function __construct()
    {
        $this->keys = array_keys($this->users);
        $this->values = array_values($this->users);
    }

    public function current()
    {
        //возвращяет текущую ключевую позицию (1я,2я,3я,4я)
        return $this->values[$this->position];
    }

    public function next()
    {
        //метод сдвигающий позицию на 1 вперед
        return $this->position += 1;
    }

    public function key()
    {
        return $this->keys[$this->position];
    }

    public function valid()
    {
        return isset($this->keys[$this->position]);
    }

    public function rewind()
    {
        $this->position = 0;
    }
}
