<?php

namespace App\Http\Controllers;
use App\Http\Constants\HttpStatusCode;
class BaseController {

    public function redirect_error($error_message, $http_status_code=HttpStatusCode::BAD_REQUEST) {
        $this->redirect([
            'message' => $error_message,
        ], $http_status_code, false);
    }

    public function redirect_created_success($message, $id) {
       $this->redirect([
            'message' => $message,
            'id'=>$id
       ], HttpStatusCode::CREATED, false);
    }

    public function redirect_updated_success($message) {
        $this->redirect([
             'message' => $message,
        ], HttpStatusCode::UPDATED, false);
    }

    public function redirect_deleted_success($message) {
        $this->redirect([
             'message' => $message,
        ], HttpStatusCode::DELETED , false);
    }
    private function redirect($message, $http_code, $bool_error){
        http_response_code($http_code);
        header('Content-Type: application/json');
        echo json_encode([
            'messages' =>$message,
            'isError' => $bool_error,
        ]);
        exit();
    }
}