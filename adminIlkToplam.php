<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>İlk Puanlama</title>
	</head>
<?php
	include("db.php");
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(isset($_POST['hesapla']))
		{
			$hesapla=$_POST['hesapla'];
			
			switch($hesapla){
				
				case 1: 		$selectGroups="SELECT DISTINCT grupId FROM ilkakademik WHERE degerlendirmeGrubu=1 ";
								$res=mysqli_query($conn, $selectGroups);
					
								
								while($loop = mysqli_fetch_row($res))
								{
									$grupId=$loop[0];
									$genelToplam=0;
									$query='SELECT COUNT(degerlendirmeId) FROM ilkakademik WHERE grupId="'.$grupId.'"';
									$result = mysqli_query($conn, $query);
									$row = mysqli_fetch_row($result);
									// Bölen sayı:
									$toplamDegerlendirme=$row[0];
									
							/////////// Dogruluk ortalama puanı 
									$query2='SELECT dogruluk FROM ilkakademik WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamDogruluk=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamDogruluk=$toplamDogruluk+$row[0];
									
									$ortDogruluk=$toplamDogruluk/$toplamDegerlendirme;	
									$genelToplam=$genelToplam+$ortDogruluk;
							//////////Potansiyel ortalama puanı
									$query2='SELECT potansiyel FROM ilkakademik WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamPotansiyel=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamPotansiyel=$toplamPotansiyel+$row[0];
									
									$ortPotansiyel=$toplamPotansiyel/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortPotansiyel;
							//////////Sistematik ortalama puanı
									$query2='SELECT sistematik FROM ilkakademik WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamSistematik=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamSistematik=$toplamSistematik+$row[0];
									
									$ortSistematik=$toplamSistematik/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortSistematik;
							//////////Problem ortalama puanı
									$query2='SELECT problem FROM ilkakademik WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamProblem=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamProblem=$toplamProblem+$row[0];
									
									$ortProblem=$toplamProblem/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortProblem;
							//////////Literatür Tarama ortalama puanı
									$query2='SELECT literaturTarama FROM ilkakademik WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamLiteratur=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamLiteratur=$toplamLiteratur+$row[0];
									
									$ortLiteratur=$toplamLiteratur/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortLiteratur;
							//////////Sunum Tarama ortalama puanı
									$query2='SELECT sunum FROM ilkakademik WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamSunum=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamSunum=$toplamSunum+$row[0];
									
									$ortSunum=$toplamSunum/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortSunum;
							/////////// Özgünlük ortalama puanı 
									$query2='SELECT ozgunluk FROM ilkakademik WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamOzgunluk=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamOzgunluk=$toplamOzgunluk+$row[0];
									
									$ortOzgunluk=$toplamOzgunluk/$toplamDegerlendirme;	
									$genelToplam=$genelToplam+$ortOzgunluk;
							/////////// ilk aşama toplamını güncelleme:
								$ilkToplam=mysqli_real_escape_string($conn, $genelToplam); 
							//but first log
								
								//kullanıcı Id:
								$kullaniciId=$_SESSION['adminId'];
								// tarih:
								$tarih=date(DATE_RFC822);
								// degiskenId:
								$degiskenId=$grupId;
								//degisiklik:
								$degisiklik="Akademik grup asama 1 degerlendirme grubu 1 ilktoplam update--> ilkToplam=".$ilkToplam;
								$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';
								$logResult=mysqli_query($conn, $logQuery);
								if(!$logResult)
									echo"a problem";
								///
								
								$sqlUpdate='UPDATE grup SET ilkToplam="'.$ilkToplam.'" WHERE grupId="'.$grupId.'"';
								$guncelle=mysqli_query($conn, $sqlUpdate);	
								if(!$guncelle)
									echo"Hesaplarken bir problemle karşılaşıldı: grupId=$grupId";
							}
							break;
							
				case 2:		$selectGroups="SELECT DISTINCT grupId FROM ilkakademik WHERE degerlendirmeGrubu=2 ";
							$res=mysqli_query($conn, $selectGroups);
								
								while($loop = mysqli_fetch_row($res))
								{
									$grupId=$loop[0];
									$genelToplam=0;
									$query='SELECT COUNT(degerlendirmeId) FROM ilkakademik WHERE grupId="'.$grupId.'"';
									$result = mysqli_query($conn, $query);
									$row = mysqli_fetch_row($result);
									// Bölen sayı:
									$toplamDegerlendirme=$row[0];
									
							/////////// Dogruluk ortalama puanı 
									$query2='SELECT dogruluk FROM ilkakademik WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamDogruluk=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamDogruluk=$toplamDogruluk+$row[0];
									
									$ortDogruluk=$toplamDogruluk/$toplamDegerlendirme;	
									$genelToplam=$genelToplam+$ortDogruluk;
							//////////Potansiyel ortalama puanı
									$query2='SELECT potansiyel FROM ilkakademik WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamPotansiyel=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamPotansiyel=$toplamPotansiyel+$row[0];
									
									$ortPotansiyel=$toplamPotansiyel/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortPotansiyel;
							//////////Sistematik ortalama puanı
									$query2='SELECT sistematik FROM ilkakademik WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamSistematik=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamSistematik=$toplamSistematik+$row[0];
									
									$ortSistematik=$toplamSistematik/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortSistematik;
							//////////Problem ortalama puanı
									$query2='SELECT problem FROM ilkakademik WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamProblem=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamProblem=$toplamProblem+$row[0];
									
									$ortProblem=$toplamProblem/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortProblem;
							//////////Literatür Tarama ortalama puanı
									$query2='SELECT literaturTarama FROM ilkakademik WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamLiteratur=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamLiteratur=$toplamLiteratur+$row[0];
									
									$ortLiteratur=$toplamLiteratur/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortLiteratur;
							//////////Sunum Tarama ortalama puanı
									$query2='SELECT sunum FROM ilkakademik WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamSunum=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamSunum=$toplamSunum+$row[0];
									
									$ortSunum=$toplamSunum/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortSunum;
							/////////// Özgünlük ortalama puanı 
									$query2='SELECT ozgunluk FROM ilkakademik WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamOzgunluk=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamOzgunluk=$toplamOzgunluk+$row[0];
									
									$ortOzgunluk=$toplamOzgunluk/$toplamDegerlendirme;	
									$genelToplam=$genelToplam+$ortOzgunluk;
							/////////// ilk aşama toplamını güncelleme:
								$ilkToplam=mysqli_real_escape_string($conn, $genelToplam); 
								//but first log
								
								//kullanıcı Id:
								$kullaniciId=$_SESSION['adminId'];
								// tarih:
								$tarih=date(DATE_RFC822);
								// degiskenId:
								$degiskenId=$grupId;
								//degisiklik:
								$degisiklik="Akademik grup asama 1 degerlendirme grubu 2 ilktoplam update--> ilkToplam=".$ilkToplam;
								$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';
								$logResult=mysqli_query($conn, $logQuery);
								///
								
								$sqlUpdate='UPDATE grup SET ilkToplam="'.$ilkToplam.'" WHERE grupId="'.$grupId.'"';
								$guncelle=mysqli_query($conn, $sqlUpdate);	
								if(!$guncelle)
									echo"Hesaplarken bir problemle karşılaşıldı: grupId=$grupId";
							}
				
							break;
							
				case 3:			$selectGroups="SELECT DISTINCT grupId FROM ilksektorel WHERE degerlendirmeGrubu=1 ";
								$res=mysqli_query($conn, $selectGroups);
								
								while($loop = mysqli_fetch_row($res))
								{
									$grupId=$loop[0];
									$genelToplam=0;
									$query='SELECT COUNT(degerlendirmeId) FROM ilksektorel WHERE grupId="'.$grupId.'"';
									$result = mysqli_query($conn, $query);
									$row = mysqli_fetch_row($result);
									// Bölen sayı:
									$toplamDegerlendirme=$row[0];
									
							/////////// Yenilikcilik ortalama puanı 
									$query2='SELECT yenilikcilik FROM ilksektorel WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamYenilikcilik=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamYenilikcilik=$toplamYenilikcilik+$row[0];
									
									$ortYenilikcilik=$toplamYenilikcilik/$toplamDegerlendirme;	
									$genelToplam=$genelToplam+$ortYenilikcilik;
							//////////Sürdürülebilirlik ortalama puanı
									$query2='SELECT surdurulebilirlik FROM ilksektorel WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamSurdurulebilirlik=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamSurdurulebilirlik=$toplamSurdurulebilirlik+$row[0];
									
									$ortSurdurulebilirlik=$toplamSurdurulebilirlik/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortSurdurulebilirlik;
							//////////cevreyeFayda ortalama puanı
									$query2='SELECT cevreyeFayda FROM ilksektorel WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamCevreyeFayda=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamCevreyeFayda=$toplamCevreyeFayda+$row[0];
									
									$ortCevreyeFayda=$toplamCevreyeFayda/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortCevreyeFayda;
							//////////Tasarım ortalama puanı
									$query2='SELECT tasarim FROM ilksektorel WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamTasarim=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamTasarim=$toplamTasarim+$row[0];
									
									$ortTasarim=$toplamTasarim/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortTasarim;
							//////////Gerçekleşme ortalama puanı
									$query2='SELECT gerceklesme FROM ilksektorel WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamGerceklesme=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamGerceklesme=$toplamGerceklesme+$row[0];
									
									$ortGerceklesme=$toplamGerceklesme/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortGerceklesme;
							//////////Demo ortalama puanı
									$query2='SELECT demo FROM ilksektorel WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamDemo=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamDemo=$toplamDemo+$row[0];
									
									$ortDemo=$toplamDemo/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortDemo;
							
							/////////// ilk aşama toplamını güncelleme:
								$ilkToplam=mysqli_real_escape_string($conn, $genelToplam); 
								//but first log
								
								//kullanıcı Id:
								$kullaniciId=$_SESSION['adminId'];
								// tarih:
								$tarih=date(DATE_RFC822);
								// degiskenId:
								$degiskenId=$grupId;
								//degisiklik:
								$degisiklik="Sektorel grup asama 1 degerlendirme grubu 1 ilktoplam update--> ilkToplam=".$ilkToplam;
								$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';
								$logResult=mysqli_query($conn, $logQuery);
								///
								
								$sqlUpdate='UPDATE grup SET ilkToplam="'.$ilkToplam.'" WHERE grupId="'.$grupId.'"';
								$guncelle=mysqli_query($conn, $sqlUpdate);	
								if(!$guncelle)
									echo"Hesaplarken bir problemle karşılaşıldı: grupId=$grupId";
							}
				
							break;
				case 4:			$selectGroups="SELECT DISTINCT grupId FROM ilksektorel WHERE degerlendirmeGrubu=2 ";
								$res=mysqli_query($conn, $selectGroups);
								
								while($loop = mysqli_fetch_row($res))
								{
									$grupId=$loop[0];
									$genelToplam=0;
									$query='SELECT COUNT(degerlendirmeId) FROM ilksektorel WHERE grupId="'.$grupId.'"';
									$result = mysqli_query($conn, $query);
									$row = mysqli_fetch_row($result);
									// Bölen sayı:
									$toplamDegerlendirme=$row[0];
									
							/////////// Yenilikcilik ortalama puanı 
									$query2='SELECT yenilikcilik FROM ilksektorel WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamYenilikcilik=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamYenilikcilik=$toplamYenilikcilik+$row[0];
									
									$ortYenilikcilik=$toplamYenilikcilik/$toplamDegerlendirme;	
									$genelToplam=$genelToplam+$ortYenilikcilik;
							//////////Sürdürülebilirlik ortalama puanı
									$query2='SELECT surdurulebilirlik FROM ilksektorel WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamSurdurulebilirlik=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamSurdurulebilirlik=$toplamSurdurulebilirlik+$row[0];
									
									$ortSurdurulebilirlik=$toplamSurdurulebilirlik/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortSurdurulebilirlik;
							//////////cevreyeFayda ortalama puanı
									$query2='SELECT cevreyeFayda FROM ilksektorel WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamCevreyeFayda=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamCevreyeFayda=$toplamCevreyeFayda+$row[0];
									
									$ortCevreyeFayda=$toplamCevreyeFayda/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortCevreyeFayda;
							//////////Tasarım ortalama puanı
									$query2='SELECT tasarim FROM ilksektorel WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamTasarim=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamTasarim=$toplamTasarim+$row[0];
									
									$ortTasarim=$toplamTasarim/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortTasarim;
							//////////Gerçekleşme ortalama puanı
									$query2='SELECT gerceklesme FROM ilksektorel WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamGerceklesme=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamGerceklesme=$toplamGerceklesme+$row[0];
									
									$ortGerceklesme=$toplamGerceklesme/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortGerceklesme;
							//////////Demo ortalama puanı
									$query2='SELECT demo FROM ilksektorel WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamDemo=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamDemo=$toplamDemo+$row[0];
									
									$ortDemo=$toplamDemo/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortDemo;
							
							/////////// ilk aşama toplamını güncelleme:
								$ilkToplam=mysqli_real_escape_string($conn, $genelToplam); 
							//but first log
								
								//kullanıcı Id:
								$kullaniciId=$_SESSION['adminId'];
								// tarih:
								$tarih=date(DATE_RFC822);
								// degiskenId:
								$degiskenId=$grupId;
								//degisiklik:
								$degisiklik="Sektorel grup asama 1 degerlendirme grubu 2 ilktoplam update--> ilkToplam=".$ilkToplam;
								$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';
								$logResult=mysqli_query($conn, $logQuery);
								///
								
								$sqlUpdate='UPDATE grup SET ilkToplam="'.$ilkToplam.'" WHERE grupId="'.$grupId.'"';
								$guncelle=mysqli_query($conn, $sqlUpdate);	
								if(!$guncelle)
									echo"Hesaplarken bir problemle karşılaşıldı: grupId=$grupId";
							}
				
							break;
							
				case 5:			$selectGroups="SELECT DISTINCT grupId FROM ilkfikir WHERE degerlendirmeGrubu=1 ";
								$res=mysqli_query($conn, $selectGroups);
								
								while($loop = mysqli_fetch_row($res))
								{
									$grupId=$loop[0];
									$genelToplam=0;
									$query='SELECT COUNT(degerlendirmeId) FROM ilkfikir WHERE grupId="'.$grupId.'"';
									$result = mysqli_query($conn, $query);
									$row = mysqli_fetch_row($result);
									// Bölen sayı:
									$toplamDegerlendirme=$row[0];
									
							/////////// degerlendirme1 ortalama puanı 
									$query2='SELECT degerlendirme1 FROM ilkfikir WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplam1=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplam1=$toplam1+$row[0];
									
									$ort1=$toplam1/$toplamDegerlendirme;	
									$genelToplam=$genelToplam+$ort1;
							//////////degerlendirme2 ortalama puanı
									$query2='SELECT degerlendirme2 FROM ilkfikir WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplam2=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplam2=$toplam2+$row[0];
									
									$ort2=$toplam2/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ort2;
							//////////degerlendirme3 ortalama puanı
									$query2='SELECT degerlendirme3 FROM ilkfikir WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplam3=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplam3=$toplam3+$row[0];
									
									$ort3=$toplam3/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ort3;
							//////////degerlendirme4 ortalama puanı
									$query2='SELECT degerlendirme4 FROM ilkfikir WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplam4=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplam4=$toplam4+$row[0];
									
									$ort4=$toplam4/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ort4;
							//////////degerlendirme5 ortalama puanı
									$query2='SELECT degerlendirme5 FROM ilkfikir WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplam5=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplam5=$toplam5+$row[0];
									
									$ort5=$toplam5/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ort5;
							
							
							/////////// ilk aşama toplamını güncelleme:
								$ilkToplam=mysqli_real_escape_string($conn, $genelToplam); 
								//but first log
								
								//kullanıcı Id:
								$kullaniciId=$_SESSION['adminId'];
								// tarih:
								$tarih=date(DATE_RFC822);
								// degiskenId:
								$degiskenId=$grupId;
								//degisiklik:
								$degisiklik="Fikir grup asama 1 degerlendirme grubu 1 ilktoplam update--> ilkToplam=".$ilkToplam;
								$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';
								$logResult=mysqli_query($conn, $logQuery);
								///
								
								$sqlUpdate='UPDATE grup SET ilkToplam="'.$ilkToplam.'" WHERE grupId="'.$grupId.'"';
								$guncelle=mysqli_query($conn, $sqlUpdate);	
								if(!$guncelle)
									echo"Hesaplarken bir problemle karşılaşıldı: grupId=$grupId";
							}
				
				
							break;
							
				case 6:			$selectGroups="SELECT DISTINCT grupId FROM ilkfikir WHERE degerlendirmeGrubu=2 ";
								$res=mysqli_query($conn, $selectGroups);
								
								while($loop = mysqli_fetch_row($res))
								{
									$grupId=$loop[0];
									$genelToplam=0;
									$query='SELECT COUNT(degerlendirmeId) FROM ilkfikir WHERE grupId="'.$grupId.'"';
									$result = mysqli_query($conn, $query);
									$row = mysqli_fetch_row($result);
									// Bölen sayı:
									$toplamDegerlendirme=$row[0];
									
							/////////// degerlendirme1 ortalama puanı 
									$query2='SELECT degerlendirme1 FROM ilkfikir WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplam1=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplam1=$toplam1+$row[0];
									
									$ort1=$toplam1/$toplamDegerlendirme;	
									$genelToplam=$genelToplam+$ort1;
							//////////degerlendirme2 ortalama puanı
									$query2='SELECT degerlendirme2 FROM ilkfikir WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplam2=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplam2=$toplam2+$row[0];
									
									$ort2=$toplam2/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ort2;
							//////////degerlendirme3 ortalama puanı
									$query2='SELECT degerlendirme3 FROM ilkfikir WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplam3=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplam3=$toplam3+$row[0];
									
									$ort3=$toplam3/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ort3;
							//////////degerlendirme4 ortalama puanı
									$query2='SELECT degerlendirme4 FROM ilkfikir WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplam4=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplam4=$toplam4+$row[0];
									
									$ort4=$toplam4/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ort4;
							//////////degerlendirme5 ortalama puanı
									$query2='SELECT degerlendirme5 FROM ilkfikir WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplam5=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplam5=$toplam5+$row[0];
									
									$ort5=$toplam5/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ort5;
							
							
							/////////// ilk aşama toplamını güncelleme:
								$ilkToplam=mysqli_real_escape_string($conn, $genelToplam); 
								//but first log
								
								//kullanıcı Id:
								$kullaniciId=$_SESSION['adminId'];
								// tarih:
								$tarih=date(DATE_RFC822);
								// degiskenId:
								$degiskenId=$grupId;
								//degisiklik:
								$degisiklik="Fikir grup asama 1 degerlendirme grubu 2 ilktoplam update--> ilkToplam=".$ilkToplam;
								$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';
								$logResult=mysqli_query($conn, $logQuery);
								///
								
								$sqlUpdate='UPDATE grup SET ilkToplam="'.$ilkToplam.'" WHERE grupId="'.$grupId.'"';
								$guncelle=mysqli_query($conn, $sqlUpdate);	
								if(!$guncelle)
									echo"Hesaplarken bir problemle karşılaşıldı: grupId=$grupId";
							}
				
				
				
							break;
				
				
			}
			
			
		}
		
		else
			echo"Lutfen birisini seçiniz!";
	}
	
?>

	<body>
		<center>
		<h1>Birinci Aşama Toplam Puanları Hesaplama Sayfası</h1>
		<?php
		if(isset($_SESSION['adminIsmi']))
		{
		?>
			<form action="adminIlkToplam.php" method="post">
				
				<b>Lutfen toplam puanını hesaplamak istediğiniz kategoriyi seçiniz:<b><br />
				
				<input type="radio" name="hesapla" value="1">İlk Akademik Değerlendirme 1. Grup<br/>
				<input type="radio" name="hesapla" value="2">İlk Akademik Değerlendirme 2. Grup<br/>
				<hr/>
				<input type="radio" name="hesapla" value="3">İlk Sektörel Değerlendirme 1. Grup<br/>
				<input type="radio" name="hesapla" value="4">İlk Sektörel Değerlendirme 2. Grup<br/>
				<hr/>
				<hr/>
				<input type="radio" name="hesapla" value="5">İlk Fikir Değerlendirme 1. Grup<br/>
				<input type="radio" name="hesapla" value="6">İlk Fikir Değerlendirme 2. Grup<br/>
				
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