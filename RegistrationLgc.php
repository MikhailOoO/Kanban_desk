<?php
	session_start();
	header("Content-Type: application/json");
	$data = json_decode(file_get_contents("php://input"));
	include 'GlobalVar.php';
	$conn = new mysqli($name, $login, $pass, $db);
	if($conn->connect_error){
		http_response_code(400);
		die("Ошибка: " . $conn->connect_error);
	}
	else {
		$query = "SELECT login FROM user WHERE login = '$data->login';";
		$result = mysqli_query($conn, $query);
		if (mysqli_num_rows($result) > 0) {
			echo "Пользователь с таким логином уже есть";
			http_response_code(400);
		} else {
			$sql = "INSERT INTO user (login, pass, role) 
			VALUES ('$data->login','$data->password', '$data->role')";
			$result = mysqli_query($conn, $sql);
			$query = "SELECT id, login, role FROM user WHERE login = '$data->login';";
			$result = mysqli_query($conn, $query);
			if (mysqli_num_rows($result) > 0) {
				$rows = $result->fetch_all(MYSQLI_NUM);
				setcookie("id_user", $rows[0][0], strtotime("+30 days"));
				setcookie("login", $rows[0][1], strtotime("+30 days"));
				setcookie("role", $rows[0][2], strtotime("+30 days"));
				http_response_code(200);
			} else {
				echo "Ошибка";
				http_response_code(400);
			}
		}
	}
	$conn->close();
?> 