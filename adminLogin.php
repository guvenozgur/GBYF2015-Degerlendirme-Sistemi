<?php
include('db.php');
?>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Administration</title>
    </head>
	
    <body>
		<center>
		<div class="header">
			<h1>Admin Login Sayfası</h1>
		</div>
		
		<?php
			//Admin login olmuşsa onu logout yapıyoruz:
			if(isset($_SESSION['adminIsmi']))
			{
				//log
				$kullaniciId=$_SESSION['adminId'];
				// tarih:
				$tarih=date(DATE_RFC822);
				// degiskenId:
				$degiskenId=$_SESSION['adminId'];
				//degisiklik:
				$degisiklik=$_SESSION['adminId']." id'li admin sistemden cikis yapti.";
				$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';
				$logResult=mysqli_query($conn, $logQuery);
				unset($_SESSION['adminIsmi'], $_SESSION['adminId'] );
		?>
				
				<div class="message">
					Başarılı bir şekilde sistemden çıkış yaptınız.<br />
					<a href="<?php echo $url_admin; ?>">Anasayfa</a>
				</div>
				
		<?php
			}
			else
			{
				$eskiAdminIsmi = '';
				//İlk olarak formun daha önce doldurulup doldurulmadığını kontrol ediyoruz.
				if(isset($_POST['adminIsmi'], $_POST['adminSifre']))
				{
					if(get_magic_quotes_gpc())
					{
						$eskiAdminIsmi = stripslashes($_POST['adminIsmi']);
						$adminIsmi = mysqli_real_escape_string($conn,stripslashes($_POST['adminIsmi']));
						$adminSifre = stripslashes($_POST['adminSifre']);
					}
					else
					{
						$adminIsmi = mysqli_real_escape_string($conn,$_POST['adminIsmi']);
						$adminSifre = $_POST['adminSifre'];
					}
					//Adminin sifresini alıyoruz
					$req = mysqli_query($conn,'select adminId, adminSifre from admin where adminIsmi="'.$adminIsmi.'"');
					$dn = mysqli_fetch_array($req);
					//Girilen şifrenin doğruluğunu kontrol ediyoruz:
					if($dn['adminSifre']==$adminSifre and mysqli_num_rows($req)>0)
					{
						//Eğer şifre doğruysa formu tekrar göstermiyoruz
						$form = false;
						//admin ismini ve şifresini session içerisine atıyoruz
						$_SESSION['adminIsmi'] = $_POST['adminIsmi'];
						$_SESSION['adminId'] = $dn['adminId'];
						//log
						$kullaniciId=$_SESSION['adminId'];
						// tarih:
						$tarih=date(DATE_RFC822);
						// degiskenId:
						$degiskenId=$_SESSION['adminId'];
						//degisiklik:
						$degisiklik=$_SESSION['adminId']." id'li admin sisteme giriş yapti.";
						$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';
						$logResult=mysqli_query($conn, $logQuery);
	    ?>
						<div class="message">
							Başarılı bir şekilde giriş yaptınız. <br />
							<a href="<?php echo $url_admin; ?>"> Admin anasayfası için lutfen tıklayınız.</a>
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
						<form action="adminLogin.php" method="post">
			
							<div class="center">
								<label for="adminIsmi">Admin İsmi: </label>
								<input type="text" name="adminIsmi" id="adminIsmi" value="<?php echo htmlentities($eskiAdminIsmi, ENT_QUOTES, 'UTF-8'); ?>" /><br />
								<label for="adminSifre">Admin Şifresi:</label>
								<input type="password" name="adminSifre" id="adminSifre" /><br />
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