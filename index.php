<!DOCTYPE html>
<html>
<head>
	<?php include 'koneksi.php'; ?>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

	<script type="text/javascript" src="bootstrap/jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<title>Data Pemakaian Alat Kontrasepsi</title>
</head>
<body>
<div class="container">  
<h2>Data Pemakaian Alat Kontrasepsi</h2>
	<div class="row">
		<div class="col-sm-12">
			<div class="card-header py-3">
				<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#ModalData">Tambah Data</button>
			</div>
			<h3 ALIGN="center">BADAN KOORDINASI KELUARGA BERENCANA NASIONAL </h3>
			<h3 ALIGN="center">REKAPITULASI PEMAKAI ALAT KONTRASEPSI DI INDONESIA<h3>
			<table  class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<td ALIGN="center" rowspan="2"> No</td>
					<td ALIGN="center" rowspan="2"> Propinsi</td>
					<td ALIGN="center" colspan="3" > Pemakai alat Kontrasepsi</td>
					<td ALIGN="center"> Jumlah</td>
				</tr>
				<tr>
					<td ALIGN="center"> Pil</td>
					<td ALIGN="center"> Kondom</td>
					<td ALIGN="center"> Iud</td>
					<td ALIGN="center"> </td>
				</tr>
			</thead>
			<tbody>
					<?php
					$sql = "
					SELECT
					
					list_propinsi.Nama_Propinsi,
					
					list_pemakai_kontrasepsi.Id_Propinsi AS KEY_IDPROPINSI,
					list_pemakai_kontrasepsi.Id_Kontrasepsi AS KEY_IDKONTRASEPSI,
					
					(
					SELECT SUM(list_pemakai_kontrasepsi.Jumlah_Pemakai)
					FROM
					list_pemakai_kontrasepsi
					INNER JOIN list_propinsi ON list_pemakai_kontrasepsi.Id_Propinsi = list_propinsi.Id_Propinsi
					INNER JOIN list_kontrasepsi ON list_pemakai_kontrasepsi.Id_Kontrasepsi = list_kontrasepsi.Id_Kontrasepsi
					WHERE list_pemakai_kontrasepsi.Id_Propinsi = KEY_IDPROPINSI
					AND list_pemakai_kontrasepsi.Id_Kontrasepsi = 1
					) AS Pil,
					
					(
					SELECT SUM(list_pemakai_kontrasepsi.Jumlah_Pemakai)
					FROM
					list_pemakai_kontrasepsi
					INNER JOIN list_propinsi ON list_pemakai_kontrasepsi.Id_Propinsi = list_propinsi.Id_Propinsi
					INNER JOIN list_kontrasepsi ON list_pemakai_kontrasepsi.Id_Kontrasepsi = list_kontrasepsi.Id_Kontrasepsi
					WHERE list_pemakai_kontrasepsi.Id_Propinsi = KEY_IDPROPINSI
					AND list_pemakai_kontrasepsi.Id_Kontrasepsi = 2
					) AS Kondom,
					
					(
					SELECT SUM(list_pemakai_kontrasepsi.Jumlah_Pemakai)
					FROM
					list_pemakai_kontrasepsi
					INNER JOIN list_propinsi ON list_pemakai_kontrasepsi.Id_Propinsi = list_propinsi.Id_Propinsi
					INNER JOIN list_kontrasepsi ON list_pemakai_kontrasepsi.Id_Kontrasepsi = list_kontrasepsi.Id_Kontrasepsi
					WHERE list_pemakai_kontrasepsi.Id_Propinsi = KEY_IDPROPINSI
					AND list_pemakai_kontrasepsi.Id_Kontrasepsi = 3
					) AS IUD,
					
					(
					SELECT SUM(list_pemakai_kontrasepsi.Jumlah_Pemakai)
					FROM
					list_pemakai_kontrasepsi
					INNER JOIN list_propinsi ON list_pemakai_kontrasepsi.Id_Propinsi = list_propinsi.Id_Propinsi
					INNER JOIN list_kontrasepsi ON list_pemakai_kontrasepsi.Id_Kontrasepsi = list_kontrasepsi.Id_Kontrasepsi
					WHERE list_pemakai_kontrasepsi.Id_Propinsi = KEY_IDPROPINSI
					) AS Jumlah
					
					FROM
					list_pemakai_kontrasepsi
					INNER JOIN list_propinsi ON list_pemakai_kontrasepsi.Id_Propinsi = list_propinsi.Id_Propinsi
					INNER JOIN list_kontrasepsi ON list_pemakai_kontrasepsi.Id_Kontrasepsi = list_kontrasepsi.Id_Kontrasepsi
					GROUP BY list_pemakai_kontrasepsi.Id_Propinsi
					";
					$data=mysqli_query($koneksi,$sql) or die("Error: ".mysqli_error($koneksi));
					$i = 0;
					while($baris=mysqli_fetch_row($data)){ 
						$i++;
						$pil[] 		= $baris[3];
						$kondom[] 	= $baris[4];
						$iud[] 		= $baris[5];
						$total[]	= $baris[6];
					?>
					<tr>
						<td><?php echo $i ?></td>
						<td><?php echo $baris[0]; ?></td>
						<td><?php echo $baris[3]; ?></td>
						<td><?php echo $baris[4]; ?></td>
						<td><?php echo $baris[5]; ?></td>
						<td><?php echo $baris[6]; ?></td>
					</tr>
					<?php }	?>
			</tbody>
			<tfoot>
                  <tr>
                    <td ALIGN="center" colspan="2">Jumlah</td>
                    <td><?php echo array_sum($pil);?></td>
                    <td><?php echo array_sum($kondom); ?></td>
                    <td><?php echo array_sum($iud);?></td>
                    <td><?php echo array_sum($total);?></td>
                  </tr>
            </tfoot>
			</table>
		</div>
		<div class="col-sm-1"></div>
		
	</div>
