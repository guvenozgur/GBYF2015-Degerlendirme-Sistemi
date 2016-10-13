<?php
include('db.php');
?>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Moderatör</title>
    </head>
	
    <body>
		<center>
		<div class="header">
			<h1>Moderatör Giriş Sayfası</h1>
		</div>
		
		<?php
			//Moderatör login olmuşsa onu logout yapıyoruz:
			if(isset($_SESSION['moderatorIsmi']))
			{
				//log:
				// kullaniciId:
				$kullaniciId=$_SESSION['moderatorId'];
				// tarih:
				$tarih=date(DATE_RFC822);
				// degiskenId:
				$degiskenId=$_SESSION['moderatorId'];
				//degisiklik:
				$degisiklik=$_SESSION['moderatorIsmi']." isimli moderator sistemden cikis yapti.";
				$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';
				$logResult=mysqli_query($conn, $logQuery);
				/////////
				unset($_SESSION['moderatorIsmi'], $_SESSION['moderatorId']);
		?>
				
				<div class="message">
					Başarılı bir şekilde sistemden çıkış yaptınız.<br />
					<a href="moderatorAnasayfa.php">Moderator anasayfasına gitmek için tıklayınız.</a><br/>
					<a href="juriAnasayfa.php">Juri anasayfasına gitmek için tıklayınız.</a>
				</div>
				
		<?php
			}
			else
			{
				$eskiModeratorIsmi = '';
				//İlk olarak formun daha önce doldurulup doldurulmadığını kontrol ediyoruz.
				if(isset($_POST['moderatorEmail'], $_POST['moderatorSifre']))
				{
					if(get_magic_quotes_gpc())
					{
						$eskiModeratorEmail = stripslashes($_POST['moderatorEmail']);
						$moderatorEmail = mysqli_real_escape_string($conn,stripslashes($_POST['moderatorEmail']));
						$moderatorSifre = stripslashes($_POST['moderatorSifre']);
					}
					else
					{
						$moderatorEmail = mysqli_real_escape_string($conn,$_POST['moderatorEmail']);
						$moderatorSifre = $_POST['moderatorSifre'];
					}
					//moderatorün sifresini alıyoruz
					$req = mysqli_query($conn,'select moderatorId, moderatorSifre, moderatorIsmi, moderatorSinifi, moderatorGrubu  from moderator where moderatorEmail="'.$moderatorEmail.'"');
					$dn = mysqli_fetch_array($req);
					//Girilen şifrenin doğruluğunu kontrol ediyoruz:
					if($dn['moderatorSifre']==$moderatorSifre and mysqli_num_rows($req)>0)
					{
						//Eğer şifre doğruysa formu tekrar göstermiyoruz
						$form = false;
						//admin ismini ve şifresini session içerisine atıyoruz
						$_SESSION['moderatorIsmi'] = $dn['moderatorIsmi'];
						$_SESSION['moderatorId'] = $dn['moderatorId'];
						$_SESSION['moderatorSinifi'] = $dn['moderatorSinifi'];
						$_SESSION['moderatorGrubu'] = $dn['moderatorGrubu'];
						
						//log:
						// kullaniciId:
						$kullaniciId=$_SESSION['moderatorId'];
						// tarih:
						$tarih=date(DATE_RFC822);
						// degiskenId:
						$degiskenId=$_SESSION['moderatorId'];
						//degisiklik:
						$degisiklik=$_SESSION['moderatorIsmi']." isimli moderator sisteme giris yapti.";
						$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';
						$logResult=mysqli_query($conn, $logQuery);
						/////////
	    ?>
						<div class="message">
							Başarılı bir şekilde giriş yaptınız. <br />
							<a href="moderatorAnasayfa.php"> Moderatör anasayfası için lutfen tıklayınız.</a>
						</div>
		<?php
					}
					else
					{
						//Aksi takdirde kullanıcı isminin veya şifresinin yanlış olduğunu söyleriz.
						$form = true;
						$message = 'Kullanıcı isminiz veya şifreniz yanlış!';
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
						<form action="moderatorLogin.php" method="post">
			
							<div class="center">
								<label for="moderatorEmail">Moderatör Email: </label><br/>
								<input type="text" name="moderatorEmail" id="moderatorEmail" value="<?php echo htmlentities($eskiModeratorIsmi, ENT_QUOTES, 'UTF-8'); ?>" /><br />
								<label for="adminSifre">Moderatör Şifre:</label><br/>
								<input type="password" name="moderatorSifre" id="moderatorSifre" /><br />
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