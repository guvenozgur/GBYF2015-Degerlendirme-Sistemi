<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Jüri Ekleme</title>
	</head>
<?php
	include("db.php");
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(isset($_POST['juriIsmi'], $_POST['juriSoyismi'],$_POST['juriSifre'], $_POST['juriEmail'], $_POST['degerlendirmeSinifi'], $_POST['degerlendirmeGrubu'] ))
		{
			// username and password sent from Form
			$juriIsmi=mysqli_real_escape_string($conn, $_POST['juriIsmi']); 
			$juriSoyismi=mysqli_real_escape_string($conn, $_POST['juriSoyismi']); 
			$juriSifre=mysqli_real_escape_string($conn, $_POST['juriSifre']); 
			$juriEmail=mysqli_real_escape_string($conn, $_POST['juriEmail']); 
			$degerlendirmeSinifi=mysqli_real_escape_string($conn, $_POST['degerlendirmeSinifi']); 
			$degerlendirmeGrubu=mysqli_real_escape_string($conn, $_POST['degerlendirmeGrubu']); 
			
			$getNumofJuriQuery="SELECT COUNT(juriID) FROM juri";
			$getNumofJuri=mysqli_fetch_row(mysqli_query($conn, $getNumofJuriQuery));
			$numofJuri=$getNumofJuri[0];
			$id=$numofJuri+200;
			$juriId=mysqli_real_escape_string($conn, $id);
			//önce log kaydı yapılacak
			
			// kullaniciId:
			$kullaniciId=$_SESSION['adminId'];
			// tarih:
			$tarih=date(DATE_RFC822);
			// degiskenId:
			$degiskenId=$juriId;
			//degisiklik:
			$degisiklik="$degiskenId id'li juri database'e eklendi.";
			$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';
			$logResult=mysqli_query($conn, $logQuery);
			/////
			$sql="INSERT INTO `juri`(`juriId`, `juriIsmi` , `juriSoyismi` , `juriSifre`, `juriEmail`, `degerlendirmeSinifi`, `degerlendirmeGrubu`) VALUES ('$juriId','$juriIsmi','$juriSoyismi','$juriSifre','$juriEmail','$degerlendirmeSinifi', '$degerlendirmeGrubu');";
			$result=mysqli_query($conn, $sql);
			if($result)
				echo "Juri üyesi database'e başarıyla eklenmiştir.";
			else
				echo "Juri ekleme işlemi sırasında bir sorunla karşılaşılmıştır.";
		}
		
		else
			echo"Alanların hepsini doldurmanız gerekmektedir!";
	}
	
?>

	<body>
		<center>
		<h1>Juri Ekleme Sayfası</h1>
		<?php
		if(isset($_SESSION['adminIsmi']))
		{
		?>
			<form action="adminJuri.php" method="post">
				
				<label>İsim :</label><br />
				<input type="text" name="juriIsmi"><br/><br />
				
				<label>Soyisim: </label><br />
				<input type="text" name="juriSoyismi"><br/><br />
				
				<label>Şifre: </label><br />
				<input type="password" name="juriSifre"><br/><br />
				
				<label>Email: </label><br />
				<input type="text" name="juriEmail"><br/><br />
				
				<label>Değerlendirme sınıfı: </label><br />
				<input type="radio" name="degerlendirmeSinifi" value="1">Akademik Değerlendirme<br/>
				<input type="radio" name="degerlendirmeSinifi" value="2">Sektörel Değerlendirme<br/>
				<input type="radio" name="degerlendirmeSinifi" value="3">Fikir Yarışması Değerlendirmesi<br/>
				<br />
				
				<label>Değerlendirme grubu: </label><br />
				<input type="radio" name="degerlendirmeGrubu" value="1">Seçtiğiniz yarışmanın 1. değerlendirme grubu<br/>
				<input type="radio" name="degerlendirmeGrubu" value="2">Seçtiğiniz yarışmanın 2. değerlendirme grubu<br/>
				<br />
				
				<input type="submit" value="Kayıt"/><br />
			</form>
		<?php
			}
			else
			{
				echo"Jüri ekleyebilmek için sisteme admin olarak giriş yapmanız gerekmektedir!";
			}
		?>
		
			<hr/>
			<a href="adminAnasayfa.php">Admin Anasayfasına gitmek için Tıklayınız!</a><br />
			</center>
	</body>
</html>