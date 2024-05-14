<?php
    include 'server.php';
	header("Content-Type: application/json");
	$data = json_decode(file_get_contents("php://input"));
    try{
        if(insertCard($data->card)){
            http_response_code(200);
        }
        else{
            http_response_code(400);
        }
    }
    catch(Exception $e)
    {
        echo $e;
        http_response_code(400);
    }
?> 