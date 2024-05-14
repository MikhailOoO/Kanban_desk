<?php
	session_start();
	header("Content-Type: application/json");
	$data = json_decode(file_get_contents("php://input"));
	include 'GlobalVar.php';
	$conn = new mysqli($name, $login, $pass, $db);
	if($conn->connect_error){
		echo "!!!";
		http_response_code(400);
		die("Ошибка: " . $conn->connect_error);
	}
	else {
		$query = "SELECT id, role FROM user WHERE login = '$data->login' and pass = '$data->password';";
		$result = mysqli_query($conn, $query);
		if (mysqli_num_rows($result) > 0) {
			$rows = $result->fetch_all(MYSQLI_NUM);
			setcookie("id_user", $rows[0][0], strtotime("+30 days"));
			setcookie("login", $data->login, strtotime("+30 days"));
			setcookie("role", $rows[0][1], strtotime("+30 days"));
			http_response_code(200);
		} else {
			echo "Нет такого пользователя";
			http_response_code(400);
		}
	}
	$conn->close();
?> 