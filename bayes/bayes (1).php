<html>
<body>
<?php
	$data=array(
		array('cuaca'=>'cerah', 'temperatur'=>'normal', 'angin'=>'pelan', 'olahraga'=>'ya'),
		array('cuaca'=>'cerah', 'temperatur'=>'normal', 'angin'=>'pelan', 'olahraga'=>'ya'),
		array('cuaca'=>'hujan', 'temperatur'=>'tinggi', 'angin'=>'pelan', 'olahraga'=>'tidak'),
		array('cuaca'=>'cerah', 'temperatur'=>'normal', 'angin'=>'kencang', 'olahraga'=>'ya'),
		array('cuaca'=>'hujan', 'temperatur'=>'tinggi', 'angin'=>'kencang', 'olahraga'=>'tidak'),
		array('cuaca'=>'cerah', 'temperatur'=>'normal', 'angin'=>'pelan', 'olahraga'=>'ya'));
?>
<table border="1" style="border-collapse: collapse">
	<tr>
		<th>No.</th>
		<th>Cuaca</th>
		<th>Temperatur</th>
		<th>Kecepatan Angin</th>
		<th>Berolahraga</th>
	</tr>
	<?php
		$n=1;
		foreach ($data as $key) {
	?>
	<tr>
		<td align="center"><?=$n?></td>
		<td align="center"><?=$key['cuaca']?></td>
		<td align="center"><?=$key['temperatur']?></td>
		<td align="center"><?=$key['angin']?></td>
		<td align="center"><?=$key['olahraga']?></td>
	</tr>
	<?php
		$n++;
		}
	?>
</table>

<form action="<?php $_PHP_SELF ?>" method="POST">
<table>
	<tr>
		<td>Cuaca</td>
		<td>:</td>
		<td><input type="text" name="cuaca" /></td>
	</tr>
	<tr>
		<td>Temperatur</td>
		<td>:</td>
		<td><input type="text" name="temperatur" /></td>
	</tr>
	<tr>
		<td>Kecepatan Angin</td>
		<td>:</td>
		<td><input type="text" name="angin" /></td>
	</tr>
	<tr>
		<td colspan="2"></td>
		<td><input type="submit" /></td>
	</tr>
</table>
</form>
<?php
	$input=array(NULL,NULL,NULL);

	if(isset($_POST["cuaca"])){
		$input[0]=$_POST["cuaca"];
	}
	if(isset($_POST["temperatur"])){
		$input[1]=$_POST["temperatur"];
	}
	if(isset($_POST["angin"])){
		$input[2]=$_POST["angin"];
	}

	$count_ya=0;
	$count_tdk=0;
	for ($i=0; $i < 6; $i++) { 
		if($data[$i]['olahraga']=='ya'){
			$count_ya++;
		}else{
			$count_tdk++;
		}
	}
	$p_ya=$count_ya/($n-1);
	$p_tdk=$count_tdk/($n-1);
	
	$count_cuaca_ya=0;
	$count_temp_ya=0;
	$count_angin_ya=0;
	for ($i=0; $i < 3; $i++) { 
		if($input[$i]!=NULL){
			if($i==0){
				for ($j=0; $j < 6; $j++) { 
					if($data[$j]['cuaca']==$input[$i] && $data[$j]['olahraga']=='ya'){
						$count_cuaca_ya++;
					}
				}
			}elseif($i==1){
				for ($j=0; $j < 6; $j++) { 
					if($data[$j]['temperatur']==$input[$i] && $data[$j]['olahraga']=='ya'){
						$count_temp_ya++;
					}
				}
			}elseif($i==2){
				for ($j=0; $j < 6; $j++) { 
					if($data[$j]['angin']==$input[$i] && $data[$j]['olahraga']=='ya'){
						$count_angin_ya++;
					}
				}
			}
		}
	}

	$p_cuaca_ya=1;
	$p_temp_ya=1;
	$p_angin_ya=1;
	for ($i=0; $i < 3; $i++) {
		if($input[$i]!=NULL){
			if($i==0){
				$p_cuaca_ya=$count_cuaca_ya/$count_ya;
			}elseif($i==1){
				$p_temp_ya=$count_temp_ya/$count_ya;
			}elseif($i==2){
				$p_angin_ya=$count_angin_ya/$count_ya;
			}
		}
	}

	$hasil_p_ya=$p_cuaca_ya*$p_temp_ya*$p_angin_ya*$p_ya;

	$count_cuaca=0;
	$count_temp=0;
	$count_angin=0;
	for ($i=0; $i < 3; $i++) { 
		if($input[$i]!=NULL){
			if($i==0){
				for ($j=0; $j < 6; $j++) { 
					if($data[$j]['cuaca']==$input[$i] && $data[$j]['olahraga']=='tidak'){
						$count_cuaca++;
					}
				}
			}elseif($i==1){
				for ($j=0; $j < 6; $j++) { 
					if($data[$j]['temperatur']==$input[$i] && $data[$j]['olahraga']=='tidak'){
						$count_temp++;
					}
				}
			}elseif($i==2){
				for ($j=0; $j < 6; $j++) { 
					if($data[$j]['angin']==$input[$i] && $data[$j]['olahraga']=='tidak'){
						$count_angin++;
					}
				}
			}
		}
	}

	$p_cuaca=1;
	$p_temp=1;
	$p_angin=1;
	for ($i=0; $i < 3; $i++) {
		if($input[$i]!=NULL){
			if($i==0){
				$p_cuaca=$count_cuaca/$count_tdk;
			}elseif($i==1){
				$p_temp=$count_temp/$count_tdk;
			}elseif($i==2){
				$p_angin=$count_angin/$count_tdk;
			}
		}
	}

	$hasil_p_tdk=$p_cuaca*$p_temp*$p_angin*$p_tdk;

	if($hasil_p_ya!=$p_ya && $hasil_p_tdk!=$p_tdk){
		if($hasil_p_ya>$hasil_p_tdk){
			echo "Berolahraga : ya<br>";
		}else{
			echo "Berolahraga : tidak<br>";
		}
	}

	// ```````echo $hasil_p_ya."<br>".$hasil_p_tdk;

?>

</body>
</html>