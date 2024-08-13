<?php
class Database{
    private static $instance;

    private function __construct() {
        echo "database connect...\n";
    }

    private function __clone(){}

    public static function getInstance(){
        if (null === static::$instance){
            static::$instance = new Database();
        }
        return static::$instance;
    }

    public function foo($sql){
        return "$sql \n";
    }

}

$singelton = Database::getInstance();
echo ($singelton->foo("SELECT...."));

$singelton2 = Database::getInstance();

if ($singelton === $singelton2){
    echo "TRUE";
}