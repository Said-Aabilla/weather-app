<?php

namespace App\Http\Controllers;

class BaseController {


    public function redirect_error($error_message, $http_status_code) {
        http_response_code($http_status_code);
        header('Content-Type: application/json');
        echo json_encode([
            'message' => $error_message,
            'error' => true
        ]);
        exit();
    }


}