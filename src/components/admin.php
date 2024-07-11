<div id="topmenu">
    <a href="#" id ="btnmenu" class="btn_openzadadd">Добавление</a>
    <a href="#" id ="btnmenu" class="btn_openzadgive">Выдача заданий</a>
    <a href="#" id ="btnmenu" class="btn_opendelmenu">Мониторинг/удаление</a>
</div>
<div id = "zadadd">
<table>
    <tr >
    <td id="F1" colspan = "2" >
        Добавление в базу новых заданий:
    <br>
    </td>
    </tr>

    <FORM method="post" enctype="multipart/form-data">
    <td id="F3"><b>Добавление группы:</b><br>
        
        <input type="text" id="textbox" name="newgroup" placeholder="a-0*m"><br>
        <input type ="submit" name="btn-newgroup" value="Добавить новую группу"><?php  
        if(isset($_POST['btn-newgroup'])){
            $nameOfGrp = $_POST['newgroup'];
            // $nameOfGrp = 'a-03m';
            $insertNewGrp = " INSERT INTO grouppa (grname) VALUES('$nameOfGrp');";
            $connection_mysql->query($insertNewGrp);
            echo "<meta http-equiv='refresh' content='0'>";
        }?> 

    </FORM>
    <br><br>
    <FORM style="font-size:1em;" method="post" enctype="multipart/form-data">
    <b>Добавление студента:</b><br><br>
        
        <input type="text" id="textbox" name="newStName" placeholder="ФИО"><br>
        <select id="1group" name="1group" size=1><?php
            foreach($groups as $group){?>
                <option>
                    <?php echo $group;?>
                </option><?php
            }?>
        </select><br>
        <input type ="submit" name="btn-newstudent" value="Добавить нового студента"><?php  
        if(isset($_POST['btn-newstudent'])){
            $group = substr($_POST['1group'], 0, 1);
            $stName = $_POST['newStName'];
            // $group = substr('3.a-00m', 0, 1);
            // $stName = 'Petya';

            $selectNumInGrp = "SELECT MAX(`num_in_grp`) as num_in_grp FROM student where id_group = '".$group."';";
            if($result = $connection_mysql->query($selectNumInGrp)) 
                $numgrp = ($result->fetch_assoc())['num_in_grp'] + 1;
            $insertNewStudent = " INSERT INTO student (id_group, num_in_grp, stname) VALUES('".$group."','".$numgrp."','".$stName."');";
            $connection_mysql->query($insertNewStudent);
            echo "<meta http-equiv='refresh' content='0'>";
        }?> 
    </td>
    </FORM>

    <FORM method="post" enctype="multipart/form-data">
        <td id="F4"><b>Добавление задания:</b><br>
        <select id="1level" name="1level" size=1>
        <?php
            foreach($arrzadlevel as $level){
                if ($level != 'notchosen'){?>
                <option>
                    <?php 
                    echo $level;?>
                </option>
    <?php   }}?> 
        </select>
        <select id="1predm" name="1predm" size=1>
        <?php
        foreach($arrpredm as $predm){?>
            <option>
                <?php echo $predm;?>
            </option><?php
        }?>
        </select><br>
        <input type="text" id="textbox" name="shortquest" placeholder="Краткое описание задания"><br>
        <textarea name="longquest" placeholder="Задание вот тут вот"></textarea><br>
        <input type ="submit" name="btn-newquest" value="Добавить новое задание"><?php  
        if(isset($_POST['btn-newquest'])){
            $shortQuest = $_POST['shortquest'];
            $longQuest = $_POST['longquest'];
            // $nameOfGrp = 'a-03m';
            $insertNewGrp = " INSERT INTO grouppa (grname) VALUES('".$numgrp.".".$nameOfGrp."');";
            $connection_mysql->query($insertNewGrp);
            echo "<meta http-equiv='refresh' content='0'>";
        }?> <br>
        </td>
    </FORM>
