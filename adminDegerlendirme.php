<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Değerlendirmeleri Aktifleştirme Ekranı</title>
	</head>
<?php
	include("db.php");
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
			
		if(isset($_POST['degerlendirmeOnOff'] ))
		{
			///log işlemleri
			$kullaniciId=$_SESSION['adminId'];
			$tarih=date(DATE_RFC822);
///////////////

			$degerlendirmeOnOff=mysqli_real_escape_string($conn, $_POST['degerlendirmeOnOff']); 
			///////////////////////////////////////
			if($degerlendirmeOnOff=="0")
			{
				$sql="UPDATE `aktiflestirme` SET `onOff`='1' WHERE aktiflestirmeId=1 ";
				$result=mysqli_query($conn, $sql);
				//log
				$degiskenId="1";
				$degisiklik="Aktiflestirme Akademik 1. grup on";
				$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';
				$logResult=mysqli_query($conn, $logQuery);
				if($result)
					echo "Akademik değerlendirmenin 1. aşamasının ilk grubu aktifleştirildi!";
				else
					echo "Akademik değerlendirmenin 1. aşamasının ikinci grubunu aktifleştirirken bir sorunla karşılaşıldı!";
			}
			///////////////////////////////////////
			else if($degerlendirmeOnOff=="1")
			{
				$sql="UPDATE `aktiflestirme` SET `onOff`='1' WHERE aktiflestirmeId=2 ";
				$result=mysqli_query($conn, $sql);
				//log
				$degiskenId="2";
				$degisiklik="Aktiflestirme Akademik 2. grup on";
				$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';
				$logResult=mysqli_query($conn, $logQuery);
				if($result)
					echo "Akademik değerlendirmenin 1. aşamasının ikinci grubu aktifleştirildi!";
				else
					echo "Akademik değerlendirmenin 1. aşamasının ikinci grubunu aktifleştirirken bir sorunla karşılaşıldı!";
			}
			//////////////////////////////////////////
			else if($degerlendirmeOnOff=="2")
			{
				$sql="UPDATE `aktiflestirme` SET `onOff`='1' WHERE aktiflestirmeId=3 ";
				$result=mysqli_query($conn, $sql);
				//log
				$degiskenId="3";
				$degisiklik="Aktiflestirme Sektorel 1. grup on";
				$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';
				$logResult=mysqli_query($conn, $logQuery);
				if($result)
					echo "Sektörel değerlendirmenin 1. aşamasının ilk grubu aktifleştirildi!";
				else
					echo "Sektörel değerlendirmenin 1. aşamasının ilk grubunu aktifleştirirken bir sorunla karşılaşıldı!";
			}
			//////////////////////////////////////////
			else if($degerlendirmeOnOff=="3")
			{
				$sql="UPDATE `aktiflestirme` SET `onOff`='1' WHERE aktiflestirmeId=4 ";
				$result=mysqli_query($conn, $sql);
				//log
				$degiskenId="4";
				$degisiklik="Aktiflestirme Sektorel 2. grup on";
				$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';	
				$logResult=mysqli_query($conn, $logQuery);
				if($result)
					echo "Sektörel değerlendirmenin 1. aşamasının ikinci grubu aktifleştirildi!";
				else
					echo "Sektörel değerlendirmenin 1. aşamasının ikinci grubunu aktifleştirirken bir sorunla karşılaşıldı!";
			}
			//////////////////////////////////////////
			else if($degerlendirmeOnOff=="4")
			{
				$sql="UPDATE `aktiflestirme` SET `onOff`='1' WHERE aktiflestirmeId=5 ";
				$result=mysqli_query($conn, $sql);
				//log
				$degiskenId="5";
				$degisiklik="Aktiflestirme Fikir 1. grup on";
				$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';					
				$logResult=mysqli_query($conn, $logQuery);
				if($result)
					echo "Fikir değerlendirmenin 1. aşamasının ilk grubu aktifleştirildi!";
				else
					echo "Fikir değerlendirmenin 1. aşamasının ilk grubunu aktifleştirirken bir sorunla karşılaşıldı!";
			}
			//////////////////////////////////////////
			else if($degerlendirmeOnOff=="5")
			{
				$sql="UPDATE `aktiflestirme` SET `onOff`='1' WHERE aktiflestirmeId=6 ";
				$result=mysqli_query($conn, $sql);
				//log
				$degiskenId="6";
				$degisiklik="Aktiflestirme Fikir 2. grup on";
				$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';					
				$logResult=mysqli_query($conn, $logQuery);
				
				if($result)
					echo "Fikir değerlendirmenin 1. aşamasının ikinci grubu aktifleştirildi!";
				else
					echo "Fikir değerlendirmenin 1. aşamasının ikinci grubunu aktifleştirirken bir sorunla karşılaşıldı!";
			}
	////////////////////////////////////////////////////////

			///////////////////////////////////////
			else if($degerlendirmeOnOff=="6")
			{
				$sql="UPDATE `aktiflestirme` SET `onOff`='0' WHERE aktiflestirmeId=1 ";
				$result=mysqli_query($conn, $sql);
				//log
				$degiskenId="1";
				$degisiklik="Aktiflestirme Akademik 1. grup off";
				$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';					
				$logResult=mysqli_query($conn, $logQuery);
				if($result)
					echo "Akademik değerlendirmenin 1. aşamasının ilk grubu sonlandırıldı!";
				else
					echo "Akademik değerlendirmenin 1. aşamasının ikinci grubunu sonlandırırken bir sorunla karşılaşıldı!";
			}
			///////////////////////////////////////
			else if($degerlendirmeOnOff=="7")
			{
				$sql="UPDATE `aktiflestirme` SET `onOff`='0' WHERE aktiflestirmeId=2 ";
				$result=mysqli_query($conn, $sql);
				//log
				$degiskenId="2";
				$degisiklik="Aktiflestirme Akademik 2. grup off";
				$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES( "'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';					
				$logResult=mysqli_query($conn, $logQuery);
				if($result)
					echo "Akademik değerlendirmenin 1. aşamasının ikinci grubu sonlandırıldı!";
				else
					echo "Akademik değerlendirmenin 1. aşamasının ikinci grubunu sonlandırırken bir sorunla karşılaşıldı!";
			}
			//////////////////////////////////////////
			else if($degerlendirmeOnOff=="8")
			{
				$sql="UPDATE `aktiflestirme` SET `onOff`='0' WHERE aktiflestirmeId=3 ";
				$result=mysqli_query($conn, $sql);
				//log
				$degiskenId="3";
				$degisiklik="Aktiflestirme Sektorel 1. grup off";
				$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';					
				$logResult=mysqli_query($conn, $logQuery);
				if($result)
					echo "Sektörel değerlendirmenin 1. aşamasının ilk grubu sonlandırıldı!";
				else
					echo "Sektörel değerlendirmenin 1. aşamasının ilk grubunu sonlandırırken bir sorunla karşılaşıldı!";
			}
			//////////////////////////////////////////
			else if($degerlendirmeOnOff=="9")
			{
				$sql="UPDATE `aktiflestirme` SET `onOff`='0' WHERE aktiflestirmeId=4 ";
				$result=mysqli_query($conn, $sql);
				//log
				$degiskenId="4";
				$degisiklik="Aktiflestirme Sektorel 2. grup off";
				$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';					
				$logResult=mysqli_query($conn, $logQuery);
				if($result)
					echo "Sektörel değerlendirmenin 1. aşamasının ikinci grubu sonlandırıldı!";
				else
					echo "Sektörel değerlendirmenin 1. aşamasının ikinci grubunu sonlandırırken bir sorunla karşılaşıldı!";
			}
			//////////////////////////////////////////
			else if($degerlendirmeOnOff=="10")
			{
				$sql="UPDATE `aktiflestirme` SET `onOff`='0' WHERE aktiflestirmeId=5 ";
				$result=mysqli_query($conn, $sql);
				//log
				$degiskenId="5";
				$degisiklik="Aktiflestirme Fikir 1. grup off";
				$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';					
				$logResult=mysqli_query($conn, $logQuery);
				if($result)
					echo "Fikir değerlendirmenin 1. aşamasının ilk grubu sonlandırıldı!";
				else
					echo "Fikir değerlendirmenin 1. aşamasının ilk grubunu sonlandırırken bir sorunla karşılaşıldı!";
			}
			//////////////////////////////////////////
			else if($degerlendirmeOnOff=="11")
			{
				$sql="UPDATE `aktiflestirme` SET `onOff`='0' WHERE aktiflestirmeId=6 ";
				$result=mysqli_query($conn, $sql);
				//log
				$degiskenId="6";
				$degisiklik="Aktiflestirme Fikir 2. grup off";
				$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';					
				$logResult=mysqli_query($conn, $logQuery);
				if($result)
					echo "Fikir değerlendirmenin 1. aşamasının ikinci grubu sonlandırıldı!";
				else
					echo "Fikir değerlendirmenin 1. aşamasının ikinci grubunu sonlandırırken bir sorunla karşılaşıldı!";
			}
	/////////
			if($degerlendirmeOnOff=="12")
			{
				$sql="UPDATE `aktiflestirme` SET `onOff`='1' WHERE aktiflestirmeId=7 ";
				$result=mysqli_query($conn, $sql);
				//log
				$degiskenId="7";
				$degisiklik="Aktiflestirme Akademik 2. asama on";
				$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';					
				$logResult=mysqli_query($conn, $logQuery);
				if($result)
					echo "Akademik değerlendirmenin 2. aşaması aktifleştirildi!";
				else
					echo "Akademik değerlendirmenin 2. aşamasını aktifleştirirken bir sorunla karşılaşıldı!";
			}
			/////////////////////////
			if($degerlendirmeOnOff=="13")
			{
				$sql="UPDATE `aktiflestirme` SET `onOff`='1' WHERE aktiflestirmeId=8 ";
				$result=mysqli_query($conn, $sql);
				//log
				$degiskenId="8";
				$degisiklik="Aktiflestirme Sektorel 2. asama on";
				$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';					
				$logResult=mysqli_query($conn, $logQuery);
				if($result)
					echo "Sektörel değerlendirmenin 2. aşaması aktifleştirildi!";
				else
					echo "Sektörel değerlendirmenin 2. aşamasını aktifleştirirken bir sorunla karşılaşıldı!";
			}
			//////////////////////
			if($degerlendirmeOnOff=="14")
			{
				$sql="UPDATE `aktiflestirme` SET `onOff`='1' WHERE aktiflestirmeId=9 ";
				$result=mysqli_query($conn, $sql);
				//log
				$degiskenId="9";
				$degisiklik="Aktiflestirme Fikir 2. asama on";
				$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';					
				$logResult=mysqli_query($conn, $logQuery);
				if($result)
					echo "Fikir değerlendirmesinin 2. aşaması aktifleştirildi!";
				else
					echo "Fikir değerlendirmenin 2. aşamasını aktifleştirirken bir sorunla karşılaşıldı!";
			}
	/////////
			if($degerlendirmeOnOff=="15")
			{
				$sql="UPDATE `aktiflestirme` SET `onOff`='0' WHERE aktiflestirmeId=7 ";
				$result=mysqli_query($conn, $sql);
				//log
				$degiskenId="7";
				$degisiklik="Aktiflestirme Akademik 2. asama off";
				$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';					
				$logResult=mysqli_query($conn, $logQuery);
				if($result)
					echo "Akademik değerlendirmenin 2. aşaması sonlandırıldı!";
				else
					echo "Akademik değerlendirmenin 2. aşamasını sonlandırırken bir sorunla karşılaşıldı!";
			}
			/////////////////////////
			if($degerlendirmeOnOff=="16")
			{
				$sql="UPDATE `aktiflestirme` SET `onOff`='0' WHERE aktiflestirmeId=8 ";
				$result=mysqli_query($conn, $sql);
				//log
				$degiskenId="8";
				$degisiklik="Aktiflestirme Sektorel 2. asama off";
				$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';					
				$logResult=mysqli_query($conn, $logQuery);
				if($result)
					echo "Sektörel değerlendirmenin 2. aşaması sonlandırıldı!";
				else
					echo "Sektörel değerlendirmenin 2. aşamasını sonlandırırken bir sorunla karşılaşıldı!";
			}
			//////////////////////
			if($degerlendirmeOnOff=="17")
			{
				$sql="UPDATE `aktiflestirme` SET `onOff`='0' WHERE aktiflestirmeId=9 ";
				$result=mysqli_query($conn, $sql);
				//log
				$degiskenId="9";
				$degisiklik="Aktiflestirme Fikir 2. asama off";
				$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';					
				$logResult=mysqli_query($conn, $logQuery);
				if($result)
					echo "Fikir değerlendirmesinin 2. aşaması sonlandırıldı!";
				else
					echo "Fikir değerlendirmenin 2. aşamasını sonlandırırken bir sorunla karşılaşıldı!";
			}
			
		}
		
		
	}
