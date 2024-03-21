<?php


namespace Model;


use App\DBmysql;

class Car
{

    //делаем методы приватными чтобы их не могли переназначить
    private ?int $id;
    private ?string $brand;
    private ?string $color;
    private ?float $price;
    const TABLE = 'cars';

    public function __construct(?string $brand, ?string $color, ?int $price, int $id = null){
        $this->brand = $brand;
        $this->color = $color;
        $this->price = $price;
        $this->id = $id;
    }

    public function save(): bool
    {
        //подсоединение к бд
        $dnconn = DBmysql::getInstance()->getDbconn();
        $table = self::TABLE;
        if (!is_null($this->id)){
            $sql = "UPDATE  $table SET brand=?, color=?,price=? WHERE id = $this->id";
        }else{
            $sql  = "INSERT INTO $table (brand, color, price) VALUES(?,?,?)";
        }

        $prepare = $dnconn->prepare($sql);
        $prepare->execute([$this->brand, $this->color, $this->price]);

    }

    //вытаскиваем из бд таблицу машины и кладем ее в тело
    public static function getAll(): array
    {
        $dbconn = DBmysql::getInstance()->getDbconn();
        $body = '';
        $res = $dbconn->query("SELECT * FROM 'cars'");
        foreach ($res as $re) {
            return $body .= print_r($re, true);
        }
    }


    public static function getById($id)
    {
        $dnconn = DBmysql::getInstance()->getDbconn();
        $table = self::TABLE;
        $res = $dnconn->query("SELECT * FROM $table where id = $id");
        foreach($res as $item){
           return new self($item['id'], $item['brand'], $item['color'], $item['price']);
        }

    }

    /**
     * @return string|null
     */
    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * @return string|null
     */
    public function getBrand(): ?string
    {
        return $this->brand;
    }

    /**
     * @return float|int|null
     */
    public function getPrice(): float|int|null
    {
        return $this->price;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setColor($color){
        $this->color = $color;
    }
}
