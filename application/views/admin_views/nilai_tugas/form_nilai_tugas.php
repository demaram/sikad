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


                    $id = $this->input->get('conid');
                    $id_matpel = $this->input->get('id_matpel');
                    $id_kelas = $this->input->get('id_kelas');
                    $id_smt = $this->input->get('smt');
                    $data = $this->db->query("SELECT * FROM nilai_tugas WHERE id_nilai = '$id'");

                    foreach ($data->result() as $row) {

                    }
                ?>

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

                                        <form class="form-horizontal" action="<?=base_url()?>admin/nilai_tugas/<?=$nama_form?>" role="form" method="post" enctype="multipart/form-data" >

                                             <input type="hidden" name="id" value="<?=$row->id_nilai?>">
                                             <input type="hidden" name="smt" value="<?=$this->input->get('smt')?>">
                                             <div class="form-group">
                                              <label class="col-lg-2 control-label" for="required">Nama Siswa</label>
                                                    <div class="col-lg-8">
                                                         <select name="id_pd_siswa" class="form-control" id="id_pd_siswa">
                                                                <?php

                                                                     $pd_siswa = $this->db->query("SELECT * FROM tbl_pd_siswa WHERE id_smt='$id_smt' AND id_kelas='$id_kelas'");
                                                                     foreach ($pd_siswa->result() as $rspd) {
                                                                          $siswa = $this->db->query("SELECT nm_siswa from tbl_siswa where id_siswa = '$rspd->id_siswa'");
                                                                          foreach($siswa->result() as $siswa ){}
                                                                          ?>
                                                                          <option <?php if ($row->id_pd_siswa == $rspd->id_pd_siswa): ?>
                                                                                selected="selected"
                                                                          <?php endif; ?> value="<?=$rspd->id_pd_siswa?>"> <?=$siswa->nm_siswa?> </option>
                                                                     <?php }
                                                                ?>
                                                         </select>
                                               </div><div class="fix"></div>
                                            </div>

                                             <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">Mata Pelajaran</label>
                                                     <div class="col-lg-8">
                                                <?php
                                                  $matpel = $this->db->query("SELECT * FROM mata_pelajaran WHERE id_matpel= '$id_matpel'");
                                                  foreach ($matpel->result() as $mtpel) {
                                                       echo $mtpel->nama_matpel;
                                                  }
                                                 ?>
                                                <input name="id_matpel"  hidden id="id_matpel" type="text"  value="<?=$mtpel->id_matpel?>" size="50">
                                                </div><div class="fix"></div>
                                             </div>

                                             <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">Kelas</label>
                                                     <div class="col-lg-8">
                                                <?php
                                                  $kelas = $this->db->query("SELECT * FROM kelas WHERE id_kelas= '$id_kelas'");
                                                  foreach ($kelas->result() as $kls) {
                                                       echo $kls->nama_kelas;
                                                  }
                                                 ?>
                                                <input name="id_kelas"  hidden id="id_kelas" type="text"  value="<?=$this->input->get('id_kelas')?>" size="50">
                                                </div><div class="fix"></div>
                                           </div>

                                           <div class="form-group">
                                                <label class="col-lg-2 control-label" for="required">Tanggal Input (nilai)</label>
                                                     <div class="col-lg-8">
                                                <input name="tgl_nilai" class="form-control datepicker" id="tgl_nilai" type="text"  value="<?=$row->tgl_nilai?>"style="width:50%">
                                                </div><div class="fix"></div>
                                         </div>
                                           <br>
                                           <div class="form-group">
                                              <label class="col-lg-2 control-label" for="required">Nilai Angka</label><span id="nilai" class="label label-info"></span>
                                                   <div class="col-lg-3">
                                              <input maxlength="3" name="nilai_angka" required="true" class="form-control required number" id="nilai_angka" value="<?=$row->nilai_angka;?>">
                                              </div><div class="fix"></div>
                                         </div>

                                         <div class="form-group">
                                           <label class="col-lg-2 control-label" for="required"></label>
                                                <div class="col-lg-7">
                                                     <div class="alert alert-info alert-dismissible" role="alert">
                                                        Belum Atur Skala Nilai? Atur <a href="<?=base_url()?>admin/master_skala_nilai"><b>Disini<b></a>
                                                        </div>
                                      </div>




                                           <br clear="all" />

                                             <div class="form-group">
                                               <div class="col-md-offset-1">
                                                   <button type="submit" class="btn btn-default marginR10">Proses</button>
                                                </div>
                                              </div><!-- End .form-group  -->

                                         </form><!--End Form-->
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