</div>


<!-- Modal -->
<div id="ModalData" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Input Data :</h4>
      </div>
      <div class="modal-body">
      	 <form method="post" action="aksi.php" class="form-horizontal">
		<div class="form-group form-group-sm">
			<label class="control-label col-md-5">Nama Propinsi :</label>
			<div class=col-md-6>
				<select id="nm_prop" name="nm_prop" class="js-example-basic-single js-states form-control" onChange="trxjenis()">
                  <option value="">Please Select</option>
                  <?php
                    $data_propinsi=mysqli_query($koneksi,"SELECT * FROM list_propinsi");
                    while($data_fix=mysqli_fetch_row($data_propinsi)){
                  ?>
                  <option value="<?php echo $data_fix[0]; ?>"><?php echo $data_fix[1] ; ?></option>
                  <?php
                    }
                  ?>
                </select>
			</div>
		 </div>
           <div class="form-group form-group-sm">
			<label class="control-label col-md-5">Nama Alat Kontrasepsi :</label>
			<div class=col-md-6>
				<select id="nm_kontrasepsi" name="nm_kontrasepsi" class="js-example-basic-single js-states form-control" onChange="trxjenis()">
                  <option value="">Please Select</option>
                  <?php
                    $data_propinsi=mysqli_query($koneksi,"SELECT * FROM list_kontrasepsi");
                    while($data_fix=mysqli_fetch_row($data_propinsi)){
                  ?>
                  <option value="<?php echo $data_fix[0]; ?>"><?php echo $data_fix[1] ; ?></option>
                  <?php
                    }
                  ?>
                </select>
		    </div>
	     </div>
         <div class="form-group form-group-sm">
			<label class="control-label col-md-5">Jumlah :</label>
			<div class=col-md-6>
				<input type="number" name="jumlah" class="form-control" required/>
		    </div>
	     </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-default " data-dismiss="modal"> Tutup</button>
        <button type="submit" class="btn btn-primary" > Tambah</button>
      </div>
      </form>

      </div>
    </div>
</div>
</div>

<div id="ModalAddNilai" class="modal fade" role="dialog">

</div>
<div class="modal fade" id="modalEditNilai">

</div>
<div class="modal fade" id="modalHapusNilai">

</div>

<script type="text/javascript">
	//untuk modul gejala
	$(document).ready(function() { 
	  $(".add_nilai").click(function(e) {
		var m = $(this).attr("id");	//ambil id
			$.ajax({
				url: "nilai/modal_add.php",
				type: "GET",
				data: {modal_id: m},
				success: function (ajaxData){
				$("#ModalAddNilai").html(ajaxData);
				$("#ModalAddNilai").modal('show',{backdrop:'true'});
				}
			});
		});
	  });
	//hapus 
	$(document).ready(function() { 
	  $(".hapus_nilai").click(function(e) {
		var m = $(this).attr("id");	//ambil id
			$.ajax({
				url: "nilai/modal_delete.php",
				type: "GET",
				data: {modal_id: m},
				success: function (ajaxData){
				$("#modalHapusNilai").html(ajaxData);
				$("#modalHapusNilai").modal('show',{backdrop:'true'});
				}
			});
		});
	  });

</script>
</body>
</html>