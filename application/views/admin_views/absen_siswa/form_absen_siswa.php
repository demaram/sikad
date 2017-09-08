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

                         $id = $this->input->get('id');
                         $id_siswa =$this->input->get('id_siswa');
                         $data_absen = $this->db->query("SELECT * FROM tbl_absen_siswa WHERE id_absen = '$id'");
                         $data_siswa = $this->db->query("SELECT * FROM tbl_siswa WHERE id_siswa = '$id_siswa'");
                         foreach ($data_absen->result() as $row_absen) {

                         }
                         foreach ($data_siswa->result() as $row) {

                         }
                    }
                    elseif ($segment == 'tambah_data') {

                         $nama_form = 'proses_tambah';
                         $id = $this->input->get('id_siswa');
                         $data_siswa = $this->db->query("SELECT * FROM tbl_siswa WHERE id_siswa = '$id'");

                         foreach ($data_siswa->result() as $row) {

                         }
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

                                        <form class="form-horizontal" action="<?=base_url()?>admin/absen_siswa/<?=$nama_form?>" role="form" method="post" enctype="multipart/form-data" >

                                             <input type="hidden" name="id" value="<?=$row->id_user?>">

                                             <div class="form-group">
                                                <label class="col-lg-2 control-label" for="required">Nama Siswa</label>
                                                      <div class="col-lg-8">
                                                 <input maxlength="60" name="nama" disabled required="true" class="form-control required" id="nama" type="text"  value="<?=$row->nm_siswa;?>" >
                                                 <input type="hidden" name="id_siswa" value="<?=$row->id_siswa?>">
                                                 <input type="hidden" name="id_absen" value="<?=$row_absen->id_absen?>">
                                                 </div><div class="fix"></div>
                                             </div>

                                             <div class="form-group">
                                                   <label class="col-lg-2 control-label" for="required">Tanggal Absen</label>
                                                        <div class="col-lg-8">
                                                   <input name="tgl_absen" class="form-control datepicker" id="tgl_absen" type="text"  value="<?=$row_absen->tgl_absen?>"style="width:50%">
                                                   </div><div class="fix"></div>
                                             </div>

                                             <div class="form-group">
                                                <label class="col-lg-2 control-label" for="required">Jenis Absen</label>
                                                      <div class="col-lg-2" style="margin-left:-20px;"><br>
                                                           <label class="fancy-radio">
               										<input name="jns_absen" value="1" type="radio" <?php if($row_absen->jns_absen=='1')echo "checked='checked'"; ?>>
               										<span><i></i>Izin</span>
          								       	</label>
                                                            <label class="fancy-radio">
               										<input name="jns_absen" value="2" type="radio" <?php if($row_absen->jns_absen=='2')echo "checked='checked'"; ?>>
               										<span><i></i>Sakit</span>
          								       	</label>
                                                            <label class="fancy-radio">
               										<input name="jns_absen" value="3" type="radio" <?php if($row_absen->jns_absen=='3')echo "checked='checked'"; ?>>
               										<span><i></i>Alpha</span>
          								       	</label>
                                                            <label class="fancy-radio">
                                                                <input name="jns_absen" value="4" type="radio" <?php if($row_absen->jns_absen=='4')echo "checked='checked'"; ?>>
                                                                <span><i></i>Terlambat</span>
                                                           </label>
                                                 </div><div class="fix"></div>
                                             </div>

                                             <div class="form-group">
                                                  <label class="col-lg-2 control-label" for="required">Keterangan</label>
                                                       <div class="col-lg-8"  id="tampil_kabkot">
                                                          <textarea name="keterangan" class="form-control" rows="8" cols="80"><?=$row_absen->keterangan?></textarea>
                                                  </div><div class="fix"></div>
                                             </div>


                                           <br clear="all" />

                                             <div class="form-group">
                                               <div class="col-md-offset-1">
                                                   <button type="submit" class="btn btn-default marginR10" id="submit">Proses</button>
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
			<footer>
				<div class="container-fluid">

				</div>
			</footer>
		</div>
		<!-- END MAIN -->
	</div>
	<!-- END WRAPPER -->

     <?php
     $this->load->view('admin_views/_template/footer');
      ?>
</body>

</html>
