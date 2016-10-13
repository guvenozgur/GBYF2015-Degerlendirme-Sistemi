<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Proje Puanları Güncelleme Sayfası</title>
		<h1>Proje Puanları Güncelleme Sayfası</h1>
	</head>
	<center>
<?php
	include("db.php");
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		//ilk aşama puanlaması
		if(isset($_POST['ilkSecilenGrup']) || isset($_POST['ikinciSecilenGrup']))
		{
			
			if(isset($_POST['ilkSecilenGrup']))
			{
		
				$form=0;
				$secilenGrupId=mysqli_real_escape_string($conn, $_POST['ilkSecilenGrup']); 
				$yetkiliJuriId=$_SESSION['juriId'];
				$degerlendirmeId=stripslashes ($yetkiliJuriId.$secilenGrupId.' 0');
				$degerlendirmeId = str_replace(' ', '', $degerlendirmeId);
				$degerlendirmeId = mysqli_real_escape_string($conn, $degerlendirmeId);
				
				$checkDegerlendirmeQuery='SELECT degerlendirmeId FROM ilkfikir WHERE degerlendirmeId="'.$degerlendirmeId.'"';
				$result=mysqli_query($conn, $checkDegerlendirmeQuery) or die("hata fikirGuncelleme line 28");
				
				$eskiPuanlamaQuery="SELECT `degerlendirme1`, `degerlendirme2`, `degerlendirme3`, `degerlendirme4`, `degerlendirme5`,   `not` FROM `ilkfikir` WHERE degerlendirmeId='$degerlendirmeId'";
				$eskiPuanlama=mysqli_query($conn, $eskiPuanlamaQuery) or die("hata fikirGuncelleme line 31");
				$puanlamalar=mysqli_fetch_row($eskiPuanlama);
			}
			
			else if(isset($_POST['ikinciSecilenGrup']))
			{
				$form=0;
				$secilenGrupId=mysqli_real_escape_string($conn, $_POST['ikinciSecilenGrup']); 
				$yetkiliJuriId=$_SESSION['juriId'];
				//degerlendirmeId sinin sonu 1 ile bitiyorsa anlamı bu grup 2. aşamaya geçmiş demektir!
				$degerlendirmeId=stripslashes ($yetkiliJuriId.$secilenGrupId.' 1');
				$degerlendirmeId = str_replace(' ', '', $degerlendirmeId);
				$degerlendirmeId = mysqli_real_escape_string($conn, $degerlendirmeId);
				
				$checkDegerlendirmeQuery='SELECT degerlendirmeId FROM ikincifikir WHERE degerlendirmeId="'.$degerlendirmeId.'"';
				$result=mysqli_query($conn, $checkDegerlendirmeQuery);
				
				$eskiPuanlamaQuery="SELECT `degerlendirme1`, `degerlendirme2`, `degerlendirme3`, `degerlendirme4`, `degerlendirme5`,  `not` FROM `ikincifikir` WHERE degerlendirmeId='$degerlendirmeId'";
				$eskiPuanlama=mysqli_query($conn, $eskiPuanlamaQuery) or die("hata fikirGuncelleme line 49");
				$puanlamalar=mysqli_fetch_row($eskiPuanlama);
			}
			
			if(mysqli_num_rows($result)==1)
			{
				$secilenProjeIsmiQuery='SELECT projeIsmi FROM grup WHERE grupId="'.$secilenGrupId.'"';
				$result=mysqli_query($conn, $secilenProjeIsmiQuery);
				$row = mysqli_fetch_row($result);
				$secilenProjeIsmi = $row[0];
				
				?>
				<table border="1">
					<tr>
						<th>Proje İsmi</th>
						<th>Yenilikçilik </th>
						<th>Sürdürülebilirlik</th>
						<th>Çevreye fayda </th>
						<th>Yöntem netliği </th>
						<th>Sunum becerisi </th>
					</tr>
					<tr>
						<td> <?php echo $secilenProjeIsmi; ?> </td>
						<td> <?php echo $puanlamalar[0]; ?> </td>
						<td> <?php echo $puanlamalar[1]; ?> </td>
						<td> <?php echo $puanlamalar[2]; ?> </td>
						<td> <?php echo $puanlamalar[3]; ?> </td>
						<td> <?php echo $puanlamalar[4]; ?> </td>
					</tr>
				</table>
				
				
<?php
				echo"<center><b><u> $secilenProjeIsmi Değerlendirme</u></b></center>";
		?>
							<form action="fikirGuncelleme.php" method="post">
							<label><br/>Yenilikçilik kriteri icin bir puan seçiniz:</label><br/>
							<?php 	for($i=1;$i<=10;$i++)
									{
								?>
									<input type="radio" name="degerlendirme1" value="<?php echo $i; ?>" <?php if($i==$puanlamalar[0]){ ?> checked <?php } ?>><?php echo $i; ?>
								<?php
									}
							?>
							
							<label><br/>Sürdürülebilirlik kriteri icin bir puan seciniz:</label><br/>
							
							<?php 	for($i=1;$i<=10;$i++)
									{
								?>
									<input type="radio" name="degerlendirme2" value="<?php echo $i; ?>" <?php if($i==$puanlamalar[1]){ ?> checked <?php } ?> ><?php echo $i; ?>
								<?php
									}
							?>
							
							<label><br/>Çevreye fayda kriteri icin bir puan seciniz:</label><br/>
							<?php 	for($i=1;$i<=10;$i++)
									{
								?>
									<input type="radio" name="degerlendirme3" value="<?php echo $i; ?>" <?php if($i==$puanlamalar[2]){ ?> checked <?php } ?> ><?php echo $i; ?>
								<?php
									}
							?>
						
							
							<label><br/>Yöntem netliği kriteri icin bir puan seciniz:</label><br/>
							<?php 	for($i=1;$i<=10;$i++)
									{
								?>
									<input type="radio" name="degerlendirme4" value="<?php echo $i; ?>" <?php if($i==$puanlamalar[3]){ ?> checked <?php } ?> ><?php echo $i;?>
								<?php
									}
							?>
						
							
							<label><br/>Sunum becerisi kriteri icin bir puan seciniz:</label><br/>
							<?php 	for($i=1;$i<=10;$i++)
									{
								?>
									<input type="radio" name="degerlendirme5" value="<?php echo $i; ?>" <?php if($i==$puanlamalar[4]){ ?> checked <?php } ?> ><?php echo $i; ?>
								<?php
									}
							?>
						
						
							
							<label><br/>Grup hakkındaki görüşlerinizi buraya yazabilirsiniz:</label><br/>
							<input type="text" name="not" style="width: 200px; height: 50;" value="<?php echo htmlentities($puanlamalar[6], ENT_QUOTES, 'UTF-8');?>" >
							
							<input type="hidden" name="degerlendirmeId" value="<?php  echo $degerlendirmeId; ?>">
							<input type="hidden" name="grupId" value=" <?php echo $secilenGrupId;?>">
							<input type="hidden" name="secilenProjeIsmi" value=" <?php echo $secilenProjeIsmi;?>">
							
							
							<input type="submit" value="Tamam"/><br />
		
	<?php
			}
			else if(mysqli_num_rows($result)==0)
			{
				echo"Daha önce bu grubun değerlendirmesini yapmamışsınız!<br/>";
				echo"<a href='fikirDegerlendirme.php'>Değerlendirme sayfasına gitmek için tıklayınız</a><br/>";
				echo"<a href='fikirGuncelleme.php'>Güncelleme sayfasına dönemek için tıklayınız</a><br/>";				
			}
			else 
			{
				echo"Bu grubun değerlendirmesi ile ilgili sorun var! Lütfen yetkili kişiye haber veriniz!(fikirGuncelleme line 168)<br/>";
				
			}
		}
		
		else if(isset($_POST['degerlendirme1']) || isset($_POST['degerlendirme2']) || isset($_POST['degerlendirme3']) || isset($_POST['degerlendirme4']) || isset($_POST['degerlendirme5'])  )
		{
			$form=0;
			if(isset($_POST['degerlendirme1'],$_POST['degerlendirme2'], $_POST['degerlendirme3'], $_POST['degerlendirme4'], $_POST['degerlendirme5'], $_POST['degerlendirmeId'], $_POST['grupId'], $_POST['secilenProjeIsmi']))
			{
			
				$degerlendirme1=mysqli_real_escape_string($conn, $_POST['degerlendirme1']); 
				$degerlendirme2=mysqli_real_escape_string($conn, $_POST['degerlendirme2']);  
				$degerlendirme3=mysqli_real_escape_string($conn, $_POST['degerlendirme3']); 
				$degerlendirme4=mysqli_real_escape_string($conn, $_POST['degerlendirme4']); 
				$degerlendirme5=mysqli_real_escape_string($conn, $_POST['degerlendirme5']); 
				
				$degerlendirmeId=mysqli_real_escape_string($conn, $_POST['degerlendirmeId']);
				
				$grupId=mysqli_real_escape_string($conn, $_POST['grupId']); 
				$projeIsmi=mysqli_real_escape_string($conn, $_POST['secilenProjeIsmi']); 
				$juriId=mysqli_real_escape_string($conn, $_SESSION['juriId']);
				$degerlendirmeGrubu=mysqli_real_escape_string($conn, $_SESSION['degerlendirmeGrubu']);
				if(isset($_POST['not']))
					$not=mysqli_real_escape_string($conn, $_POST['not']);
				else
					$not=mysqli_real_escape_string($conn, '');
				$asama=substr($degerlendirmeId,-1);
				if($asama==0)
				{
					//log:
					// kullaniciId:
					$kullaniciId=$_SESSION['juriId'];
					// tarih:
					$tarih=date(DATE_RFC822);
					// degiskenId:
					$degiskenId=$grupId;
					//degisiklik:
					$degisiklik="ilkfikir update.Sirasiyla guncellenen puanlar: ".$degerlendirme1.",".$degerlendirme2.",".$degerlendirme3.",".$degerlendirme4.",".$degerlendirme5;
					$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';
					$logResult=mysqli_query($conn, $logQuery);
					//////
					$puanlamaQuery="UPDATE `ilkfikir` SET `degerlendirme1`='$degerlendirme1',`degerlendirme2`='$degerlendirme2',`degerlendirme3`='$degerlendirme3',`degerlendirme4`='$degerlendirme4',`degerlendirme5`='$degerlendirme5',`not`='$not' 
									WHERE `degerlendirmeId`= '$degerlendirmeId'";
					$result=mysqli_query($conn, $puanlamaQuery);
				}
				
				if($asama==1)
				{
					//log:
					// kullaniciId:
					$kullaniciId=$_SESSION['juriId'];
					// tarih:
					$tarih=date(DATE_RFC822);
					// degiskenId:
					$degiskenId=$grupId;
					//degisiklik:
					$degisiklik="ikinciFikir update.Sirasiyla guncellenen puanlar: ".$degerlendirme1.",".$degerlendirme2.",".$degerlendirme3.",".$degerlendirme4.",".$degerlendirme5;
					$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';
					$logResult=mysqli_query($conn, $logQuery);
					//////
					$puanlamaQuery="UPDATE `ikincifikir` SET `degerlendirme1`='$degerlendirme1',`degerlendirme2`='$degerlendirme2',`degerlendirme3`='$degerlendirme3',`degerlendirme4`='$degerlendirme4',`degerlendirme5`='$degerlendirme5',`not`='$not' 
									WHERE `degerlendirmeId`= '$degerlendirmeId'";
					$result=mysqli_query($conn, $puanlamaQuery);
				}
				if($result)
					echo"Puanlarınız kaydedilmiştir!";
				else
					echo"Puanlarınızın kaydedilmesi sırasında bir sorun oluştu!";
				echo'<br/><a href="fikirGuncelleme.php">Güncelleme sayfasına geri dönmek için tıklayınız.</a>';
			}
			else
			{
				echo"Lutfen bütün puanlama türlerinde puanlama yapınız! Yapmanıza rağmen hata veriyorsa yetkiliye haber veriniz!";
				?>
					<br/><a href="fikirGuncelleme.php">Güncelleme sayfasına geri dönmek için tıklayınız.</a>
			<?php
			}
			
		}
		
		
		
		else{
			$form=0;
			echo"Lutfen birisini seçiniz!";
		}
	}
	
