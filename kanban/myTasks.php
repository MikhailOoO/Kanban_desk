<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Мои задачи</title>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<style>
    body{
        background-color: #333333;
    }
    table {
        font: small-caps bold 20px/1 sans-serif;
        display: table;
        border-radius: 10px;
        margin: auto; 
        width: max-content;
        height: max-content;
        margin-top: 20px;
        margin-bottom: 20px;
        background-color: #EFEFEF;
    }
    .head-col {
        text-align: center;
        background-color: #F0EFF4;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        min-height: min-content;
        width: 300px;
        height: max-content;
        border-radius: 10px;
        margin: 10px;
        display: inline-block;
        position: relative; 
        vertical-align: top;
    }
    .head-col1 {
        text-align: center;
        background-color: #F0EFF4;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        width: 600px;
        height: max-content;
        border-radius: 10px;
        margin: 10px;
        display: inline-block;
        position: relative; 
        vertical-align: top;
    }
    .row_div {
        max-width:500px;
        width: min-content;
        padding: 10px;
        margin-bottom: 10px;
        height: min-content;
        border-radius: 10px;
        text-align: center;
        background-color: #E3E3E8;
        word-wrap: break-word;
        transition: 0.1s linear;
    }
    .row_div:hover{
        background-color: #D3D3E8;
        transform: scale(1.02, 1.02);
    }
    .btn{
        font: small-caps bold 15px/1 sans-serif;
        background-color: rgb(196,198,200);
        transition: 0.1s linear;
    }
    .btn:hover{
        background-color: #78DBE2;
        transform: scale(1.05, 1.05);
    }
    .btnDel{
        font: small-caps bold 15px/1 sans-serif;
        background-color: rgb(196,198,200);
        transition: 0.1s linear;
    }
    .btnDel:hover{
        background-color: #800000;
        transform: scale(1.05, 1.05);
    }
    .m-container {
        text-align: center;
        width: max-content;
        margin: 10px auto;
        padding: 20px;
        border-radius: 10px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        background-color: #EFEFEF;
    }
</style>
<script>
        function clearR(){
            document.getElementById('taskId').value = "-1";
            document.getElementById('head').value = "";
            document.getElementById('body').value = "";
            document.getElementById('date').value = "";
        }
        function deleteTask(){
            var taskid = document.getElementById('taskId').value;
            if(taskid.length>0){
                if(confirm("Данные будут удалены")){
                    let xhr = new XMLHttpRequest();
                    let url = "deleteTask.php";
                    xhr.open("POST", url, true);
                    xhr.setRequestHeader("Content-Type", "application/json");
                    xhr.onerror = function(e) {
                        alert("Error fetching " + e.error);
                    };
                    xhr.onload = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            clearR();
                            getTasks();
                        }
                        else{
                            clearR();
                            getTasks();
                            alert("Ошибка на стороне сервера");
                        }
                    };
                    var data = {
                        taskid : taskid,
                    };
                    xhr.send(JSON.stringify(data));
                }
            }
            else{
                alert("Выберите что удалить!");
            }
        }
        function updateTask(){
            var id = document.getElementById("taskId").value;
            var head = document.getElementById("head").value;
            var body = document.getElementById("body").value;
            var date = document.getElementById("date").value;
            var res = document.getElementById("responsible").value;
            var imp = document.getElementById("importance").value;
            var card = document.getElementById("cards").value;
            if(id!="-1"){
                if(head.length>0 && body.length>0 && date.length>0 && res!="-1" && imp!="-1" && card!="-1"){
                    let xhr = new XMLHttpRequest();
                    let url = "updateTaskMain.php";
                    xhr.open("POST", url, true);
                    xhr.setRequestHeader("Content-Type", "application/json");
                    xhr.onerror = function(e) {
                        alert("Error fetching " + e.error);
                    };
                    xhr.onload = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            alert("Данные обновлены!");
                            clearR();
                            getTasks();
                        }
                        else{
                            clearR();
                            alert("Ошибка на стороне сервера");
                        }
                    };
                    var data = {
                        id : id,
                        head : head,
                        body : body,
                        date : date,
                        res : res,
                        imp : imp,
                        card : card
                    };
                    xhr.send(JSON.stringify(data));
                }
                else{
                    alert("Все поля должны быть заполнены!");
                }
            }
            else{
                alert("Выберите что редактировать!");
            }
        }
        function transportInfo(idT){
            try{
                var trp = JSON.parse(document.getElementById('tsk'+idT).value);
                document.getElementById('taskId').value = trp[0];
                document.getElementById('head').value = trp[2];
                document.getElementById('body').value = trp[3];
                document.getElementById('date').value = trp[7];
                document.getElementById('responsible').value = trp[10];
                document.getElementById('importance').value = trp[9];
                document.getElementById('cards').value = trp[1];
            }
            catch(e){alert("Ошибка на стороне сервера!");}
        }
        function getCookie(name) {
            var matches = document.cookie.match(new RegExp(
                "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
            ));
            return matches ? decodeURIComponent(matches[1]) : undefined;
        }
        function setTaskTable(t){
            try{
                var tb = JSON.parse(t);
                var tbin = "";
                for(var i = 0; i < tb.length; i++){

                    tbin+="<tr><td class = 'row_div' onclick='transportInfo("+tb[i][0]+")'>";

                    tbin+= "<input type='text' id='tsk"+tb[i][0]+"' value = '"+JSON.stringify(tb[i])+"' hidden>";

                    tbin+= tb[i][2] + "<br><br> " + tb[i][3] + "<br><br> " + tb[i][4] +" ("+ tb[i][8] + ")";
                    
                    tbin+="</tb></tr><tr><td><br></td></tr>";
                }
                document.getElementById('tasks').innerHTML = tbin;
            }
            catch(e){
                document.getElementById('tasks').innerHTML = "";
            }
        }
        function getTasks(){
            var desc= document.getElementById('desc').value;
            let xhr = new XMLHttpRequest();
            let url = "getTasks.php";
            xhr.open("POST", url, true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.onerror = function(e) {
                alert("Error fetching " + e.error);
            };
            xhr.onload = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    setTaskTable(this.responseText);
                }
            };
            var data = {
                dc : desc,
                id_user : getCookie("id_user"),
                role : getCookie("role")
            };
            xhr.send(JSON.stringify(data));
        }
        window.onload = function(){
            getTasks();
        }
