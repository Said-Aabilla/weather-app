<?php

namespace  App\Http\Requests;
use InvalidArgumentException;
use App\Exception\EntityNotFoundException;
use  App\Models\CityModel;
use App\Models\WeatherModel;

class DeleteWeatherRequest {
    private $weather_id;
    private $city_id;
    private $cityModel;
    private $weatherModel;

    public function __construct($city_id,$weather_id) {
        $this->cityModel = new CityModel();
        $this->weatherModel = new WeatherModel();
        $this->validate($city_id,$weather_id);
        $this->weather_id = $weather_id;
        $this->city_id = $city_id;
    }

    private function validate($city_id,$weather_id) {

        if (empty($weather_id) || empty($city_id)) {
            throw new InvalidArgumentException("The city id and weather id are both required.");
        }

        if (!$this->cityModel->findById($city_id)) {
            throw new EntityNotFoundException("The city was not found by id: ".$city_id);
        }
        if (!$this->weatherModel->findById($weather_id)) {
            throw new EntityNotFoundException("The weather was not found by id: ".$weather_id);
        }
    }

    public function getWeatherId() {
        return $this->weather_id;
    }

    public function all() {
        return [
            'city_id' => $this->cityId,
            'weather_id' => $this->id
       ];
    }
}