?>

	<body>
		<center>
		<h1>Değerlendirmeyi Aktifleştir veya Pasifleştir</h1>
		<?php
		if(isset($_SESSION['adminIsmi']))
			{
		?>
			<b>Yanlızca 1 tane seçiniz!</b>
			<form action="adminDegerlendirme.php" method="post">
				<input type="radio" name="degerlendirmeOnOff" value="0">Akademik değerlendirmenin ilk aşamasının birinci grubunun puanlamasını başlat.<br/>
				<input type="radio" name="degerlendirmeOnOff" value="1">Akademik değerlendirmenin ilk aşamasının ikinci grubunun puanlamasını başlat.<br/>
				
				<input type="radio" name="degerlendirmeOnOff" value="2">Sektörel değerlendirmenin ilk aşamasının birinci grubunun puanlamasını başlat.<br/>
				<input type="radio" name="degerlendirmeOnOff" value="3">Sektörel değerlendirmenin ilk aşamasının ikinci grubunun puanlamasını başlat.<br/>
				
				<input type="radio" name="degerlendirmeOnOff" value="4">Fikir yarışmasının ilk aşamasının birinci grubunun puanlamasını başlat.<br/>
				<input type="radio" name="degerlendirmeOnOff" value="5">Fikir yarışmasının ilk aşamasının ikinci grubunun puanlamasını başlat.<br/>

			<hr/>
				
				<input type="radio" name="degerlendirmeOnOff" value="6">Akademik değerlendirmenin ilk aşamasının birinci grubunun puanlamasını sonlandır.<br/>
				<input type="radio" name="degerlendirmeOnOff" value="7">Akademik değerlendirmenin ilk aşamasının ikinci grubunun puanlamasını sonlandır.<br/>
				
				<input type="radio" name="degerlendirmeOnOff" value="8">Sektörel değerlendirmenin ilk aşamasının birinci grubunun puanlamasını sonlandır.<br/>
				<input type="radio" name="degerlendirmeOnOff" value="9">Sektörel değerlendirmenin ilk aşamasının ikinci grubunun puanlamasını sonlandır.<br/>
				
				<input type="radio" name="degerlendirmeOnOff" value="10">Fikir yarışmasının ilk aşamasının birinci grubunun puanlamasını sonlandır.<br/>
				<input type="radio" name="degerlendirmeOnOff" value="11">Fikir yarışmasının ilk aşamasının ikinci grubunun puanlamasını sonlandır.<br/>
				
			<hr/>	
			<b>İkinci aşamayı başlatmadan önce ilk aşamayı kapattığınızdan ve gerekli hesaplamaları yaptığınızdan emin olunuz!</b><br/>
				<input type="radio" name="degerlendirmeOnOff" value="12">Akademik değerlendirmenin ikinci aşamasının puanlamasını başlat.<br/>
				
				<input type="radio" name="degerlendirmeOnOff" value="13">Sektörel değerlendirmenin ikinci aşamasının puanlamasını başlat.<br/>
				
				<input type="radio" name="degerlendirmeOnOff" value="14">Fikir yarışmasının ikinci aşamasının puanlamasını başlat.<br/>
				
			<hr/>
			
				<input type="radio" name="degerlendirmeOnOff" value="15">Akademik değerlendirmenin ikinci aşamasının puanlamasını sonlandır.<br/>
				
				<input type="radio" name="degerlendirmeOnOff" value="16">Sektörel değerlendirmenin ikinci aşamasının puanlamasını sonlandır.<br/>
				
				<input type="radio" name="degerlendirmeOnOff" value="17">Fikir yarışmasının ikinci aşamasının puanlamasını sonlandır.<br/>
				
				<br />	
				<input type="submit" value="Uygula"/><br />
			</form>
			
			
		<?php
			}
			else
			{
				echo"Bu işlem için sisteme admin olarak giriş yapmanız gerekmektedir!";
			}
		?>
		
			<hr/>
			<a href="adminAnasayfa.php">Admin Anasayfasına gitmek için Tıklayınız!</a><br />
			</center>
	</body>
</html>