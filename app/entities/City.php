<?php
namespace App\Entities;
use JsonSerializable;
class City implements JsonSerializable {
    private $id;
    private $country;
    private $cityLabel;
    private $creationDate;

    // Getters and Setters
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function getCityLabel() {
        return $this->cityLabel;
    }

    public function setCityLabel($cityLabel) {
        $this->cityLabel = $cityLabel;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

    public function jsonSerialize(): mixed {
        return [
            'id' => $this->id,
            'country' => $this->country,
            'city_label' => $this->cityLabel,
            'creation_date' => $this->creationDate,
        ];
    }

}
