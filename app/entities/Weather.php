<?php
namespace App\Entities;
use JsonSerializable;

class Weather implements JsonSerializable {
    private $id;
    private $cityId;
    private $temperature;
    private $weatherCondition;
    private $precipitation;
    private $humidity;
    private $wind;
    private $date;

    // Getters and Setters
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getCityId() {
        return $this->cityId;
    }

    public function setCityId($cityId) {
        $this->cityId = $cityId;
    }

    public function getTemperature() {
        return $this->temperature;
    }

    public function setTemperature($temperature) {
        $this->temperature = $temperature;
    }

    public function getWeatherCondition() {
        return $this->weatherCondition;
    }

    public function setWeatherCondition($weatherCondition) {
        $this->weatherCondition = $weatherCondition;
    }

    public function getPrecipitation() {
        return $this->precipitation;
    }

    public function setPrecipitation($precipitation) {
        $this->precipitation = $precipitation;
    }

    public function getHumidity() {
        return $this->humidity;
    }

    public function setHumidity($humidity) {
        $this->humidity = $humidity;
    }

    public function getWind() {
        return $this->wind;
    }

    public function setWind($wind) {
        $this->wind = $wind;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'city_id' => $this->cityId,
            'temperature' => $this->temperature,
            'weather_condition' => $this->weatherCondition,
            'precipitation' => $this->precipitation,
            'humidity' => $this->humidity,
            'wind' => $this->wind,
            'date' => $this->date,
        ];
    }
}
