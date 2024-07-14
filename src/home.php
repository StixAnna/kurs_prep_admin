<?php
require_once __DIR__ . '/helpers/functions.php';
require_once __DIR__ . '/helpers/envdefine.php';
checkAuth();
$user = currentUser();

$arrzadlevel = [];
$arrpredm = [];
$arrstud = [];
$groups = [];

// SQL Connection
$db_hostname = DB_HOST;
$db_username = DB_USERNAME;
$db_password = DB_PASSWORD;
$db_database = DB_DATABASE;

$connection_mysql = new mysqli($db_hostname, $db_username, $db_password, $db_database);
if ($connection_mysql->connect_error) {
    die("Ошибка: " . $connection_mysql->connect_error);
}

// Get predmName and zadlevel from zadania table
$selectpredm = "SELECT zadania.predmName, zadania.zadlevel FROM zadania";
if ($result = $connection_mysql->query($selectpredm)) {
    while ($row = $result->fetch_assoc()) {
        if (!in_array($row['predmName'], $arrpredm)) {
            array_push($arrpredm, $row['predmName']);
        }
        if (!in_array($row['zadlevel'], $arrzadlevel)) {
            array_push($arrzadlevel, $row['zadlevel']);
        }
    }
}

// Get stname, id_student, and grname from student and grouppa tables
$selectstud = "SELECT student.stname, student.id_student, grouppa.grname
                FROM student
                JOIN grouppa ON student.id_group = grouppa.id";
if ($result = $connection_mysql->query($selectstud)) {
    while ($row = $result->fetch_assoc()) {
        $str = $row['grname'] . " : " . $row['id_student'] . "." . $row['stname'];
        if (!in_array($str, $arrstud)) {
            array_push($arrstud, $str);
        }
        if (!in_array($row['grname'], $groups)) {
            array_push($groups, $row['grname']);
        }
    }
}

// Get id_student and id_group from student table
$selectstudgrp = "SELECT student.id_student, student.id_group FROM student";
if ($result = $connection_mysql->query($selectstudgrp)) {
    while ($row = $result->fetch_assoc()) {
        $studIdAndGrp[$row['id_student']] = $row;
    }
}


$selectabtlnk = "SELECT * FROM zadania_link_to_student";


?>



<!DOCTYPE html>
<html>
    <?php include_once __DIR__ . '/components/head2.php'?>

    <body>
    <img
        class="avatar"
        src="<?php echo $user['avatar'] ?>"
        alt="<?php echo $user['name'] ?>"
    >
        <h1 style="margin-top: 15px;">Привет, <?php echo $user['name'] ?>!</h1>
        <form action="./actions/logout.php" method="post">
            <button role="button">Выйти из аккаунта</button>
        </form>
        <?php 
        if ($user['admin']) {//glalniyif
            include __DIR__ . '/components/admin.php';?>
            <?php 
        } else {
            include __DIR__ . '/components/user.php';?>
            <?php 
        }
        ?>
        
        <?php include_once __DIR__ . '/components/scripts.php' ?>
    </body>
</html>