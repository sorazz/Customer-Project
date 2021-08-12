<?php
    
    class customerController{

        // Connection
        private $conn;

        // Table
        private $db_table = "customers";

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        
        //Calculating the location from latitude and longitude 
         function location()
            {
                $lat = $this->latitude;
                $lng = $this->longitude;
                $query = "SELECT *,(((ACOS(SIN(($lat*PI()/180)) 
                            * SIN((location_latitude*PI()/180))
                             + COS(($lat*PI()/180)) * COS((location_latitude*PI()/180))
                             * COS((($lng - location_longitude)*PI()/180))))*180/PI())*60*1.1515) 
                            AS distance FROM " . $this->db_table . "
                            ORDER BY distance";

                $stmt = $this->conn->prepare($query);

                $stmt->execute();
                
                return $stmt;
            }
    }
?>