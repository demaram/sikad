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

                                   $qsmt = $this->db->query("SELECT * From master_data_semester where id_smt = '$id_smt'");
                                   $nama_smt = $qsmt->row()->nama_smt;

                                   $today = date('Y-m-d');

                                   $tgl_absen = date('Y-m-d');


                                        ?>
                                                  <div class="panel panel-headline">
                                                       <div class="panel">
                                                            <div class="panel-heading">
                                                                 <?php

                                                                 $rkelas = $this->db->query("SELECT * FROM kelas where id_kelas= '$id_kelas_pilih'");
                                                                      foreach ($rkelas->result() as $kelas) {}
                                                                 $rmtpel = $this->db->query("SELECT * FROM mata_pelajaran where id_matpel= '$id_matpel_pilih'");
                                                                      foreach ($rmtpel->result() as $matpel) {}
                                                                  ?>
                                                                <h3 class="panel-title"><?=$judul?></h3>
                                                                <div class="alert alert-info col-md-8">
                                                                           <table>
                                                                                     <tr>
                                                                                          <td> <b>Tanggal</b> </td> <td> : </td> <td style="padding-left:10px;"><?=date('d M Y',strtotime($tgl_nilai));?> <?php if(date('d-m-Y') == date('d-m-Y',strtotime($tgl_nilai))){ echo "(Hari Ini)"; } ?></td>
                                                                                     </tr>
                                                                                     <tr>
                                                                                          <td><b>Kelas </b> </td> <td> : </td> <td style="padding-left:10px;"><?=$kelas->nama_kelas?></td>
                                                                                     </tr>
                                                                                     <tr>
                                                                                          <td><b>Mata Pelajaran </b> </td> <td> : </td> <td style="padding-left:10px;"><?=$matpel->nama_matpel?></td>
                                                                                     </tr>
                                                                                     <tr>
                                                                                          <td> <b>Semester</b></td> <td> : </td> <td style="padding-left:10px;"><?=$nama_smt?></td>
                                                                                     </tr>
                                                                           </table>

                                                                         </div>
                                                                <div class="right">

                                                                      <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                                                                </div>
                                                            </div>
                                                            <div class="panel-body no-padding">

                                                                 <?php
                                                                  $data = $this->db->query("SELECT * From tbl_pd_siswa a LEFT JOIN tbl_siswa b ON a.id_siswa = b.id_siswa  WHERE  a.id_kelas = '$id_kelas_pilih' AND a.id_smt = '$id_smt'");
                                                                  $hitung = $data->num_rows();
                                                                ?>
                                                                 <form class="form-horizontal" action="<?=base_url()?>staff/s_nilai_tugas/proses_tambah" role="form" method="post" enctype="multipart/form-data">
                                                                      <input hidden name="id_kelas" value="<?=$id_kelas_pilih?>">
                                                                      <input hidden name="tgl_nilai" value="<?=$tgl_nilai?>">
                                                                      <input hidden name="id_matpel" value="<?=$id_matpel_pilih?>">

                                                                      <table <?php if($hitung <= 10){echo "class='table table-striped'" ;}else{echo "class='table table-striped data_table'";} ?>>
                                                                           <thead>
                                                                                <tr>
                                                                                     <th >No</th>
                                                                                     <th >Nama</th>
                                                                                     <th >NISN</th>
                                                                                     <th >Nilai Tugas</th>
                                                                                     <th >Deskripsi</th>
                                                                                </tr>
                                                                           </thead>
                                                                           <tbody>
                                                                                <?php

                                                                                $tgl_absen = date('Y-m-d',strtotime($tgl_absen));



                                                                                $no = 1;
                                                                                $i = 1;
                                                                                foreach ($data->result() as $row){



                                                                                         $qtugas= $this->db->query("SELECT * FROM nilai_tugas   where id_pd_siswa ='$row->id_pd_siswa' AND id_matpel ='$id_matpel_pilih' AND tgl_nilai='$tgl_nilai'");
                                                                                              foreach ($qtugas->result() as $tugas) { }



                                                                                     ?>
                                                                                <tr>
                                                                                    <td><?=$no?></td>
                                                                                    <td><?=$row->nm_siswa?></td>

                                                                                    <td><?=$row->nisn?></td>

                                                                                    <style media="screen">
                                                                                         .setengah{
                                                                                              width: 50%;
                                                                                         }
                                                                                    </style>
                                                                                    <td><input type="text" class="form-control setengah number" name="nilai_angka_<?=$row->id_pd_siswa?>" value="<?=$tugas->nilai_angka?>" maxlength="3"></td>
                                                                                    <td><input type="text" class="form-control" name="deskripsi_<?=$row->id_pd_siswa?>" value="<?=$tugas->deskripsi?>"></td>
                                                                                    <input type="hidden" name="id_pd_siswa_<?=$row->id_pd_siswa?>" value="<?=$row->id_pd_siswa?>">



                                                                                </tr>
                                                                                <?php $no++;
                                                                                      $i++;
                                                                                } ?>
                                                                           </tbody>
                                                                     </table>
                                                                     <div class="form-group">
                                                                       <div class="col-md-1">
                                                                           <?php if ($hitung  >=1) :?><button type="submit" class="btn btn-primary marginR10">Proses</button> <?php endif ?>
                                                                        </div>
                                                                      </div><!-- End .form-group  -->
                                                                 </form>
                                                            </div>

                                                       </div>
                         					</div>


					<!-- END OVERVIEW -->
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
