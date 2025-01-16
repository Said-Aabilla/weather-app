<?php

namespace App\Http\Controllers\Api\V1;
use  App\Http\Controllers\BaseController;
use  App\Http\Requests\CreateCityRequest;
use  App\Models\CityModel;
use InvalidArgumentException;

class CityController extends BaseController {

    private $cityModel;


    public function __construct(){
        $this->cityModel = new CityModel();
    }


    public function index() {
        header('Content-Type: application/json');
        echo json_encode($this->cityModel->findAll());
    }


    public function create() {
        $input = json_decode(file_get_contents('php://input'), true);
        if (!$input) {
            $this->redirect_error("Invalid JSON input.", 400);
        }
        try {
            // Validate 
            $request = new CreateCityRequest($input);
            $result = $this->cityModel->create($request->all());
            http_response_code(201); 
            echo json_encode($result);

        } catch (InvalidArgumentException $e) {
            $this->redirect_error($e->getMessage(), 400);
        } 
    }


}