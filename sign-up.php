<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sign-up.css">
    <title>Kayıt Ol</title>
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
    <button class="action-button" id="submit" name="signup-btn-insert">Kayıt Ol <svg width="32" height="32" fill="#ffffff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
 <path d="M9.6 10.8a3.6 3.6 0 1 0 0-7.2 3.6 3.6 0 0 0 0 7.2Zm0 2.4a7.2 7.2 0 0 1 7.2 7.2H2.4a7.2 7.2 0 0 1 7.2-7.2Zm9.6-4.8a1.2 1.2 0 1 0-2.4 0v1.2h-1.2a1.2 1.2 0 1 0 0 2.4h1.2v1.2a1.2 1.2 0 1 0 2.4 0V12h1.2a1.2 1.2 0 0 0 0-2.4h-1.2V8.4Z"></path>
</svg></button>
  </form>
  <a href="Login.php" class="are-u-member">Zaten Bir Üyeliğim var. Hemen Giriş Yap</a>

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
 
	if(isset($_POST['signup-btn-insert'])){
		$servername = "localhost";
		$database = "inventory-list";
		$username = "root";
		$password = "";

		$usernameUSER=$_POST['username-text'];
		$passwordUSER=$_POST['password-text'];
		
		$conn = mysqli_connect($servername, $username, $password, $database);
		$query = "select * from login";
		$query_run=mysqli_query($conn,$query); 
		$isUsing=false;
		while($row=mysqli_fetch_array($query_run))
		{
			?>        
				<?php        			
				$dbusername=$row['username'];
				$dbpassword=$row['password'];		
				if($dbusername==$usernameUSER){
					$isUsing=true;		
				}
				?>
			<?php
		}

		if(!$isUsing){
			mysqli_query($conn,"INSERT INTO `login` (`username`,`password`) VALUES ('$usernameUSER','$passwordUSER');");

			echo "<div class='success-msg-bg'></div><a class='success-msg' href='Login.php'>Kayıt Başarıyla Oluşturuldu.<br> Hemen Giriş Yap.</a>";
		}
		else{
			echo "<span class='failed-msg'>Bu Kullanıcı Adı Kullanımda.<br>Başka bir Kullanıcı Adı Dene !</span>";
		}
		
		
	}

	?>
  
</body>
</html>