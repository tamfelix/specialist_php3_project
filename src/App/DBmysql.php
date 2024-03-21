<?php


namespace App;


use PDO;
use PDOException;

//singleton класс с 1 экземпляром и 1 точкой входа
class DBmysql
{
    private static $instance = null;
    private PDO $dbconn;

    //создание подключения
    public function __construct()
    {
        //$dns пароль и пользователь нужно вынести в настройки приложения
        $dns = 'mysql:dbname=specialist; host=localhost';
        $user = 'root';
        $pwd = '';
        try{
            $this->dbconn = new PDO($dns, $user, $pwd);
        }catch(PDOException $exception){
            echo 'connection not successful:', $exception->getMessage();
        }
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

     //геттер для соединения с бд
    public function getDbconn(): PDO
    {
        return $this->dbconn;
    }



    public function test(): void
    {
        echo 'running...';
    }
}
