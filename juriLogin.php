<?php
include('db.php');
?>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Juri Login Sayfası</title>
    </head>
	
    <body>
		<center>
		<div class="header">
			<h1>Juri Login</h1>
		</div>
		
		<?php
			//Jüri login olmuşsa onu logout yapıyoruz:
			if(isset($_SESSION['juriIsmi']))
			{
				//log:
				// kullaniciId:
				$kullaniciId=$_SESSION['juriId'];
				// tarih:
				$tarih=date(DATE_RFC822);
				// degiskenId:
				$degiskenId=$_SESSION['juriId'];
				//degisiklik:
				$degisiklik=$_SESSION['juriIsmi']." isimli juri sistemden cikis yapti.";
				$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';
				$logResult=mysqli_query($conn, $logQuery);
				/////////
				unset($_SESSION['juriIsmi'], $_SESSION['juriId'], $_SESSION['juriSoyismi'], $_SESSION['juriEmail'], $_SESSION['degerlendirmeGrubu'], $_SESSION['degerlendirmeSinifi'] );
		?>
				
				<div class="message">
					Başarılı bir şekilde sistemden çıkış yaptınız.<br />
					<a href="juriAnasayfa.php">Anasayfa</a>
				</div>
				
		<?php
			}
			else
			{
				$eskiJuriIsmi = '';
				//İlk olarak formun daha önce doldurulup doldurulmadığını kontrol ediyoruz.
				if(isset($_POST['email'], $_POST['juriSifre']))
				{
					if(get_magic_quotes_gpc())
					{
						$eskiEmail = stripslashes($_POST['email']);
						$email = mysqli_real_escape_string($conn,stripslashes($_POST['email']));
						$juriSifre = stripslashes($_POST['juriSifre']);
					}
					else
					{
						$email = mysqli_real_escape_string($conn,$_POST['email']);
						$juriSifre = $_POST['juriSifre'];
					}
					//Jüri sifresini alıyoruz
					$req = mysqli_query($conn,'select juriIsmi, juriId, juriSifre, juriSoyismi, degerlendirmeGrubu, degerlendirmeSinifi from juri where juriEmail="'.$email.'"');
					$dn = mysqli_fetch_array($req);
					//Girilen şifrenin doğruluğunu kontrol ediyoruz:
					if($dn['juriSifre']==$juriSifre and mysqli_num_rows($req)>0)
					{
						//Eğer şifre doğruysa formu tekrar göstermiyoruz
						$form = false;
						//juri ismini, soyismini ve şifresini session içerisine atıyoruz
						$_SESSION['juriIsmi'] = $dn['juriIsmi'];
						$_SESSION['juriEmail'] = $_POST['email'];
						$_SESSION['juriId'] = $dn['juriId'];
						$_SESSION['juriSoyismi'] = $dn['juriSoyismi'];
						$_SESSION['degerlendirmeGrubu'] = $dn['degerlendirmeGrubu'];
						$_SESSION['degerlendirmeSinifi']=$dn['degerlendirmeSinifi'];
						//log:
						// kullaniciId:
						$kullaniciId=$_SESSION['juriId'];
						// tarih:
						$tarih=date(DATE_RFC822);
						// degiskenId:
						$degiskenId=$_SESSION['juriId'];
						//degisiklik:
						$degisiklik=$_SESSION['juriIsmi']." isimli juri sisteme giris yapti.";
						$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';
						$logResult=mysqli_query($conn, $logQuery);
						/////////
	    ?>
						<div class="message">
							Başarılı bir şekilde giriş yaptınız. <br />
							<a href="juriAnasayfa.php"> Juri anasayfası için lutfen tıklayınız.</a>
						</div>
		<?php
					}
					else
					{
						//Aksi takdirde kullanıcı isminin veya şifresinin yanlış olduğunu söyleriz.
						$form = true;
						$message = 'Sistemde böyle bir juri kayıtlı değildir! Kullanıcı isminiz veya şifreniz yanlış olabilir!';
					}
				}
				else
				{
					$form = true;
				}
				if($form)
				{
					//Mesaj gerekliyse ekrana yazarız.
					if(isset($message))
					{
						echo '<div class="message">'.$message.'</div>';
					}
					// Form:
		?>
					<div class="content">
						<form action="juriLogin.php" method="post">
			
							<div class="center">
								<label for="email"> Email adresiniz: </label>
								<input type="text" name="email" id="email" value="<?php echo htmlentities($eskiJuriIsmi, ENT_QUOTES, 'UTF-8'); ?>" /><br />
								<label for="juriSifre">Şifreniz:</label>
								<input type="password" name="juriSifre" id="juriSifre" /><br />
								<input type="submit" value="Giriş" />
							</div>
						</form>
					</div>
		<?php
				}
			}
		?>
	</center>
	</body>
</html>