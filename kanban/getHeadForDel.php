<?php
    include '../GlobalVar.php';
    $conn = new mysqli($name, $login, $pass, $db);
    if($conn->connect_error) {
        http_response_code(400);
        echo "<option value='-1'>" . "Ой, ошибка :(". "</option>";
        die("Ошибка: " . $conn->connect_error);
    }
    else{
        $sql = "SELECT * FROM card;";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)>0){
            $rows = $result->fetch_all(MYSQLI_NUM);
            for($i = 0; $i < sizeof($rows); $i++){
                echo "<option  value='" . $rows[$i][0] . "'>" . $rows[$i][1] . "</option>";
            }
        }
        else{
            echo "<option value='-1'>" . "Ой, в таблице ничего нет :(". "</option>";
        }
        http_response_code(200);
    }
    $conn->close();
?>