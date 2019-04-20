<style>
button {
    text-decoration: none;
    color: rgb(229,124,124);
    font-weight: 1000;
	cursor:pointer;
	background:none;
	border:none;
}
</style>
<?php
require_once "functions/functions.php";
if(isset($_GET['table'])){
        $table=$_GET['table'];
        if(isset($_GET['book'])){
			$book=$_GET['book'];
			
			$data = sqlQuery_select("SELECT * FROM books WHERE id=".$book);
			
			
			echo $data[0]['name'].'<br>';
			echo $data[0]['author'].'<br>';
			echo $data[0]['year'].'<br>';
			echo $data[0]['genre'].'<br>';
			echo $data[0]['cost'].'руб.<br>';
			echo '
			<form action="server.php" method="POST">
        <table>
            <tr><td>Ваш номер телефона:</td><td><input name="phone_number"></input></td></tr>
			<tr><td>Ваш адрес:</td><td><input name="address"></input></td></tr>
			<tr><td>Ваш email:</td><td><input name="email"></input></td></tr>
			<input name="id_book" type="hidden" value="'.$book.'">
        </table>
        <button type="submit" name="do_order">Оформить заказ</button>
    </form>';
			
		}
}

?>