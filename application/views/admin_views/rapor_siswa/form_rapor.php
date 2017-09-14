<?php
$this->load->view('admin_views/_template/head');
 ?>
<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- SIDEBAR -->
          <?php
               error_reporting(~E_NOTICE);
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
                    $segment = $this->uri->segment('3');

                    if ($segment == 'edit_data') {
                         $nama_form = 'proses_edit';
                    }
                    elseif ($segment == 'tambah_data') {
                         $nama_form = 'proses_tambah';
                    }


                    $id_pd = $this->input->get('conid');
                    $id_matpel = $this->input->get('mtpel');
                    $id_smt = $this->input->get('smt');


                ?>

			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
                              <div class="panel">
                                   <div class="panel-heading">
                                       <h3 class="panel-title">Refrensi Nilai</h3>
                                       <div class="right">
                                             <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                                       </div>
                                   </div>
                                   <div class="panel-body no-padding">
                                        <!--Mulai Form-->

                                       <div class="row">
                                            <div  style="width:95% ; margin-left:auto; margin-right:auto">
                                                 <div class="col-md-6">
                                                      <label class="col-md-6"><h4>1. Nilai Harian</h4></label><br>
                                                      <table class="table table-striped table-inverse">
                                                            <thead>
                                                                 <tr>
                                                                      <th>No</th>
                                                                      <th>Nilai Harian Ekspresif</th>
                                                                      <th>Nilai Harian Reseptif</th>

                                                                 </tr>
                                                            </thead>
                                                            <tbody>
                                                                 <?php
                                                                      $id_pd = $this->input->get('conid');

                                                                      $id_matpel = $this->input->get('mtpel');
                                                                      $matpel = $this->db->query("SELECT * FROM mata_pelajaran where id_matpel = '$id_matpel'");
                                                                      foreach ($matpel->result() as $matpel) {}


                                                                      $id_smt = $this->input->get('smt');
                                                                      $smt = $this->db->query("SELECT * FROM master_data_semester where id_smt = '$id_smt'");
                                                                      foreach ($smt->result() as $smt) {}

                                                                      $query  = $this->db->query("SELECT * FROM nilai_harian where id_pd_siswa = '$id_pd' AND id_matpel= '$id_matpel'");
                                                                      $no = 1;
                                                                      foreach ($query->result() as $harian ) {

                                                                 ?>
                                                                 <tr>
                                                                      <td><?=$no?></td>
                                                                      <td><?=$harian->nilai_angka_ekspresif?> ( <?=$harian->nilai_huruf_ekspresif?> )</td>
                                                                      <td><?=$harian->nilai_angka_reseptif?>  ( <?=$harian->nilai_huruf_reseptif?> )</td>

                                                                 <?php $no++; }
                                                                 ?>
                                                            </tbody>
                                                      </table>
                                                 </div>
                                                 <div class="col-md-6">
                                                      <label class="col-md-6"><h4>2.Nilai Tugas</h4></label><br>
                                                      <table class="table table-striped table-inverse">
                                                            <thead>
                                                                 <tr>
                                                                      <th>No</th>
                                                                      <th>Nilai Tugas</th>

                                                                 </tr>
                                                            </thead>
                                                            <tbody>
                                                                 <?php
                                                                      $query  = $this->db->query("SELECT * FROM  nilai_tugas where id_pd_siswa = '$id_pd' AND id_matpel= '$id_matpel'");
                                                                      $no = 1;
                                                                      foreach ($query->result() as $tugas ) {

                                                                 ?>
                                                                 <tr>
                                                                      <td><?=$no?></td>
                                                                      <td><?=$tugas->nilai_angka?></td>

                                                                 <?php $no++; }
                                                                 ?>
                                                            </tbody>
                                                      </table>
                                                 </div>
                                            </div>
                                       </div><!--END ROW-->

                                       <div class="row">
                                            <div  style="width:95% ; margin-left:auto; margin-right:auto">
                                                 <div class="col-md-12">
                                                      <label class="col-md-6"><h4>3. Nilai Uas</h4></label><br>
                                                      <table class="table table-striped table-inverse">
                                                            <thead>
                                                                 <tr>
                                                                      <th>No</th>
                                                                      <th>Semester</th>
                                                                      <th>Nilai Uas</th>
                                                                 </tr>
                                                            </thead>
                                                            <tbody>
                                                                 <?php
                                                                      $uas  = $this->db->query("SELECT * FROM nilai_uas where id_pd_siswa = '$id_pd' AND id_matpel= '$id_matpel'");
                                                                      $no = 1;
                                                                      foreach ($uas->result() as $uas ) {

                                                                 ?>
                                                                 <tr>
                                                                      <td><?=$no?></td>
                                                                      <td><?=$smt->nama_smt?></td>
                                                                      <td><?=$uas->nilai_uas_angka?></td>

                                                                 <?php $no++; }
                                                                 ?>
                                                            </tbody>
                                                      </table>
                                                 </div>
                                            </div>
                                       </div><!--END ROW-->

                                   </div>

                              </div>
					</div>
					<!-- END OVERVIEW -->
				</div>
			</div>
			<!-- END MAIN CONTENT -->

               <!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
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
                                        <!--Mulai Form-->
                                          <form class="form-horizontal" action="<?=base_url()?>admin/rapor_siswa/proses_nilai" role="form" method="post" enctype="multipart/form-data" >
                                               <?php
                                                   $cek_eksis = $this->db->query("SELECT * FROM rapor_siswa where id_matpel='$id_matpel' AND id_pd_siswa='$id_pd'");

                                                   foreach ($cek_eksis->result() as $row ) {

                                                   }
                                                ?>
                                               <input type="hidden" name="id_pd_siswa" value="<?=$id_pd?>">
                                               <input type="hidden" name="id_matpel" value="<?=$id_matpel?>">
                                             <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">Nilai Rapor (angka)</label>
                                                     <div class="col-lg-8">
                                                <input maxlength="3" name="nilai_rapor"  required="true" class="form-control required number" id="nisn" type="text"  value="<?=$row->nilai_rapor?>" size="50" style="width:30%">
                                                </div><div class="fix"></div>
                                             </div>
                                             <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">Terbilang</label>
                                                     <div class="col-lg-8">
                                                <input name="nilai_terbilang"  required="true" class="form-control required" id="nilai_terbilang" type="text"  value="<?=$row->nilai_terbilang?>" size="50">
                                                </div><div class="fix"></div>
                                             </div>
                                             <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">Deskripsi</label>
                                                     <div class="col-lg-8">
                                                <textarea name="deskripsi"  required="true" class="form-control required " id="deskripsi"><?=$row->deskripsi?></textarea>
                                                </div><div class="fix"></div>
                                             </div>

                                              <br clear="all" />
                                             <div class="form-group">
                                              <div class="col-md-offset-1">
                                                  <button type="submit" class="btn btn-default marginR10">Proses</button>
                                               </div>
                                             </div><!-- End .form-group  -->
                                          </form>
                                  </div>

                              </div>
					</div>
					<!-- END OVERVIEW -->
				</div>
			</div><!--END MAIN CONTENT-->

		</div>
		<!-- END MAIN -->
	</div>
	<!-- END WRAPPER -->

     <?php
     $this->load->view('admin_views/_template/footer');
      ?>
</body>

</html>
