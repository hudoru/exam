<?php ob_start(); ?>
<html>
<head>
<?php 
require_once "functions/functions.php"; ?>
 
    <meta charset="utf-8">
    <title>Главная</title>
    <!--<link href="css/style.css" rel="stylesheet" type="text/css">-->
 
</head>
<style>
body {
    width: 100%;
    height: 100%;
    background-color: #fff;
    color: #333;
    font-family: "Segoe UI", Arial, sans-serif;
    font-size: 1em;
    line-height: 135%;
    float: left;
}
#t2 {
    border-collapse: collapse;
}
#t2 th{
    padding: 0 10px 0 10px;
    border: 1px solid black;
    border-collapse: collapse;
}
#t2 td{
    padding: 0 10px 0 10px;
    text-align: center;
    border: 1px solid black;
    border-collapse: collapse;
}
#tr2:hover{
    background:rgba(100,100,100,0.1);
}
#do_delete a{
    text-decoration: none;
    color: rgb(229,124,124);
    font-weight: 1000;
}
</style>
<!--<script src="js/profile.js"></script>-->
    <?php if(isset($_GET['login'])){
		echo'<form action="server.php" method="POST">
        <table>
            <tr><td>Название:</td><td><input name="name"></input></td></tr>
			<tr><td>Автор:</td><td><input name="author"></input></td></tr>
			<tr><td>Год:</td><td><input name="year"></input></td></tr>
			<tr><td>Жанр:</td><td><input name="genre"></input></td></tr>
			<tr><td>Стоимость:</td><td><input name="cost"></input></td></tr>
        </table>
        <button type="submit" name="do_send">Отправить</button>
    </form>';
	$link='server.php?table=books&string_to_delete=';
	$button = 'Удалить';
	echo 'Заказы<br>';
	$data = sqlQuery_select("SELECT * FROM orders");
	echo '<table id="t2">';
	echo
    '        <tr><th>id</th><th>id_book</th><th>id_customer</th><th>Дата</th></tr>';
	for($i=0;$i<count($data);$i++){
                echo '<tr id="tr2"><td>'.$data[$i]['id'].'</td><td style="text-align: justify;">'.$data[$i]['id_book'].'</td>
				<td style="text-align: justify;">'.$data[$i]['id_customer'].'</td><td style="text-align: justify;">'
				.date_format(date_create($data[$i]['date']), 'd.m.Y').
                '</td>';
            }
			echo '</table><br>';
	echo 'Заказы за выбранный период<br>';
	echo'
	<form action="main.php?login='.$_GET['login'].'" method="POST">
	<table>
            <tr><td>Дата начала периода(Y-m-d):</td><td><input name="begin_date"></input></td></tr>
			<tr><td>Дата окончания периода(Y-m-d):</td><td><input name="finish_date"></input></td></tr>
        </table>
		<button type="submit" name="check_period">Отправить</button>
		</form>';
		if(isset($_POST['begin_date'])){
			$begin_date=htmlspecialchars($_POST['begin_date']);
			if(isset($_POST['finish_date'])){
				$finish_date = htmlspecialchars($_POST['finish_date']);
					$data = sqlQuery_select("SELECT * FROM `orders` WHERE `date`>='$begin_date' AND `date`<='$finish_date'");
			echo '<table id="t2">';
			echo
    '        <tr><th>id</th><th>id_book</th><th>id_customer</th><th>Дата</th></tr>';
			for($i=0;$i<count($data);$i++){
                echo '<tr id="tr2"><td>'.$data[$i]['id'].'</td><td style="text-align: justify;">'.$data[$i]['id_book'].'</td>
				<td style="text-align: justify;">'.$data[$i]['id_customer'].'</td><td style="text-align: justify;">'
				.date_format(date_create($data[$i]['date']), 'd.m.Y').
                '</td>';
            }
			echo '</table><br>';
				}
			}
		
	
	}
	else {$link='order.php?table=books&book=';
	$button = 'Перейти';}
	
	?>
	Книги
	<table id="t2">
    <?php $data = sqlQuery_select("SELECT * FROM books");
    if(count($data)>0){
        echo
    '        <tr><th>id</th><th>Название</th><th>Автор</th><th>Год</th><th>Жанр</th><th>Стоимость</th></tr>';
            for($i=0;$i<count($data);$i++){
                echo '<tr id="tr2"><td>'.$data[$i]['id'].'</td><td style="text-align: justify;">'.$data[$i]['name'].'</td>
				<td style="text-align: justify;">'.$data[$i]['author'].
                '</td><td>'.$data[$i]['year'].'</td><td>'.$data[$i]['genre'].'</td><td>'.$data[$i]['cost'].'руб.</td>
				<td id="do_delete">
                <a href="'.$link.''.$data[$i]['id'].'">'.$button.'</a></td></tr>';
            }
    }
      /* .date_format(date_create($data[$i]['date_1']), 'd.m.Y').'</td>
                <td>'.date_format(date_create($data[$i]['date_2']), 'd.m.Y').'</td>
                <td>'.intval(abs(strtotime($data[$i]['date_2'])-strtotime($data[$i]['date_1'])))/(3600*24).'</td>
                <td id="do_delete">
                <a href="server.php?table=table1&string_to_delete='.$data[$i]['id'].'">Удалить</a></td></tr>'; */?>
</table>
        
 
    <?php 
ob_end_flush();    ?>
</body>
</html>