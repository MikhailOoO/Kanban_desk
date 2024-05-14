<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Главная</title>
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
        margin:auto;
        width: max-content;
        padding:10px;
        margin-top: 20px;
        margin-bottom: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
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
    .external-col {
        padding: 20px;
        border-radius: 10px;
        background-color: #F0EFF4;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        min-height: 300px;
        width: 300px;
        height: max-content;
        margin: 10px;
        display: inline-block;
        position: relative; 
        vertical-align: top;
    }
    .internal-div {
        width: 100%;
        padding: 10px;
        height: min-content;
        border-radius: 3px;
        margin: auto;
        margin-top: 10px;
        text-align: center;
        background-color: #E3E3E8;
        word-wrap: break-word;
        transition: 0.1s linear;
    }
    .internal-div:active{
        background-color: #D3D3E8;
    }
    .internal-div:hover{
        background-color: #D3D3E8;
        transform: scale(1.02, 1.02);
    }
    .openDiv{
        font: small-caps bold 25px/1 sans-serif;
        cursor: pointer;
        user-select: none;
        width: 60px;
        margin-top:20px;
        margin-left:20px;
        transition: 0.1s linear;
        display: none;
    }
    .openDiv:hover{
        color: #78DBE2;
        transform: scale(1.1, 1.1);
    }
    .closeDiv{
        position: absolute;
        text-align: center;
        font: small-caps bold 25px/1 sans-serif;
        cursor: pointer;
        user-select: none;
        width: min-content;
        top:20px;
        right:20px;
        transition: 0.1s linear;
    }
    .closeDiv:hover{
        color: #78DBE2;
        transform: scale(1.1, 1.1);
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
    .m-container {
        text-align: center;
        width: max-content;
        margin: 10px auto;
        padding: 20px;
        border-radius: 10px;
        background-color: #FCFAF9;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        background-color: white;
    }
    .marker{
        position: absolute;
        top: 10px;
        right: 20px;
        width: 30px;
        height: 30px;
        border-radius: 3px;
    }
    .del{
        cursor: pointer;
        font: small-caps bold 25px/1 sans-serif;
        position: absolute;
        bottom: 20px;
        right: 20px;
        width: 30px;
        height: 30px;
        border-radius: 3px;
    }
    .del:hover{
        color: #78DBE2;
        transform: scale(1.1, 1.1);
    }
    .date{
        position: absolute;
        top: 16px;
        left: 20px;
        width: 150px;
        text-align: left;
    }

</style>
<script>
        function openModal(s){
            var test = JSON.parse(document.getElementById("taskInf"+s).value);
            document.getElementById("taskUpdate").value = test[0];
            document.getElementById("headModal").value = test[2];
            document.getElementById("bodyModal").value = test[3];
            document.getElementById("dateModal").value = test[7];
            document.getElementById("responsibleModal").value = test[10];
            document.getElementById("importanceModal").value = test[9];
            document.getElementById("cardsModal").value = test[1];
            new bootstrap.Modal(document.getElementById('updateModal')).show();

        }
        function updTask(modal){
            var id = document.getElementById("taskUpdate").value;
            var head = document.getElementById("headModal").value;
            var body = document.getElementById("bodyModal").value;
            var date = document.getElementById("dateModal").value;
            var res = document.getElementById("responsibleModal").value;
            var imp = document.getElementById("importanceModal").value;
            var card = document.getElementById("cardsModal").value;
            if(id.length>0 && head.length>0 && body.length>0 && date.length>0 && res!="-1" && imp!="-1" && card!="-1"){
                let xhr = new XMLHttpRequest();
                let url = "updateTaskMain.php";
                xhr.open("POST", url, true);
                xhr.setRequestHeader("Content-Type", "application/json");
                xhr.onerror = function(e) {
                    alert("Error fetching " + e.error);
                };
                xhr.onload = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        getInfo();
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
        }
        function insertCard(){
            var newCard = document.getElementById('insCard').value;
            if(newCard.length>0){
                let xhr = new XMLHttpRequest();
                let url = "insertCard.php";
                xhr.open("POST", url, true);
                xhr.setRequestHeader("Content-Type", "application/json");
                xhr.onerror = function(e) {
                    alert("Error fetching " + e.error);
                };
                xhr.onload = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        alert("Данные обновлены.");
                        getInfo();
                        adminPanel();
                        getCards();
                    }
                };
                var data = {
                    card : newCard
                };
                xhr.send(JSON.stringify(data));
            }
            else{
                alert("Поле не должно быть пустым!");
            }
        }
        function clearNewT() {
            document.getElementById('head').value = "";
            document.getElementById('body').value = "";
            document.getElementById('date').value = "";
        }
        function getCookie(name) {
            var matches = document.cookie.match(new RegExp(
                "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
            ));
            return matches ? decodeURIComponent(matches[1]) : undefined;
        }
        function addTask(){
            var head = document.getElementById('head').value;
            var body = document.getElementById('body').value;
            var responsible = document.getElementById('responsible').value;
            var date = document.getElementById('date').value;
            var importance = document.getElementById('importance').value;
            var card = document.getElementById('cards').value;
            if(head.length>0 && body.length>0 && card!="-1" && responsible!="-1" && date.length>0 && importance!="-1"){
                let xhr = new XMLHttpRequest();
                let url = "addTask.php";
                xhr.open("POST", url, true);
                xhr.setRequestHeader("Content-Type", "application/json");
                xhr.onerror = function(e) {
                    alert("Error fetching " + e.error);
                };
                xhr.onload = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        alert("Данные обновлены.");
                        getInfo();
                    }
                };
                var data = {
                    taskU : getCookie('id_user'),
                    taskH : head,
                    taskB : body,
                    taskR : responsible,
                    taskD : date,
                    taskI : importance,
                    taskC : card
                };
                xhr.send(JSON.stringify(data));
            }
            else{
                alert("Все поля должны быть заполнены!");
            }
        }
        function updateTasksCard(taskId, newCardId, oldCard){
            try{
                if(newCardId!=oldCard){
                    let xhr = new XMLHttpRequest();
                    let url = "updateTasksCard.php";
                    xhr.open("POST", url, true);
                    xhr.setRequestHeader("Content-Type", "application/json");
                    xhr.onerror = function(e) {
                        alert("Error fetching " + e.error);
                    };
                    xhr.onload = function () {
                        if (xhr.readyState === 4 && xhr.status !== 200) {
                            location.reload();
                        }
                    };
                    var data = {
                        taskid : taskId,
                        cardid : newCardId
                    };
                    xhr.send(JSON.stringify(data));
                }
            }
            catch(e){
                getInfo();
            }
        }
        function setBehavior(){
            $(function() {
                $(".internal-div").draggable({
                    revert: "invalid",
                    zIndex: 2700,
                    cursor: "grab"
                });

                $(".external-col").droppable({
                    accept: ".internal-div",
                    drop: function(event, ui) {
                        var draggable = ui.draggable;
                        var temp = draggable[0].parentNode.getAttribute('id').substring(4);
                        var dropped = $(this);
                        draggable.appendTo(dropped).css({top: 0, left: 0});
                        updateTasksCard(draggable[0].getAttribute('id').substring(4), draggable[0].parentNode.getAttribute('id').substring(4), temp);
                    }
                });
            });
        }
        function setTable(t){
            try{
                var tb = JSON.parse(t);
                var table = document.getElementById('table');
                table.innerHTM = "";
                var temp = "";
                var head = "<tr>";
                for(var i = 0; i < tb["head"].length; i++){
                    temp = "<td class = 'head-col' id = 'head" + tb["head"][i][0] + "'>" + tb["head"][i][1] + "</td>";
                    head += temp;
                }
                head += "<tr>";
                for(var i = 0; i < tb["head"].length; i++){
                    head += "<td class = 'external-col' id = 'body"+tb["head"][i][0]+"'></td>"
                }
                head += "</tr>";
                table.innerHTML = head;
                var tempE = 0;
                for(var i = 0; i < tb["body"].length; i++){
                    tempE = document.getElementById("body"+tb["body"][i][1]);
                    
                    tempE.innerHTML += "<div class='internal-div' ondblclick = 'openModal("+tb["body"][i][0]+")' title='Отправитель: "+tb["body"][i][5]+"' id = 'task"+tb["body"][i][0]+"'><div class='date'>До: "+tb["body"][i][7]+"</div><div class='marker' style = 'background-color:"+tb["body"][i][6]+";'></div><br><hr><h3>" 
                    + tb["body"][i][2] + "</h3><br><p>" + tb["body"][i][3] + "</p><br><i>Ответсвенный: " + tb["body"][i][8] + "</i><input id = 'taskInf"+tb["body"][i][0]+"' value = '"+JSON.stringify(tb["body"][i])+"' hidden></input><br><hr><br><br><div class = 'del'><img onclick='deleteTask("+tb["body"][i][0]+")' src='../img/del.png' style = 'width: 20px; heigth: 20px;'></div></div>";
                }
                setBehavior();
            }
            catch(e){
                document.getElementById('table').innerHTML = "<center style = 'margin:10px;'>Ошибка при получении данных с сервера! (обновите страницу)</center>";
            }
        }
        function getInfo(){
            var table = document.getElementById('table');
            //table.innerHTML = "<center style = 'margin:10px;'>Обработка запроса...</center>";
            let xhr = new XMLHttpRequest();
            let url = "getTable.php";
            xhr.open("POST", url, true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.onerror = function(e) {
                alert("Error fetching " + e.error);
            };
            xhr.onload = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    setTable(this.responseText);
                }
                else{
                    table.innerHTML = "<center style = 'margin:10px;'>"+this.responseText+"</center>";
                }
            };
            var data = {};
            xhr.send(JSON.stringify(data));
        }
        function updateCard(c){
            var arr = [];
            var flag = false;
            for(var i = 0; i < c; i ++){
                if(document.getElementById("hd"+document.getElementById("ih"+i).value).value.length==0){
                    flag = true;
                    break;
                }
                if(document.getElementById("oldV"+i).value!=document.getElementById("hd"+document.getElementById("ih"+i).value).value ){
                    document.getElementById("oldV"+i).value = document.getElementById("hd"+document.getElementById("ih"+i).value).value;
                    arr.push(document.getElementById("hd"+document.getElementById("ih"+i).value).value);
                    arr.push(document.getElementById("ih"+i).value);
                }
            }
            if(flag == false){
                let xhr = new XMLHttpRequest();
                let url = "updateHead.php";
                xhr.open("POST", url, true);
                xhr.setRequestHeader("Content-Type", "application/json");
                xhr.onerror = function(e) {
                    alert("Error fetching " + e.error);
                };
                xhr.onload = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        getInfo();
                    }
                    else{
                        alert("Произошла ошибка на стороне сервера!");
                        getInfo();
                    }
                };
                var data = {
                    arr : arr
                };
                xhr.send(JSON.stringify(data));
            }
            else{
                alert("Не должно быть пустых полей!");
            }
        }
        function deleteCard(){
            var cardid = document.getElementById('delCard').value;
            if(cardid!=-1){
                if(confirm("Столбец со всеми данными будет удален!")){
                    let xhr = new XMLHttpRequest();
                    let url = "deleteCard.php";
                    xhr.open("POST", url, true);
                    xhr.setRequestHeader("Content-Type", "application/json");
                    xhr.onerror = function(e) {
                        alert("Error fetching " + e.error);
                    };
                    xhr.onload = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            getInfo();
                            adminPanel();
                            getCards();
                        }
                        else{
                            getInfo();
                            adminPanel();
                            getCards();
                            alert("Ошибка на стороне сервера");
                        }
                    };
                    var data = {
                        cardid : cardid,
                    };
                    xhr.send(JSON.stringify(data));
                }
            }
            else{
                alert("Нечего удалять, все удалили(");
            }
            adminPanel();
        }
        function getHeadForDel(){
            var count = 0;
            let xhr = new XMLHttpRequest();
            let url = "getHeadForDel.php";
            xhr.open("POST", url, true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.onerror = function(e) {
                alert("Error fetching " + e.error);
            };
            xhr.onload = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('delCard').innerHTML = this.responseText;
                }
                else{
                    document.getElementById('delCard').innerHTML = "<option value='-1'>Ой, ошибка :(</option>";
                }
            };
            var data = {};
            xhr.send(JSON.stringify(data));
        }
        function adminPanel(){
            try{
                if(getCookie("role") == "3"){
                    var temp = "<br><hr><br><h2 class='text-center mb-4'>Изменить карточку</h2>";
                    var count = 0;
                    let xhr = new XMLHttpRequest();
                    let url = "getHead.php";
                    xhr.open("POST", url, true);
                    xhr.setRequestHeader("Content-Type", "application/json");
                    xhr.onerror = function(e) {
                        alert("Error fetching " + e.error);
                    };
                    xhr.onload = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            var t = JSON.parse(this.responseText);
                            count = t.length;
                            for(var i = 0; i < t.length; i++){
                                temp+="<input  type='text' class='form-control' id='hd"
                                +t[i][0]+"' value = '"+t[i][1]+"' maxlength='100'><input type='text' id='ih"+i+"' value = '"+t[i][0]+"' hidden>"+
                                "<input type='text' id='oldV"+i+"' value = '"+t[i][1]+"' hidden><br>"
                            }
                            temp+="<button onclick='updateCard("+count+")' class='btn'>Изменить</button>";
                        }
                        else{
                            temp="";
                        }
                        document.getElementById('updateHead').innerHTML = temp;
                        document.getElementById('insertCard').innerHTML = "<br><hr><br><h2 class='text-center mb-4'>Добавить карточку</h2><input type='text' class='form-control' id='insCard' maxlength='100'><button style = 'margin-top:20px;'onclick='insertCard()' class='btn'>Добавить</button>";
                        document.getElementById('deleteCard').innerHTML = "<br><hr><br><h2 class='text-center mb-4'>Удалить карточку</h2><select id='delCard' class='form-select' name='delCard'></select><button style = 'margin-top:20px;'onclick='deleteCard()' class='btn'>Удалить</button>";
                        getHeadForDel();
                    };
                    var data = {
                        role : getCookie('role')
                    };
                    xhr.send(JSON.stringify(data));
                    
                }
                getInfo();
            }
            catch(e){ alert(e);}
        }
        window.onload = function(){
            adminPanel();
        }
        function opendiv(){
            var open = document.getElementById('openDiv');
            var close = document.getElementById('closeDiv');
            if(close.style.display == "inline-block"){
                close.style.display = "none";
                open.style.display = "block";
            }
            else{
                close.style.display = "inline-block";
                open.style.display = "none";
            }
        }
        function deleteTask(id){
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
                            getInfo();
                            adminPanel();
                        }
                        else{
                            getInfo();
                            adminPanel();
                            alert("Ошибка на стороне сервера");
                        }
                    };
                    var data = {
                        taskid : id,
                    };
                    xhr.send(JSON.stringify(data));
                }
        }
        function getCards(){
            let xhr = new XMLHttpRequest();
            let url = "getCards.php";
            xhr.open("POST", url, true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.onerror = function(e) {
                alert("Error fetching " + e.error);
            };
            xhr.onload = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('cards').innerHTML = this.responseText;
                }
            };
            var data = {};
            xhr.send(JSON.stringify(data));
        }
    </script>
