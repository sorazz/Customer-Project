    <?php
 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once 'db_config.php';
    include_once 'customerController.php';
    require 'bootstrap.php';
    include_once 'validate.php';

    $database = new Database();
    $db = $database->getConnection();

     $validate = new Validate($db);

    //calling validate function to validate inputs
    $validate->locationValidation();

     if ($_POST["auth_token"] != '10010001') {  
        die( "You are not authorized");
     }

    $item = new customerController($db);


    $item->latitude = $_POST['latitude'];
    $item->longitude = $_POST['longitude'];
     $stmt = $item->location();
    $itemCount = $stmt->rowCount();
    echo json_encode($itemCount);

   

    if($itemCount > 0){
        
        $customerArr = array();
        $customerArr["data"] = array();
        $customerArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "fname" => $fname,
                "lname" => $lname,
                "location" => $location,
                "email" => $email,
                "location_longitude" => $location_longitude,
                "location_latitude" => $location_latitude,
                "created_at" => $created_at
            
            );

            array_push($customerArr["data"], $e);
        }
        echo json_encode($customerArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }

?>