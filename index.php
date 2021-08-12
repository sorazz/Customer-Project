<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once 'db_config.php';
    require 'bootstrap.php';
    include_once 'Customer.php';
    
    use Models\Customer;
    use Illuminate\Database\Connection as DB;

    if(!$_GET['auth_token'] || $_GET['auth_token'] != '10010001')
         {
            die("You are not authorized");
         }

    $customers = Customer::orderBy('fname','asc')->get();

    if(count($customers) > 0){ 
        $data = [];

        foreach($customers as $customer)
        {
            $data[]=[
                "id" => $customer->id,
                "fname" => $customer->fname,
                "lname" => $customer->lname,
                "location" => $customer->location,
                "email" => $customer->email,
                "location_longitude" => $customer->location_longitude,
                "location_latitude" => $customer->location_latitude,
                "created_at" => $customer->created_at
            ];
        }

        echo json_encode($data);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>