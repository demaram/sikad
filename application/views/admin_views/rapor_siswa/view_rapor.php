<?php
$this->load->view('admin_views/_template/head');
 ?>
<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- SIDEBAR -->
          <?php
               $this->load->view('admin_views/_template/sidebar');
           ?>
		<!-- END SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- NAVBAR -->
               <?php
                    $this->load->view('admin_views/_template/navbar');
                ?>
			<!-- END NAVBAR -->
               <?php
                    $data_kelas = $this->db->query("SELECT * FROM kelas");
                    $smt = $this->db->query("SELECT * FROM master_data_semester where status_active ='1'");
                    $smt = $smt->row();

                    $id_siswa = $this->input->post('id_siswa');
                ?>

			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
                         <?php

                         $pesan = sha1('pesan');
                         $pesan=$_GET[$pesan];
               			switch ($pesan) {
 //                  alert tambah
               				case 'add_sukses':
               				?>
                                   <div class="alert alert-success">
                                               <button type="button" class="close" data-dismiss="alert">×</button>
                                               <strong>Success!</strong> Berhasil Tambah Data
                                           </div>
               				<?php
               				break;
               				case 'add_gagal':
               				?>
                                  <div class="alert alert-danger">
                                               <button type="button" class="close" data-dismiss="alert">×</button>
                                               <strong>Failed!</strong>Gagal Tambah Data
                                           </div>
               				<?php
               				break;
//                  alert edit
                                   case 'edit_sukses':
                                   ?>
                                   <div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <strong>Success!</strong>Sukses Edit Data
                                            </div>
                                   <?php
                                   break;

                                   case 'edit_gagal':
                                   ?>
                                   <div class="alert alert-danger">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <strong>Failed!</strong>Gagal Edit Data
                                           </div>
                                   <?php
                                   break;
//                  alert hapus
                                   case 'hapus_sukses':
                                   ?>
                                   <div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <strong>Success!</strong>Sukses Hapus Data
                                            </div>
                                   <?php
                                   break;

                                   case 'hapus_gagal':
                                   ?>
                                   <div class="alert alert-danger">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <strong>Failed!</strong>Gagal Hapus Data
                                           </div>
                                   <?php
                                   break;
               			}
                              ?>

					<!-- OVERVIEW -->
					<div class="panel panel-headline">
                              <div class="panel">
                                   <div class="panel-heading">
                                       <h3 class="panel-title"><?=$judul?></h3>
                                       <div class="right">


                                             <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                                       </div>
                                   </div>

                                   <div class="panel-body no-padding">
                                      <form class="form-horizontal" action="" role="form" method="post" enctype="multipart/form-data" id="form_cari">

                              <script type="text/javascript">
                                   $(document).ready(function(){
                                        $("#id_kelas").change(function(){
                                             var id_kelas = $("#id_kelas").val();
                                             $.ajax({
                                                  type : "POST",
                                                  url : "<?=base_url();?>admin/rapor_siswa/ajax_siswa",
                                                  data : "id_kelas=" + id_kelas,
                                                  success : function(data){
                                                       $("#id_siswa").html(data);
                                                  }
                                             });
                                        });
                                   });
                              </script>

                                                <div class="form-group">
                                                 <label class="col-lg-2 control-label" for="required">Pilih Kelas</label>
                                                      <div class="col-lg-4">
                                                           <select name="id_kelas" class="form-control" id="id_kelas">
                                                                <option value="0">-- Pilih Kelas --</option>
                                                                  <?php
                                                                         if (!empty($this->input->post('id_kelas'))) {
                                                                             $id_kelas = $this->input->post('id_kelas');
                                                                        }else {
                                                                             $id_kelas = $this->input->get('id_kelas');
                                                                        }

                                                                         $qkel = $this->db->query("SELECT * FROM kelas WHERE 1=1");
                                                                         foreach ($qkel->result()as $rkel) { ?>
                                                                              <option <?php if ($id_kelas == $rkel->id_kelas): ?>
                                                                                   selected="selected"
                                                                              <?php endif; ?> value="<?=$rkel->id_kelas?>"> <?=$rkel->nama_kelas?> </option>
                                                                         <?php }
                                                                  ?>
                                                           </select>
                                                 </div><div class="fix"></div>
                                              </div>

                                              <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">Nama Siswa</label>
                                                    <div class="col-lg-4">
                                                         <select name="id_siswa" class="form-control" id="id_siswa" required="true">
                                                              <?php if (!empty($id_kelas) && !empty($id_siswa)) {
                                                                        $query = $this->db->query("SELECT * FROM tbl_pd_siswa where id_kelas='$id_kelas' AND id_smt='$smt->id_smt'");
                                                                        foreach($query->result() as $pd_siswa) {
                                                                             $siswa = $this->db->query("SELECT * FROM tbl_siswa where id_siswa= '$pd_siswa->id_siswa'");
                                                                             foreach ($siswa->result() as $siswa) {}
                                                                        ?>
                                                                   <option value="<?=$pd_siswa->id_siswa?>" <?php if($id_siswa == $pd_siswa->id_siswa) {echo "selected='selected'";}?>> <?=$siswa->nm_siswa?>  </option>

                                                             <?php } } ?>
                                                         </select>
                                                    </div>

                                           </div>


                                         <div class="form-group">
                                          <label class="col-lg-2 control-label" for="required">Semester</label>
                                               <div class="col-lg-4">
                                                    <?php


                                                     ?>
                                                    <label for="nama_smt" class="control-label"><?=$smt->nama_smt?></label>

                                          </div><div class="fix"></div>
                                      </div>




                                         <div class="form-group">
                                           <div class="col-md-offset-1">
                                              <button type="submit" id="submit" class="btn btn-default marginR10">set</button>
                                           </div>
                                         </div><!-- End .form-group  -->

                                      </form>

                                   </div>

                              </div>
					</div>


                         <?php if (!empty($id_kelas)): ?>


                         <div class="panel panel-headline">
                              <div class="panel">
                                   <div class="panel-heading">
                                        <?php $qmtpel = $this->db->query("SELECT id_matpel_senin as id_matpel from kelas_matpel where id_kelas ='$id_kelas'
                                             UNION select id_matpel_selasa from kelas_matpel where id_kelas ='$id_kelas'
                                             UNION select id_matpel_rabu from kelas_matpel where id_kelas ='$id_kelas'
                                             UNION select id_matpel_kamis from kelas_matpel where id_kelas ='$id_kelas'
                                             UNION select id_matpel_jumat from kelas_matpel where id_kelas ='$id_kelas'
                                             UNION select id_matpel_sabtu from kelas_matpel where id_kelas ='$id_kelas'");

                                             foreach ($qmtpel->result() as $rmtpel) {
                                                  $id_matpel[] = $rmtpel->id_matpel;

                                             }
                                             $imp_idmt = implode(',',$id_matpel);

                                         ?>
                                       <h3 class="panel-title"><?=$judul2?></h3>
                                       <div class="right">

                                             <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                                       </div>
                                   </div>
                                   <div class="panel-body no-padding">
                                        <table class="table  table-striped table-inverse">
                                              <thead>
                                                   <tr>
                                                        <th>No</th>
                                                        <th>Mata Pelajaran</th>
                                                        <th>KKM</th>
                                                        <th>Nilai Rapor</th>
                                                        <th>Nilai Terbilang</th>
                                                        <th>Deskripsi Nilai</th>
                                                        <th>Nilai</th>

                                                   </tr>
                                              </thead>
                                              <tbody>
                                                   <?php
                                                   $q_pd_siswa = $this->db->query("SELECT * FROM tbl_pd_siswa where id_kelas='$id_kelas' AND id_smt='$smt->id_smt' AND id_siswa='$id_siswa'");
                                                   foreach($q_pd_siswa->result() as $r_pd_siswa) {}
                                                   $no = 1;
                                                   $data = $this->db->query("SELECT * FROM mata_pelajaran where id_matpel in($imp_idmt)");
                                                   foreach ($data->result() as $row):
                                                       $rapor = $this->db->query("SELECT * FROM rapor_siswa where id_matpel = '$row->id_matpel' AND id_pd_siswa ='$pd_siswa->id_pd_siswa'");
                                                       foreach ($rapor->result() as $rapor) {}
                                                        ?>
                                                   <tr>
                                                        <td><?=$no?></td>
                                                        <td><?=$row->nama_matpel?></td>
                                                        <td><?=$row->nilai_kkm?></td>
                                                        <td><?=$rapor->nilai_rapor?></td>
                                                        <td><?=$rapor->nilai_terbilang?></td>
                                                        <td><?=$rapor->deskripsi?></td>
                                                        <td><a href="<?=base_url()?>admin/rapor_siswa/get_siswa?conid=<?=$r_pd_siswa->id_pd_siswa?>&mtpel=<?=$row->id_matpel?>&smt=<?=$smt->id_smt?>" class="btn btn-primary">Set Up Rapor</a></td>
                                                   </tr>
                                                   <?php $no++; endforeach; ?>
                                              </tbody>
                                        </table>
                                   </div>

                              </div>
					</div>
					<!-- END OVERVIEW --> <?php endif; ?>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
	</div>
	<!-- END WRAPPER -->

     <?php
     $this->load->view('admin_views/_template/footer');
      ?>
</body>

</html>
