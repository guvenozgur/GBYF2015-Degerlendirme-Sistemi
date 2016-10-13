<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Grup Ekleme</title>
	</head>
<?php
	include("db.php");
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(isset($_POST['projeIsmi'], $_POST['katilimci1'], $_POST['katilimci1uni'], $_POST['katilimci1dep'], $_POST['grupEmail'], $_POST['degerlendirmeSinifi'], $_POST['degerlendirmeGrubu'] ))
		{
			// username and password sent from Form
			$projeIsmi=mysqli_real_escape_string($conn, $_POST['projeIsmi']); 
			$katilimci1=mysqli_real_escape_string($conn, $_POST['katilimci1']);  
			$katilimci1uni=mysqli_real_escape_string($conn, $_POST['katilimci1uni']); 
			$katilimci1dep=mysqli_real_escape_string($conn, $_POST['katilimci1dep']); 
			$grupEmail=mysqli_real_escape_string($conn, $_POST['grupEmail']); 
			$degerlendirmeSinifi=mysqli_real_escape_string($conn, $_POST['degerlendirmeSinifi']); 
			$degerlendirmeGrubu=mysqli_real_escape_string($conn, $_POST['degerlendirmeGrubu']); 
		///////////////////////////////	
			if($_POST['katilimci2']!=null)
				$katilimci2=mysqli_real_escape_string($conn, $_POST['katilimci2']);
			else
				$katilimci2=mysqli_real_escape_string($conn, '');
			
			if($_POST['katilimci2uni']!=null)
				$katilimci2uni=mysqli_real_escape_string($conn, $_POST['katilimci2uni']);
			else
				$katilimci2uni=mysqli_real_escape_string($conn, '');
			
			if($_POST['katilimci2dep']!=null)
				$katilimci2dep=mysqli_real_escape_string($conn, $_POST['katilimci2dep']);
			else
				$katilimci2dep=mysqli_real_escape_string($conn, '');
		/////////////////////////////
			if($_POST['katilimci3']!=null)
				$katilimci3=mysqli_real_escape_string($conn, $_POST['katilimci3']);
			else
				$katilimci3=mysqli_real_escape_string($conn, '');
			
			if($_POST['katilimci3uni']!=null)
				$katilimci3uni=mysqli_real_escape_string($conn, $_POST['katilimci3uni']);
			else
				$katilimci3uni=mysqli_real_escape_string($conn, '');
			
			if($_POST['katilimci3dep']!=null)
				$katilimci3dep=mysqli_real_escape_string($conn, $_POST['katilimci3dep']);
			else
				$katilimci3dep=mysqli_real_escape_string($conn, '');
		////////////////////////////
			if($_POST['katilimci4']!=null)
				$katilimci4=mysqli_real_escape_string($conn, $_POST['katilimci4']);
			else
				$katilimci4=mysqli_real_escape_string($conn, '');
			
			if($_POST['katilimci4uni']!=null)
				$katilimci4uni=mysqli_real_escape_string($conn, $_POST['katilimci4uni']);
			else
				$katilimci4uni=mysqli_real_escape_string($conn, '');
			
			if($_POST['katilimci4dep']!=null)
				$katilimci4dep=mysqli_real_escape_string($conn, $_POST['katilimci4dep']);
			else
				$katilimci4dep=mysqli_real_escape_string($conn, '');
		////////////////////////////
			if($_POST['katilimci5']!=null)
				$katilimci5=mysqli_real_escape_string($conn, $_POST['katilimci5']);
			else
				$katilimci5=mysqli_real_escape_string($conn, '');
	
			if($_POST['katilimci5uni']!=null)
				$katilimci5uni=mysqli_real_escape_string($conn, $_POST['katilimci5uni']);
			else
				$katilimci5uni=mysqli_real_escape_string($conn, '');
	
			if($_POST['katilimci5dep']!=null)
				$katilimci5dep=mysqli_real_escape_string($conn, $_POST['katilimci5dep']);
			else
				$katilimci5dep=mysqli_real_escape_string($conn, '');
		///////////////////////
		
			$getNumofGrupQuery="SELECT COUNT(grupId) FROM grup";
			$getNumofGrup=mysqli_fetch_row(mysqli_query($conn, $getNumofGrupQuery));
			$numofGrup=$getNumofGrup[0];
			$id=$numofGrup+300;
			$grupId=mysqli_real_escape_string($conn, $id);
			
			/// log
			
			// kullaniciId:
			$kullaniciId=$_SESSION['adminId'];
			// tarih:
			$tarih=date(DATE_RFC822);
			// degiskenId:
			$degiskenId=$grupId;
			//degisiklik:
			$degisiklik="Yeni grup:proje ismi:$projeIsmi";
			$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';
			$logResult=mysqli_query($conn, $logQuery);
		/////
			
			$sql="INSERT INTO `grup`(`grupId`, `projeIsmi` , `katilimci1` ,`katilimci1uni`,`katilimci1dep`, `katilimci2`,`katilimci2uni`, `katilimci2dep`,`katilimci3`,`katilimci3uni`,`katilimci3dep`, 
			                          `katilimci4`, `katilimci4uni`, `katilimci4dep`,`katilimci5`, `katilimci5uni`,`katilimci5dep`,`grupEmail`, `degerlendirmeSinifi`, `degerlendirmeGrubu`)
			      VALUES ('$grupId','$projeIsmi','$katilimci1', '$katilimci1uni','$katilimci1dep', '$katilimci2','$katilimci2uni','$katilimci2dep','$katilimci3','$katilimci3uni','$katilimci3dep',
				           '$katilimci4','$katilimci4uni','$katilimci4dep', '$katilimci5','$katilimci5uni','$katilimci5dep', '$grupEmail', '$degerlendirmeSinifi', '$degerlendirmeGrubu');";
			
			
			$result=mysqli_query($conn, $sql);
			if($result)
				echo "Grup database'e başarıyla eklenmiştir.";
			else
				echo "Grubu database'e eklerken bir sorunla karşılaşılmıştır!";
		}
		else
		{
			echo"Proje ismi, 1. katilimci ismi-soyismi, üniversitesi, bölümü , grupEmail, degerlendirme grubu, degerlendirme sınıfı bölümleri dolu olmak zorundadır! Birden fazla katılımcı varsa onlarda yazılmalıdır!";
			
		}
	}
