<!DOCTYPE html>
<html>
<head>
	<title>Поиск по команде</title>
    <link rel="stylesheet" type="text/css" href="table.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="input.css">
</head>
<body>
    <div id="wrapper">
        <div id="header"></div>
        <div id="menu">
            <a href="record.html">К ВЫБОРУ</a> &nbsp; &nbsp; &nbsp; &nbsp; 
        </div>
        <div id="main">
            <form action="" method="post">
                <p>Введите команду оператора:</p>
                <input type="text" name="team"/>
                <p><input type="submit" value="Enter"></p>
            </form>
        </div>
        <?php
            if(!empty($_POST["team"])){
                require_once 'connection.php';
                $link = mysqli_connect($host, $user, $password, $database) or die("Ошибка подключения к базу данных" . mysqli_error($link));
                $sql = mysqli_query($link, 
                "SELECT dt.date_time_accept, inf.id_client, op.operator_team, rec.topic
                FROM operator op 
                LEFT JOIN information inf ON op.id_operator = inf.id_operator 
                LEFT JOIN date_time dt ON dt.id_date_time = inf.id_date_time
                LEFT JOIN record rec ON rec.id_information = inf.id_information
                WHERE operator_team = '{$_POST['team']}'");
                if ($sql) {
                    $rows = mysqli_num_rows($sql);
                    echo "<table  border=1  cellspacing=0 cellpading=0>
                    <tread>
                    <tr>
                    <td>Дата принятия вызова</sup></td>
                    <td>Id клиента</td>
                    <td>Команда оператора</td>
                    <td>Тема разговора</td>
                    </tr>
                    <tread>";
                    echo "<tbody>";
                    for($i=1;$i<=$rows;++$i) {
                        $row=mysqli_fetch_row($sql);
                        echo "<tr>";
                        for ($j=0; $j<4; ++$j) {
                            echo "<td>$row[$j]</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    mysqli_free_result($sql);
                }
                mysqli_close($link);
            }
        ?>
    </div>
  <div id="footer"> <a href="http://test1.ru/opd/index.html">Home</a> &copy;2020 </div>
</div>
</body>
</html>