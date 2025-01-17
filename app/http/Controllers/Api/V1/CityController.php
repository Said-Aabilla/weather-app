<?php

namespace App\Http\Controllers\Api\V1;
use  App\Http\Controllers\BaseController;
use  App\Http\Requests\CreateCityRequest;
use  App\Http\Requests\UpdateCityRequest;
use  App\Models\CityModel;
use InvalidArgumentException;
use Exception;

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
            if($result){
                $this->redirect_created_success('City Created Successfully', $result);
            }else{
                $this->redirect_error('Error Creating the city', 424 );
            }

        } catch (Exception $e) {
            $this->redirect_error($e->getMessage(), 400);
        } 
    }

    public function update($id)
    {

 

        $input = json_decode(file_get_contents('php://input'), true);

        if (!$input) {
            $this->redirect_error("Invalid JSON input.", 400);
        }
        try {
            // Validate 
            $input['id']=$id;
            $request = new UpdateCityRequest($input);
            $result = $this->cityModel->update($request->all());
            if($result){
                $this->redirect_updated_success('City Updated Successfully');
            }else{
                $this->redirect_error('Error Updating the city', 424 );
            }

        } catch (Exception $e) {
            $this->redirect_error($e->getMessage(), 400);
        } 
    }

}