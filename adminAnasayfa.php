<?php
include('db.php')
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Admin Anasayfa</title>
    </head>
    <body>
		<center>	
		<div class="content">
			<?php
				//Eğer admin giriş yapmışsa, giriş mesajı yazdırırız ekranda
				if(isset($_SESSION['adminIsmi']))
				{
			?>
					
					Merhaba<?php if(isset($_SESSION['adminIsmi'])){echo ' '.htmlentities($_SESSION['adminIsmi'], ENT_QUOTES, 'UTF-8');} ?><br/>
					Sistemde gerekli değişiklikleri yapmak için giriş yapmış bulunmaktasın!<br/><br/>
					
					
					<a href="adminJuri.php">Juri üyesi eklemek için tıklayınız.</a><br />
					<a href="adminGrup.php">Grup eklemek için tıklayınız.</a><br />
					<a href="adminDegerlendirmeler.php">Değerlendirmeleri görebilmek için tıklayınız.</a><br />
					<a href="adminDegerlendirme.php">Değerlendirme sayfalarını açmak veya kapatmak için tıklayınız.</a><br />
				<hr/>
					<a href="adminIlkToplam.php">İlk oturumun toplam puanını hesaplamak için tıklayınız.</a><br />
					<a href="adminIkinciToplam.php">İkinci oturumun toplam puanlamasını hesaplamak için tıklayınız.</a><br />
				<hr/>
					<a href="ilkSiralama.php">İlk oturumun sıralamalarını öğrenmek için tıklayınız.(Önce toplam puanları yapmanız önerilir)</a><br/>
					<a href="ikinciSiralama.php">İkinci oturumun sıralamalarını öğrenmek için tıklayınız.(Önce toplam puanları yapmanız önerilir)</a><br/>
				<hr/>
					<a href="adminLogin.php">Çıkış</a>
			<?php
				}
				else
				{
					//Eğer admin sisteme giriş yapmamışsa Login sayfasına yönlendiririz!
			?>
					Merhaba, sistemde gerekli değişiklikleri yapmak için giriş yapmanız gerekmektedir! <br/><br/>
					<a href="adminLogin.php">Giriş yapmak için lutfen tıklayınız.</a>
			<?php
				}
			?>
		</div>
		</center>
	</body>
</html>