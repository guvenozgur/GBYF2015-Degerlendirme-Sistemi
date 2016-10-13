<?php
include('db.php')
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="refresh" content="30">
        <title>Moderatör Anasayfa</title>
    </head>
    <body>
		
		<center>	
		<a href="moderatorLogin.php">Sistemden çıkış yapmak için tıklayınız.</a><br/>
		<a href="juriAnasayfa.php">Juri anasayfasına gitmek için tıklayınız.</a>
		<hr/>
		<div class="content">
			<?php
				//Eğer moderatör giriş yapmışsa, giriş mesajı yazdırırız ekranda
				if(isset($_SESSION['moderatorIsmi']))
				{
					//yapım aşamasında
			?>
					
					Merhaba<?php if(isset($_SESSION['moderatorIsmi'])){echo ' '.htmlentities($_SESSION['moderatorIsmi'], ENT_QUOTES, 'UTF-8');} ?><br/>
					Sistemde gerekli değişiklikleri yapmak için giriş yapmış bulunmaktasın!<br/><br/>
					
			<?php
					if($_SESSION['moderatorSinifi']==1 and $_SESSION['moderatorGrubu']==1)
					{
								$ilkAkademikOnOffQuery='SELECT onOff FROM aktiflestirme WHERE degerlendirmeSinifi="1" and degerlendirmeGrubu="1"';
								$result=mysqli_query($conn, $ilkAkademikOnOffQuery);
								$row = mysqli_fetch_row($result);
								$ilkAkademikOnOff = $row[0];
				
								$ikinciAkademikOnOffQuery='SELECT onOff FROM aktiflestirme WHERE degerlendirmeSinifi="1" and degerlendirmeGrubu="3"';
								$result=mysqli_query($conn, $ikinciAkademikOnOffQuery);
								$row = mysqli_fetch_row($result);
								$ikinciAkademikOnOff = $row[0];
								
								
						if($ilkAkademikOnOff==1)
						{
								$selectGroups="SELECT DISTINCT grupId FROM ilkakademik WHERE degerlendirmeGrubu=1 ";
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
								$sqlUpdate='UPDATE grup SET ilkToplam="'.$ilkToplam.'" WHERE grupId="'.$grupId.'"';
								$guncelle=mysqli_query($conn, $sqlUpdate);	
								
								if(!$guncelle)
									echo"Hesaplarken bir problemle karşılaşıldı: grupId=$grupId";
							}
							
							$queryCountNumofGrubs="SELECT COUNT(grupId)  FROM grup WHERE degerlendirmeSinifi=1 and degerlendirmeGrubu=1 ";
								$result=mysqli_query($conn, $queryCountNumofGrubs);
								$row = mysqli_fetch_row($result);
								$countNumofGrubs = $row[0];
								
								$selectGroups="SELECT grupId, projeIsmi, ilkToplam FROM grup WHERE degerlendirmeGrubu=1 AND degerlendirmeSinifi=1 ORDER BY ilkToplam DESC";
								$res=mysqli_query($conn, $selectGroups);
								
								$listOfgrupIDs=array($countNumofGrubs );
								$listOfprojeNames=array($countNumofGrubs );
								$listOfgrupPuan=array($countNumofGrubs );
								$i=0;
								while($loop = mysqli_fetch_row($res))
								{
									$listOfgrupIDs[$i]=$loop[0];
									$listOfprojeNames[$i]=$loop[1];
									$listOfgrupPuan[$i]=$loop[2];	
									$i++;
								}
								
							?>
								
								<center>
								<table border="1">
									<tr>
										<th>Sıralaması</th>
										<th>Proje İsmi</th>
										<th>Değerlendirilen Grup Id</th>
										<th>Puan</th>
									</tr>
								</center>
							<?php
								for($i=1;$i<=$countNumofGrubs;$i++)
								{
							?>			<center>
										<tr>
											<td><?php echo $i;?></td>
											<td><?php echo $listOfprojeNames[$i-1];?></td>
											<td><?php echo $listOfgrupIDs[$i-1];?></td>
											<td><?php echo $listOfgrupPuan[$i-1];?></td>
										</tr>
										</center>
							<?php		
								}
					
						}
						
						if($ikinciAkademikOnOff==1)
						{
							$selectGroups="SELECT DISTINCT grupId FROM ikinciakademik ";
								$res=mysqli_query($conn, $selectGroups);
					
								
								while($loop = mysqli_fetch_row($res))
								{
									$grupId=$loop[0];
									$genelToplam=0;
									$query='SELECT COUNT(degerlendirmeId) FROM ikinciakademik WHERE grupId="'.$grupId.'"';
									$result = mysqli_query($conn, $query);
									$row = mysqli_fetch_row($result);
									// Bölen sayı:
									$toplamDegerlendirme=$row[0];
									
							/////////// Dogruluk ortalama puanı 
									$query2='SELECT dogruluk FROM ikinciakademik WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamDogruluk=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamDogruluk=$toplamDogruluk+$row[0];
									
									$ortDogruluk=$toplamDogruluk/$toplamDegerlendirme;	
									$genelToplam=$genelToplam+$ortDogruluk;
							//////////Potansiyel ortalama puanı
									$query2='SELECT potansiyel FROM ikinciakademik WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamPotansiyel=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamPotansiyel=$toplamPotansiyel+$row[0];
									
									$ortPotansiyel=$toplamPotansiyel/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortPotansiyel;
							//////////Sistematik ortalama puanı
									$query2='SELECT sistematik FROM ikinciakademik WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamSistematik=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamSistematik=$toplamSistematik+$row[0];
									
									$ortSistematik=$toplamSistematik/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortSistematik;
							//////////Problem ortalama puanı
									$query2='SELECT problem FROM ikinciakademik WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamProblem=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamProblem=$toplamProblem+$row[0];
									
									$ortProblem=$toplamProblem/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortProblem;
							//////////Literatür Tarama ortalama puanı
									$query2='SELECT literaturTarama FROM ikinciakademik WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamLiteratur=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamLiteratur=$toplamLiteratur+$row[0];
									
									$ortLiteratur=$toplamLiteratur/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortLiteratur;
							//////////Sunum Tarama ortalama puanı
									$query2='SELECT sunum FROM ikinciakademik WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamSunum=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamSunum=$toplamSunum+$row[0];
									
									$ortSunum=$toplamSunum/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortSunum;
							/////////// Özgünlük ortalama puanı 
									$query2='SELECT ozgunluk FROM ikinciakademik WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamOzgunluk=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamOzgunluk=$toplamOzgunluk+$row[0];
									
									$ortOzgunluk=$toplamOzgunluk/$toplamDegerlendirme;	
									$genelToplam=$genelToplam+$ortOzgunluk;
							/////////// ikinci aşama toplamını güncelleme:
							
								$ikinciToplam=mysqli_real_escape_string($conn, $genelToplam); 
								$sqlUpdate='UPDATE grup SET ikinciToplam="'.$ikinciToplam.'" WHERE grupId="'.$grupId.'"';
								$guncelle=mysqli_query($conn, $sqlUpdate);	
								if(!$guncelle)
									echo"Hesaplarken bir problemle karşılaşıldı: grupId=$grupId";
							}
							////////////////////////////////////////////////////
							
							$queryCountNumofGrubs="SELECT COUNT(grupId)  FROM grup WHERE degerlendirmeSinifi=1 and basari=1 ";
								$result=mysqli_query($conn, $queryCountNumofGrubs);
								$row = mysqli_fetch_row($result);
								$countNumofGrubs = $row[0];
								
								$selectGroups="SELECT grupId, projeIsmi, ikinciToplam FROM grup WHERE basari=1 AND degerlendirmeSinifi=1 ORDER BY ikinciToplam DESC";
								$res=mysqli_query($conn, $selectGroups);
								
								$listOfgrupIDs=array($countNumofGrubs );
								$listOfprojeNames=array($countNumofGrubs );
								$listOfgrupPuan=array($countNumofGrubs );
								$i=0;
								while($loop = mysqli_fetch_row($res))
								{
									$listOfgrupIDs[$i]=$loop[0];
									$listOfprojeNames[$i]=$loop[1];
									$listOfgrupPuan[$i]=$loop[2];	
									$i++;
								}
								
							?>
								
								<center>
								<table border="1">
									<tr>
										<th>Sıralaması</th>
										<th>Proje İsmi</th>
										<th>Değerlendirilen Grup Id</th>
										<th>Puan</th>
									</tr>
								</center>
							<?php
								for($i=1;$i<=$countNumofGrubs;$i++)
								{
							?>			<center>
										<tr>
											<td><?php echo $i;?></td>
											<td><?php echo $listOfprojeNames[$i-1];?></td>
											<td><?php echo $listOfgrupIDs[$i-1];?></td>
											<td><?php echo $listOfgrupPuan[$i-1];?></td>
										</tr>
										</center>
							<?php		
								}
							
						}
					}
						
						else if($_SESSION['moderatorSinifi']==1 and $_SESSION['moderatorGrubu']==2)
						{
								$ilkAkademikOnOffQuery='SELECT onOff FROM aktiflestirme WHERE degerlendirmeSinifi="1" and degerlendirmeGrubu="2"';
								$result=mysqli_query($conn, $ilkAkademikOnOffQuery);
								$row = mysqli_fetch_row($result);
								$ilkAkademikOnOff = $row[0];
				
								$ikinciAkademikOnOffQuery='SELECT onOff FROM aktiflestirme WHERE degerlendirmeSinifi="1" and degerlendirmeGrubu="3"';
								$result=mysqli_query($conn, $ikinciAkademikOnOffQuery);
								$row = mysqli_fetch_row($result);
								$ikinciAkademikOnOff = $row[0];
							
							
							
							if($ilkAkademikOnOff==1)
							{
								$selectGroups="SELECT DISTINCT grupId FROM ilkakademik WHERE degerlendirmeGrubu=2 ";
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
								$sqlUpdate='UPDATE grup SET ilkToplam="'.$ilkToplam.'" WHERE grupId="'.$grupId.'"';
								$guncelle=mysqli_query($conn, $sqlUpdate);	
								if(!$guncelle)
									echo"Hesaplarken bir problemle karşılaşıldı: grupId=$grupId";
							}
							
							/////////////////////////////////////
							$queryCountNumofGrubs="SELECT COUNT(grupId)  FROM grup WHERE degerlendirmeSinifi=1 and degerlendirmeGrubu=2 ";
								$result=mysqli_query($conn, $queryCountNumofGrubs);
								$row = mysqli_fetch_row($result);
								$countNumofGrubs = $row[0];
								
								$selectGroups="SELECT grupId, projeIsmi, ilkToplam FROM grup WHERE degerlendirmeGrubu=2 AND degerlendirmeSinifi=1 ORDER BY ilkToplam DESC";
								$res=mysqli_query($conn, $selectGroups);
								
								$listOfgrupIDs=array($countNumofGrubs );
								$listOfprojeNames=array($countNumofGrubs );
								$listOfgrupPuan=array($countNumofGrubs );
								$i=0;
								while($loop = mysqli_fetch_row($res))
								{
									$listOfgrupIDs[$i]=$loop[0];
									$listOfprojeNames[$i]=$loop[1];
									$listOfgrupPuan[$i]=$loop[2];	
									$i++;
								}
								
							?>
								
								<center>
								<table border="1">
									<tr>
										<th>Sıralaması</th>
										<th>Proje İsmi</th>
										<th>Değerlendirilen Grup Id</th>
										<th>Puan</th>
									</tr>
								</center>
							<?php
								for($i=1;$i<=$countNumofGrubs;$i++)
								{
							?>			<center>
										<tr>
											<td><?php echo $i;?></td>
											<td><?php echo $listOfprojeNames[$i-1];?></td>
											<td><?php echo $listOfgrupIDs[$i-1];?></td>
											<td><?php echo $listOfgrupPuan[$i-1];?></td>
										</tr>
										</center>
							<?php		
								}
				
						}
					
						if($ikinciAkademikOnOff==1)
						{
								$selectGroups="SELECT DISTINCT grupId FROM ikinciakademik ";
								$res=mysqli_query($conn, $selectGroups);
					
								
								while($loop = mysqli_fetch_row($res))
								{
									$grupId=$loop[0];
									$genelToplam=0;
									$query='SELECT COUNT(degerlendirmeId) FROM ikinciakademik WHERE grupId="'.$grupId.'"';
									$result = mysqli_query($conn, $query);
									$row = mysqli_fetch_row($result);
									// Bölen sayı:
									$toplamDegerlendirme=$row[0];
									
							/////////// Dogruluk ortalama puanı 
									$query2='SELECT dogruluk FROM ikinciakademik WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamDogruluk=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamDogruluk=$toplamDogruluk+$row[0];
									
									$ortDogruluk=$toplamDogruluk/$toplamDegerlendirme;	
									$genelToplam=$genelToplam+$ortDogruluk;
							//////////Potansiyel ortalama puanı
									$query2='SELECT potansiyel FROM ikinciakademik WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamPotansiyel=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamPotansiyel=$toplamPotansiyel+$row[0];
									
									$ortPotansiyel=$toplamPotansiyel/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortPotansiyel;
							//////////Sistematik ortalama puanı
									$query2='SELECT sistematik FROM ikinciakademik WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamSistematik=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamSistematik=$toplamSistematik+$row[0];
									
									$ortSistematik=$toplamSistematik/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortSistematik;
							//////////Problem ortalama puanı
									$query2='SELECT problem FROM ikinciakademik WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamProblem=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamProblem=$toplamProblem+$row[0];
									
									$ortProblem=$toplamProblem/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortProblem;
							//////////Literatür Tarama ortalama puanı
									$query2='SELECT literaturTarama FROM ikinciakademik WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamLiteratur=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamLiteratur=$toplamLiteratur+$row[0];
									
									$ortLiteratur=$toplamLiteratur/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortLiteratur;
							//////////Sunum Tarama ortalama puanı
									$query2='SELECT sunum FROM ikinciakademik WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamSunum=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamSunum=$toplamSunum+$row[0];
									
									$ortSunum=$toplamSunum/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortSunum;
							/////////// Özgünlük ortalama puanı 
									$query2='SELECT ozgunluk FROM ikinciakademik WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamOzgunluk=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamOzgunluk=$toplamOzgunluk+$row[0];
									
									$ortOzgunluk=$toplamOzgunluk/$toplamDegerlendirme;	
									$genelToplam=$genelToplam+$ortOzgunluk;
							/////////// ikinci aşama toplamını güncelleme:
							
								$ikinciToplam=mysqli_real_escape_string($conn, $genelToplam); 
								$sqlUpdate='UPDATE grup SET ikinciToplam="'.$ikinciToplam.'" WHERE grupId="'.$grupId.'"';
								$guncelle=mysqli_query($conn, $sqlUpdate);	
								if(!$guncelle)
									echo"Hesaplarken bir problemle karşılaşıldı: grupId=$grupId";
							}
							
					////////////////////////////////////////////////
					
					
							$queryCountNumofGrubs="SELECT COUNT(grupId)  FROM grup WHERE degerlendirmeSinifi=1 and basari=1 ";
								$result=mysqli_query($conn, $queryCountNumofGrubs);
								$row = mysqli_fetch_row($result);
								$countNumofGrubs = $row[0];
								
								$selectGroups="SELECT grupId, projeIsmi, ikinciToplam FROM grup WHERE basari=1 AND degerlendirmeSinifi=1 ORDER BY ikinciToplam DESC";
								$res=mysqli_query($conn, $selectGroups);
								
								$listOfgrupIDs=array($countNumofGrubs );
								$listOfprojeNames=array($countNumofGrubs );
								$listOfgrupPuan=array($countNumofGrubs );
								$i=0;
								while($loop = mysqli_fetch_row($res))
								{
									$listOfgrupIDs[$i]=$loop[0];
									$listOfprojeNames[$i]=$loop[1];
									$listOfgrupPuan[$i]=$loop[2];	
									$i++;
								}
								
							?>
								
								<center>
								<table border="1">
									<tr>
										<th>Sıralaması</th>
										<th>Proje İsmi</th>
										<th>Değerlendirilen Grup Id</th>
										<th>Puan</th>
									</tr>
								</center>
							<?php
								for($i=1;$i<=$countNumofGrubs;$i++)
								{
							?>			<center>
										<tr>
											<td><?php echo $i;?></td>
											<td><?php echo $listOfprojeNames[$i-1];?></td>
											<td><?php echo $listOfgrupIDs[$i-1];?></td>
											<td><?php echo $listOfgrupPuan[$i-1];?></td>
										</tr>
										</center>
							<?php		
								}
							
						}
					}
						
						else if($_SESSION['moderatorSinifi']==2 and $_SESSION['moderatorGrubu']==1)
						{
							
							$ilkSektorelOnOffQuery='SELECT onOff FROM aktiflestirme WHERE degerlendirmeSinifi="2" and degerlendirmeGrubu="1"';
							$result=mysqli_query($conn, $ilkSektorelOnOffQuery);
							$row = mysqli_fetch_row($result);
							$ilkSektorelOnOff = $row[0];
							
							$ikinciSektorelOnOffQuery='SELECT onOff FROM aktiflestirme WHERE degerlendirmeSinifi="2" and degerlendirmeGrubu=3';
							$result=mysqli_query($conn, $ikinciSektorelOnOffQuery);
							$row = mysqli_fetch_row($result);
							$ikinciSektorelOnOff = $row[0];
				
							if($ilkSektorelOnOff==1)
							{
								$selectGroups="SELECT DISTINCT grupId FROM ilksektorel WHERE degerlendirmeGrubu=1 ";
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
								$sqlUpdate='UPDATE grup SET ilkToplam="'.$ilkToplam.'" WHERE grupId="'.$grupId.'"';
								$guncelle=mysqli_query($conn, $sqlUpdate);	
								if(!$guncelle)
									echo"Hesaplarken bir problemle karşılaşıldı: grupId=$grupId";
							}
						/////////////////////////////////////////////////////
						$queryCountNumofGrubs="SELECT COUNT(grupId)  FROM grup WHERE degerlendirmeSinifi=2 and degerlendirmeGrubu=1 ";
								$result=mysqli_query($conn, $queryCountNumofGrubs);
								$row = mysqli_fetch_row($result);
								$countNumofGrubs = $row[0];
								
								$selectGroups="SELECT grupId, projeIsmi, ilkToplam FROM grup WHERE degerlendirmeGrubu=1 AND degerlendirmeSinifi=2 ORDER BY ilkToplam DESC";
								$res=mysqli_query($conn, $selectGroups);
								
								$listOfgrupIDs=array($countNumofGrubs );
								$listOfprojeNames=array($countNumofGrubs );
								$listOfgrupPuan=array($countNumofGrubs );
								$i=0;
								while($loop = mysqli_fetch_row($res))
								{
									$listOfgrupIDs[$i]=$loop[0];
									$listOfprojeNames[$i]=$loop[1];
									$listOfgrupPuan[$i]=$loop[2];	
									$i++;
								}
								
							?>
								
								<center>
								<table border="1">
									<tr>
										<th>Sıralaması</th>
										<th>Proje İsmi</th>
										<th>Değerlendirilen Grup Id</th>
										<th>Puan</th>
									</tr>
								</center>
							<?php
								for($i=1;$i<=$countNumofGrubs;$i++)
								{
							?>			<center>
										<tr>
											<td><?php echo $i;?></td>
											<td><?php echo $listOfprojeNames[$i-1];?></td>
											<td><?php echo $listOfgrupIDs[$i-1];?></td>
											<td><?php echo $listOfgrupPuan[$i-1];?></td>
										</tr>
										</center>
							<?php		
								}
						}
					
					if($ikinciSektorelOnOff==1)
					{
						$selectGroups="SELECT DISTINCT grupId FROM ikincisektorel  ";
								$res=mysqli_query($conn, $selectGroups);
								
								while($loop = mysqli_fetch_row($res))
								{
									$grupId=$loop[0];
									$genelToplam=0;
									$query='SELECT COUNT(degerlendirmeId) FROM ikincisektorel WHERE grupId="'.$grupId.'"';
									$result = mysqli_query($conn, $query);
									$row = mysqli_fetch_row($result);
									// Bölen sayı:
									$toplamDegerlendirme=$row[0];
									
							/////////// Yenilikcilik ortalama puanı 
									$query2='SELECT yenilikcilik FROM ikincisektorel WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamYenilikcilik=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamYenilikcilik=$toplamYenilikcilik+$row[0];
									
									$ortYenilikcilik=$toplamYenilikcilik/$toplamDegerlendirme;	
									$genelToplam=$genelToplam+$ortYenilikcilik;
							//////////Sürdürülebilirlik ortalama puanı
									$query2='SELECT surdurulebilirlik FROM ikincisektorel WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamSurdurulebilirlik=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamSurdurulebilirlik=$toplamSurdurulebilirlik+$row[0];
									
									$ortSurdurulebilirlik=$toplamSurdurulebilirlik/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortSurdurulebilirlik;
							//////////cevreyeFayda ortalama puanı
									$query2='SELECT cevreyeFayda FROM ikincisektorel WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamCevreyeFayda=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamCevreyeFayda=$toplamCevreyeFayda+$row[0];
									
									$ortCevreyeFayda=$toplamCevreyeFayda/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortCevreyeFayda;
							//////////Tasarım ortalama puanı
									$query2='SELECT tasarim FROM ikincisektorel WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamTasarim=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamTasarim=$toplamTasarim+$row[0];
									
									$ortTasarim=$toplamTasarim/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortTasarim;
							//////////Gerçekleşme ortalama puanı
									$query2='SELECT gerceklesme FROM ikincisektorel WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamGerceklesme=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamGerceklesme=$toplamGerceklesme+$row[0];
									
									$ortGerceklesme=$toplamGerceklesme/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortGerceklesme;
							//////////Demo ortalama puanı
									$query2='SELECT demo FROM ikincisektorel WHERE grupId="'.$grupId.'"';
									$result2 = mysqli_query($conn, $query2);
									$toplamDemo=0;
									//Bölünen sayı
									while($row = mysqli_fetch_row($result2))
										$toplamDemo=$toplamDemo+$row[0];
									
									$ortDemo=$toplamDemo/$toplamDegerlendirme;
									$genelToplam=$genelToplam+$ortDemo;
							
							/////////// ikinci aşama toplamını güncelleme:
							
								$ikinciToplam=mysqli_real_escape_string($conn, $genelToplam); 
								$sqlUpdate='UPDATE grup SET ikinciToplam="'.$ikinciToplam.'" WHERE grupId="'.$grupId.'"';
								$guncelle=mysqli_query($conn, $sqlUpdate);	
								if(!$guncelle)
									echo"Hesaplarken bir problemle karşılaşıldı: grupId=$grupId";
							}
							
						////////////////////////////////
							$queryCountNumofGrubs="SELECT COUNT(grupId)  FROM grup WHERE degerlendirmeSinifi=2 and basari=1 ";
								$result=mysqli_query($conn, $queryCountNumofGrubs);
								$row = mysqli_fetch_row($result);
								$countNumofGrubs = $row[0];
								
								$selectGroups="SELECT grupId, projeIsmi, ikinciToplam FROM grup WHERE basari=1 AND degerlendirmeSinifi=2 ORDER BY ikinciToplam DESC";
								$res=mysqli_query($conn, $selectGroups);
								
								$listOfgrupIDs=array($countNumofGrubs );
								$listOfprojeNames=array($countNumofGrubs );
								$listOfgrupPuan=array($countNumofGrubs );
								$i=0;
								while($loop = mysqli_fetch_row($res))
								{
									$listOfgrupIDs[$i]=$loop[0];
									$listOfprojeNames[$i]=$loop[1];
									$listOfgrupPuan[$i]=$loop[2];	
									$i++;
								}
								
							?>
								
								<center>
								<table border="1">
									<tr>
										<th>Sıralaması</th>
										<th>Proje İsmi</th>
										<th>Değerlendirilen Grup Id</th>
										<th>Puan</th>
									</tr>
								</center>
							<?php
								for($i=1;$i<=$countNumofGrubs;$i++)
								{
							?>			<center>
										<tr>
											<td><?php echo $i;?></td>
											<td><?php echo $listOfprojeNames[$i-1];?></td>
											<td><?php echo $listOfgrupIDs[$i-1];?></td>
											<td><?php echo $listOfgrupPuan[$i-1];?></td>
										</tr>
										</center>
							<?php		
								}
							
					}
					
					
					
				}
						else if($_SESSION['moderatorSinifi']==2 and $_SESSION['moderatorGrubu']==2)
						{
							$ilkSektorelOnOffQuery='SELECT onOff FROM aktiflestirme WHERE degerlendirmeSinifi="2" and degerlendirmeGrubu="2"';
							$result=mysqli_query($conn, $ilkSektorelOnOffQuery);
							$row = mysqli_fetch_row($result);
							$ilkSektorelOnOff = $row[0];
								
							$ikinciSektorelOnOffQuery='SELECT onOff FROM aktiflestirme WHERE degerlendirmeSinifi="2" and degerlendirmeGrubu=3';
							$result=mysqli_query($conn, $ikinciSektorelOnOffQuery);
							$row = mysqli_fetch_row($result);
							$ikinciSektorelOnOff = $row[0];
								
							if($ilkSektorelOnOff==1)
							{
								$selectGroups="SELECT DISTINCT grupId FROM ilksektorel WHERE degerlendirmeGrubu=2 ";
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
								$sqlUpdate='UPDATE grup SET ilkToplam="'.$ilkToplam.'" WHERE grupId="'.$grupId.'"';
								$guncelle=mysqli_query($conn, $sqlUpdate);	
								if(!$guncelle)
									echo"Hesaplarken bir problemle karşılaşıldı: grupId=$grupId";
							}
							////////////////////////////////////////////////
							$queryCountNumofGrubs="SELECT COUNT(grupId)  FROM grup WHERE degerlendirmeSinifi=2 and degerlendirmeGrubu=2 ";
								$result=mysqli_query($conn, $queryCountNumofGrubs);
								$row = mysqli_fetch_row($result);
								$countNumofGrubs = $row[0];
								
								$selectGroups="SELECT grupId, projeIsmi, ilkToplam FROM grup WHERE degerlendirmeGrubu=2 AND degerlendirmeSinifi=2 ORDER BY ilkToplam DESC";
								$res=mysqli_query($conn, $selectGroups);
								
								$listOfgrupIDs=array($countNumofGrubs );
								$listOfprojeNames=array($countNumofGrubs );
								$listOfgrupPuan=array($countNumofGrubs );
								$i=0;
								while($loop = mysqli_fetch_row($res))
								{
									$listOfgrupIDs[$i]=$loop[0];
									$listOfprojeNames[$i]=$loop[1];
									$listOfgrupPuan[$i]=$loop[2];	
									$i++;
								}
								
							?>
								
								<center>
								<table border="1">
									<tr>
										<th>Sıralaması</th>
										<th>Proje İsmi</th>
										<th>Değerlendirilen Grup Id</th>
										<th>Puan</th>
									</tr>
								</center>
							<?php
								for($i=1;$i<=$countNumofGrubs;$i++)
								{
							?>			<center>
										<tr>
											<td><?php echo $i;?></td>
											<td><?php echo $listOfprojeNames[$i-1];?></td>
											<td><?php echo $listOfgrupIDs[$i-1];?></td>
											<td><?php echo $listOfgrupPuan[$i-1];?></td>
										</tr>
										</center>
							<?php		
								}
					
							}
							
						if($ikinciSektorelOnOff==1)
						{
							$selectGroups="SELECT DISTINCT grupId FROM ikincisektorel  ";
									$res=mysqli_query($conn, $selectGroups);
									
									while($loop = mysqli_fetch_row($res))
									{
										$grupId=$loop[0];
										$genelToplam=0;
										$query='SELECT COUNT(degerlendirmeId) FROM ikincisektorel WHERE grupId="'.$grupId.'"';
										$result = mysqli_query($conn, $query);
										$row = mysqli_fetch_row($result);
										// Bölen sayı:
										$toplamDegerlendirme=$row[0];
										
								/////////// Yenilikcilik ortalama puanı 
										$query2='SELECT yenilikcilik FROM ikincisektorel WHERE grupId="'.$grupId.'"';
										$result2 = mysqli_query($conn, $query2);
										$toplamYenilikcilik=0;
										//Bölünen sayı
										while($row = mysqli_fetch_row($result2))
											$toplamYenilikcilik=$toplamYenilikcilik+$row[0];
										
										$ortYenilikcilik=$toplamYenilikcilik/$toplamDegerlendirme;	
										$genelToplam=$genelToplam+$ortYenilikcilik;
								//////////Sürdürülebilirlik ortalama puanı
										$query2='SELECT surdurulebilirlik FROM ikincisektorel WHERE grupId="'.$grupId.'"';
										$result2 = mysqli_query($conn, $query2);
										$toplamSurdurulebilirlik=0;
										//Bölünen sayı
										while($row = mysqli_fetch_row($result2))
											$toplamSurdurulebilirlik=$toplamSurdurulebilirlik+$row[0];
										
										$ortSurdurulebilirlik=$toplamSurdurulebilirlik/$toplamDegerlendirme;
										$genelToplam=$genelToplam+$ortSurdurulebilirlik;
								//////////cevreyeFayda ortalama puanı
										$query2='SELECT cevreyeFayda FROM ikincisektorel WHERE grupId="'.$grupId.'"';
										$result2 = mysqli_query($conn, $query2);
										$toplamCevreyeFayda=0;
										//Bölünen sayı
										while($row = mysqli_fetch_row($result2))
											$toplamCevreyeFayda=$toplamCevreyeFayda+$row[0];
										
										$ortCevreyeFayda=$toplamCevreyeFayda/$toplamDegerlendirme;
										$genelToplam=$genelToplam+$ortCevreyeFayda;
								//////////Tasarım ortalama puanı
										$query2='SELECT tasarim FROM ikincisektorel WHERE grupId="'.$grupId.'"';
										$result2 = mysqli_query($conn, $query2);
										$toplamTasarim=0;
										//Bölünen sayı
										while($row = mysqli_fetch_row($result2))
											$toplamTasarim=$toplamTasarim+$row[0];
										
										$ortTasarim=$toplamTasarim/$toplamDegerlendirme;
										$genelToplam=$genelToplam+$ortTasarim;
								//////////Gerçekleşme ortalama puanı
										$query2='SELECT gerceklesme FROM ikincisektorel WHERE grupId="'.$grupId.'"';
										$result2 = mysqli_query($conn, $query2);
										$toplamGerceklesme=0;
										//Bölünen sayı
										while($row = mysqli_fetch_row($result2))
											$toplamGerceklesme=$toplamGerceklesme+$row[0];
										
										$ortGerceklesme=$toplamGerceklesme/$toplamDegerlendirme;
										$genelToplam=$genelToplam+$ortGerceklesme;
								//////////Demo ortalama puanı
										$query2='SELECT demo FROM ikincisektorel WHERE grupId="'.$grupId.'"';
										$result2 = mysqli_query($conn, $query2);
										$toplamDemo=0;
										//Bölünen sayı
										while($row = mysqli_fetch_row($result2))
											$toplamDemo=$toplamDemo+$row[0];
										
										$ortDemo=$toplamDemo/$toplamDegerlendirme;
										$genelToplam=$genelToplam+$ortDemo;
								
								/////////// ikinci aşama toplamını güncelleme:
								
									$ikinciToplam=mysqli_real_escape_string($conn, $genelToplam); 
									$sqlUpdate='UPDATE grup SET ikinciToplam="'.$ikinciToplam.'" WHERE grupId="'.$grupId.'"';
									$guncelle=mysqli_query($conn, $sqlUpdate);	
									if(!$guncelle)
										echo"Hesaplarken bir problemle karşılaşıldı: grupId=$grupId";
								}
								
							////////////////////////////////
								$queryCountNumofGrubs="SELECT COUNT(grupId)  FROM grup WHERE degerlendirmeSinifi=2 and basari=1 ";
									$result=mysqli_query($conn, $queryCountNumofGrubs);
									$row = mysqli_fetch_row($result);
									$countNumofGrubs = $row[0];
									
									$selectGroups="SELECT grupId, projeIsmi, ikinciToplam FROM grup WHERE basari=1 AND degerlendirmeSinifi=2 ORDER BY ikinciToplam DESC";
									$res=mysqli_query($conn, $selectGroups);
									
									$listOfgrupIDs=array($countNumofGrubs );
									$listOfprojeNames=array($countNumofGrubs );
									$listOfgrupPuan=array($countNumofGrubs );
									$i=0;
									while($loop = mysqli_fetch_row($res))
									{
										$listOfgrupIDs[$i]=$loop[0];
										$listOfprojeNames[$i]=$loop[1];
										$listOfgrupPuan[$i]=$loop[2];	
										$i++;
									}
									
								?>
									
									<center>
									<table border="1">
										<tr>
											<th>Sıralaması</th>
											<th>Proje İsmi</th>
											<th>Değerlendirilen Grup Id</th>
											<th>Puan</th>
										</tr>
									</center>
								<?php
									for($i=1;$i<=$countNumofGrubs;$i++)
									{
								?>			<center>
											<tr>
												<td><?php echo $i;?></td>
												<td><?php echo $listOfprojeNames[$i-1];?></td>
												<td><?php echo $listOfgrupIDs[$i-1];?></td>
												<td><?php echo $listOfgrupPuan[$i-1];?></td>
											</tr>
											</center>
								<?php		
									}
								
						}
					}
						else if($_SESSION['moderatorSinifi']==3 and $_SESSION['moderatorGrubu']==1)
						{
							
							$ilkFikirOnOffQuery='SELECT onOff FROM aktiflestirme WHERE degerlendirmeSinifi="3" and degerlendirmeGrubu="1"';
							$result=mysqli_query($conn, $ilkFikirOnOffQuery);
							$row = mysqli_fetch_row($result);
							$ilkFikirOnOff = $row[0];
				
							$ikinciFikirOnOffQuery='SELECT onOff FROM aktiflestirme WHERE degerlendirmeSinifi="'.$_SESSION['moderatorSinifi'].'" and moderatorSinifi=3';
							$result=mysqli_query($conn, $ikinciFikirOnOffQuery);
							$row = mysqli_fetch_row($result);
							$ikinciFikirOnOff = $row[0];
							
							if($ilkFikirOnOff)
							{
									$selectGroups="SELECT DISTINCT grupId FROM ilkfikir WHERE degerlendirmeGrubu=1 ";
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
								//////////Demo degerlendirme6 puanı
										$query2='SELECT degerlendirme6 FROM ilkfikir WHERE grupId="'.$grupId.'"';
										$result2 = mysqli_query($conn, $query2);
										$toplam6=0;
										//Bölünen sayı
										while($row = mysqli_fetch_row($result2))
											$toplam6=$toplam6+$row[0];
										
										$ort6=$toplam6/$toplamDegerlendirme;
										$genelToplam=$genelToplam+$ort6;
								
								/////////// ilk aşama toplamını güncelleme:
								
									$ilkToplam=mysqli_real_escape_string($conn, $genelToplam); 
									$sqlUpdate='UPDATE grup SET ilkToplam="'.$ilkToplam.'" WHERE grupId="'.$grupId.'"';
									$guncelle=mysqli_query($conn, $sqlUpdate);	
									if(!$guncelle)
										echo"Hesaplarken bir problemle karşılaşıldı: grupId=$grupId";
								}
								
								/////////////////////////////////////////
								$queryCountNumofGrubs="SELECT COUNT(grupId)  FROM grup WHERE degerlendirmeSinifi=3 and degerlendirmeGrubu=1 ";
									$result=mysqli_query($conn, $queryCountNumofGrubs);
									$row = mysqli_fetch_row($result);
									$countNumofGrubs = $row[0];
									
									$selectGroups="SELECT grupId, projeIsmi, ilkToplam FROM grup WHERE degerlendirmeGrubu=1 AND degerlendirmeSinifi=3 ORDER BY ilkToplam DESC";
									$res=mysqli_query($conn, $selectGroups);
									
									$listOfgrupIDs=array($countNumofGrubs );
									$listOfprojeNames=array($countNumofGrubs );
									$listOfgrupPuan=array($countNumofGrubs );
									$i=0;
									while($loop = mysqli_fetch_row($res))
									{
										$listOfgrupIDs[$i]=$loop[0];
										$listOfprojeNames[$i]=$loop[1];
										$listOfgrupPuan[$i]=$loop[2];	
										$i++;
									}
									
								?>
									
									<center>
									<table border="1">
										<tr>
											<th>Sıralaması</th>
											<th>Proje İsmi</th>
											<th>Değerlendirilen Grup Id</th>
											<th>Puan</th>
										</tr>
									</center>
								<?php
									for($i=1;$i<=$countNumofGrubs;$i++)
									{
								?>			<center>
											<tr>
												<td><?php echo $i;?></td>
												<td><?php echo $listOfprojeNames[$i-1];?></td>
												<td><?php echo $listOfgrupIDs[$i-1];?></td>
												<td><?php echo $listOfgrupPuan[$i-1];?></td>
											</tr>
											</center>
								<?php		
									}
								
							}
							
							if($ikinciFikirOnOff==1)
							{
								
									$selectGroups="SELECT DISTINCT grupId FROM ikincifikir  ";
									$res=mysqli_query($conn, $selectGroups);
									
									while($loop = mysqli_fetch_row($res))
									{
										$grupId=$loop[0];
										$genelToplam=0;
										$query='SELECT COUNT(degerlendirmeId) FROM ikincifikir WHERE grupId="'.$grupId.'"';
										$result = mysqli_query($conn, $query);
										$row = mysqli_fetch_row($result);
										// Bölen sayı:
										$toplamDegerlendirme=$row[0];
										
								/////////// degerlendirme1 ortalama puanı 
										$query2='SELECT degerlendirme1 FROM ikincifikir WHERE grupId="'.$grupId.'"';
										$result2 = mysqli_query($conn, $query2);
										$toplam1=0;
										//Bölünen sayı
										while($row = mysqli_fetch_row($result2))
											$toplam1=$toplam1+$row[0];
										
										$ort1=$toplam1/$toplamDegerlendirme;	
										$genelToplam=$genelToplam+$ort1;
								//////////degerlendirme2 ortalama puanı
										$query2='SELECT degerlendirme2 FROM ikincifikir WHERE grupId="'.$grupId.'"';
										$result2 = mysqli_query($conn, $query2);
										$toplam2=0;
										//Bölünen sayı
										while($row = mysqli_fetch_row($result2))
											$toplam2=$toplam2+$row[0];
										
										$ort2=$toplam2/$toplamDegerlendirme;
										$genelToplam=$genelToplam+$ort2;
								//////////degerlendirme3 ortalama puanı
										$query2='SELECT degerlendirme3 FROM ikincifikir WHERE grupId="'.$grupId.'"';
										$result2 = mysqli_query($conn, $query2);
										$toplam3=0;
										//Bölünen sayı
										while($row = mysqli_fetch_row($result2))
											$toplam3=$toplam3+$row[0];
										
										$ort3=$toplam3/$toplamDegerlendirme;
										$genelToplam=$genelToplam+$ort3;
								//////////degerlendirme4 ortalama puanı
										$query2='SELECT degerlendirme4 FROM ikincifikir WHERE grupId="'.$grupId.'"';
										$result2 = mysqli_query($conn, $query2);
										$toplam4=0;
										//Bölünen sayı
										while($row = mysqli_fetch_row($result2))
											$toplam4=$toplam4+$row[0];
										
										$ort4=$toplam4/$toplamDegerlendirme;
										$genelToplam=$genelToplam+$ort4;
								//////////degerlendirme5 ortalama puanı
										$query2='SELECT degerlendirme5 FROM ikincifikir WHERE grupId="'.$grupId.'"';
										$result2 = mysqli_query($conn, $query2);
										$toplam5=0;
										//Bölünen sayı
										while($row = mysqli_fetch_row($result2))
											$toplam5=$toplam5+$row[0];
										
										$ort5=$toplam5/$toplamDegerlendirme;
										$genelToplam=$genelToplam+$ort5;
								//////////Demo degerlendirme6 puanı
										$query2='SELECT degerlendirme6 FROM ikincifikir WHERE grupId="'.$grupId.'"';
										$result2 = mysqli_query($conn, $query2);
										$toplam6=0;
										//Bölünen sayı
										while($row = mysqli_fetch_row($result2))
											$toplam6=$toplam6+$row[0];
										
										$ort6=$toplam6/$toplamDegerlendirme;
										$genelToplam=$genelToplam+$ort6;
								
								/////////// ikinci aşama toplamını güncelleme:
								
									$ikinciToplam=mysqli_real_escape_string($conn, $genelToplam); 
									$sqlUpdate='UPDATE grup SET ikinciToplam="'.$ikinciToplam.'" WHERE grupId="'.$grupId.'"';
									$guncelle=mysqli_query($conn, $sqlUpdate);	
									if(!$guncelle)
										echo"Hesaplarken bir problemle karşılaşıldı: grupId=$grupId";
								}
								
								
							//////////////////////////////////////////
							
								$queryCountNumofGrubs="SELECT COUNT(grupId)  FROM grup WHERE degerlendirmeSinifi=3 and basari=1";
								$result=mysqli_query($conn, $queryCountNumofGrubs);
								$row = mysqli_fetch_row($result);
								$countNumofGrubs = $row[0];
								
								$selectGroups="SELECT grupId, projeIsmi, ikinciToplam FROM grup WHERE basari=1 AND degerlendirmeSinifi=3 ORDER BY ikinciToplam DESC";
								$res=mysqli_query($conn, $selectGroups);
								
								$listOfgrupIDs=array($countNumofGrubs );
								$listOfprojeNames=array($countNumofGrubs );
								$listOfgrupPuan=array($countNumofGrubs );
								$i=0;
								while($loop = mysqli_fetch_row($res))
								{
									$listOfgrupIDs[$i]=$loop[0];
									$listOfprojeNames[$i]=$loop[1];
									$listOfgrupPuan[$i]=$loop[2];	
									$i++;
								}
								
							?>
								
								<center>
								<table border="1">
									<tr>
										<th>Sıralaması</th>
										<th>Proje İsmi</th>
										<th>Değerlendirilen Grup Id</th>
										<th>Puan</th>
									</tr>
								</center>
							<?php
								for($i=1;$i<=$countNumofGrubs;$i++)
								{
							?>			<center>
										<tr>
											<td><?php echo $i;?></td>
											<td><?php echo $listOfprojeNames[$i-1];?></td>
											<td><?php echo $listOfgrupIDs[$i-1];?></td>
											<td><?php echo $listOfgrupPuan[$i-1];?></td>
										</tr>
										</center>
							<?php		
								}
				
							}
						
						}
						else if($_SESSION['moderatorSinifi']==3 and $_SESSION['moderatorGrubu']==2)
						{
								$ilkFikirOnOffQuery='SELECT onOff FROM aktiflestirme WHERE degerlendirmeSinifi="'.$_SESSION['degerlendirmeSinifi'].'" and degerlendirmeGrubu="'.$_SESSION['degerlendirmeGrubu'].'"';
								$result=mysqli_query($conn, $ilkFikirOnOffQuery);
								$row = mysqli_fetch_row($result);
								$ilkFikirOnOff = $row[0];
					
								$ikinciFikirOnOffQuery='SELECT onOff FROM aktiflestirme WHERE degerlendirmeSinifi="'.$_SESSION['degerlendirmeSinifi'].'" and degerlendirmeGrubu=3';
								$result=mysqli_query($conn, $ikinciFikirOnOffQuery);
								$row = mysqli_fetch_row($result);
								$ikinciFikirOnOff = $row[0];
								
								if($ilkFikirOnOff==1)
								{
									$selectGroups="SELECT DISTINCT grupId FROM ilkfikir WHERE degerlendirmeGrubu=2 ";
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
								//////////Demo degerlendirme6 puanı
										$query2='SELECT degerlendirme6 FROM ilkfikir WHERE grupId="'.$grupId.'"';
										$result2 = mysqli_query($conn, $query2);
										$toplam6=0;
										//Bölünen sayı
										while($row = mysqli_fetch_row($result2))
											$toplam6=$toplam6+$row[0];
										
										$ort6=$toplam6/$toplamDegerlendirme;
										$genelToplam=$genelToplam+$ort6;
								
								/////////// ilk aşama toplamını güncelleme:
								
									$ilkToplam=mysqli_real_escape_string($conn, $genelToplam); 
									$sqlUpdate='UPDATE grup SET ilkToplam="'.$ilkToplam.'" WHERE grupId="'.$grupId.'"';
									$guncelle=mysqli_query($conn, $sqlUpdate);	
									if(!$guncelle)
										echo"Hesaplarken bir problemle karşılaşıldı: grupId=$grupId";
								}
								
								////////////////////////////////////////
								$queryCountNumofGrubs="SELECT COUNT(grupId)  FROM grup WHERE degerlendirmeSinifi=3 and degerlendirmeGrubu=2";
									$result=mysqli_query($conn, $queryCountNumofGrubs);
									$row = mysqli_fetch_row($result);
									$countNumofGrubs = $row[0];
									
									$selectGroups="SELECT grupId, projeIsmi, ilkToplam FROM grup WHERE degerlendirmeGrubu=2 AND degerlendirmeSinifi=3 ORDER BY ilkToplam DESC";
									$res=mysqli_query($conn, $selectGroups);
									
									$listOfgrupIDs=array($countNumofGrubs );
									$listOfprojeNames=array($countNumofGrubs );
									$listOfgrupPuan=array($countNumofGrubs );
									$i=0;
									while($loop = mysqli_fetch_row($res))
									{
										$listOfgrupIDs[$i]=$loop[0];
										$listOfprojeNames[$i]=$loop[1];
										$listOfgrupPuan[$i]=$loop[2];	
										$i++;
									}
									
								?>
									
									<center>
									<table border="1">
										<tr>
											<th>Sıralaması</th>
											<th>Proje İsmi</th>
											<th>Değerlendirilen Grup Id</th>
											<th>Puan</th>
										</tr>
									</center>
								<?php
									for($i=1;$i<=$countNumofGrubs;$i++)
									{
								?>			<center>
											<tr>
												<td><?php echo $i;?></td>
												<td><?php echo $listOfprojeNames[$i-1];?></td>
												<td><?php echo $listOfgrupIDs[$i-1];?></td>
												<td><?php echo $listOfgrupPuan[$i-1];?></td>
											</tr>
											</center>
								<?php		
									}
								}
								
								if($ikinciFikirOnOff==1)
							{
								
									$selectGroups="SELECT DISTINCT grupId FROM ikincifikir  ";
									$res=mysqli_query($conn, $selectGroups);
									
									while($loop = mysqli_fetch_row($res))
									{
										$grupId=$loop[0];
										$genelToplam=0;
										$query='SELECT COUNT(degerlendirmeId) FROM ikincifikir WHERE grupId="'.$grupId.'"';
										$result = mysqli_query($conn, $query);
										$row = mysqli_fetch_row($result);
										// Bölen sayı:
										$toplamDegerlendirme=$row[0];
										
								/////////// degerlendirme1 ortalama puanı 
										$query2='SELECT degerlendirme1 FROM ikincifikir WHERE grupId="'.$grupId.'"';
										$result2 = mysqli_query($conn, $query2);
										$toplam1=0;
										//Bölünen sayı
										while($row = mysqli_fetch_row($result2))
											$toplam1=$toplam1+$row[0];
										
										$ort1=$toplam1/$toplamDegerlendirme;	
										$genelToplam=$genelToplam+$ort1;
								//////////degerlendirme2 ortalama puanı
										$query2='SELECT degerlendirme2 FROM ikincifikir WHERE grupId="'.$grupId.'"';
										$result2 = mysqli_query($conn, $query2);
										$toplam2=0;
										//Bölünen sayı
										while($row = mysqli_fetch_row($result2))
											$toplam2=$toplam2+$row[0];
										
										$ort2=$toplam2/$toplamDegerlendirme;
										$genelToplam=$genelToplam+$ort2;
								//////////degerlendirme3 ortalama puanı
										$query2='SELECT degerlendirme3 FROM ikincifikir WHERE grupId="'.$grupId.'"';
										$result2 = mysqli_query($conn, $query2);
										$toplam3=0;
										//Bölünen sayı
										while($row = mysqli_fetch_row($result2))
											$toplam3=$toplam3+$row[0];
										
										$ort3=$toplam3/$toplamDegerlendirme;
										$genelToplam=$genelToplam+$ort3;
								//////////degerlendirme4 ortalama puanı
										$query2='SELECT degerlendirme4 FROM ikincifikir WHERE grupId="'.$grupId.'"';
										$result2 = mysqli_query($conn, $query2);
										$toplam4=0;
										//Bölünen sayı
										while($row = mysqli_fetch_row($result2))
											$toplam4=$toplam4+$row[0];
										
										$ort4=$toplam4/$toplamDegerlendirme;
										$genelToplam=$genelToplam+$ort4;
								//////////degerlendirme5 ortalama puanı
										$query2='SELECT degerlendirme5 FROM ikincifikir WHERE grupId="'.$grupId.'"';
										$result2 = mysqli_query($conn, $query2);
										$toplam5=0;
										//Bölünen sayı
										while($row = mysqli_fetch_row($result2))
											$toplam5=$toplam5+$row[0];
										
										$ort5=$toplam5/$toplamDegerlendirme;
										$genelToplam=$genelToplam+$ort5;
								//////////Demo degerlendirme6 puanı
										$query2='SELECT degerlendirme6 FROM ikincifikir WHERE grupId="'.$grupId.'"';
										$result2 = mysqli_query($conn, $query2);
										$toplam6=0;
										//Bölünen sayı
										while($row = mysqli_fetch_row($result2))
											$toplam6=$toplam6+$row[0];
										
										$ort6=$toplam6/$toplamDegerlendirme;
										$genelToplam=$genelToplam+$ort6;
								
								/////////// ikinci aşama toplamını güncelleme:
								
									$ikinciToplam=mysqli_real_escape_string($conn, $genelToplam); 
									$sqlUpdate='UPDATE grup SET ikinciToplam="'.$ikinciToplam.'" WHERE grupId="'.$grupId.'"';
									$guncelle=mysqli_query($conn, $sqlUpdate);	
									if(!$guncelle)
										echo"Hesaplarken bir problemle karşılaşıldı: grupId=$grupId";
								}
								
								
							//////////////////////////////////////////
							
								$queryCountNumofGrubs="SELECT COUNT(grupId)  FROM grup WHERE degerlendirmeSinifi=3 and basari=1";
								$result=mysqli_query($conn, $queryCountNumofGrubs);
								$row = mysqli_fetch_row($result);
								$countNumofGrubs = $row[0];
								
								$selectGroups="SELECT grupId, projeIsmi, ikinciToplam FROM grup WHERE basari=1 AND degerlendirmeSinifi=3 ORDER BY ikinciToplam DESC";
								$res=mysqli_query($conn, $selectGroups);
								
								$listOfgrupIDs=array($countNumofGrubs );
								$listOfprojeNames=array($countNumofGrubs );
								$listOfgrupPuan=array($countNumofGrubs );
								$i=0;
								while($loop = mysqli_fetch_row($res))
								{
									$listOfgrupIDs[$i]=$loop[0];
									$listOfprojeNames[$i]=$loop[1];
									$listOfgrupPuan[$i]=$loop[2];	
									$i++;
								}
								
							?>
								
								<center>
								<table border="1">
									<tr>
										<th>Sıralaması</th>
										<th>Proje İsmi</th>
										<th>Değerlendirilen Grup Id</th>
										<th>Puan</th>
									</tr>
								</center>
							<?php
								for($i=1;$i<=$countNumofGrubs;$i++)
								{
							?>			<center>
										<tr>
											<td><?php echo $i;?></td>
											<td><?php echo $listOfprojeNames[$i-1];?></td>
											<td><?php echo $listOfgrupIDs[$i-1];?></td>
											<td><?php echo $listOfgrupPuan[$i-1];?></td>
										</tr>
										</center>
							<?php		
								}
				
							}
				
						
					  }
					}
				
				else
				{
					//Eğer admin sisteme giriş yapmamışsa Login sayfasına yönlendiririz!
			?>
					Merhaba, sistemde gerekli değişiklikleri yapmak için giriş yapmanız gerekmektedir! <br/><br/>
					<a href="moderatorLogin.php">Giriş yapmak için lutfen tıklayınız.</a>
			<?php
				}
			?>
		</div>
		
		

		</center>
	</body>
</html>