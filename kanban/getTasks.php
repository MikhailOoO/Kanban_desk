<?php
    include 'server.php';
	header("Content-Type: application/json");
	$data = json_decode(file_get_contents("php://input"));
    try{
        echo json_encode(getTasks($data->dc, $data->id_user, $data->role));
        http_response_code(200);
    }
    catch(Exception $e)
    {
        echo $e;
        http_response_code(400);
    }
?> 