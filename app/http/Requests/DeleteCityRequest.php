<?php

namespace  App\Http\Requests;
use InvalidArgumentException;
use App\Exception\EntityNotFoundException;
use  App\Models\CityModel;

class DeleteCityRequest {
    private $id;
    private $cityModel;

    public function __construct($id) {
        $this->cityModel = new CityModel();
        $this->validate($id);
        $this->id = $id;
    }

    private function validate($id) {

        if (empty($id)) {
            throw new InvalidArgumentException("The 'id' field is required.");
        }

        if (!$this->cityModel->findById($id)) {
            throw new EntityNotFoundException("The city was not found by id: ".$id);
        }
    }

    public function all() {
        return  $this->id;
    }
}