</table>
</div>
<div id = "zadgive">
<table>
    <tr>
    <td id="F1" colspan = 2>
        Выдача уже готовых заданий:

    <br>
    </td>
    </tr>
    <tr>
    <FORM method="post" enctype="multipart/form-data">
    <td id="F2"><b>Дать всем задания:</b><br><br>
        <select id="2predm" name="2predm" size=1>
        <?php
        foreach($arrpredm as $predm){?>
            <option>
                <?php echo $predm;?>
            </option><?php
        }?>
        </select>
        <select id="2group" name="2group" size=1><?php
        foreach($groups as $group){?>
            <option>
                <?php echo $group;?>
            </option><?php
        }?>
        </select>
        <select id="3level" name="3level" size=1>
        <?php
            foreach($arrzadlevel as $level){
                if ($level != 'notchosen'){?>?>
                <option>
                    <?php echo $level;?>
                </option>
    <?php   }}?> 
        </select><br>
        <input type ="submit" name="btn-vsem" value="Выдать задания всей группе"><?php 
        if(isset($_POST['btn-vsem'])){
            $predmet = $_POST['2predm'];
            $level = $_POST['3level'];
            $grouppa = substr($_POST['2group'], 0, 1);
            // $predmet = 'math';
            // $grouppa = '3';
            $selectlszadid = "SELECT id_zadaniya FROM zadania WHERE zadania.predmName = '".$predmet."' AND zadania.zadlevel = '".$level."';";
            if($result = $connection_mysql->query($selectlszadid)) {
                $row = $result->fetch_assoc();
                $zadid = $row['id_zadaniya'];
            }
            foreach ($studIdAndGrp as $studId){//rabotaet
                if ($studId['id_group'] == $grouppa){
                    $sqlLs4All = " INSERT INTO zadania_link_to_student(id_student,id_zadania) VALUES(".$studId['id_student'].",".$zadid.");";
                    $connection_mysql->query($sqlLs4All);
                }
            }
            echo "<meta http-equiv='refresh' content='0'>";
        }
    ?></td></FORM>
    <FORM method="post" enctype="multipart/form-data">
    <td id="F2"><b>Дать задания конкретному студенту:</b><br><br>
        <select id="2student" name="2student" size=1>
        <?php
            foreach($arrstud as $stud){?>
                <option>
                    <?php echo $stud;?>
                </option>
    <?php   }?>
        </select>
        <select id="2level" name="2level" size=1>
        <?php
            foreach($arrzadlevel as $level){
            if ($level != 'notchosen'){?>
                <option>
                    <?php echo $level;?>
                </option>
    <?php   }}?> 
        </select>
        <select id="3predm" name="3predm" size=1>
        <?php
            foreach($arrpredm as $predm){?>
                <option>
                    <?php echo $predm;?>
                </option>
    <?php   }?>
        </select>
    <?php
        if(isset($_POST['concr'])){
            $level = $_POST['2level']; 
            $predmet = $_POST['3predm'];
            $student = substr(explode(' : ', $_POST['2student'])[1], 0, 1);
            // $level = '4ls'; 
            // $predmet = 'math';
            // $student = substr(explode(' : ', '2.a08m : 4.Johnson')[1], 0, 1);
            $selectlszadid = "SELECT id_zadaniya FROM zadania WHERE zadania.predmName = '".$predmet."' AND zadania.zadlevel ='".$level."';";
            if($result = $connection_mysql->query($selectlszadid)) {
                $row = $result->fetch_assoc();
                $zadid = $row['id_zadaniya'];
            }
            $sqlinsconcr = " INSERT INTO zadania_link_to_student(id_student,id_zadania) VALUES(".$student.",".$zadid.");";
            $connection_mysql->query($sqlinsconcr);
            echo "<meta http-equiv='refresh' content='0'>";
        }
    ?>
        <br><input type ="submit" name="concr" value="Выдать">
    </td>
    </FORM></tr><tr>
    <FORM method="post" enctype="multipart/form-data">
        <td id="F3"><b>Предоставить студентам возможность выбора сложности</b><br><br>
        <select id="4predm" name="4predm" size=1>
            <?php
                foreach($arrpredm as $predm){?>
                    <option>
                        <?php echo $predm;?>
                    </option>
        <?php   }?>
        </select>
        <select id="3group" name="3group" size=1>
            <?php
                foreach($groups as $group){?>
                    <option>
                        <?php echo $group;?>
                    </option>
        <?php   }?>
        </select><br>
        <input type ="submit" name="btn-sami" value="Предоставить"><?php  
        if(isset($_POST['btn-sami'])){
            $predmet = $_POST['4predm'];
            $grouppa = substr($_POST['3group'], 0, 1); 
            // $predmet = 'math';
            // $grouppa = '1';
            $selectlszadid = "SELECT id_zadaniya FROM zadania WHERE zadania.predmName = '".$predmet."' AND zadania.zadlevel = 'notchosen';";
            if($result = $connection_mysql->query($selectlszadid)) {
                $row = $result->fetch_assoc();
                $zadid = $row['id_zadaniya'];
            }
            foreach ($studIdAndGrp as $studId){
                if ($studId['id_group'] == $grouppa){
                    $sqlinssami = " INSERT INTO zadania_link_to_student(id_student,id_zadania) VALUES(".$studId['id_student'].",".$zadid.");";
                    $connection_mysql->query($sqlinssami);
                }
            }
            echo "<meta http-equiv='refresh' content='0'>";
        }?> 
    <br>
    </td>
    </FORM>
    <td id="F4">
    <b>Выбирайте наказание для них и смотрите результат!</b>
    </td>
    </tr>
