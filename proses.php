<?php
	$txt_file    = file_get_contents('data.txt');
	$rows        = explode("\n", $txt_file); // Memisahkan Item Data dariPemisah enter
	$hipotesa_pisang = array('x','x');
	$data_baru_pisang = 0;
	$hipotesa_apel = array('x','x');
	$data_baru_apel = 0;
	//Proses Mencari Hipotesa
	echo "<h2>HASIL HIPOTESA</h2>";
	foreach($rows as $row => $data)
	{
		$row_data = explode('|', $data);// Memisahkan Item Data dariPemisah |
		$target = $row_data[2];
		if($target=='PISANG'){	
			echo "Hipotesa pisang => ";
			for($i=0;$i<2;$i++){
				if($data_baru_pisang==0){
					$hipotesa_pisang[$i] = $row_data[$i];
				}else{
					if($hipotesa_pisang[$i]==$row_data[$i])
						$hipotesa_pisang[$i] = $row_data[$i];
					else
						$hipotesa_pisang[$i] = '?';
				}
				echo $hipotesa_pisang[$i].", ";
			}
			$data_baru_pisang++;
			echo "<br>";
		}else{
			echo "Hipotesa apel => ";
			for($i=0;$i<2;$i++){
				if($data_baru_apel==0){
					$hipotesa_apel[$i] = $row_data[$i];
				}else{
					if($hipotesa_apel[$i]==$row_data[$i])
						$hipotesa_apel[$i] = $row_data[$i];
					else
						$hipotesa_apel[$i] = '?';
				}
				echo $hipotesa_apel[$i].", ";
			}
			$data_baru_apel++;
			echo "<br>";
		}
	}
	//end proses hipotesa
	
	if(isset($_POST['submit'])){
		$masalah[0]	= $_POST['att1'];
		$masalah[1] = $_POST['att2'];
		echo "<hr>";
	
		//proses singkronisasi data
		$beda_pisang = 0;
		$beda_apel = 0;
		echo "<h2>HASIL AKHIR</h2>";
		for($i=0;$i<2;$i++){
			if($masalah[$i]!=$hipotesa_pisang[$i])
				$beda_pisang++;
			if($masalah[$i]!=$hipotesa_apel[$i])
				$beda_apel++;
		}
		if($beda_pisang<=1)
			echo "Buah Tersebut Adalah Pisang <br>Buah Tersebut Bukan Apel";
		else if($beda_pisang>1 && $beda_apel>0)
			echo "Buah Tersebut Bukan Pisang <br>Buah Tersebut Bukan Apel";
		else 
			echo "Buah Tersebut Bukan Pisang <br>Buah Tersebut Adalah Apel";
	}
?>
<html>
<body>
<h2>DATA LEARNING</h2>
<form action="proses.php" method="post">
Masukkan Attribute :
	<table>
		<tr>
			<td>Attribute 1</td>
			<td>:</td>
			<td><input type="textfield" name="att1"/></td>
		</tr>
		<tr>
			<td>Attribute 2</td>
			<td>:</td>
			<td><input type="textfield" name="att2"/></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><input type="submit" name="submit"/></td>
		</tr>
	</table>
</form>
<p><a href="index.php">Kembali Ke Halaman Utama</a></p>
</body>
</html>