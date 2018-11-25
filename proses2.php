<?php
	$txt_file    = file_get_contents('data2.txt');
	$rows        = explode("\n", $txt_file); // Memisahkan Item Data dariPemisah enter
	$hipotesa_tidak = array('x','x');
	$data_baru_tidak = 0;
	$hipotesa_ya = array('x','x');
	$data_baru_ya = 0;
	//Proses Mencari Hipotesa
	echo "<h2>HASIL HIPOTESA</h2>";
	foreach($rows as $row => $data)
	{
		$row_data = explode('|', $data);// Memisahkan Item Data dariPemisah |
		$target = $row_data[2];
		if($target=='TIDAK'){	
			echo "Hipotesa TIDAK => ";
			for($i=0;$i<2;$i++){
				if($data_baru_tidak==0){
					$hipotesa_tidak[$i] = $row_data[$i];
				}else{
					if($hipotesa_tidak[$i]==$row_data[$i])
						$hipotesa_tidak[$i] = $row_data[$i];
					else
						$hipotesa_tidak[$i] = '?';
				}
				echo $hipotesa_tidak[$i].", ";
			}
			$data_baru_tidak++;
			echo "<br>";
		}else{
			echo "Hipotesa YA => ";
			for($i=0;$i<2;$i++){
				if($data_baru_ya==0){
					$hipotesa_ya[$i] = $row_data[$i];
				}else{
					if($hipotesa_ya[$i]==$row_data[$i])
						$hipotesa_ya[$i] = $row_data[$i];
					else
						$hipotesa_ya[$i] = '?';
				}
				echo $hipotesa_ya[$i].", ";
			}
			$data_baru_ya++;
			echo "<br>";
		}
	}
	//end proses hipotesa
	
	if(isset($_POST['submit'])){
		$masalah[0]	= $_POST['att1'];
		$masalah[1] = $_POST['att2'];
		echo "<hr>";
		//proses singkronisasi data
		$beda_tidak = 0;
		$beda_ya = 0;
		echo "<h2>HASIL AKHIR</h2>";
		for($i=0;$i<2;$i++){
			if($masalah[$i]!=$hipotesa_tidak[$i])
				$beda_tidak++;
			if($masalah[$i]!=$hipotesa_ya[$i])
				$beda_ya++;
		}
		if($beda_tidak==2)
			echo "Tidak Bukan Ya <br>";
		if($beda_ya==1)
			echo "Ya Bukan Tidak <br>";
	}
	
?>
<html>
<body>
<h2>DATA LEARNING</h2>
<form action="proses2.php" method="post">
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