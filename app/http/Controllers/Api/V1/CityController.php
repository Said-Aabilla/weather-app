<?php

namespace App\Http\Controllers\Api\V1;
use  App\Http\Controllers\BaseController;
use  App\Http\Requests\CreateCityRequest;
use  App\Http\Requests\UpdateCityRequest;
use  App\Http\Requests\DeleteCityRequest;
use  App\Models\CityModel;
use InvalidArgumentException;
use Exception;
use App\Http\Constants\HttpStatusCode;
class CityController extends BaseController {

    private $cityModel;
    

    public function __construct(){
        $this->cityModel = new CityModel();
    }


    public function index() {
        header('Content-Type: application/json');
        echo json_encode($this->cityModel->findAll());
    }


    public function create($input) {
        if (!$input) {
            $this->redirect_error("Invalid JSON input.");
        }
        try {
            // Validate 
            $request = new CreateCityRequest($input);
            $result = $this->cityModel->create($request->all());
            if($result){
                $this->redirect_created_success('City Created Successfully', $result);
            }else{
                $this->redirect_error('Error Creating the city');
            }

        } catch (Exception $e) {
            $this->redirect_error($e->getMessage());
        } 
    }

    public function update($input, $id)
    {
        if (!$input) {
            $this->redirect_error("Invalid JSON input.");
        }
        try {
            // Validate 
            $input['id']=$id;
            $request = new UpdateCityRequest($input);
            $result = $this->cityModel->update($request->all());
            if($result){
                $this->redirect_updated_success('City Updated Successfully');
            }else{
                $this->redirect_error('Error Updating the city');
            }

        } catch (Exception $e) {
            $this->redirect_error($e->getMessage());
        } 
    }

    public function delete($id)
    {
        try {
            $request = new DeleteCityRequest($id);
            $result = $this->cityModel->delete($request->all());
            if($result){
                $this->redirect_deleted_success('City Deleted Successfully');
            }else{
                $this->redirect_error('Error Deletng the city');
            }

        } catch (Exception $e) {
            $this->redirect_error($e->getMessage(),);
        } 
    }

}