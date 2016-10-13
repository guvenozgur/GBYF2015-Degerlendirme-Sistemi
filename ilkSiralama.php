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
				//Akademik 1. grup sıralama:
				case 1: 		$queryCountNumofGrubs="SELECT COUNT(grupId)  FROM grup WHERE degerlendirmeSinifi=1 and degerlendirmeGrubu=1 ";
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
							break;
							
				case 2:			$queryCountNumofGrubs="SELECT COUNT(grupId)  FROM grup WHERE degerlendirmeSinifi=1 and degerlendirmeGrubu=2 ";
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
							break;
				//Sektörel 1. grup sıralama			
				case 3:			$queryCountNumofGrubs="SELECT COUNT(grupId)  FROM grup WHERE degerlendirmeSinifi=2 and degerlendirmeGrubu=1 ";
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
							break;
				//Sektörel aşama 1 grup 2 sıralama
				case 4:			$queryCountNumofGrubs="SELECT COUNT(grupId)  FROM grup WHERE degerlendirmeSinifi=2 and degerlendirmeGrubu=2 ";
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
							break;
				//Fikir aşama 1 grup 1 sıralaması
				case 5:			$queryCountNumofGrubs="SELECT COUNT(grupId)  FROM grup WHERE degerlendirmeSinifi=3 and degerlendirmeGrubu=1 ";
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
							break;
				//Fikir aşama 1 grup 2 sıralaması			
				case 6:			$queryCountNumofGrubs="SELECT COUNT(grupId)  FROM grup WHERE degerlendirmeSinifi=3 and degerlendirmeGrubu=2";
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
							break;
				
				
			}
			
			
		}
		
		else
			echo"Lutfen birisini seçiniz!";
	}
	
?>

	<body>
		<center>
		<h1>İlk Oturum Sıralamalar Sayfası</h1>
		<?php
		if(isset($_SESSION['adminIsmi']))
		{
		?>
			<form action="ilkSiralama.php" method="post">
				
				<b>Lütfen sıralamasını görmek istediğiniz kategoriyi ve grubu seçiniz:<b><br />
				
				<input type="radio" name="hesapla" value="1">İlk Akademik Değerlendirme 1. Grup<br/>
				<input type="radio" name="hesapla" value="2">İlk Akademik Değerlendirme 2. Grup<br/>
				<hr/>
				<input type="radio" name="hesapla" value="3">İlk Sektörel Değerlendirme 1. Grup<br/>
				<input type="radio" name="hesapla" value="4">İlk Sektörel Değerlendirme 2. Grup<br/>
				<hr/>
				<hr/>
				<input type="radio" name="hesapla" value="5">İlk Fikir Değerlendirme 1. Grup<br/>
				<input type="radio" name="hesapla" value="6">İlk Fikir Değerlendirme 2. Grup<br/>
				
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
			<a href="ikinciAsamaAktarim.php">İlk oturumda başarılı olan grupları ikinci oturuma aktarmak için tıklayınız!</a><br />
			<a href="adminAnasayfa.php">Admin Anasayfasına gitmek için Tıklayınız!</a><br />
			</center>
	</body>
</html>