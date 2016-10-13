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
				
				$checkDegerlendirmeQuery='SELECT degerlendirmeId FROM ilkakademik WHERE degerlendirmeId="'.$degerlendirmeId.'"';
				$result=mysqli_query($conn, $checkDegerlendirmeQuery) or die("hata1");
				
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
				
				$checkDegerlendirmeQuery='SELECT degerlendirmeId FROM ikinciakademik WHERE degerlendirmeId="'.$degerlendirmeId.'"';
				$result=mysqli_query($conn, $checkDegerlendirmeQuery) or die("hata2");
			}			
			
			if(mysqli_num_rows($result)==0)
			{
				$secilenProjeIsmiQuery='SELECT projeIsmi FROM grup WHERE grupId="'.$secilenGrupId.'"';
				$result=mysqli_query($conn, $secilenProjeIsmiQuery);
				$row = mysqli_fetch_row($result);
				$secilenProjeIsmi = $row[0];
				echo"<center><b><u> $secilenProjeIsmi Değerlendirme</u></b></center>";
		?>
							<form method="post" >
						
							<label><br/>Özgünlük kriteri icin bir puan seciniz</label><br/>
							<?php 	for($i=1;$i<=10;$i++)
									{
								?>
									<input type="radio" class="radios" name="ozgunluk" onchange="test(this)" id="0" value="<?php echo $i; ?>"><?php echo $i; ?>
								<?php
									}
							?>
							
							<label><br/>Çalışmanın doğruluğu kriteri icin bir puan seciniz</label><br/>
							
							<?php 	for($i=1;$i<=10;$i++)
									{
								?>
									<input type="radio" class="radios" name="dogruluk" onchange="test(this)"  id="1" value="<?php echo $i; ?>"><?php echo $i; ?>
								<?php
									}
							?>
							
							<label><br/>Yayına dönüşüm potansiyeli kriteri icin bir puan seciniz</label><br/>
							<?php 	for($i=1;$i<=10;$i++)
									{
								?>
									<input type="radio" class="radios" name="potansiyel" onchange="test(this)"  id="2" value="<?php echo $i; ?>"><?php echo $i; ?>
								<?php
									}
							?>
						
							
							<label><br/>Problemin sistematik çalışması kriteri icin bir puan seciniz</label><br/>
							<?php 	for($i=1;$i<=10;$i++)
									{
								?>
									<input type="radio" class="radios" name="sistematik" onchange="test(this)"  id="3" value="<?php echo $i; ?>"><?php echo $i;?>
								<?php
									}
							?>
						
							
							<label><br/>Problemin önemini vurgulama kriteri icin bir puan seciniz</label><br/>
							<?php 	for($i=1;$i<=10;$i++)
									{
								?>
									<input type="radio" class="radios" class="radios" name="problem" onchange="test(this)"  id="4" value="<?php echo $i; ?>"><?php echo $i; ?>
								<?php
									}
							?>
						
						
							
							<label><br/>Literatür tarama ve değerlendirme kriteri icin bir puan seciniz</label><br/>
							<?php 	for($i=1;$i<=10;$i++)
									{
								?>
									<input type="radio" class="radios" name="literaturTarama" onchange="test(this)" id="5"  value="<?php echo $i; ?>"><?php echo $i; ?>
								<?php
									}
							?>
						
							
							<label><br/>Sunum başarısı kriteri icin bir puan seciniz</label><br/>
							<?php 	for($i=1;$i<=10;$i++)
									{
								?>
									<input type="radio" class="radios" name="sunum" onchange="test(this)"  id="6" value="<?php echo $i; ?>"><?php echo $i; ?>
						
								<?php
									}
							?>
							
							<script>
								var checkedStat = [0,0,0,0,0,0,0];
								
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
							<input type="text" name="not" style="width: 200px; height: 50;">
							
							<input type="hidden" name="degerlendirmeId" value="<?php  echo $degerlendirmeId; ?>">
							<input type="hidden" name="grupId" value=" <?php echo $secilenGrupId;?>">
							<input type="hidden" name="secilenProjeIsmi" value=" <?php echo $secilenProjeIsmi;?>">
							
	
							<input type="submit" id="myBtn" value="Tamam" disabled=true/><br />
		
	<?php
			}
			else
			{
				echo"Daha önce bu grubun değerlendirmesini yapmışsınız!<br/>";
				echo'<a href="akademikGuncelleme.php">Guncelleme sayfasına gitmek için tıklayınız.</a>';
				
			}
		}
		
		else if(isset($_POST['ozgunluk']) || isset($_POST['dogruluk']) || isset($_POST['potansiyel']) || isset($_POST['sistematik']) || isset($_POST['problem']) || isset($_POST['literaturTarama']) || isset($_POST['sunum']) )
		{
			$form=0;
			if(isset($_POST['ozgunluk'],$_POST['dogruluk'], $_POST['potansiyel'], $_POST['sistematik'], $_POST['problem'], $_POST['literaturTarama'], $_POST['degerlendirmeId'], $_POST['grupId'], $_POST['secilenProjeIsmi'], $_POST['sunum']))
			{
			
				$ozgunluk=mysqli_real_escape_string($conn, $_POST['ozgunluk']); 
				$dogruluk=mysqli_real_escape_string($conn, $_POST['dogruluk']);  
				$potansiyel=mysqli_real_escape_string($conn, $_POST['potansiyel']); 
				$sistematik=mysqli_real_escape_string($conn, $_POST['sistematik']); 
				$problem=mysqli_real_escape_string($conn, $_POST['problem']); 
				$literaturTarama=mysqli_real_escape_string($conn, $_POST['literaturTarama']); 
				$sunum=mysqli_real_escape_string($conn, $_POST['sunum']); 
				
				$degerlendirmeId=mysqli_real_escape_string($conn, $_POST['degerlendirmeId']);
				
				$grupId=mysqli_real_escape_string($conn, $_POST['grupId']); 
				$projeIsmi=mysqli_real_escape_string($conn, $_POST['secilenProjeIsmi']); 
				$degerlendirmeGrubu=mysqli_real_escape_string($conn, $_SESSION['degerlendirmeGrubu']);
				$juriId=mysqli_real_escape_string($conn, $_SESSION['juriId']);
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
					$degisiklik="ilkAkademik insert:puanlar sirasiyla: ".$ozgunluk.",".$dogruluk.",".$potansiyel.",".$sistematik.",".$problem.",".$literaturTarama.",".$sunum.",not:".$not;
					$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';
					$logResult=mysqli_query($conn, $logQuery);
					///////
					$puanlamaQuery="INSERT INTO `ilkakademik`(`degerlendirmeId`, `degerlendirmeGrubu`, `juriId`, `grupId`, `projeIsmi`, 
															  `ozgunluk`, `dogruluk`, `potansiyel`, `sistematik`, `problem`, `literaturTarama`, `sunum`, `not`) 
													VALUES ('$degerlendirmeId','$degerlendirmeGrubu', '$juriId','$grupId','$projeIsmi', '$ozgunluk',
															'$dogruluk','$potansiyel', '$sistematik', '$problem', '$literaturTarama', '$sunum', '$not')";
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
					$degisiklik="ikinciAkademik insert:puanlar sirasiyla: ".$ozgunluk.",".$dogruluk.",".$potansiyel.",".$sistematik.",".$problem.",".$literaturTarama.",".$sunum.",not:".$not;
					$logQuery='INSERT INTO log(kullaniciId, tarih, degisiklik, degiskenId) VALUES("'.$kullaniciId.'", "'.$tarih.'", "'.$degisiklik.'", "'.$degiskenId.'")';
					$logResult=mysqli_query($conn, $logQuery);
					///////
					$puanlamaQuery="INSERT INTO `ikinciakademik`(`degerlendirmeId`, `juriId`, `grupId`, `projeIsmi`, 
															  `ozgunluk`, `dogruluk`, `potansiyel`, `sistematik`, `problem`, `literaturTarama`, `sunum`, `not`) 
													VALUES ('$degerlendirmeId', '$juriId','$grupId','$projeIsmi', '$ozgunluk',
															'$dogruluk','$potansiyel', '$sistematik', '$problem', '$literaturTarama', '$sunum', '$not')";
					$result=mysqli_query($conn, $puanlamaQuery);
				}
				if($result)
					echo"Puanlarınız kaydedilmiştir!";
				else
					echo"Puanlarınızın kaydedilmesi sırasında bir sorun oluştu!";
				echo'<br/><a href="akademikDegerlendirme.php">Değerlendirme sayfasına geri dönmek için tıklayınız.</a>';
				
			}
			else
			{
				echo"Lutfen bütün puanlama türlerinde puanlama yapınız! Yapmanıza rağmen hata veriyorsa yetkiliye haber veriniz!";
				?>
					<br/><a href="akademikDegerlendirme.php">Değerlendirme sayfasına geri dönmek için tıklayınız.</a>
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
				
				$ilkAkademikOnOffQuery='SELECT onOff FROM aktiflestirme WHERE degerlendirmeSinifi="'.$_SESSION['degerlendirmeSinifi'].'" and degerlendirmeGrubu="'.$_SESSION['degerlendirmeGrubu'].'"';
				$result=mysqli_query($conn, $ilkAkademikOnOffQuery);
				$row = mysqli_fetch_row($result);
				$ilkAkademikOnOff = $row[0];
				
				$ikinciAkademikOnOffQuery='SELECT onOff FROM aktiflestirme WHERE degerlendirmeSinifi="'.$_SESSION['degerlendirmeSinifi'].'" and degerlendirmeGrubu=3';
				$result=mysqli_query($conn, $ikinciAkademikOnOffQuery);
				$row = mysqli_fetch_row($result);
				$ikinciAkademikOnOff = $row[0];
				//Akademik ilk oturum değerlendirme
				if($ilkAkademikOnOff=="1" && $ikinciAkademikOnOff=="0")
				{
					switch($juriDegerlendirmeGrubu)
					{
						case "1":////////ilk olarak numaralandırılacak grubu seçiyoruz
									$queryCountNumofGrubs="SELECT COUNT(grupId)  FROM grup WHERE degerlendirmeSinifi=1 and degerlendirmeGrubu=1 ";
									$result=mysqli_query($conn, $queryCountNumofGrubs);
									$row = mysqli_fetch_row($result);
									$countNumofGrubs = $row[0];
									
									$listOfgrupNames=array($countNumofGrubs );
									$listOfgrupIDs=array($countNumofGrubs );
									$i=0;
									$queryGrups="SELECT grupId, projeIsmi  FROM grup WHERE degerlendirmeSinifi=1 and degerlendirmeGrubu=1 ORDER BY grupId ASC ";
									$res = mysqli_query($conn, $queryGrups);
									
								
									while($row = mysqli_fetch_row($res))
									{
										$listOfgrupIDs[$i]=$row[0];
										$listOfgrupNames[$i]=$row[1];
										$i++;	
									}
									
									?>
									<form action="akademikDegerlendirme.php" method="post">
									<b>Lutfen puanlayacağınız grubu seçiniz:<b><br />
									<?php
									for($i=0;$i<$countNumofGrubs;$i++)
									{
										$yetkiliJuriId=$_SESSION['juriId'];
										$degerlendirmeId=stripslashes ($yetkiliJuriId.$listOfgrupIDs[$i].'0');
										$degerlendirmeId = str_replace(' ', '', $degerlendirmeId);
										$degerlendirmeId = mysqli_real_escape_string($conn, $degerlendirmeId);
										$checkDegerlendirmeQuery='SELECT degerlendirmeId FROM ilkakademik WHERE degerlendirmeId="'.$degerlendirmeId.'"';
										$result=mysqli_query($conn, $checkDegerlendirmeQuery) or die("hata3");
										$res=mysqli_num_rows($result);
						
										?>
												<input type="radio" name="ilkSecilenGrup" value =" <?php echo $listOfgrupIDs[$i]; ?>" ><?php echo $listOfgrupNames[$i]; if($res==1){echo"✓";} ?><br/>
										<?php
										
									}
							
										?>
												<input type="submit" value="Tamam"/><br />
										<?php
									
									break;
						case "2":////////ilk olarak numaralandırılacak grubu seçiyoruz
									$queryCountNumofGrubs="SELECT COUNT(grupId)  FROM grup WHERE degerlendirmeSinifi=1 and degerlendirmeGrubu=2 ";
									$result=mysqli_query($conn, $queryCountNumofGrubs);
									$row = mysqli_fetch_row($result);
									$countNumofGrubs = $row[0];
									
									$listOfgrupNames=array($countNumofGrubs );
									$listOfgrupIDs=array($countNumofGrubs );
									$i=0;
									$queryGrups="SELECT grupId, projeIsmi  FROM grup WHERE degerlendirmeSinifi=1 and degerlendirmeGrubu=2 ORDER BY grupId ASC ";
									$res = mysqli_query($conn, $queryGrups);
									
									while($row = mysqli_fetch_row($res))
									{
										$listOfgrupIDs[$i]=$row[0];
										$listOfgrupNames[$i]=$row[1];
										$i++;	
									}
									?>
									<form action="akademikDegerlendirme.php" method="post">
									<b>Lutfen puanlayacağınız grubu seçiniz:<b><br />
									<?php
									for($i=0;$i<$countNumofGrubs;$i++)
									{
										$yetkiliJuriId=$_SESSION['juriId'];
										$degerlendirmeId=stripslashes ($yetkiliJuriId.$listOfgrupIDs[$i].'0');
										$degerlendirmeId = str_replace(' ', '', $degerlendirmeId);
										$degerlendirmeId = mysqli_real_escape_string($conn, $degerlendirmeId);
										$checkDegerlendirmeQuery='SELECT degerlendirmeId FROM ilkakademik WHERE degerlendirmeId="'.$degerlendirmeId.'"';
										$result=mysqli_query($conn, $checkDegerlendirmeQuery) or die("hata4");
										$res=mysqli_num_rows($result);
										?>
												<input type="radio" name="ilkSecilenGrup" value="<?php echo $listOfgrupIDs[$i]; ?>"> <?php echo $listOfgrupNames[$i]; if($res==1){echo"✓";} ?><br/>
										<?php
										
									}
							
										?>
												<input type="submit" value="Tamam"/><br />
										<?php
									
									break;
									
							default : echo"Bir sorunla karşılaşıldı:juriGrup:$juriDegerlendirmeGrubu:ilkAkademikOn";
						//switch kapa
						}
				//ilkAkademikOn if kapa
				}
				//Akademik ikinci oturum değerlendirme
				else if($ilkAkademikOnOff=="0" && $ikinciAkademikOnOff=="1")
				{
					
					$queryCountNumofGrubs="SELECT COUNT(grupId)  FROM grup WHERE degerlendirmeSinifi=1 and basari=1 ";
					$result=mysqli_query($conn, $queryCountNumofGrubs);
					$row = mysqli_fetch_row($result);
					$countNumofGrubs = $row[0];
									
					$listOfgrupNames=array($countNumofGrubs );
					$listOfgrupIDs=array($countNumofGrubs );
					$i=0;
					$queryGrups="SELECT grupId, projeIsmi  FROM grup WHERE degerlendirmeSinifi=1 and basari=1 ORDER BY grupId ASC ";
					$res = mysqli_query($conn, $queryGrups);
					
				
					while($row = mysqli_fetch_row($res))
					{
						$listOfgrupIDs[$i]=$row[0];
						$listOfgrupNames[$i]=$row[1];
						$i++;	
					}
					?>
						<form action="akademikDegerlendirme.php" method="post">
						<b>Lutfen puanlayacağınız grubu seçiniz:<b><br />
						<?php
							for($i=0;$i<$countNumofGrubs;$i++)
							{
								$yetkiliJuriId=$_SESSION['juriId'];
								$degerlendirmeId=stripslashes ($yetkiliJuriId.$listOfgrupIDs[$i].'1');
								$degerlendirmeId = str_replace(' ', '', $degerlendirmeId);
								$degerlendirmeId = mysqli_real_escape_string($conn, $degerlendirmeId);
								$checkDegerlendirmeQuery='SELECT degerlendirmeId FROM ikinciakademik WHERE degerlendirmeId="'.$degerlendirmeId.'"';
								$result=mysqli_query($conn, $checkDegerlendirmeQuery) or die("hata5");
								$res=mysqli_num_rows($result);
					?>
								<input type="radio" name="ikinciSecilenGrup" value="<?php echo $listOfgrupIDs[$i]; ?>"> <?php echo $listOfgrupNames[$i]; if($res==1){echo"✓";}  ?><br/>
					<?php
										
							}
							
					?>
							<input type="submit" value="Tamam"/><br />
					<?php
									
						
				//ikinciAkademikOn if kapa
				}
				else if($ilkAkademikOnOff=="0" && $ikinciAkademikOnOff=="0")
				{
					echo"Değerlendirmeler henüz başlamamıştır!";
				}
				else if($ilkAkademikOnOff=="1" && $ikinciAkademikOnOff=="1")
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

