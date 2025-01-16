<?php
namespace App\Models;

class CityModel extends BaseModel {
    

    private static $table = "city";

    public function __construct(){
        parent::__construct(self::$table);
    }


  
}