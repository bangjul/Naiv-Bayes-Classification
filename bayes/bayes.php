<?php
	$data=array(
				array('cuaca'=>'cerah','temperatur'=>'normal','angin'=>'pelan','hasil'=>'ya'),
				array('cuaca'=>'cerah','temperatur'=>'normal','angin'=>'pelan','hasil'=>'ya'),
				array('cuaca'=>'hujan','temperatur'=>'tinggi','angin'=>'pelan','hasil'=>'tidak'),
				array('cuaca'=>'cerah','temperatur'=>'normal','angin'=>'kencang','hasil'=>'ya'),
				array('cuaca'=>'hujan','temperatur'=>'tinggi','angin'=>'kencang','hasil'=>'tidak'),
				array('cuaca'=>'cerah','temperatur'=>'normal','angin'=>'pelan','hasil'=>'ya'),
			);
	$cuacaYa=1;$temperaturYa=1;$anginYa=1;
	$cuacaTidak=1;$temperaturTidak=1;$anginTidak=1;

	if (isset($_POST['submit'])) {
		$cuaca=0;
		$temperatur=0;
		$angin=0;

		$cuacaNo=0;
		$temperaturNo=0;
		$anginNo=0;
		$ya=0;
		$tidak=0;
		foreach ($data as $key) {
			if($key['hasil']=='ya'){
				// $cuaca++;
				$ya++;
			}
			if($key['hasil']=='tidak'){
				// $cuaca++;
				$tidak++;
			}
			if($_POST['cuaca']!=""){
				if ($key['cuaca']==$_POST['cuaca'] && $key['hasil']=='ya') {
					$cuaca++;
				}
				if ($key['cuaca']==$_POST['cuaca'] && $key['hasil']=='tidak') {
					$cuacaNo++;
				}
			}
			if($_POST['temperatur']!=""){
				if ($key['temperatur']==$_POST['temperatur'] && $key['hasil']=='ya') {
					$temperatur++;
				}
				if ($key['temperatur']==$_POST['temperatur'] && $key['hasil']=='tidak') {
					$temperaturNo++;
				}
			}
			if($_POST['angin']!=""){
				if ($key['angin']==$_POST['angin'] && $key['hasil']=='ya') {
					$angin++;
				}
				if ($key['angin']==$_POST['angin'] && $key['hasil']=='tidak') {
					$anginNo++;
				}
			}
		}
		
		if ($_POST['cuaca']=="" && $_POST['temperatur']=="" && $_POST['angin']=="") {
			$cuacaYa=0;$temperaturYa=0;$anginYa=0;
			$cuacaTidak=0;$temperaturTidak=0;$anginTidak=0;

		}else{
			if($_POST['cuaca']!=""){
				$cuacaYa=($cuaca/count($data))/($ya/count($data));
				$cuacaTidak=($cuacaNo/count($data))/($tidak/count($data));
			}
			if($_POST['temperatur']!=""){
				$temperaturYa=($temperatur/count($data))/($ya/count($data));
				$temperaturTidak=($temperaturNo/count($data))/($tidak/count($data));
			}
			if($_POST['angin']!=""){
				$anginYa=($angin/count($data))/($ya/count($data));
				$anginTidak=($anginTidak/count($data))/($tidak/count($data));
			}
			$hasilYa=($cuacaYa*$temperaturYa*$anginYa)*$ya/count($data);
			$hasilTidak=($cuacaTidak*$temperaturTidak*$anginTidak)*$tidak/count($data);
			echo "ya=".$hasilYa."<br>tidak=".$hasilTidak;
			if ($hasilYa > $hasilTidak) {
				$result = "Ya";
			}else{
				$result="Tidak";
			}
		}
		// echo $cuacaTidak.' '.$temperaturTidak.' '.$anginTidak.' '.$tidak.'<br>';
		// echo $result;
	}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body style="overflow-x: hidden;">
<!-- Data Buah -->
	<div class="row">
		
		<div class="container">
			<table class="table table-hover">
				<thead>
					<tr style="background: #50bb81;">
						<th style="text-align: center;">Cuaca</th>
						<th style="text-align: center;">Temperatur</th>
						<th style="text-align: center;">Kecepatan Angin</th>
						<th style="text-align: center;">Hasil</th>
					</tr>
				</thead>

				<tbody>
					<?php foreach($data as $data){?>
						<tr>
							<td style="text-align: center;"><?=strtoupper($data['cuaca'])?></td>
							<td style="text-align: center;"><?=strtoupper($data['temperatur'])?></td>
							<td style="text-align: center;"><?=strtoupper($data['angin'])?></td>
							<td style="text-align: center;"><?=strtoupper($data['hasil'])?></td>
						</tr>
					<?php }?>
				</tbody>
			</table>

			<div class="form-group col-md-5 col-md-offset-3">
				<form action="" method="post">
					<table class="table">
						<tr>
							<div class="input-group">
		    					<span class="input-group-addon">Cuaca</span>
		   						 <input id="msg" type="text" class="form-control" name="cuaca" placeholder="cerah / hujan">
		  					</div>
						</tr>
						<tr>
							<div class="input-group">
		    					<span class="input-group-addon">temperatur</span>
		   						 <input id="msg" type="text" class="form-control" name="temperatur" placeholder="normal / tinggi">
		  					</div>
						</tr>
						<tr>
							<div class="input-group">
		    					<span class="input-group-addon">Kecepatan Angin</span>
		   						 <input id="msg" type="text" class="form-control" name="angin" placeholder="pelan / kencang">
		  					</div>
						</tr>
						
						<?php if (isset($result)) {?>
						<tr>
							<td>Hasil</td>
							<td> : </td>
							<td>
								<input class="form-control" type="text" name="result" value="<?= $result?>" disabled="disabled"/>
							</td>
						</tr>
						<?php }?>
						<tr>
							<td colspan="3" align="center">
								<input type="submit" name="submit" class="btn btn-success"/>
							</td>
						</tr>
					</table>
				</form>
		    </div>
		</div>
	</div>
</body>
</html>
<script src="jquery.min.js"></script>
