<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: post");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once 'db_config.php';
    require 'bootstrap.php';
    include_once 'Customer.php';
    
    use Models\Customer;
    use Illuminate\Database\Connection as DB;

    if(empty($_POST['auth_token']))
         {
            die("please add auth token");
         }
    if($_POST["auth_token"] != '10010001')
    {
        die("You are not authorized");
    }

    $customer = Customer::find($_POST['id']);

    if($customer)
    {
        $customer->delete();
        echo json_encode("Customer deleted.");

        die();
    }

    echo json_encode("Customer does not exist.");
?>