?>

	<body>
		<center>
		<h1>Grup Ekleme Sayfası</h1>
		<?php
		if(isset($_SESSION['adminIsmi']))
			{
		?>
		<form action="adminGrup.php" method="post">
			
			<label>Gruba ait projenin İsmi :</label><br />
			<input type="text" name="projeIsmi"><br/><br />
			
			<label> 1. Grup üyesinin ismi ve soyismi: </label><br />
			<input type="text" name="katilimci1"><br/>
			<label> 1. grup üyesinin üniversitesi: </label><br />
			<input type="text" name="katilimci1uni"><br/>
			<label> 1. grup üyesinin bölümü: </label><br />
			<input type="text" name="katilimci1dep"><br/><br />
			
			<label>Eğer varsa 2. grup üyesinin ismi ve soyismi: </label><br />
			<input type="text" name="katilimci2"><br/>
			<label> Eğer varsa 2. grup üyesinin üniversitesi: </label><br />
			<input type="text" name="katilimci2uni"><br/>
			<label> Eğer varsa 2. Grup üyesinin bölümü: </label><br />
			<input type="text" name="katilimci2dep"><br/><br />
			
			<label>Eğer varsa 3. grup üyesinin ismi ve soyismi: </label><br />
			<input type="text" name="katilimci3"><br/>
			<label> Eğer varsa 3. grup üyesinin üniversitesi: </label><br />
			<input type="text" name="katilimci3uni"><br/>
			<label> Eğer varsa 3. Grup üyesinin bölümü: </label><br />
			<input type="text" name="katilimci3dep"><br/><br />
			
			<label>Eğer varsa 4. grup üyesinin ismi ve soyismi : </label><br />
			<input type="text" name="katilimci4"><br/>
			<label> Eğer varsa 4. grup üyesinin üniversitesi: </label><br />
			<input type="text" name="katilimci4uni"><br/>
			<label> Eğer varsa 4. Grup üyesinin bölümü: </label><br />
			<input type="text" name="katilimci4dep"><br/><br />
			
			<label>Eğer varsa 5. grup üyesinin ismi ve soyismi: </label><br />
			<input type="text" name="katilimci5"><br/>
			<label> Eğer varsa 5. grup üyesinin üniversitesi: </label><br />
			<input type="text" name="katilimci5uni"><br/>
			<label> Eğer varsa 5. Grup üyesinin bölümü: </label><br />
			<input type="text" name="katilimci5dep"><br/><br />
			
			<label>Grupla iletişime geçilebilecek email adresi : </label><br />
			<input type="text" name="grupEmail"><br/><br />
			
			
			<label>Değerlendirme sınıfını seçiniz: </label><br />
			<input type="radio" name="degerlendirmeSinifi" value="1">Akademik Değerlendirme<br/>
			<input type="radio" name="degerlendirmeSinifi" value="2">Sektörel Değerlendirme<br/>
			<input type="radio" name="degerlendirmeSinifi" value="3">Fikir Yarışması Değerlendirmesi<br/>
			<br />
			
			<label>Değerlendirme grubunu seçiniz: </label><br />
			<input type="radio" name="degerlendirmeGrubu" value="1">Seçtiğiniz yarışmanın 1. değerlendirme grubu<br/>
			<input type="radio" name="degerlendirmeGrubu" value="2">Seçtiğiniz yarışmanın 2. değerlendirme grubu<br/>
			<br />
			
			
			<input type="submit" value="Kayıt"/><br />
		</form>
		<?php
			}
			else
			{
				echo"Grup ekleyebilmek için sisteme admin olarak giriş yapmanız gerekmektedir!";
			}
		?>
		<hr/>
		<a href="adminAnasayfa.php">Admin Anasayfasına gitmek için Tıklayınız!</a><br />
		</center>
	</body>
</html>