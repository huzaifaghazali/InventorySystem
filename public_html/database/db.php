<?php

    class Database {
        
        private $con;

        // function __construct()
        // {
            
        // }


        public function connect(){
            require_once("constants.php");
            $this->con = new Mysqli(HOST, USER, PASS, DB);
            if($this->con){
                return $this->con;
            }
           return "DATABASE_CONNECTION_FAIL";
        }
    }

    
?>