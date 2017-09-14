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

			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
                         <?php

                              $pesan_success = $this->session->flashdata('pesan_success');
                              $pesan_error = $this->session->flashdata('pesan_error');
               			if ($pesan_error!== NULL) {
 //                  alert tambah
               				?>
                                   <div class="alert alert-danger" id="alert_pesan">
                                               <button type="button" class="close" data-dismiss="alert">×</button>
                                               <?=$pesan_error?>
                                           </div>
               				<?php
                              }
                              else if ($pesan_success!== NULL) {
 //                  alert tambah
               				?>
                                   <div class="alert alert-success" id="alert_pesan">
                                               <button type="button" class="close" data-dismiss="alert">×</button>
                                               <?=$pesan_success?>
                                           </div>
               				<?php
                              }
                              ?>
                              <script type="text/javascript">
                                   $(document).ready(function(){
                                        $("#alert_pesan").show(2000);
                                        $("#alert_pesan").delay(3000).hide(1000);
                                   });
                              </script>
					<!-- OVERVIEW -->



                                   <?php
                                   $id_siswa = $this->input->post('id_siswa');
                                   $qsmt = $this->db->query("SELECT * From master_data_semester where id_smt = '$id_smt'");
                                   $nama_smt = $qsmt->row()->nama_smt;

                                   if (empty($id_kelas) || $id_kelas == NULL) {
                                       echo "<h1>Anda Bukan Wali Kelas, Tidak Bisa Melakukan Kegiatan Ini</h1>";
                                   }elseif (!empty($id_kelas)) {


                                        ?>
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


                                                             <div class="form-group">
                                                              <label class="col-lg-2 control-label" for="required">Nama Siswa</label>
                                                                   <div class="col-lg-4">
                                                                        <select name="id_siswa" class="form-control" id="id_siswa" required="true">
                                                                             <?php
                                                                                       $query = $this->db->query("SELECT * FROM tbl_pd_siswa where id_kelas='$id_kelas' AND id_smt='$id_smt'");
                                                                                       foreach($query->result() as $pd_siswa) {
                                                                                            $siswa = $this->db->query("SELECT * FROM tbl_siswa where id_siswa= '$pd_siswa->id_siswa'");
                                                                                            foreach ($siswa->result() as $siswa) {}
                                                                                       ?>
                                                                                  <option value="<?=$pd_siswa->id_siswa?>" <?php if($id_siswa == $pd_siswa->id_siswa) {echo "selected='selected'";}?>> <?=$siswa->nm_siswa?>  </option>

                                                                            <?php }  ?>
                                                                        </select>
                                                                   </div>

                                                          </div>


                                                        <div class="form-group">
                                                         <label class="col-lg-2 control-label" for="required">Semester</label>
                                                              <div class="col-lg-4">
                                                                   <?php


                                                                    ?>
                                                                   <label for="nama_smt" class="control-label"><?=$nama_smt?></label>

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


                                        <?php

                                        if (!empty($id_siswa)): ?>


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
                                                                  $q_pd_siswa = $this->db->query("SELECT * FROM tbl_pd_siswa where id_kelas='$id_kelas' AND id_smt='$id_smt' AND id_siswa='$id_siswa'");
                                                                  foreach($q_pd_siswa->result() as $r_pd_siswa) {}
                                                                  $no = 1;
                                                                  $data = $this->db->query("SELECT * FROM mata_pelajaran where id_matpel in($imp_idmt)");
                                                                  foreach ($data->result() as $row):
                                                                      $rapor = $this->db->query("SELECT * FROM rapor_siswa where id_matpel = '$row->id_matpel' AND id_pd_siswa ='$r_pd_siswa->id_pd_siswa'");
                                                                      foreach ($rapor->result() as $rapor) {}
                                                                       ?>
                                                                  <tr>
                                                                       <td><?=$no?></td>
                                                                       <td><?=$row->nama_matpel?></td>
                                                                       <td><?=$row->nilai_kkm?></td>
                                                                       <td><?=$rapor->nilai_rapor?></td>
                                                                       <td><?=$rapor->nilai_terbilang?></td>
                                                                       <td><?=$rapor->deskripsi?></td>
                                                                       <td><a href="<?=base_url()?>staff/s_rapor_siswa/get_siswa?conid=<?=$r_pd_siswa->id_pd_siswa?>&mtpel=<?=$row->id_matpel?>&smt=<?=$id_smt?>" class="btn btn-primary">Set Up Rapor</a></td>
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
}
     $this->load->view('admin_views/_template/footer');
      ?>
</body>

</html>
