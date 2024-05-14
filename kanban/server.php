<?php
    function addTask($user_id, $taskHead, $taskBody, $taskResp, $taskDate, $taskImp, $taskCard){
        include '../GlobalVar.php';
        $conn = new mysqli($name, $login, $pass, $db);
        if($conn->connect_error) {
            $conn->close();
            return false;
        }
        else{
            $sql = "INSERT INTO task (task_from, task_head, task_body, id_card, id_importance, deadline, responsible)
            VALUES ($user_id, '$taskHead', '$taskBody', $taskCard, $taskImp, '$taskDate', $taskResp);";
            $result = mysqli_query($conn, $sql);
            $conn->close();
            return $result;
        }
    }
    function getTable(){
        include '../GlobalVar.php';
        $conn = new mysqli($name, $login, $pass, $db);
        if($conn->connect_error) {
            $conn->close();
            return array();
        }
        else{
                $sql = "SELECT * from card;";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result)>0){
                    $head = $result->fetch_all(MYSQLI_NUM);
                    $sql = "SELECT task.id, task.id_card, task.task_head, task.task_body, card.card_head, us.login, importance.color, task.deadline, us1.login, task.id_importance, task.responsible
                    from task 
                    INNER JOIN card ON card.id = task.id_card
                    INNER JOIN importance ON importance.id = task.id_importance
                    INNER JOIN user as us ON task.task_from = us.id
                    INNER JOIN user as us1 ON task.responsible = us1.id;";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result)>0){
                        $body= $result->fetch_all(MYSQLI_NUM);
                        $conn->close();
                        return array("head"=>$head, "body"=>$body);
                    }
                    else{
                        $conn->close();
                        return array();
                    }
                }
                else{
                    $conn->close();
                    return array();
                }
        }
    }
    function getTasks($desc, $id_user, $role){
        include '../GlobalVar.php';
        $conn = new mysqli($name, $login, $pass, $db);
        if($conn->connect_error) {
            $conn->close();
            return array();
        }
        else{
            if($role != $adminRoleId){
                $sql = "SELECT task.id, task.id_card, task.task_head, task.task_body, card.card_head, us.login, importance.color, task.deadline, us1.login, task.id_importance, task.responsible
                from task 
                INNER JOIN card ON card.id = task.id_card
                INNER JOIN importance ON importance.id = task.id_importance
                INNER JOIN user as us ON task.task_from = us.id
                INNER JOIN user as us1 ON task.responsible = us1.id
                where task.task_from = $id_user and task.task_body like '%$desc%';";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result)>0){
                    $result = $result->fetch_all(MYSQLI_NUM);
                    $conn->close();
                    return $result;
                }
            }
            else{
                $sql = "SELECT task.id, task.id_card, task.task_head, task.task_body, card.card_head, us.login, importance.color, task.deadline, us1.login, task.id_importance, task.responsible
                from task 
                INNER JOIN card ON card.id = task.id_card
                INNER JOIN importance ON importance.id = task.id_importance
                INNER JOIN user as us ON task.task_from = us.id
                INNER JOIN user as us1 ON task.responsible = us1.id
                where task.task_body like '%$desc%';";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result)>0){
                    $result = $result->fetch_all(MYSQLI_NUM);
                    $conn->close();
                    return $result;
                }
            }
        }
    }
    function updateTasksCard($taskid, $cardid){
        include '../GlobalVar.php';
        $conn = new mysqli($name, $login, $pass, $db);
        if($conn->connect_error) {
            $conn->close();
            return false;
        }
        else{
            $sql = "UPDATE task SET id_card = $cardid WHERE id = $taskid;";
            $result = mysqli_query($conn, $sql);
            $conn->close();
            return $result;
        }
    }
    function updateTask($taskid,$head,$body,$cardid){
        include '../GlobalVar.php';
        $conn = new mysqli($name, $login, $pass, $db);
        if($conn->connect_error) {
            $conn->close();
            return false;
        }
        else{
            $sql = "UPDATE task SET id_card = $cardid, task_head = '$head', task_body = '$body' WHERE id = $taskid;";
            $result = mysqli_query($conn, $sql);
            $conn->close();
            return $result;
        }
    }
    function deleteTask($taskid){
        include '../GlobalVar.php';
        $conn = new mysqli($name, $login, $pass, $db);
        if($conn->connect_error) {
            $conn->close();
            return false;
        }
        else{
            $sql = "DELETE FROM task WHERE id = $taskid;";
            $result = mysqli_query($conn, $sql);
            $conn->close();
            return $result;
        }
    }
    function getHead(){
        include '../GlobalVar.php';
        $conn = new mysqli($name, $login, $pass, $db);
        if($conn->connect_error) {
            $conn->close();
            return array();
        }
        else{
            $sql = "SELECT * FROM card;";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result)>0){
                $result = $result->fetch_all(MYSQLI_NUM);
                $conn->close();
                return $result;
            }
            else{
                $conn->close();
                return array();
            }
        }
    }
    function updateCard($arr){
        include '../GlobalVar.php';
        $flag = true;
        $conn = new mysqli($name, $login, $pass, $db);
        if($conn->connect_error) {
            $conn->close();
            return false;
        }
        else{
            $temp = "";
            $temp1 = "";
            for($i = 0; $i < sizeof($arr); $i+=2){
                $temp = $arr[$i];
                $temp1 = $arr[$i+1];
                $sql = "UPDATE card SET card_head = '$temp' WHERE id = $temp1;";
                $result = mysqli_query($conn, $sql);
                if($result<>true){
                    $flag = false;
                }
            }
            return $flag;
        }
    }
    function deleteCard($cardid){
        include '../GlobalVar.php';
        $conn = new mysqli($name, $login, $pass, $db);
        if($conn->connect_error) {
            $conn->close();
            return false;
        }
        else{
            $sql = "DELETE FROM card WHERE id = $cardid;";
            $result = mysqli_query($conn, $sql);
            $conn->close();
            return $result;
        }
    }
    function insertCard($card){
        include '../GlobalVar.php';
        $conn = new mysqli($name, $login, $pass, $db);
        if($conn->connect_error) {
            $conn->close();
            return false;
        }
        else{
            $sql = "INSERT INTO card (card_head) VALUES ('$card');";
            $result = mysqli_query($conn, $sql);
            $conn->close();
            return $result;
        }
    }
    function updateTaskMain($id,$head,$body,$date,$res,$imp,$card){
        include '../GlobalVar.php';
        $conn = new mysqli($name, $login, $pass, $db);
        if($conn->connect_error) {
            $conn->close();
            return false;
        }
        else{
            $sql = "UPDATE task SET id_card = $card, task_head = '$head', task_body = '$body', id_importance = $imp, deadline = '$date', responsible = $res  WHERE id = $id;";
            $result = mysqli_query($conn, $sql);
            $conn->close();
            return $result;
        }
    }
?>