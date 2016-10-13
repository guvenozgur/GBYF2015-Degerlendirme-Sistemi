<?php
	include("db.php");

?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Değerlendirmeler</title>
	</head>
	<body>
		<center>
		<h1>Yapılan Bütün Değerlendirmeler:</h1>
		<?php
		if(isset($_SESSION['juriIsmi']))
		{
			$yetkiliJuriId=$_SESSION['juriId'];
			$yetkiliJuriGrubu=$_SESSION['degerlendirmeGrubu'];
			$yetkiliJuriSinifi=$_SESSION['degerlendirmeSinifi'];
			
			if($yetkiliJuriSinifi==1 && $yetkiliJuriGrubu==1)
			{
		?>
				<hr/>
				<h3><u>Akademik Değerlendirme 1. Aşama Grup 1:</u></h3>
				<?php
					$query="SELECT projeIsmi, degerlendirmeId, juriId, grupId, ozgunluk, dogruluk, potansiyel, sistematik, problem, literaturTarama, sunum FROM ilkakademik WHERE degerlendirmeGrubu=1 and juriId=$yetkiliJuriId";
					$res = mysqli_query($conn, $query);
				?>
					<table border="1">
						<tr>
							<th>Proje İsmi</th>
							<th>Değerlendirme Id</th>
							<th>Değerlendiren Juri Id</th>
							<th>Değerlendirilen Grup Id</th>
							<th>Özgünlük</th>
							<th>Doğruluk</th>
							<th>Potansiyel</th>
							<th>Sistematik</th>
							<th>Problem</th>
							<th>Literatür Tarama</th>
							<th>Sunum</th>
						</tr>
				<?php
					while($row = mysqli_fetch_row($res))
					{
				?>		
						<tr>
							<td><?php echo $row[0];?></td>
							<td><?php echo $row[1];?></td>
							<td><?php echo $row[2];?></td>
							<td><?php echo $row[3];?></td>
							<td><?php echo $row[4];?></td>
							<td><?php echo $row[5];?></td>
							<td><?php echo $row[6];?></td>
							<td><?php echo $row[7];?></td>
							<td><?php echo $row[8];?></td>
							<td><?php echo $row[9];?></td>
							<td><?php echo $row[10];?></td>
						</tr>
				
				<?php
					}
				?>
				<table/>
		<!--------------------------------->
			
				<hr/>
			<?php
			}
			else if($yetkiliJuriSinifi==1 && $yetkiliJuriGrubu==2)
			{
			?>
			
				<h3><u>Akademik Değerlendirme 1. Aşama Grup 2:</u></h3>
				<?php
					$query="SELECT projeIsmi, degerlendirmeId, juriId, grupId, ozgunluk, dogruluk, potansiyel, sistematik, problem, literaturTarama, sunum FROM ilkakademik WHERE degerlendirmeGrubu=2 and juriId=$yetkiliJuriId";
					$res = mysqli_query($conn, $query);
				?>
					<table border="1">
						<tr>
							<th>Proje İsmi</th>
							<th>Değerlendirme Id</th>
							<th>Değerlendiren Juri Id</th>
							<th>Değerlendirilen Grup Id</th>
							<th>Özgünlük</th>
							<th>Doğruluk</th>
							<th>Potansiyel</th>
							<th>Sistematik</th>
							<th>Problem</th>
							<th>Literatür Tarama</th>
							<th>Sunum</th>
						</tr>
				<?php
					while($row = mysqli_fetch_row($res))
					{
				?>		
						<tr>
							<td><?php echo $row[0];?></td>
							<td><?php echo $row[1];?></td>
							<td><?php echo $row[2];?></td>
							<td><?php echo $row[3];?></td>
							<td><?php echo $row[4];?></td>
							<td><?php echo $row[5];?></td>
							<td><?php echo $row[6];?></td>
							<td><?php echo $row[7];?></td>
							<td><?php echo $row[8];?></td>
							<td><?php echo $row[9];?></td>
							<td><?php echo $row[10];?></td>
						</tr>
				
				<?php
					}
				?>
				<table/>
			<!---------------------------------------->
				<hr/>
			<?php
			}
			else if($yetkiliJuriSinifi==2 && $yetkiliJuriGrubu==1)
			{
				?>
				<h3><u>Sektörel Değerlendirme 1. Aşama Grup 1:</u></h3>
				<?php
					$query="SELECT projeIsmi, degerlendirmeId, juriId, grupId, yenilikcilik, surdurulebilirlik, cevreyeFayda, tasarim, gerceklesme, demo FROM ilksektorel WHERE degerlendirmeGrubu=1 and juriId=$yetkiliJuriId";
					$res = mysqli_query($conn, $query);
				?>
					<table border="1">
						<tr>
							<th>Proje İsmi</th>
							<th>Değerlendirme Id</th>
							<th>Değerlendiren Juri Id</th>
							<th>Değerlendirilen Grup Id</th>
							<th>Yenilikçilik</th>
							<th>Sürdürülebilirlik</th>
							<th>Çevreye Fayda</th>
							<th>Tarsarım</th>
							<th>Gerçekleşme</th>
							<th>Demo</th>
						</tr>
				<?php
					while($row = mysqli_fetch_row($res))
					{
				?>		
						<tr>
							<td><?php echo $row[0];?></td>
							<td><?php echo $row[1];?></td>
							<td><?php echo $row[2];?></td>
							<td><?php echo $row[3];?></td>
							<td><?php echo $row[4];?></td>
							<td><?php echo $row[5];?></td>
							<td><?php echo $row[6];?></td>
							<td><?php echo $row[7];?></td>
							<td><?php echo $row[8];?></td>
							<td><?php echo $row[9];?></td>
						</tr>
				
				<?php
					}
				?>
				<table/>
			<!---------------------------------------->
				<hr/>
			<?php
			}
			else if($yetkiliJuriSinifi==2 && $yetkiliJuriGrubu==2)
			{
				?>
				<h3><u>Sektörel Değerlendirme 1. Aşama Grup 2:</u></h3>
				<?php
					$query="SELECT projeIsmi, degerlendirmeId, juriId, grupId, yenilikcilik, surdurulebilirlik, cevreyeFayda, tasarim, gerceklesme, demo FROM ilksektorel WHERE degerlendirmeGrubu=2 and juriId=$yetkiliJuriId";
					$res = mysqli_query($conn, $query);
				?>
					<table border="1">
						<tr>
							<th>Proje İsmi</th>
							<th>Değerlendirme Id</th>
							<th>Değerlendiren Juri Id</th>
							<th>Değerlendirilen Grup Id</th>
							<th>Yenilikçilik</th>
							<th>Sürdürülebilirlik</th>
							<th>Çevreye Fayda</th>
							<th>Tarsarım</th>
							<th>Gerçekleşme</th>
							<th>Demo</th>
						</tr>
				<?php
					while($row = mysqli_fetch_row($res))
					{
				?>		
						<tr>
							<td><?php echo $row[0];?></td>
							<td><?php echo $row[1];?></td>
							<td><?php echo $row[2];?></td>
							<td><?php echo $row[3];?></td>
							<td><?php echo $row[4];?></td>
							<td><?php echo $row[5];?></td>
							<td><?php echo $row[6];?></td>
							<td><?php echo $row[7];?></td>
							<td><?php echo $row[8];?></td>
							<td><?php echo $row[9];?></td>
						</tr>
				
				<?php
					}
				?>
				<table/>
			<!---------------------------------------->
				<hr/>
			<?php
			}
			else if($yetkiliJuriSinifi==3 && $yetkiliJuriGrubu==1)
			{
			?>
				<h3><u>Fikir Değerlendirme :</u></h3>
				<?php
					$query="SELECT projeIsmi, degerlendirmeId, juriId, grupId, degerlendirme1, degerlendirme2, degerlendirme3, degerlendirme4, degerlendirme5 FROM ilkfikir WHERE degerlendirmeGrubu=1 and juriId=$yetkiliJuriId";
					$res = mysqli_query($conn, $query);
				?>
					<table border="1">
						<tr>
							<th>Proje İsmi</th>
							<th>Değerlendirme Id</th>
							<th>Değerlendiren Juri Id</th>
							<th>Değerlendirilen Grup Id</th>
							<th>Yenilikçilik</th>
							<th>Sürdürülebilirlik</th>
							<th>Çevreye fayda</th>
							<th>Yöntem netliği</th>
							<th>Sunum becerisi</th>
						</tr>
				<?php
					while($row = mysqli_fetch_row($res))
					{
				?>		
						<tr>
							<td><?php echo $row[0];?></td>
							<td><?php echo $row[1];?></td>
							<td><?php echo $row[2];?></td>
							<td><?php echo $row[3];?></td>
							<td><?php echo $row[4];?></td>
							<td><?php echo $row[5];?></td>
							<td><?php echo $row[6];?></td>
							<td><?php echo $row[7];?></td>
							<td><?php echo $row[8];?></td>
						</tr>
				
				<?php
					}
				?>
					<table/>
				<!---------------------------------------->
				<hr/>
			<?php
			}
			/*
			else if($yetkiliJuriSinifi==3 && $yetkiliJuriGrubu==2)
			{
				?>
				<h3><u>Fikir Değerlendirme 1. Aşama Grup 2:</u></h3>
				<?php
					$query="SELECT projeIsmi, degerlendirmeId, juriId, grupId, degerlendirme1, degerlendirme2, degerlendirme3, degerlendirme4, degerlendirme5, degerlendirme6 FROM ilkfikir WHERE degerlendirmeGrubu=2 and juriId=$yetkiliJuriId";
					$res = mysqli_query($conn, $query);
				?>
					<table border="1">
						<tr>
							<th>Proje İsmi</th>
							<th>Değerlendirme Id</th>
							<th>Değerlendiren Juri Id</th>
							<th>Değerlendirilen Grup Id</th>
							<th>Değerlendirme 1</th>
							<th>Değerlendirme 2</th>
							<th>Değerlendirme 3</th>
							<th>Değerlendirme 4</th>
							<th>Değerlendirme 5</th>
							<th>Değerlendirme 6</th>
						</tr>
				<?php
					while($row = mysqli_fetch_row($res))
					{
				?>		
						<tr>
							<td><?php echo $row[0];?></td>
							<td><?php echo $row[1];?></td>
							<td><?php echo $row[2];?></td>
							<td><?php echo $row[3];?></td>
							<td><?php echo $row[4];?></td>
							<td><?php echo $row[5];?></td>
							<td><?php echo $row[6];?></td>
							<td><?php echo $row[7];?></td>
							<td><?php echo $row[8];?></td>
							<td><?php echo $row[9];?></td>
						</tr>
				
				<?php
					}
				?>
					<table/>
				<!---------------------------------------->
				<hr/>
			<?php
			}
			*/
			if($yetkiliJuriSinifi==1)
			{
			?>
				<h3><u>Akademik Değerlendirme 2. Aşama :</u></h3>
				<?php
					$query="SELECT projeIsmi, degerlendirmeId, juriId, grupId, ozgunluk, dogruluk, potansiyel, sistematik, problem, literaturTarama, sunum FROM ikinciakademik WHERE juriId=$yetkiliJuriId";
					$res = mysqli_query($conn, $query);
				?>
					<table border="1">
						<tr>
							<th>Proje İsmi</th>
							<th>Değerlendirme Id</th>
							<th>Değerlendiren Juri Id</th>
							<th>Değerlendirilen Grup Id</th>
							<th>Özgünlük</th>
							<th>Doğruluk</th>
							<th>Potansiyel</th>
							<th>Sistematik</th>
							<th>Problem</th>
							<th>Literatür Tarama</th>
							<th>Sunum</th>
						</tr>
				<?php
					while($row = mysqli_fetch_row($res))
					{
				?>		
						<tr>
							<td><?php echo $row[0];?></td>
							<td><?php echo $row[1];?></td>
							<td><?php echo $row[2];?></td>
							<td><?php echo $row[3];?></td>
							<td><?php echo $row[4];?></td>
							<td><?php echo $row[5];?></td>
							<td><?php echo $row[6];?></td>
							<td><?php echo $row[7];?></td>
							<td><?php echo $row[8];?></td>
							<td><?php echo $row[9];?></td>
							<td><?php echo $row[10];?></td>
						</tr>
				
				<?php
					}
				?>
					<table/>
				<!---------------------------------------->
				<hr/>
			<?php
			}
			else if($yetkiliJuriSinifi==2)
			{
				?>
				<h3><u>Sektörel Değerlendirme 2. Aşama :</u></h3>
				<?php
					$query="SELECT projeIsmi, degerlendirmeId, juriId, grupId, yenilikcilik, surdurulebilirlik, cevreyeFayda, tasarim, gerceklesme, demo FROM ikincisektorel WHERE juriId=$yetkiliJuriId";
					$res = mysqli_query($conn, $query);
				?>
					<table border="1">
						<tr>
							<th>Proje İsmi</th>
							<th>Değerlendirme Id</th>
							<th>Değerlendiren Juri Id</th>
							<th>Değerlendirilen Grup Id</th>
							<th>Yenilikçilik</th>
							<th>Sürdürülebilirlik</th>
							<th>Çevreye Fayda</th>
							<th>Tarsarım</th>
							<th>Gerçekleşme</th>
							<th>Demo</th>
						</tr>
				<?php
					while($row = mysqli_fetch_row($res))
					{
				?>		
						<tr>
							<td><?php echo $row[0];?></td>
							<td><?php echo $row[1];?></td>
							<td><?php echo $row[2];?></td>
							<td><?php echo $row[3];?></td>
							<td><?php echo $row[4];?></td>
							<td><?php echo $row[5];?></td>
							<td><?php echo $row[6];?></td>
							<td><?php echo $row[7];?></td>
							<td><?php echo $row[8];?></td>
							<td><?php echo $row[9];?></td>
						</tr>
				
				<?php
					}
				?>
				<table/>
				<!---------------------------------------->
				<hr/>
			<?php
			}
			/*
			else if($yetkiliJuriSinifi==3)
			{
				?>
				<h3><u>Fikir Değerlendirme 2. Aşama :</u></h3>
				<?php
					$query="SELECT projeIsmi, degerlendirmeId, juriId, grupId, degerlendirme1, degerlendirme2, degerlendirme3, degerlendirme4, degerlendirme5, degerlendirme6 FROM ikincifikir WHERE juriId=$yetkiliJuriId";
					$res = mysqli_query($conn, $query);
				?>
					<table border="1">
						<tr>
							<th>Proje İsmi</th>
							<th>Değerlendirme Id</th>
							<th>Değerlendiren Juri Id</th>
							<th>Değerlendirilen Grup Id</th>
							<th>Değerlendirme 1</th>
							<th>Değerlendirme 2</th>
							<th>Değerlendirme 3</th>
							<th>Değerlendirme 4</th>
							<th>Değerlendirme 5</th>
							<th>Değerlendirme 6</th>
						</tr>
				<?php
					while($row = mysqli_fetch_row($res))
					{
				?>		
						<tr>
							<td><?php echo $row[0];?></td>
							<td><?php echo $row[1];?></td>
							<td><?php echo $row[2];?></td>
							<td><?php echo $row[3];?></td>
							<td><?php echo $row[4];?></td>
							<td><?php echo $row[5];?></td>
							<td><?php echo $row[6];?></td>
							<td><?php echo $row[7];?></td>
							<td><?php echo $row[8];?></td>
							<td><?php echo $row[9];?></td>
						</tr>
				
				
				<?php
					}
				?>
				<table/>
			<?php
			}*/
			}
			else
			{
				echo"Jüri ekleyebilmek için sisteme admin olarak giriş yapmanız gerekmektedir!";
			}
		?>
		
			<hr/>
			<a href="juriAnasayfa.php">Juri Anasayfasına gitmek için Tıklayınız!</a><br />
			</center>
	</body>
</html>