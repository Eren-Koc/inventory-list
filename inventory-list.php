<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--<meta http-equiv="refresh" content="5;URL='inventory-list.php'">-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="inventory-list.css">
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
    <title>Envanter Listesi</title>
</head>
<body> 

<button name="logout-btn" class="go-back-btn"><span onclick="LogoutRequest(this.id)" id="inventory-list.php?logout=1"><svg width="32" height="32" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
 <path d="M14 8V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2v-2"></path>
 <path d="M7 12h13"></path>
 <path d="m10 15-3-3 3-3"></path>
</svg>
</svg></span></button>
<div class="all-col"> 
<a href="https://github.com/Eren-Koc"><img src="img/erenkoc-project-logo.png" alt="eren koç Logo"></a>
<form method="POST" action="" class="search-form" autocomplete="off">
<input class="search-elemani" onclick="Searching()" type="text" id="searchbarid" name="search-bar" placeholder="Ürün Ara" onkeypress="return restrictAlphabets(event)">
</form>
<div class="input-col">
    <form action="" method="POST" autocomplete="off">
    <input class="form-elemani" id="form-count" type="number" min="1" step="1" name="adet-text" placeholder="Adet" onkeypress="return event.keyCode === 8 || event.charCode >= 48 && event.charCode <= 57" required>
<input class="form-elemani" id="form-product" type="text" name="baslik-text" placeholder="Ürün" required>
<input class="form-elemani" id="from-desc" type="text" name="aciklama-text" placeholder="Açıklama">
<br>
<input type="submit" id="submit" class="submit-btn" value="Yeni Ekle" name="btn-insert">
</form>
</div>
<br>
<table>
    <tr>
    <th>Adet</th>
        <th>Ürün</th>   
        <th>Açıklama</th>
        <th></th>
        <th></th>
    </tr>
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
   session_start();
   $servername = "localhost";
	$database = "inventory-list";
	$username = "root";
	$password = "";
   $conn = mysqli_connect($servername, $username, $password, $database);
   $query = "select * from login";
   $isFindUser=false;
   $query_run=mysqli_query($conn,$query); 
   while($row=mysqli_fetch_array($query_run))
   {
       ?>        
           <?php  
           $adminid=$row['username'];   
           $adminsif=$row['password'];  
           
           if($_SESSION["kullaniciadi"]==$adminid && $_SESSION["sifre"]==$adminsif){
            $UserID=$_SESSION['userid'];
            $isFindUser=true;
           }
           
           ?>
       <?php
   }
    if(!$isFindUser){
    try {
        header('Location: Login.php');
        exit;
    } catch (Exception $e) {
        echo $e;
    }
   }

   $aratmayapti=false;
   if(isset($_POST['search-bar'])){
    if($_POST['search-bar']!=""){
        $aratmayapti=true;
        $servername = "localhost";
	$database = "inventory-list";
	$username = "root";
	$password = "";
    $searching=$_POST['search-bar'];
   
    $conn = mysqli_connect($servername, $username, $password, $database);
$query = "SELECT * FROM `envanter-table` where Baslik like '%$searching%' and UserID=$UserID";
$query_run=mysqli_query($conn,$query); 
echo "<div class='search-filt-bg'><span class='searching-filt'>Arama Filtresi: <a href='inventory-list.php' class='search-item'>$searching X</a></span></div>";
$satirhesapla=0;

   while($row=mysqli_fetch_array($query_run))
   { 
    $satirhesapla++;
    $tableid=$row['id'];
    $tablebaslik=$row['Baslik'];
    $tableaciklama=$row['Aciklama'];
    $tableadet=$row['Adet'];
       ?>        
           <?php         
           if($satirhesapla%2==0){
            echo "<tr>
            <td id='first' style='background-color:#ededed;'>$tableadet</td>
            <td style='background-color:#ededed;'>$tablebaslik</td>
            <td style='background-color:#ededed;'>$tableaciklama</td>
            <td style='background-color:#ededed;'>$tableid</td>
            <td id='last' style='background-color:#ededed;'><span class='sil' onClick='DeleteRequest(this.id)' id='inventory-list.php?sil=$tableid'>Sil</span></td>
         </tr>";  
           }
           else{
            echo "<tr>
            <td id='first'>$tableadet</td>
            <td>$tablebaslik</td>
            <td>$tableaciklama</td>
            <td style='color:#ffffff'>$tableid</td>
            <td id='last'><span class='sil' onClick='DeleteRequest(this.id)' id='inventory-list.php?sil=$tableid'>Sil</span></td>
         </tr>";
            }
        
           ?>
       <?php
   }
unset($_POST["search-bar"]);
}
}
if($aratmayapti==false){
   $conn = mysqli_connect($servername, $username, $password, $database);
   $query = "select * from `envanter-table` where UserID=$UserID";
   $query_run=mysqli_query($conn,$query); 
   $satirhesapla=0;

   while($row=mysqli_fetch_array($query_run))
   { 
    $satirhesapla++;
    $tableid=$row['id'];
    $tablebaslik=$row['Baslik'];
    $tableaciklama=$row['Aciklama'];
    $tableadet=$row['Adet'];
       ?>        
           <?php         
           if($satirhesapla%2==0){
            echo "<tr>
            <td id='first' style='background-color:#DAD9DB;'>$tableadet</td>
            <td style='background-color:#DAD9DB;'>$tablebaslik</td>
            <td style='background-color:#DAD9DB;'>$tableaciklama</td>
            <!--<td style='background-color:#DAD9DB; color:#DAD9DB;'></td>-->
            <td id='last' style='background-color:#DAD9DB;'><span class='sil' onClick='DeleteRequest(this.id)' id='inventory-list.php?sil=$tableid'>Sil</span></td>
         </tr>";  
           }
           else{
            echo "<tr>
            <td id='first'>$tableadet</td>
            <td>$tablebaslik</td>
            <td>$tableaciklama</td>
            <!--<td style='color:#ffffff'></td>-->
            <td id='last'><span class='sil' onClick='DeleteRequest(this.id)' id='inventory-list.php?sil=$tableid'>Sil</span></td>
         </tr>";
            }
        
           ?>
       <?php
   }

   if(isset($_POST['btn-insert'])){
    $entryBaslik=$_POST['baslik-text'];
    $entryAdet=$_POST['adet-text'];
    $entryAciklama=$_POST['aciklama-text'];
    
    mysqli_query($conn,"INSERT INTO `envanter-table` (Baslik,Aciklama,Adet,UserID) VALUES ('$entryBaslik','$entryAciklama',$entryAdet,$UserID);");
    header('Location: inventory-list.php');
    exit;
   }

   if(isset($_GET['logout'])){
    $Logout=$_GET['logout'];
    if($Logout==1){
        //session_start(); 
        // unset($_SESSION["username"], $_SESSION["password"],$_SESSION["userid"]);
        session_destroy();
        header("Location: Login.php");
    }
   }
    if(isset($_GET['sil'])){
     $silID=$_GET['sil'];
     $sil=mysqli_query($conn,"DELETE FROM `envanter-table` where `id`=$silID");
     header('Location: inventory-list.php');
     exit;
 }
}
 ?>

</table>
</div>
</body>
</html>


<script src="alerts.js"></script>
