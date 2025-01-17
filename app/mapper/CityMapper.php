<?php
namespace App\Mapper;
use App\Entities\City;


class CityMapper {
    
    public static function databaseRowToCity($row) {
            $city = new City();
            $city->setId($row['id']);
            $city->setCountry($row['country']);
            $city->setCityLabel($row['city_label']);
            $city->setCreationDate($row['CREATION_DATE']);
            return $city;
    }
  
}