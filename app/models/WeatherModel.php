<?php
namespace App\Models;

class WeatherModel extends BaseModel{
    
    private static $table = "weather";

    public function __construct(){
        $this->table_name = self::$table;
    }

}