</head>
<body >
    <div class = "m-container" >
        <button  class="btn" id = "main">Главная</button>
        <button  class="btn" id = "myTasks">Задачи</button>		
    </div>
    <table>
        <tr>
        <td class = "head-col openDiv" id = "openDiv" style = " display:block;" onclick="opendiv()">+</td>
        <td class = "head-col" id = "closeDiv" style = "margin-top: 20px; display:none">
                <div id = "openningDiv" >
                    <p class = "closeDiv" onclick="opendiv()">x</p><br><hr>
                    <h2 class="text-center mb-4">Добавить задачу</h2>
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
                    <button onclick="addTask()" class="btn">Добавить</button> <button onclick="clearNewT()" class="btn">Очистить</button>
                    <div id = "updateHead">
                    </div>
                    <div id = "insertCard">
                    </div>
                    <div id = "deleteCard">
                    </div>
                </div>
            </td>
            <td style = "vertical-align: top;">
                <table id = "table">
                </table>
            </td>
        </tr>
    </table>
    
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="Modal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titleModal">Изменение задачи</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" >
          <form>
                <input id = "taskUpdate" value = "-1" hidden>
                <div class="mb-3">
                    <label for="headModal" class="form-label">Шапка задачи</label>
                    <input  type="text" class="form-control" id="headModal" maxlength="100">
                </div>
                <div class="mb-3">
                    <label for="bodyModal" class="form-label">Описание задачи</label>
                    <textarea  type="text" class="form-control" id="bodyModal" maxlength="500"></textarea>
                </div>
                <div class="mb-3">
                    <label for="dateModal" class="form-label">Срок до</label>
                    <input  type="date" id = "dateModal" class="form-control">
                </div>
                <div class="mb-3">
                        <label for="responsibleModal" class="form-label">Ответственный</label>
                        <select  id="responsibleModal" class="form-select" name="responsible">
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
                        <label for="importanceModal" class="form-label">Степень важности задачи</label>
                        <select  id="importanceModal" class="form-select" name="importance">
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
                        <label for="cardsModal" class="form-label">Карточка</label>
                        <select  id="cardsModal" class="form-select" name="cards">
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
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn" data-bs-dismiss="modal">Закрыть</button>
          <button class="btn" onclick = "updTask()">Сохранить</button>
        </div>
      </div>
    </div>
  </div>

    <script>
        document.getElementById('main')
        .addEventListener('click', () => window.open('kanban.php', '_self'));

        document.getElementById('myTasks')
        .addEventListener('click', () => window.open('myTasks.php', '_self'));
    </script>
</body>
</html>