</table>
</div>
<div id = "delmenu">
<table>
    <tr>
    <td id="F1" colspan = "2" >
        Удаление записей из базы
    <br>
    </td>
    </tr>
    <tr>
    <td id="F3"><b>Удаление группы:</b>
    <FORM method="post" enctype="multipart/form-data">
        
        <select id="4group" name="4group" size=1><?php
            foreach($groups as $group){?>
                <option>
                    <?php echo $group;?>
                </option><?php
            }?>
        </select><br>
        <input type ="submit" name="btn-grpdel" value="Удалить группу"><?php  
        if(isset($_POST['btn-grpdel'])){
            $sttodel = [];
            $grouppa = $_POST['4group']; 
            // $grouppa = "2.a08n"; 
            $sqlselectst = "select student.id_student from student
                            join grouppa on student.id_group = grouppa.id
                            where grouppa.grname = '$grouppa';";
            if($result = $connection_mysql->query($sqlselectst)) {
                while($row = $result->fetch_assoc()){
                    array_push($sttodel, $row['id_student']);
                }
            }
            $strstdtodel = implode(",", $sttodel);
            $sqldelete3 = "delete from zadania_link_to_student where zadania_link_to_student.id_student in (".$strstdtodel.");";
            $connection_mysql->query($sqldelete3);
            $sqldelete2 = "delete from student where student.id_student in (".$strstdtodel.");";
            $connection_mysql->query($sqldelete2);
            $sqldelete1 = "delete from grouppa where grouppa.grname = '$grouppa';";
            $connection_mysql->query($sqldelete1);
            echo "<meta http-equiv='refresh' content='0'>";
            
        }    ?> 
    </FORM>
    </td>
    <td id="F4">
    <b>Удаление задания:</b><br>
    <FORM style="font-size:1em;" method="post" enctype="multipart/form-data">
    <?php
        $zadsDescrs = [];
        $sqlselectzads = "select zadShortDescr from zadania where `zadShortDescr` is not NULL;";
        if($result = $connection_mysql->query($sqlselectzads)) {
            while($row = $result->fetch_assoc()){
                array_push($zadsDescrs, $row['zadShortDescr']);
            }
        }
    ?>
        <select id="4zad" name="4zad" size=1>
            <?php
            foreach($zadsDescrs as $zadDescr){
            ?>
                <option>
                    <?php echo $zadDescr;?>
                </option><?php
            }?>
        </select><br>    
        <input type ="submit" name="btn-zaddel" value="Del задания"><?php
        if(isset($_POST['btn-zaddel'])){
            $linkstodel = [];
            $zad = $_POST['4zad']; //str not id
            $sqlselectlinks = "  select linkId from zadania_link_to_student 
                                join zadania on zadania_link_to_student.id_zadania = zadania.id_zadaniya
                                where zadania.`zadShortDescr` = '$zad';";
            if($result = $connection_mysql->query($sqlselectlinks)) {
                while($row = $result->fetch_assoc()){
                    array_push($linkstodel, $row['linkId']);
                }
            }
            if(count($linkstodel) > 0){
                $strstdtodel = implode(",", $linkstodel);
                $sqldelete2 = "delete from zadania_link_to_student where zadania_link_to_student.linkId in ($strstdtodel);";
                $connection_mysql->query($sqldelete2);
            }
            $sqldelete1 = "delete from zadania where zadania.zadShortDescr = '$zad';";
            $connection_mysql->query($sqldelete1);
            echo "<meta http-equiv='refresh' content='0'>";
        }    ?> 
    </FORM>
    </td>
    </tr>
