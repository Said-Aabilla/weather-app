<?php
namespace App\Config;
require __DIR__."/../../vendor/autoload.php";
use  Dotenv\Dotenv;
use PDO;
use App\Exception\DatabaseException;

class Database {

    private static $pdoSinglton;

    public static function getConnection(){


        if(self::$pdoSinglton != null){
            return self::$pdoSinglton;
        }else{

            try {
                
                $dotenv = Dotenv::createImmutable(__DIR__.'/../../');
                $dotenv->load();
        
                try {
                    $dsn = "mysql:host=".$_ENV['DB_HOST'].";dbname=".$_ENV['DB_NAME'].";charset=utf8mb4";
                    $pdo_instance = new PDO($dsn, $_ENV['DB_USER'],$_ENV['DB_PASSWORD']);    
                } catch (\Throwable $th) {
                    throw new DatabaseException("Internal server error", 150);
                }
            
                self::$pdoSinglton =  $pdo_instance ;
                return self::$pdoSinglton;

            } catch (DatabaseException $e) {
                $e->response_error();
            }

        }

       
    }

    
}
?>