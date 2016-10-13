<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>İlk Oturum Sıralamaları</title>
	</head>
<?php
	include("db.php");
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(isset($_POST['hesapla']))
		{
			$hesapla=$_POST['hesapla'];
			
			switch($hesapla){
				
				//Akademik ikinci aşama sıralama:		
				case 1:			$queryCountNumofGrubs="SELECT COUNT(grupId)  FROM grup WHERE degerlendirmeSinifi=1 and basari=1 ";
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
							break;
				
				//Sektörel aşama 2 sıralama
				case 2:			$queryCountNumofGrubs="SELECT COUNT(grupId)  FROM grup WHERE degerlendirmeSinifi=2 and basari=1 ";
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
							break;
			
				//Fikir aşama 1 sıralaması			
				case 3:			$queryCountNumofGrubs="SELECT COUNT(grupId)  FROM grup WHERE degerlendirmeSinifi=3 and basari=1";
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
							break;
				
				
			}
			
			
		}
		
		else
			echo"Lutfen birisini seçiniz!";
	}
	
?>

	<body>
		<center>
		<h1>İkinci Oturum Sıralamalar Sayfası</h1>
		<?php
		if(isset($_SESSION['adminIsmi']))
		{
		?>
			<form action="ikinciSiralama.php" method="post">
				
				<b>Lütfen sıralamasını görmek istediğiniz kategoriyi seçiniz:<b><br /><br/>
				
				<input type="radio" name="hesapla" value="1"> Akademik Değerlendirme İkinci Aşama<br/><br/>
				<input type="radio" name="hesapla" value="2"> Sektörel Değerlendirme İkinci Aşama<br/><br/>
				<input type="radio" name="hesapla" value="3"> Fikir Değerlendirme İkinci Aşama<br/><br/>
				
				
				<input type="submit" value="Tamam"/><br />
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