</script>
</head>
<body>
    <div class = "m-container" >
        <button  class="btn" id = "main">Главная</button>
        <button  class="btn" id = "myTasks">Задачи</button>		
    </div>
    <table id = "table">
        <tr>
            <td class = "head-col">
                <input id = "taskId" value = "-1" hidden>
                <div class="mb-3">
                        <label for="head" class="form-label">Шапка задачи</label>
                        <input  type="text" class="form-control" id="head" maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label">Описание задачи</label>
                        <textarea  type="text" class="form-control" id="body" maxlength="500"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Срок до</label>
                        <input  type="date" id = "date" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="responsible" class="form-label">Ответственный</label>
                        <select  id="responsible" class="form-select" name="responsible">
                            <?php
                                include '../GlobalVar.php';
                                $conn = new mysqli($name, $login, $pass, $db);
                                if($conn->connect_error) {
                                    http_response_code(400);
                                    die("Ошибка: " . $conn->connect_error);
                                    echo "<option value='-1'>" . "Ой, ошибка :(". "</option>";
                                }
                                else{
                                    $sql = "SELECT * FROM user;";
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
                                }
                                $conn->close();
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="importance" class="form-label">Степень важности задачи</label>
                        <select  id="importance" class="form-select" name="importance">
                            <?php
                                include '../GlobalVar.php';
                                $conn = new mysqli($name, $login, $pass, $db);
                                if($conn->connect_error) {
                                    http_response_code(400);
                                    die("Ошибка: " . $conn->connect_error);
                                    echo "<option value='-1'>" . "Ой, ошибка :(". "</option>";
                                }
                                else{
                                    $sql = "SELECT * FROM importance;";
                                    $result = mysqli_query($conn, $sql);
                                    if(mysqli_num_rows($result)>0){
                                        $rows = $result->fetch_all(MYSQLI_NUM);
                                        for($i = 0; $i < sizeof($rows); $i++){
                                            echo "<option  style = 'background-color:". $rows[$i][2] ."' value='" . $rows[$i][0] . "'>" . $rows[$i][1] . "</option>";
                                        }
                                    }
                                    else{
                                        echo "<option value='-1'>" . "Ой, в таблице ничего нет :(". "</option>";
                                    }
                                }
                                $conn->close();
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cards" class="form-label">Карточка</label>
                        <select  id="cards" class="form-select" name="cards">
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
                        </select>
                    </div>
                <button onclick="updateTask()" class="btn">Изменить</button> <button onclick="deleteTask()" class="btn btnDel">Удалить</button>
            </td>
            <td class = "head-col1">
                <div class="mb-3">
                    <label for="head" class="form-label">Поиск по описанию</label>
                    <input type="text" class="form-control" id="desc" maxlength="100">
                </div>
                <table id = "tasks">
                </table>
            </td>
        </tr>  
    </table>
    <script>
        document.getElementById('desc').oninput = function(){
            getTasks()
        }
        document.getElementById('main')
        .addEventListener('click', () => window.open('kanban.php', '_self'));

        document.getElementById('myTasks')
        .addEventListener('click', () => window.open('myTasks.php', '_self'));
    </script>
</body>
</html>