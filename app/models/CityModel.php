<?php
namespace App\Models;
use App\Entities\City;
use App\Mapper\CityMapper;

class CityModel extends BaseModel {
    

    private static $table = "city";

    public function __construct(){
        parent::__construct(self::$table);
    }


    public function findAll() {
        $rows = parent::findAll();
        $cities = [];
        foreach ($rows as $row) {
            $cities[] = CityMapper::databaseRowToCity($row);
        }
        return $cities;
    }

}