<?php
namespace App\Models;
use App\Entities\City;
use App\Mapper\CityMapper;
use App\Models\WeatherModel;

class CityModel extends BaseModel {
    

    private static $table = "city";
    private $weatherModel;

    public function __construct(){
        parent::__construct(self::$table);
        $this->weatherModel = new WeatherModel();
    }


    public function findAll() {
        $rows = parent::findAll();
        $cities = [];
        foreach ($rows as $row) {
            $cities[] = CityMapper::databaseRowToCity($row);
        }
        return $cities;
    }


    public function delete($id) {
        
        $weather_deleted =$this->weatherModel->deleteByCityId($id);

        $city_deleted = parent::delete($id);
        
        return ($weather_deleted &&  $city_deleted);
    }
}