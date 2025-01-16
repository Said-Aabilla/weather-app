<?php
namespace App\Mapper;
use App\Entities\City;


class CityMapper {
    
    public static function DatabaseRowToCity($row) {
            $city = new City();
            $city->setId($row['city_id']);
            $city->setCountry($row['country']);
            $city->setCityLabel($row['city_label']);
            $city->setCreationDate($row['CREATION_DATE']);
            return $city;
    }
  
}