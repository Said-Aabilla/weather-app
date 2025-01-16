<?php
namespace App\Models;

class WeatherModel extends BaseModel{
    
    private static $table = "city";

    public function __construct(){
        $this->table_name = self::$table;
    }

}