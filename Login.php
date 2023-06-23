<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Login.css">
    <title>Giriş Yap</title>
</head>
<body>

<span class="website-title">Envanter Listesi</span>


  <a href="https://github.com/Eren-Koc" target="_b"><img src="img/erenkoc-project-logo.png" alt="eren koç Logo"></a>
<br>

  <form action="" method="POST">
    <input type="text" name="username-text" placeholder="Kullanıcı Adı" required>
    <br>
    <input type="password" name="password-text" placeholder="Şifre" required>
    <br>
    <button class="action-button" id="submit" name="btn-login">Giriş Yap <svg width="36" height="36" fill="#ffffff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
 <path d="M18.375 3.75h-7.5A2.628 2.628 0 0 0 8.25 6.375v4.875h7.19l-2.47-2.47a.75.75 0 0 1 1.06-1.06l3.75 3.75a.75.75 0 0 1 0 1.06l-3.75 3.75a.75.75 0 0 1-1.06-1.06l2.47-2.47H8.25v4.875c0 1.502 1.584 2.625 3 2.625h7.125A2.627 2.627 0 0 0 21 17.625V6.375a2.627 2.627 0 0 0-2.625-2.625Z"></path>
 <path d="M3.75 11.25a.75.75 0 1 0 0 1.5h4.5v-1.5h-4.5Z"></path>
</svg> </button>
  </form>
  <a href="sign-up.php" class="not-member-yet">Henüz Üye Değil Misin? Hemen Üye Ol !</a>
  <?php 
  /*
Create Database inventory-list
.
.
use inventory-list
create table login(
id int identity(1,1),
username varchar(50),
password varchar(50)
)

create table envanter-table(
id int identity(1,1),
Baslik varchar(70),
Aciklama varchar(300),
Adet int,
UserID int
)
  */
 
	if(isset($_POST['btn-login'])){
		$servername = "localhost";
		$database = "inventory-list";
		$username = "root";
		$password = "";

		$usernameUSER=$_POST['username-text'];
		$passwordUSER=$_POST['password-text'];

		$conn = mysqli_connect($servername, $username, $password, $database);
		$query = "select * from login";
		$query_run=mysqli_query($conn,$query); 
		$didenter=false;
		while($row=mysqli_fetch_array($query_run))
		{
			?>        
				<?php        
				$dbuserid=$row['id']; 
				$dbusername=$row['username'];
				$dbpassword=$row['password'];
				
				if($dbusername==$usernameUSER && $dbpassword==$passwordUSER){
					$didenter=true;
					session_start();
					session_regenerate_id();									
					$_SESSION["kullaniciadi"]=$usernameUSER;
					$_SESSION["sifre"]=$passwordUSER;
					$_SESSION["userid"]=$dbuserid;
					session_write_close();
					ob_start();
					header('Location: inventory-list.php');		
					exit;
					
				}
				?>
			<?php
		}
		if($didenter==false){
			echo 'Kullanıcı adı veya şifre hatalı';
		}	
	}

	?>

</body>
</html>