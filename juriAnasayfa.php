<?php
	include('db.php')
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Juri Anasayfa</title>
    </head>
    <body>
		<center>
		<div class="content">
			<?php
				//Eğer juri giriş yapmışsa, giriş mesajı yazdırırız ekranda
				if(isset($_SESSION['juriIsmi']))
				{
			?>
					<b>Juri Anasayfa</b><br/>
					Merhaba sayın <?php if(isset($_SESSION['juriSoyismi'])){echo ' '.htmlentities($_SESSION['juriSoyismi'], ENT_QUOTES, 'UTF-8');} ?><br/>
					Sisteme başarılı bir şekilde giriş yaptınız!<br/><br/>
					
					
					<a href="<?php
								switch($_SESSION['degerlendirmeSinifi']){
									case "1":	?>  akademikDegerlendirme.php
									<?php
												break;
									case "2":   ?>  sektorelDegerlendirme.php
									<?php
												break;
									case "3": 	?> 	fikirDegerlendirme.php
									<?php			break;
									default: 	?> 	adminAnasayfa.php
									<?php
													break;
									
								}
					
					?> "> Değerlendirme yapmak için tıklayınız.</a><br />
					
					
					
					<a href="<?php
								switch($_SESSION['degerlendirmeSinifi']){
									case "1":	?>  akademikGuncelleme.php
									<?php
												break;
									case "2":   ?>  sektorelGuncelleme.php
									<?php
												break;
									case "3": 	?> 	fikirGuncelleme.php
									<?php			break;
									default: 	?> 	adminAnasayfa.php
									<?php
													break;
									
								}
					
					?> ">  Daha önce yapmış olduğunuz puanlamayı güncellemek için tıklayınız.</a><br />
					<a href="juriDegerlendirmeler.php">Yaptığınız değerlendirmeleri görmek için tıklayınız.</a><br />
					<a href="juriLogin.php">Çıkış</a>
					
			<?php
				}
				else
				{
					//Eğer juri üyesi sisteme giriş yapmamışsa Login sayfasına yönlendiririz!
			?>
					Merhaba, sistemde gerekli değişiklikleri yapmak için giriş yapmanız gerekmektedir! <br/><br/>
					<a href="juriLogin.php">Giriş yapmak için lutfen tıklayınız.</a>
			<?php
				}
			?>
		</div>
		</center>
	</body>
</html>