</table>

<table>
    <FORM method="post" enctype="multipart/form-data">
    <tr>
        <td id="F6" colspan = 7>
        <select id="4group" name="4group" size=1>
        <?php
        foreach($groups as $group){?>
        <option>
            <?php echo $group;?>
        </option>
        <?php   }?>
        </select><br>
        <input type ="submit" name="showstuds" value="Посмотреть задания">
        <br>
        </td>
    </tr>
    <tr id="F7">
        <td class ="bordered">
            №
        </td>
        <td class ="bordered">
            Группа
        </td>
        <td class ="bordered">
            Имя
        </td>
        <td class ="bordered">
            Предмет
        </td>
        <td class ="bordered">
            Задание
        </td>
        <td class ="bordered">
            Сложность    
        </td>
        <td class ="bordered">
            delbtn    
        </td>
    </tr>
    </FORM>
    <?php 
    if(isset($_POST['showstuds'])){
        $grouppa = $_POST['4group'];
        $zadarr = [];
        $i = 0;
        // $grouppa = substr('1.a08n', 0, 1);
        $selectlszadid = "  select student.stname, grouppa.grname, zadania.predmName, zadania.zadShortDescr, zadania.zadlevel
                        from zadania_link_to_student
                        join student ON zadania_link_to_student.id_student = student.id_student 
                        LEFT join zadania ON zadania_link_to_student.id_zadania =zadania.id_zadaniya 
                        join grouppa ON student.id_group = grouppa.id
                        where grouppa.grname = '".$grouppa."'";
        if($result = $connection_mysql->query($selectlszadid)) {
        while($row = $result->fetch_assoc()) {
            array_push($zadarr, $row);   
            ?> 
            <tr id = "F8" ident ="<?php echo $i; ?>">
                <td class ="bordered"><?php echo $i;?></td>
                <td class ="bordered"><?php echo $zadarr[$i]['grname'];?></td>
                <td class ="bordered"><?php echo $zadarr[$i]['stname'];?></td>
                <td class ="bordered"><?php echo $zadarr[$i]['predmName'];?></td>
                <td class ="bordered"><?php echo $zadarr[$i]['zadShortDescr'];?></td>
                <td class ="bordered"><?php echo $zadarr[$i]['zadlevel']; ?></td>
                <!-- <FORM method="post" enctype="multipart/form-data"> -->
                <td class ="bordered"><input id = "del" type ="submit" name="dellink" value="DEL" onclick="handleButtonClick(this)"></td>
                <!-- </FORM> -->
            </tr><?php 
            $i++;
        }
        }
    }
 // if(isset($_POST['dellink'])){
    //     $id = $_POST['value'];
    //     echo $id;
    // }
    ?>
