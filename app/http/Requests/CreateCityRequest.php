<?php

namespace  App\Http\Requests;
use InvalidArgumentException;

class CreateCityRequest {
    private $country;
    private $cityLabel;

    public function __construct(array $data) {
        $this->validate($data);
        $this->country = $data['country'];
        $this->cityLabel = $data['city_label'];
    }

    private function validate(array $data) {
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
            'city_label' => $this->cityLabel,
            'country' => $this->country
        ];
    }
}
