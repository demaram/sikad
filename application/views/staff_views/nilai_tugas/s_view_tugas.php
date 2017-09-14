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
                ?>

			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
                         <?php
                         $tgl_nilai = $this->input->post('tgl_nilai');
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
                                            <label class="col-lg-2 control-label" for="required">Kelas Yang Diajar</label>
                                                 <div class="col-lg-4">
                                                      <select name="id_kelas" class="form-control" id="id_kelas">
                                                           <option value="0">-- Pilih Kelas --</option>
                                                             <?php
                                                                 if ($this->input->post('id_kelas') == NULL) {
                                                                      $id_kelas = NULL;
                                                                 }else {
                                                                      $id_kelas =$this->input->post('id_kelas');
                                                                 }
                                                                 $imp_id_kelas = implode(',',$all_id_kelas);
                                                                 $qpr = $this->db->query("SELECT * FROM kelas WHERE id_kelas IN($imp_id_kelas)");
                                                                    foreach ($qpr->result() as $rkel) { ?>
                                                                         <option <?php if ($id_kelas == $rkel->id_kelas): ?>
                                                                              selected="selected"
                                                                         <?php endif; ?> value="<?=$rkel->id_kelas?>"> <?=$rkel->nama_kelas?> </option>
                                                                    <?php }
                                                             ?>
                                                      </select>
                                            </div><div class="fix"></div>
                                         </div>

                                         <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">Tanggal</label>
                                                    <div class="col-lg-8">
                                               <input name="tgl_nilai" class="form-control datepicker" id="tgl_nilai" type="text"  value="<?=$tgl_nilai?>"style="width:30%">
                                               </div><div class="fix"></div>
                                        </div>


                                         <div class="form-group">
                                          <label class="col-lg-2 control-label" for="required">Semester</label>
                                               <div class="col-lg-4">
                                                    <?php
                                                          $smt = $this->db->query("SELECT * FROM master_data_semester where status_active ='1'");
                                                          $smt = $smt->row();

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


                         <?php


                         if (!empty($id_kelas)): ?>


                         <div class="panel panel-headline">
                              <div class="panel">
                                   <div class="panel-heading">
                                        <h3 class="panel-title">Mata Pelajaran Yang Diajar</h3>
                                        <?php $qmtpel = $this->db->query("SELECT id_matpel_senin as id_matpel from kelas_matpel where id_kelas ='$id_kelas' AND id_guru_senin ='$id_guru'
                                             UNION select id_matpel_selasa from kelas_matpel where id_kelas ='$id_kelas' AND id_guru_selasa ='$id_guru'
                                             UNION select id_matpel_rabu from kelas_matpel where id_kelas ='$id_kelas' AND id_guru_rabu ='$id_guru'
                                             UNION select id_matpel_kamis from kelas_matpel where id_kelas ='$id_kelas' AND id_guru_kamis ='$id_guru'
                                             UNION select id_matpel_jumat from kelas_matpel where id_kelas ='$id_kelas' AND id_guru_jumat ='$id_guru'
                                             UNION select id_matpel_sabtu from kelas_matpel where id_kelas ='$id_kelas' AND id_guru_sabtu ='$id_guru'");

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
                                        <table class="table table-striped ">
                                              <thead>
                                                   <tr>
                                                        <th>No</th>
                                                        <th>Nama Mata Pelajaran</th>
                                                        <th>Kode Mata Pelajaran</th>
                                                        <th>Kelompok</th>
                                                        <th width="30%">Nilai</th>

                                                   </tr>
                                              </thead>
                                              <tbody>
                                                   <?php
                                                   $no = 1;
                                                   $data = $this->db->query("SELECT * FROM mata_pelajaran where id_matpel in($imp_idmt)");
                                                   foreach ($data->result() as $row): ?>
                                                   <tr>
                                                        <td><?=$no?></td>
                                                        <td><?=$row->nama_matpel?></td>
                                                        <td><?=$row->kode_matpel?></td>
                                                        <td><?=$row->kelompok?></td>
                                                        <td><a href="<?=base_url()?>staff/s_nilai_tugas/get_siswa?id_matpel=<?=$row->id_matpel?>&id_kelas=<?=$id_kelas?>&smt=<?=$smt->id_smt?>&day=<?=$tgl_nilai?>" class="btn btn-primary">Set Up Nilai</a></td>
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
