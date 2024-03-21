<?php


namespace App;


use SQLite3;

class DB
{
    private static $instance="test.db";

    private $db;

    private final function __construct()
    {
        $this->db= new SQLite3(self::DB_NAME);
        $this->db->connect(self::DB_NAME);
    }

    public static function getInstance(): DB
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function test(): void
    {
        echo 'running...';
    }

    public function getDb(): SQLite3
    {
        return $this->db;
    }
}
