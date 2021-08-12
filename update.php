<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once 'db_config.php';
    require 'bootstrap.php';
    include_once 'Customer.php';
    include_once 'validate.php';
    
    use Models\Customer;
    use Illuminate\Database\Connection as DB;


    $database = new Database();
    $db = $database->getConnection();

    $validate = new Validate($db);

    //calling validate function to validate inputs
    $validate->valid();

    if ($_POST["auth_token"] != '10010001') {  
        $error = "You are not authorized"; 
    } 
     
     $customer = Customer::find($_POST['id']);
     if($customer)
     {
        $customer->fname = $_POST['fname'];
        $customer->lname = $_POST['lname'];
        $customer->password = base64_encode($_POST['password']);
        $customer->email = $_POST['email'];
        $customer->location = $_POST['location'];
        $customer->location_latitude = $_POST['location_latitude'];
        $customer->location_longitude = $_POST['location_longitude'];
        $customer->created_at = date('Y-m-d H:i:s');
        $customer->update();
        echo json_encode("Customer data updated.");
     }
     else
     {
        echo json_encode("Customer not found.");
        die();
     }
    
?>