<?php
namespace App\Exception;
use Exception;
class RouteException extends Exception{

   public function __construct($message, $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }



    public function response_error(){
        http_response_code(404);
        header('Content-Type: application/json');
        echo json_encode(['message'=> $this->getMessage(), 'error' =>true]);
        exit();
    }

}