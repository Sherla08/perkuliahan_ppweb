<?php
	include 'class_db.php';
	$db = new database();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ajax</title>
	<script type="text/javascript" src="jquery-3.6.1.js"></script>
</head>
<body>
	<form name="addForm" method="post" action="proses.php">
		<select name="propinsi_id" id="propinsi_id">
			<option selected>Pilih</option>
			<?php
			    $sql = "SELECT * FROM propinsi ORDER BY nama";
			    $data = $db->fetchdata($sql);
			    foreach ($data as $dat) {
			    	echo "<option value='".$dat['id']."'>".$dat['nama']."</option>";
			    }
			?>
		</select>
		<select name="kabupaten_id" id="kabupaten_id"></select>
		<select name="kecamatan_id" id="kecamatan_id"></select>
		<select name="desa_id" id="desa_id"></select>
	</form>
</body>
</html>

<script type="text/javascript">
$(document).ready(function() {
	$('#propinsi_id').change(function(){
		var prop = $('#propinsi_id').val();
		//alert(prop);
		$.ajax({
			type  : "POST",
			url   : "proc.php",
			data  : 'jenis=kab&prop='+prop,
			success : function(res){
				         //alert(res);
				         $('#kabupaten_id').html(res);
			        }
		})
	})

	$('#kabupaten_id').change(function(){
		var prop = $('#kabupaten_id').val();
		$.ajax({
			type  : "POST",
			url   : "proc.php",
			data  : 'jenis=kec&kab='+kab,
			success : function(res){
				         $('#kecamatan_id').html(res);
			        }
		})	
	})

	$('kecamatan_id').change(function(){
		var kec = $('#kecamatan_id').val();
		$ajax({
			type   : "POST",
			url    : "proc.php",
			data   : 'jenis=desa&kec='+kec,
			success : function(res){
				         $('#desa_id').html(
				         	res);
		            }
		})
	})
});
</script>
