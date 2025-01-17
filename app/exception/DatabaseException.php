<?php
namespace App\Exception;
use PDOException;
class DatabaseException extends PDOException{

   public function __construct($message, $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }



    public function response_error(){
        http_response_code(500);
        header('Content-Type: application/json');
        echo json_encode(['message'=> $this->getMessage(), 'isError' =>true]);
        exit();
    }

}