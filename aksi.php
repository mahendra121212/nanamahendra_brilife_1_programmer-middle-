<?php
include 'koneksi.php';

$id_propinsi	= $_POST['nm_prop'];
$id_kontrasepsi	= $_POST['nm_kontrasepsi'];
$jumlah			= $_POST['jumlah'];


$sql1	= "INSERT INTO list_pemakai_kontrasepsi (Id_Propinsi, Id_Kontrasepsi, Jumlah_Pemakai) VALUES('$id_propinsi','$id_kontrasepsi',$jumlah)";

if (!empty($id_propinsi)){
mysqli_query($koneksi,$sql1);
	if(mysqli_affected_rows($koneksi)){
		echo '
			<script>
				alert("SUCCESS");
				window.location.href = "index.php";
			</script>
		';
	}else{
		echo "gagal";
	}
}

?>