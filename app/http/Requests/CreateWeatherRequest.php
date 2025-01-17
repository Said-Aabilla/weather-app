<?php

namespace App\Http\Requests;

use InvalidArgumentException;
use App\Exception\EntityNotFoundException;
use App\Models\CityModel;

class CreateWeatherRequest {
    private $temperature;
    private $cityId;
    private $weatherCondition;
    private $precipitation;
    private $humidity;
    private $wind;
    private $date;
    private $cityModel;

    public function __construct(array $data) {
        $this->cityModel = new CityModel(); 
        $this->validate($data);

        $this->temperature = $data['temperature'];
        $this->cityId = $data['city_id'];
        $this->weatherCondition = $data['weather_condition'];
        $this->precipitation = $data['precipitation'];
        $this->humidity = $data['humidity'];
        $this->wind = $data['wind'];
        $this->date = $data['date'];
    }

    private function validate(array $data) {
        if (!isset($data['temperature']) || !is_numeric($data['temperature'])) {
            throw new InvalidArgumentException("The 'temperature' field is required and must be a number.");
        }

        if (empty($data['city_id'])) {
            throw new InvalidArgumentException("The 'city_id' field is required !");
        }
        if (!$this->cityModel->findById($data['city_id'])) {
            throw new EntityNotFoundException("The city was not found by id: " . $data['city_id']);
        }

        // Weather condition validation
        if (empty($data['weather_condition']) || !is_string($data['weather_condition'])) {
            throw new InvalidArgumentException("The 'weather_condition' field is required and must be a string.");
        }

        // Precipitation validation
        if (!isset($data['precipitation']) || !is_numeric($data['precipitation'])) {
            throw new InvalidArgumentException("The 'precipitation' field is required and must be a number.");
        }

        // Humidity validation
        if (!isset($data['humidity']) || !is_numeric($data['humidity'])) {
            throw new InvalidArgumentException("The 'humidity' field is required and must be a number.");
        }

        // Wind validation
        if (!isset($data['wind']) || !is_numeric($data['wind'])) {
            throw new InvalidArgumentException("The 'wind' field is required and must be a number.");
        }

        // Date validation
        if (empty($data['date']) || !strtotime($data['date'])) {
            throw new InvalidArgumentException("The 'date' field is required and must be a valid date string.");
        }
    }

    public function all() {
        return [
            'temperature' => $this->temperature,
            'city_id' => $this->cityId,
            'weather' => $this->weatherCondition,
            'precipitation' => $this->precipitation,
            'humidity' => $this->humidity,
            'wind' => $this->wind,
            'date' => $this->date
        ];
    }
}
