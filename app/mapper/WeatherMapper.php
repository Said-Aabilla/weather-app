<?php
namespace App\Mapper;
use App\Entities\Weather;


class WeatherMapper {
    
    public static function databaseRowToWeather($row) {
            $weather = new Weather();
            $weather->setId($row['id']);
            $weather->setCityId($row['city_id']);
            $weather->setTemperature($row['temperature']);
            $weather->setWeatherCondition($row['weather']);
            $weather->setPrecipitation($row['precipitation']);
            $weather->setHumidity($row['humidity']);
            $weather->setWind($row['wind']);
            $weather->setDate($row['date']);
            return $weather;
    }
  
}