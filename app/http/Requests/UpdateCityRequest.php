<?php

namespace  App\Http\Requests;
use InvalidArgumentException;
use App\Exception\EntityNotFoundException;
use  App\Models\CityModel;

class UpdateCityRequest {
    private $id;
    private $country;
    private $cityLabel;
    private $cityModel;

    public function __construct(array $data) {
        $this->cityModel = new CityModel();
        $this->validate($data);
        $this->id = $data['id'];
        $this->country = $data['country'];
        $this->cityLabel = $data['city_label'];
    }

    private function validate(array $data) {

        if (empty($data['id'])) {
            throw new InvalidArgumentException("The 'id' field is required.");
        }

        if (!$this->cityModel->findById($data['id'])) {
            throw new EntityNotFoundException("The city was not found by id: ".$data['id']);
        }

        if (empty($data['country'])) {
            throw new InvalidArgumentException("The 'country' field is required.");
        }

        if (empty($data['city_label'])) {
            throw new InvalidArgumentException("The 'city_label' field is required.");
        }

        if (!is_string($data['country'])) {
            throw new InvalidArgumentException("The 'country' field must be a string.");
        }

        if (!is_string($data['city_label'])) {
            throw new InvalidArgumentException("The 'city_label' field must be a string.");
        }
    }

    public function getCountry() {
        return $this->country;
    }

    public function getCityLabel() {
        return $this->cityLabel;
    }

    public function all() {
        return [
            'id' => $this->id,
            'city_label' => $this->cityLabel,
            'country' => $this->country
        ];
    }
}
