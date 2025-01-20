<?php

namespace App\Http\Controllers\Api\V1;
use  App\Http\Controllers\BaseController;
use  App\Models\WeatherModel;
use  App\Models\CityModel;
use  App\Http\Requests\CreateWeatherRequest;
use  App\Http\Requests\DeleteWeatherRequest;
use Exception;
use App\Exception\EntityNotFoundException;
class WeatherController extends BaseController {


    private $weatherModel;
    private $cityModel;
    

    public function __construct(){
        $this->weatherModel = new WeatherModel();
        $this->cityModel = new CityModel();
    }


    public function index($city_id) {
        if (!$this->cityModel->findById($city_id)) {
            throw new EntityNotFoundException("The city was not found by id: " . $city_id);
        }
        header('Content-Type: application/json');
        echo json_encode($this->weatherModel->findAllByCityId($city_id));        
    }

    public function create($input, $city_id) {
        try {
            $input['city_id'] = $city_id;
            // Validate 
            $request = new CreateWeatherRequest($input);
            $result = $this->weatherModel->create($request->all());
            if($result){
                $this->redirect_created_success('Weather Created Successfully for City: '.$city_id, $result);
            }else{
                $this->redirect_error('Error Creating the Weather for city '.$city_id );
            }

        } catch (Exception $e) {
            $this->redirect_error($e->getMessage());
        } 
    }


    public function delete($city_id, $weather_id)
    {
        try {
            $request = new DeleteWeatherRequest($city_id, $weather_id);
            $result = $this->weatherModel->delete($request->getWeatherId());
            if($result){
                $this->redirect_deleted_success('Weather Deleted Successfully');
            }else{
                $this->redirect_error('Error Deletng the Weather');
            }

        } catch (Exception $e) {
            $this->redirect_error($e->getMessage());
        } 
    }


}