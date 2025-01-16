<?php

namespace App\Http\Controllers\Api\V1;
use  App\Http\Controllers\BaseController;
use  App\Models\CityModel;

class CityController extends BaseController {

    private $cityModel;


    public function __construct(){
        $this->cityModel = new CityModel();
    }


    public function index() {
        echo json_encode($this->cityModel->findAll());
    }


}