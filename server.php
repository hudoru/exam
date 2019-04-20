<?php ob_start(); ?>
<meta charset="utf-8">
<?php
require_once "functions/functions.php";
if(isset($_POST['do_send'])){
    $name = htmlspecialchars($_POST['name']);
	$author = htmlspecialchars($_POST['author']);
	$year = htmlspecialchars($_POST['year']);
	$genre = htmlspecialchars($_POST['genre']);
	$cost = htmlspecialchars($_POST['cost']);
   // $date_1 = date('Y-m-d');
   // $days = $_POST['days'];
   // $date_2 = date("Y-m-d", time()+60*60*24*$days);
            //echo $field_1.'<br>'.$date_1.'<br>'.$date_2;
            sqlQuery ("INSERT INTO `bookStore_db`.`books` (`name`,`author`,`year`,`genre`,`cost`) VALUES ('$name','$author',
            '$year','$genre','$cost')");
                //echo date_format(date_create($begin_date), 'd-m-Y').'<br>';
//echo "INSERT INTO `hudoru_db`.`contests` (`customer_id`,`category`,`contest_name`,`customer_info`,`description`) VALUES ($profile_id,'$category','$contest_name','$customer_info', '$description')";
header('Location: index.php');
}
 else if(isset($_GET['table'])){
        $table=$_GET['table'];
        if(isset($_GET['string_to_delete'])){
            $string_to_delete=$_GET['string_to_delete'];
            sqlQuery ("DELETE FROM `bookStore_db`.`$table` WHERE id = $string_to_delete");
            //echo $table.'<br>'.$string_to_delete;
            header('Location: index.php');
        }
    }
else if(isset($_POST['do_signin'])){
		$login = htmlspecialchars($_POST['login']);
		$password = htmlspecialchars($_POST['password']);
		$data = sqlQuery_select("SELECT * FROM `employees` WHERE `login`=$login");
		if(count($data)>0){
			if($password==$data[0]['password'])
				header('Location: main.php?login='.$login);
			else echo '<p style="color:red">Вы ввели неправильный логин или пароль</p>';
		}
		
	}
	else if(isset($_POST['do_order'])){
		$phone_number = htmlspecialchars($_POST['phone_number']);
		$address = htmlspecialchars($_POST['address']);
		$email = htmlspecialchars($_POST['email']);
		$book = $_POST['id_book'];

		$data = sqlQuery_select("SELECT * FROM `customers` WHERE `email`='$email'");
		if(count($data)==0){
		sqlQuery ("INSERT INTO `bookStore_db`.`customers` (`phone_number`,`address`,`email`) VALUES ('$phone_number',
		'$address','$email')");
		$data = sqlQuery_select("SELECT * FROM `customers` WHERE `email`='$email'");
		}
		sqlQuery ("INSERT INTO `bookStore_db`.`orders` (`id_book`,`id_customer`,`date`) VALUES ('".$book."','".$data[0]['id']."'
		,'".date("Y-m-d")."')");
		header('Location: main.php');
	}
		
	
 
?>