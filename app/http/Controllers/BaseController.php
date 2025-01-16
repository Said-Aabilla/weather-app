<?php

namespace App\Http\Controllers;

class BaseController {


    public function redirect_error($error_message, $http_status) {
        http_response_code($http_status);
        header('Content-Type: application/json');
        echo json_encode([
            'error' => $error_message,
            'status' => $http_status
        ]);
        exit();
    }


}