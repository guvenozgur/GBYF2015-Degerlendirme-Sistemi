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
		if(isset($_SESSION['adminIsmi']))
		{
		?>
			<hr/>
			<h3><u>Akademik Değerlendirme 1. Aşama Grup 1:</u></h3>
			<?php
				$query="SELECT projeIsmi, degerlendirmeId, juriId, grupId FROM ilkakademik WHERE degerlendirmeGrubu=1";
				$res = mysqli_query($conn, $query);
			?>
				<table border="1">
					<tr>
						<th>Proje İsmi</th>
						<th>Değerlendirme Id</th>
						<th>Değerlendiren Juri Id</th>
						<th>Değerlendirilen Grup Id</th>
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
					</tr>
			
			<?php
				}
			?>
			<table/>
		<!--------------------------------->
			
			<hr/>
			<h3><u>Akademik Değerlendirme 1. Aşama Grup 2:</u></h3>
			<?php
				$query="SELECT projeIsmi, degerlendirmeId, juriId, grupId FROM ilkakademik WHERE degerlendirmeGrubu=2";
				$res = mysqli_query($conn, $query);
			?>
				<table border="1">
					<tr>
						<th>Proje İsmi</th>
						<th>Değerlendirme Id</th>
						<th>Değerlendiren Juri Id</th>
						<th>Değerlendirilen Grup Id</th>
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
					</tr>
			
			<?php
				}
			?>
			<table/>
		<!---------------------------------------->
			<hr/>
			<h3><u>Sektörel Değerlendirme 1. Aşama Grup 1:</u></h3>
			<?php
				$query="SELECT projeIsmi, degerlendirmeId, juriId, grupId FROM ilksektorel WHERE degerlendirmeGrubu=1";
				$res = mysqli_query($conn, $query);
			?>
				<table border="1">
					<tr>
						<th>Proje İsmi</th>
						<th>Değerlendirme Id</th>
						<th>Değerlendiren Juri Id</th>
						<th>Değerlendirilen Grup Id</th>
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
					</tr>
			
			<?php
				}
			?>
			<table/>
		<!---------------------------------------->
			<hr/>
			<h3><u>Sektörel Değerlendirme 1. Aşama Grup 2:</u></h3>
			<?php
				$query="SELECT projeIsmi, degerlendirmeId, juriId, grupId FROM ilksektorel WHERE degerlendirmeGrubu=2";
				$res = mysqli_query($conn, $query);
			?>
				<table border="1">
					<tr>
						<th>Proje İsmi</th>
						<th>Değerlendirme Id</th>
						<th>Değerlendiren Juri Id</th>
						<th>Değerlendirilen Grup Id</th>
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
					</tr>
			
			<?php
				}
			?>
			<table/>
		<!---------------------------------------->
			<hr/>
			<h3><u>Fikir Değerlendirme 1. Aşama Grup 1:</u></h3>
			<?php
				$query="SELECT projeIsmi, degerlendirmeId, juriId, grupId FROM ilkfikir WHERE degerlendirmeGrubu=1";
				$res = mysqli_query($conn, $query);
			?>
				<table border="1">
					<tr>
						<th>Proje İsmi</th>
						<th>Değerlendirme Id</th>
						<th>Değerlendiren Juri Id</th>
						<th>Değerlendirilen Grup Id</th>
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
					</tr>
			
			<?php
				}
			?>
				<table/>
			<!---------------------------------------->
			<hr/>
			<h3><u>Fikir Değerlendirme 1. Aşama Grup 2:</u></h3>
			<?php
				$query="SELECT projeIsmi, degerlendirmeId, juriId, grupId FROM ilkfikir WHERE degerlendirmeGrubu=2";
				$res = mysqli_query($conn, $query);
			?>
				<table border="1">
					<tr>
						<th>Proje İsmi</th>
						<th>Değerlendirme Id</th>
						<th>Değerlendiren Juri Id</th>
						<th>Değerlendirilen Grup Id</th>
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
					</tr>
			
			<?php
				}
			?>
				<table/>
			<!---------------------------------------->
			<hr/>
			<h3><u>Akademik Değerlendirme 2. Aşama :</u></h3>
			<?php
				$query="SELECT projeIsmi, degerlendirmeId, juriId, grupId FROM ikinciakademik ";
				$res = mysqli_query($conn, $query);
			?>
				<table border="1">
					<tr>
						<th>Proje İsmi</th>
						<th>Değerlendirme Id</th>
						<th>Değerlendiren Juri Id</th>
						<th>Değerlendirilen Grup Id</th>
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
					</tr>
			
			<?php
				}
			?>
				<table/>
			<!---------------------------------------->
			<hr/>
			<h3><u>Sektörel Değerlendirme 2. Aşama :</u></h3>
			<?php
				$query="SELECT projeIsmi, degerlendirmeId, juriId, grupId FROM ikincisektorel";
				$res = mysqli_query($conn, $query);
			?>
				<table border="1">
					<tr>
						<th>Proje İsmi</th>
						<th>Değerlendirme Id</th>
						<th>Değerlendiren Juri Id</th>
						<th>Değerlendirilen Grup Id</th>
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
					</tr>
			
			<?php
				}
			?>
			<table/>
			<!---------------------------------------->
			<hr/>
			<h3><u>Fikir Değerlendirme 2. Aşama :</u></h3>
			<?php
				$query="SELECT projeIsmi, degerlendirmeId, juriId, grupId FROM ikincifikir";
				$res = mysqli_query($conn, $query);
			?>
				<table border="1">
					<tr>
						<th>Proje İsmi</th>
						<th>Değerlendirme Id</th>
						<th>Değerlendiren Juri Id</th>
						<th>Değerlendirilen Grup Id</th>
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
					</tr>
			
			<?php
				}
			?>
			<table/>
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