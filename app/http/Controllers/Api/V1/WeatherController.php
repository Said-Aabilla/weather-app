<?php

namespace App\Http\Controllers\Api\V1;
use  App\Http\Controllers\BaseController;

class CityController extends BaseController {


    public function index() {

        if(10<11){
            $this->redirect_error("not found", 404);
        }
        echo json_encode(['test'=> 'test']);
    }


}