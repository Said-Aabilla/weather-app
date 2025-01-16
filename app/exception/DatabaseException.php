<?php
namespace App\Exception;
use PDOException;
class DatabaseException extends PDOException{

   public function __construct($message, $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }



    public function response_error(){
        echo json_encode(['message'=> $this->getMessage(), 'code' =>$this->getCode()]);
        exit();
    }

}