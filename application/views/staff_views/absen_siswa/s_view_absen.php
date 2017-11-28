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




                                   if (empty($id_kelas) || $id_kelas == NULL) {
                                       echo "<h1>Anda Bukan Wali Kelas, Tidak Bisa Melakukan Kegiatan Ini</h1>";
                                   }elseif (!empty($id_kelas)) {

                                        ?>
                                        <div class="panel panel-headline">
                                             <div class="panel">
                                                  <div class="panel-heading">
                                                      <h3 class="panel-title"><?=$judul?> <?=$rsiswa->nm_siswa?></h3>

                                                  </div>
                                                  <div class="panel-body no-padding">
                                                       <form class="form-horizontal" action="" role="form" method="post" enctype="multipart/form-data" id="form_cari">
                                                            <div class="form-group">
                                                                 <label class="col-lg-2 control-label" for="required">Pilih Tanggal Absensi</label>
                                                                      <div class="col-lg-8">
                                                                 <input name="tgl_absen" class="form-control datepicker" id="tgl_absen" type="text"  value="<?=$this->input->post('tgl_absen')?>"style="width:50%">
                                                                 </div><div class="fix"></div>
                                                          </div>

                                                          <div class="form-group">
                                                            <div class="col-md-offset-1">
                                                               <button type="submit" class="btn btn-default marginR10" id="submit">Cari</button>
                                                             </div>
                                                          </div><!-- End .form-group  -->

                                                     </form>
                                                  </div>

                                             </div>
                                        </div>


                                                  <div class="panel panel-headline">
                                                       <div class="panel">
                                                            <div class="panel-heading">
                                                                 <?php

                                                                 $rjudul = $this->db->query("SELECT * FROM kelas where id_kelas= '$id_kelas'");
                                                                      foreach ($rjudul->result() as $kelas) {}

                                                                           if ($this->input->post('tgl_absen') == NULL)
                                                                           {
                                                                                $tgl_absen = date('Y-m-d');
                                                                           }else {
                                                                                $tgl_absen = $this->input->post('tgl_absen');
                                                                           }
                                                                  ?>
                                                                <h3 class="panel-title">Data Absensi</h3>
                                                                <div class="alert alert-info col-md-8">
                                                                           <table>
                                                                                     <tr>
                                                                                          <td> <b>Tanggal</b> </td> <td> : </td> <td style="padding-left:10px;"><?=date('d M Y',strtotime($tgl_absen));?> <?php if(date('d-m-Y') == date('d-m-Y',strtotime($tgl_absen))){ echo "(Hari Ini)"; } ?></td>
                                                                                     </tr>
                                                                                     <tr>
                                                                                          <td><b>Kelas </b> </td> <td> : </td> <td style="padding-left:10px;"><?=$kelas->nama_kelas?></td>
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
                                                                  $data = $this->db->query("SELECT * From tbl_pd_siswa a LEFT JOIN tbl_siswa b ON a.id_siswa = b.id_siswa  WHERE  a.id_kelas = '$id_kelas' AND a.id_smt = '$id_smt'");
                                                                  $hitung = $data->num_rows();
                                                                ?>
                                                                 <form class="form-horizontal" action="<?=base_url()?>staff/s_absen_siswa/proses_tambah" role="form" method="post" enctype="multipart/form-data">
                                                                      <input hidden name="id_kelas" value="<?=$id_kelas?>">
                                                                      <input hidden name="tgl_absen" value="<?=$tgl_absen?>">
                                                                      <table <?php if($hitung <= 10){echo "class='table table-striped data_table '" ;}else{echo "class='table table-striped data_table'";} ?>>
                                                                           <thead>
                                                                                <tr>
                                                                                     <th >No</th>
                                                                                     <th >Nama</th>
                                                                                     <th >NISN</th>
                                                                                     <th >Absen</th>
                                                                                </tr>
                                                                           </thead>
                                                                           <tbody>
                                                                                <?php



                                                                                $no = 1;
                                                                                $i = 1;
                                                                                foreach ($data->result() as $row){



                                                                                         $qabsen = $this->db->query("SELECT * FROM tbl_absen_siswa where id_pd_siswa ='$row->id_pd_siswa' AND tgl_absen='$tgl_absen'");
                                                                                         foreach ($qabsen->result() as $absen) { }

                                                                                         $qmaster_absen = $this->db->query("SELECT * FROM master_jenis_absen");


                                                                                     ?>
                                                                                <tr>
                                                                                    <td><?=$no?></td>
                                                                                    <td><?=$row->nm_siswa?></td>
                                                                                    <input hidden name="id_pd_siswa_<?=$row->id_pd_siswa?>" value="<?=$row->id_pd_siswa?>">
                                                                                    <input hidden name="id_absen_<?=$absen->id_absen?>" value="<?=$absen->id_absen?>">
                                                                                    <input hidden name="id_smt" value="<?=$id_smt?>">
                                                                                    <td><?=$row->nisn?></td>
                                                                                    <td><select class="" name="id_jenis_absen_<?=$i?>">
                                                                                         <option value="0">Belum Ada Keterangan</option>
                                                                                         <?php foreach($qmaster_absen->result() as $master_absen){ ?>
                                                                                           <option value="<?=$master_absen->id_jenis_absen?>"
                                                                                                <?php if ($absen->id_jenis_absen == $master_absen->id_jenis_absen) {
                                                                                                     echo "selected ='selected'";
                                                                                                 } ?>
                                                                                                ><?=$master_absen->nama_absen?>
                                                                                            </option>
                                                                                           <?php } ?>
                                                                                         </select>

                                                                                     </td>
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
}
     $this->load->view('admin_views/_template/footer');
      ?>
</body>

</html>
