<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Proje Değerlendirme Sayfası</title>
		<h1>Proje Değerlendirme Sayfası</h1>
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
				$result=mysqli_query($conn, $checkDegerlendirmeQuery);
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
			}
			
			if(mysqli_num_rows($result)==0)
			{
				$secilenProjeIsmiQuery='SELECT projeIsmi FROM grup WHERE grupId="'.$secilenGrupId.'"';
				$result=mysqli_query($conn, $secilenProjeIsmiQuery);
				$row = mysqli_fetch_row($result);
				$secilenProjeIsmi = $row[0];
				
				echo"<center><b><u> $secilenProjeIsmi Değerlendirme</u></b></center>";
		?>
							<form action="fikirDegerlendirme.php" method="post">
							<label><br/>Yenilikçilik kriteri icin bir puan seçiniz:</label><br/>
							<?php 	for($i=1;$i<=10;$i++)
									{
								?>
									<input type="radio" name="degerlendirme1" onchange="test(this)" id="0"  value="<?php echo $i; ?>"  > <?php echo $i; ?>
								<?php
									}
							?>
							
							<label><br/>Sürdürülebilirlik kriteri icin bir puan seciniz:</label><br/>
							
							<?php 	for($i=1;$i<=10;$i++)
									{
								?>
									<input type="radio" name="degerlendirme2" onchange="test(this)" id="1"  value="<?php echo $i; ?>" ><?php echo $i; ?>
								<?php
									}
							?>
							
							<label><br/>Çevreye fayda kriteri icin bir puan seciniz:</label><br/>
							<?php 	for($i=1;$i<=10;$i++)
									{
								?>
									<input type="radio" name="degerlendirme3" onchange="test(this)" id="2"  value="<?php echo $i; ?>" ><?php echo $i; ?>
								<?php
									}
							?>
						
							
							<label><br/>Yöntem netliği kriteri icin bir puan seciniz:</label><br/>
							<?php 	for($i=1;$i<=10;$i++)
									{
								?>
									<input type="radio" name="degerlendirme4" onchange="test(this)" id="3"  value="<?php echo $i; ?>"  ><?php echo $i;?>
								<?php
									}
							?>
						
							
							<label><br/>Sunum becerisi kriteri icin bir puan seciniz:</label><br/>
							<?php 	for($i=1;$i<=10;$i++)
									{
								?>
									<input type="radio" name="degerlendirme5" onchange="test(this)" id="4"  value="<?php echo $i; ?>" ><?php echo $i; ?>
								<?php
									}
							?>
						
						
							<script>
								var checkedStat = [0,0,0,0,0];
								
								function test(rad)
								{
									//alert(parseInt(rad.id));
									checkedStat[parseInt(rad.id)] = 1;
									//alert(checkedStat[parseInt(rad.id)]);
									
										if(checkedStat.indexOf(0) == -1)
										{
											//alert("all checked");
											document.getElementById("myBtn").disabled = false;
										}
										else{
											//alert("all NOT checked");
											document.getElementById("myBtn").disabled = true;
										}
								}
							</script>
							
							<label><br/>Grup hakkındaki görüşlerinizi buraya yazabilirsiniz:</label><br/>
							<input type="text" name="not" style="width: 200px; height: 50;"  >
							
							<input type="hidden" name="degerlendirmeId" value="<?php  echo $degerlendirmeId; ?>">
							<input type="hidden" name="grupId" value=" <?php echo $secilenGrupId;?>">
							<input type="hidden" name="secilenProjeIsmi" value=" <?php echo $secilenProjeIsmi;?>">
							
							
							<input type="submit" value="Tamam" id="myBtn" disabled=true/><br />
		
	<?php
	

			}
			else
			{
				echo"Daha önce bu grubun değerlendirmesini yapmışsınız!<br/>";
				echo'<a href="fikirGuncelleme.php">Guncelleme sayfasına gitmek için tıklayınız.</a>';
				
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
					
					// tarih:
					$tarih=date(DATE_RFC822);
					// kullaniciId:
					$kullaniciId=$_SESSION['juriId'];
					// degiskenId:
					$degiskenId=$grupId;
					//degisiklik:
					$degisiklik="ilkFikir insert:puanlar sirasiyla: ".$degerlendirme1.",".$degerlendirme2.",".$degerlendirme3.",".$degerlendirme4.",".$degerlendirme5.",".",not:".$not;
					$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';
					$logResult=mysqli_query($conn, $logQuery);
					///////
					$puanlamaQuery="INSERT INTO `ilkfikir`(`degerlendirmeId`, `degerlendirmeGrubu`, `juriId`, `grupId`, `projeIsmi`, 
															  `degerlendirme1`, `degerlendirme2`, `degerlendirme3`, `degerlendirme4`, `degerlendirme5`,  `not`) 
													VALUES ('$degerlendirmeId','$degerlendirmeGrubu', '$juriId','$grupId','$projeIsmi', '$degerlendirme1',
															'$degerlendirme2','$degerlendirme3', '$degerlendirme4', '$degerlendirme5',  '$not')";
					$result=mysqli_query($conn, $puanlamaQuery);
				}
				
				if($asama==1)
				{
					//log:
					
					// tarih:
					$tarih=date(DATE_RFC822);
					// kullaniciId:
					$kullaniciId=$_SESSION['juriId'];
					// degiskenId:
					$degiskenId=$grupId;
					//degisiklik:
					$degisiklik="ikinciFikir insert:puanlar sirasiyla: ".$degerlendirme1.",".$degerlendirme2.",".$degerlendirme3.",".$degerlendirme4.",".$degerlendirme5.",".",not:".$not;
					$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';
					$logResult=mysqli_query($conn, $logQuery);
					///////
					$puanlamaQuery="INSERT INTO `ikincifikir`(`degerlendirmeId`, `juriId`, `grupId`, `projeIsmi`, 
															  `degerlendirme1`, `degerlendirme2`, `degerlendirme3`, `degerlendirme4`, `degerlendirme5`, `not`) 
													VALUES ('$degerlendirmeId', '$juriId','$grupId','$projeIsmi', '$degerlendirme1',
															'$degerlendirme2','$degerlendirme3', '$degerlendirme4', '$degerlendirme5',  '$not')";
					$result=mysqli_query($conn, $puanlamaQuery);
				}
				if($result)
					echo"Puanlarınız kaydedilmiştir!";
				else
					echo"Puanlarınızın kaydedilmesi sırasında bir sorun oluştu!";
				echo'<br/><a href="fikirDegerlendirme.php">Değerlendirme sayfasına geri dönmek için tıklayınız.</a>';
			}
			else
			{
				
				
				
				echo"Lutfen bütün puanlama türlerinde puanlama yapınız! Yapmanıza rağmen hata veriyorsa yetkiliye haber veriniz!";
				?>
					<br/><a href="fikirDegerlendirme.php">Değerlendirme sayfasına geri dönmek için tıklayınız.</a>
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
									<form action="fikirDegerlendirme.php" method="post">
									<b>Lutfen puanlayacağınız grubu seçiniz:<b><br />
									<?php
									for($i=0;$i<$countNumofGrubs;$i++)
									{
										$yetkiliJuriId=$_SESSION['juriId'];
										$degerlendirmeId=stripslashes ($yetkiliJuriId.$listOfgrupIDs[$i].'0');
										$degerlendirmeId = str_replace(' ', '', $degerlendirmeId);
										$degerlendirmeId = mysqli_real_escape_string($conn, $degerlendirmeId);
										$checkDegerlendirmeQuery='SELECT degerlendirmeId FROM ilkfikir WHERE degerlendirmeId="'.$degerlendirmeId.'"';
										$result=mysqli_query($conn, $checkDegerlendirmeQuery) or die("hata");
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
									<form action="fikirDegerlendirme.php" method="post">
									<b>Lutfen puanlayacağınız grubu seçiniz:<b><br />
									<?php
									for($i=0;$i<$countNumofGrubs;$i++)
									{
										$yetkiliJuriId=$_SESSION['juriId'];
										$degerlendirmeId=stripslashes ($yetkiliJuriId.$listOfgrupIDs[$i].'0');
										$degerlendirmeId = str_replace(' ', '', $degerlendirmeId);
										$degerlendirmeId = mysqli_real_escape_string($conn, $degerlendirmeId);
										$checkDegerlendirmeQuery='SELECT degerlendirmeId FROM ilkfikir WHERE degerlendirmeId="'.$degerlendirmeId.'"';
										$result=mysqli_query($conn, $checkDegerlendirmeQuery) or die("hata");
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
					$queryGrups="SELECT grupId, projeIsmi  FROM grup WHERE degerlendirmeSinifi=3 and basari=1 ORDER BY grupId ASC ";
					$res = mysqli_query($conn, $queryGrups);
									
					while($row = mysqli_fetch_row($res))
					{
						$listOfgrupIDs[$i]=$row[0];
						$listOfgrupNames[$i]=$row[1];
						$i++;	
					}
					?>
						<form action="fikirDegerlendirme.php" method="post">
						<b>Lutfen puanlayacağınız grubu seçiniz:<b><br />
						<?php
							for($i=0;$i<$countNumofGrubs;$i++)
							{
								$yetkiliJuriId=$_SESSION['juriId'];
								$degerlendirmeId=stripslashes ($yetkiliJuriId.$listOfgrupIDs[$i].'1');
								$degerlendirmeId = str_replace(' ', '', $degerlendirmeId);
								$degerlendirmeId = mysqli_real_escape_string($conn, $degerlendirmeId);
								$checkDegerlendirmeQuery='SELECT degerlendirmeId FROM ikincifikir WHERE degerlendirmeId="'.$degerlendirmeId.'"';
								$result=mysqli_query($conn, $checkDegerlendirmeQuery) or die("hata");
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