</table>
</div>
<div id = "zadchk">
<table>
    <FORM method="post" enctype="multipart/form-data">
    <tr>
        <td id="F6" colspan = 7>
        <select id="4group" name="4group" size=1>
        <?php
        foreach($groups as $group){?>
        <option>
            <?php 
            echo $group;?>
        </option>
        <?php   }?>
        </select><br>
        <input type ="submit" name="showstuds" value="Посмотреть задания">
        <br>
        </td>
    </tr>
    <tr id="F7">
        <td class ="bordered">
            №
        </td>
        <td class ="bordered">
            Группа
        </td>
        <td class ="bordered">
            Имя
        </td>
        <td class ="bordered">
            Предмет
        </td>
        <td class ="bordered">
            Задание
        </td>
        <td class ="bordered">
            Сложность    
        </td>
    </tr>
    </FORM>
    <?php 
    if(isset($_POST['showstuds'])){// написание новой даты на страницу  
        $grouppa = $_POST['4group'];
        $zadarr = [];
        $i = 0;
        // $grouppa = substr('1.a08n', 0, 1);
        $selectlszadid = "  select student.stname, grouppa.grname, zadania.predmName, zadania.zadShortDescr, zadania.zadlevel
                        from zadania_link_to_student
                        join student ON zadania_link_to_student.id_student = student.id_student 
                        LEFT join zadania ON zadania_link_to_student.id_zadania =zadania.id_zadaniya 
                        join grouppa ON student.id_group = grouppa.id
                        where grouppa.grname = '".$grouppa."'";
        if($result = $connection_mysql->query($selectlszadid)) {
        while($row = $result->fetch_assoc()) {
            array_push($zadarr, $row);   
            ?> 
            <tr id = "F8">
                <td class ="bordered"><?php echo $i;?></td>
                <td class ="bordered"><?php echo $zadarr[$i]['grname'];?></td>
                <td class ="bordered"><?php echo $zadarr[$i]['stname'];?></td>
                <td class ="bordered"><?php echo $zadarr[$i]['predmName'];?></td>
                <td class ="bordered"><?php echo $zadarr[$i]['zadShortDescr'];?></td>
                <td class ="bordered"><?php echo $zadarr[$i]['zadlevel']; ?></td>
            </tr><?php 
            $i++;
        }
        }
    }?> 
</table>
</div>

<?php include_once __DIR__ . '/scripts.php'?>
<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">
// когда страница загрузится
$(document).ready(function(){
    // вешаем обработчик на ссылку с классом "btn_openzadadd" (верхнее меню)
    $(".btn_openzadadd").click(function(){
        // выдвигаем/прячем панель
        $("#zadadd").slideToggle("slow");
        $("#zadgive").slideUp("slow");
        $("#delmenu").slideUp("slow");
        $("#zadchk").slideDown("slow");
        // изменяем класс самой ссылки
        $(this).toggleClass("active");
        // и ничего не делаем дальше (дабы не было перехода по ссылки)
        return false;
    });
    
    // вешаем обработчик на ссылку с классом "btn_openzadgive" (нижнее меню)
    $(".btn_openzadgive").click(function(){
        // выдвигаем/прячем панель 
        $("#zadadd").slideUp("slow");
        $("#zadgive").slideToggle("slow");
        $("#delmenu").slideUp("slow");
        $("#zadchk").slideDown("slow");
        // изменяем класс самой ссылки
        $(this).toggleClass("active2");
        // и ничего не делаем дальше (дабы не было перехода по ссылки)
        return false;
    });
    // вешаем обработчик на ссылку с классом "btn_opendelmenu" (нижнее меню)
    $(".btn_opendelmenu").click(function(){
        // выдвигаем/прячем панель
        $("#zadadd").slideUp("slow");
        $("#zadgive").slideUp("slow");
        $("#zadchk").slideToggle("slow");
        $("#delmenu").slideToggle("slow");
        // изменяем класс самой ссылки
        $(this).toggleClass("active3");
        // и ничего не делаем дальше (дабы не было перехода по ссылки)
        return false;
    });
    function handleButtonClick(button) {
        var ident = button.parentNode.parentNode.getAttribute("ident");
        // Создаем XMLHTTP объект
        var xhr = new XMLHttpRequest();
        // Отправляем POST запрос на сервер
        xhr.open('POST', 'admin.php', true);
        // Устанавливаем заголовок запроса
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        // Отправляем данные
        xhr.send('value=' + encodeURIComponent(ident));
   
   // выполнить требуемые действия с ident
}

});
</script>