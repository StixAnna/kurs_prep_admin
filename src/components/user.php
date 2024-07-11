<table style="margin-top: 15px;">
<tr>
<td id="F1" >
<b>Просмотр выданных заданий, сортировка по группам:</b>
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
