<?php
include '../GlobalVar.php';
$conn = new mysqli($name, $login, $pass, $db);
if($conn->connect_error) {
    http_response_code(400);
    die("Ошибка: " . $conn->connect_error);
    echo "<option value='-1'>" . "Ой, ошибка :(". "</option>";
}
else{
    $sql = "SELECT * FROM card;";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
        $rows = $result->fetch_all(MYSQLI_NUM);
        for($i = 0; $i < sizeof($rows); $i++){
            echo "<option value='" . $rows[$i][0] . "'>" . $rows[$i][1] . "</option>";
        }
    }
    else{
        echo "<option value='-1'>" . "Ой, в таблице ничего нет :(". "</option>";
    }
}
$conn->close();
?>