?>

	<body>
		
		<?php
		
		if(!isset($form))
		{
			if(isset($_SESSION['juriIsmi']))
			{
				$juriDegerlendirmeGrubu=$_SESSION['degerlendirmeGrubu'];
				
				$ilkFikirOnOffQuery='SELECT onOff FROM aktiflestirme WHERE degerlendirmeSinifi="'.$_SESSION['degerlendirmeSinifi'].'" and degerlendirmeGrubu="'.$_SESSION['degerlendirmeGrubu'].'"';
				$result=mysqli_query($conn, $ilkFikirOnOffQuery);
				$row = mysqli_fetch_row($result);
				$ilkFikirOnOff = $row[0];
				
				$ikinciFikirOnOffQuery='SELECT onOff FROM aktiflestirme WHERE degerlendirmeSinifi="'.$_SESSION['degerlendirmeSinifi'].'" and degerlendirmeGrubu=3';
				$result=mysqli_query($conn, $ikinciFikirOnOffQuery);
				$row = mysqli_fetch_row($result);
				$ikinciFikirOnOff = $row[0];
				
				//Sektörel ilk oturum değerlendirme
				if($ilkFikirOnOff=="1" && $ikinciFikirOnOff=="0")
				{
					switch($juriDegerlendirmeGrubu)
					{
						case "1":////////ilk olarak numaralandırılacak grubu seçiyoruz
									$queryCountNumofGrubs="SELECT COUNT(grupId)  FROM grup WHERE degerlendirmeSinifi=3 and degerlendirmeGrubu=1 ";
									$result=mysqli_query($conn, $queryCountNumofGrubs);
									$row = mysqli_fetch_row($result);
									$countNumofGrubs = $row[0];
									
									$listOfgrupNames=array($countNumofGrubs );
									$listOfgrupIDs=array($countNumofGrubs );
									$i=0;
									$queryGrups="SELECT grupId, projeIsmi  FROM grup WHERE degerlendirmeSinifi=3 and degerlendirmeGrubu=1 ORDER BY grupId ASC ";
									$res = mysqli_query($conn, $queryGrups);
									
								
									while($row = mysqli_fetch_row($res))
									{
										$listOfgrupIDs[$i]=$row[0];
										$listOfgrupNames[$i]=$row[1];
										$i++;	
									}
									
									?>
									<form action="fikirGuncelleme.php" method="post">
									<b>Lutfen puanlayacağınız grubu seçiniz:<b><br />
									<?php
									for($i=0;$i<$countNumofGrubs;$i++)
									{
										$yetkiliJuriId=$_SESSION['juriId'];
										$degerlendirmeId=stripslashes ($yetkiliJuriId.$listOfgrupIDs[$i].'0');
										$degerlendirmeId = str_replace(' ', '', $degerlendirmeId);
										$degerlendirmeId = mysqli_real_escape_string($conn, $degerlendirmeId);
										$checkDegerlendirmeQuery='SELECT degerlendirmeId FROM ilkfikir WHERE degerlendirmeId="'.$degerlendirmeId.'"';
										$result=mysqli_query($conn, $checkDegerlendirmeQuery) or die("hata fikirGuncelleme line 304");
										$res=mysqli_num_rows($result);
										?>
												<input type="radio" name="ilkSecilenGrup" value =" <?php echo $listOfgrupIDs[$i]; ?>" ><?php echo $listOfgrupNames[$i];  if($res==1){echo"✓";} ?><br/>
										<?php
										
									}
							
										?>
												<input type="submit" value="Tamam"/><br />
										<?php
									
									break;
						case "2":////////ilk olarak numaralandırılacak grubu seçiyoruz
									$queryCountNumofGrubs="SELECT COUNT(grupId)  FROM grup WHERE degerlendirmeSinifi=3 and degerlendirmeGrubu=2 ";
									$result=mysqli_query($conn, $queryCountNumofGrubs);
									$row = mysqli_fetch_row($result);
									$countNumofGrubs = $row[0];
									
									$listOfgrupNames=array($countNumofGrubs );
									$listOfgrupIDs=array($countNumofGrubs );
									$i=0;
									$queryGrups="SELECT grupId, projeIsmi  FROM grup WHERE degerlendirmeSinifi=3 and degerlendirmeGrubu=2 ORDER BY grupId ASC ";
									$res = mysqli_query($conn, $queryGrups);
									
									while($row = mysqli_fetch_row($res))
									{
										$listOfgrupIDs[$i]=$row[0];
										$listOfgrupNames[$i]=$row[1];
										$i++;	
									}
									?>
									<form action="fikirGuncelleme.php" method="post">
									<b>Lutfen güncelleyeceğiniz grubu seçiniz:<b><br />
									<?php
									for($i=0;$i<$countNumofGrubs;$i++)
									{
										$yetkiliJuriId=$_SESSION['juriId'];
										$degerlendirmeId=stripslashes ($yetkiliJuriId.$listOfgrupIDs[$i].'0');
										$degerlendirmeId = str_replace(' ', '', $degerlendirmeId);
										$degerlendirmeId = mysqli_real_escape_string($conn, $degerlendirmeId);
										$checkDegerlendirmeQuery='SELECT degerlendirmeId FROM ilkfikir WHERE degerlendirmeId="'.$degerlendirmeId.'"';
										$result=mysqli_query($conn, $checkDegerlendirmeQuery) or die("hata fikirGuncelleme line 346");
										$res=mysqli_num_rows($result);
										?>
												<input type="radio" name="ilkSecilenGrup" value="<?php echo $listOfgrupIDs[$i]; ?>"> <?php echo $listOfgrupNames[$i];if($res==1){echo"✓";} ?><br/>
										<?php
										
									}
							
										?>
												<input type="submit" value="Tamam"/><br />
										<?php
									
									break;
									
							default : echo"Bir sorunla karşılaşıldı:juriGrup:$juriDegerlendirmeGrubu:ilkFikirOn";
						//switch kapa
						}
				//ilkFikirOn if kapa
				}
				//Fikir ikinci oturum değerlendirme
				else if($ilkFikirOnOff=="0" && $ikinciFikirOnOff=="1")
				{
					
					$queryCountNumofGrubs="SELECT COUNT(grupId)  FROM grup WHERE degerlendirmeSinifi=3 and basari=1 ";
					$result=mysqli_query($conn, $queryCountNumofGrubs);
					$row = mysqli_fetch_row($result);
					$countNumofGrubs = $row[0];
									
					$listOfgrupNames=array($countNumofGrubs );
					$listOfgrupIDs=array($countNumofGrubs );
					$i=0;
					$queryGrups="SELECT grupId, projeIsmi FROM grup WHERE degerlendirmeSinifi=3 and basari=1 ORDER BY grupId ASC ";
					$res = mysqli_query($conn, $queryGrups);
									
					while($row = mysqli_fetch_row($res))
					{
						$listOfgrupIDs[$i]=$row[0];
						$listOfgrupNames[$i]=$row[1];
						$i++;	
					}
					?>
						<form action="fikirGuncelleme.php" method="post">
						<b>Lutfen puanlayacağınız grubu seçiniz:<b><br />
						<?php
							for($i=0;$i<$countNumofGrubs;$i++)
							{
								$yetkiliJuriId=$_SESSION['juriId'];
								$degerlendirmeId=stripslashes ($yetkiliJuriId.$listOfgrupIDs[$i].'1');
								$degerlendirmeId = str_replace(' ', '', $degerlendirmeId);
								$degerlendirmeId = mysqli_real_escape_string($conn, $degerlendirmeId);
								$checkDegerlendirmeQuery='SELECT degerlendirmeId FROM ikincifikir WHERE degerlendirmeId="'.$degerlendirmeId.'"';
								$result=mysqli_query($conn, $checkDegerlendirmeQuery) or die("hata fikirGuncelleme line 397");
								$res=mysqli_num_rows($result);
					?>
								<input type="radio" name="ikinciSecilenGrup" value="<?php echo $listOfgrupIDs[$i]; ?>"> <?php echo $listOfgrupNames[$i]; if($res==1){echo"✓";} ?><br/>
					<?php
										
							}
							
					?>
							<input type="submit" value="Tamam"/><br />
					<?php
									
						
				//ikinciFikirOn if kapa
				}
				else if($ilkFikirOnOff=="0" && $ikinciFikirOnOff=="0")
				{
					echo"Değerlendirmeler henüz başlamamıştır!";
				}
				else if($ilkFikirOnOff=="1" && $ikinciFikirOnOff=="1")
				{
					echo"İlk aşama değerlendirmeleri henüz bitmemiştir! Eğer bu mesajı almaya devam ederseniz yetkiliye haber veriniz!";
				}
			
			}
				else
				{
					echo"Değerlendirme yapabilmek için juri isminiz ve şifrenizi kullanarak giriş yapmanız gerekmektedir!";
				}
		}
		?>
		
			<hr/>
			<a href="juriAnasayfa.php">Juri Anasayfasına gitmek için Tıklayınız!</a><br />
			</center>
	</body>
</html>