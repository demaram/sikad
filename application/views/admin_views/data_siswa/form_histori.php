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
                    $id      = $this->input->get('id');
                    $conid = $this->input->get("conid");

                    $siswa = $this->db->query("SELECT * FROM tbl_siswa WHERE id_siswa = '$conid'");
                    foreach ($siswa->result() as $rsiswa) {

                    }

                    if ($segment == 'edit_histori') {
                         $act = 'edit';

                         $data = $this->db->query("SELECT * FROM tbl_pd_siswa WHERE id_pd_siswa = '$id'");
                         foreach ($data->result() as $row) {

                         }
                     }
                    elseif ($segment == 'tambah_histori') {
                         $act = 'add';

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

                                        <form class="form-horizontal" action="<?=base_url()?>admin/data_siswa/proses_form?act=<?=$act?>" role="form" method="post" enctype="multipart/form-data" >

                                             <!--Hidden Input-->
                                             <input name="id_siswa" hidden  id="id_siswa"  value="<?=$rsiswa->id_siswa;?>">
                                             <input name="id_pd_siswa" hidden  id="id_pd_siswa"  value="<?=$id?>">
                                             <!--Hidden Input-->


                                             <div class="form-group">
                                                <label class="col-lg-2 control-label" for="required">Nama Siswa</label>
                                                      <div class="col-lg-8">
                                                 <input name="nama_siswa" required="true" class="form-control required" id="nama_siswa" disabled  value="<?=$rsiswa->nm_siswa;?>" size="50">

                                                 <div id="pesan"></div>
                                                 </div><div class="fix"></div>
                                            </div>

                                            <div class="form-group">
                                              <label class="col-lg-2 control-label" for="required">Kelas</label>
                                                    <div class="col-lg-8">
                                               <select class="form-control" required ="true" name="id_kelas">
                                                    <option value="">Pilih Kelas</option>
                                                    <?php
                                                    $kelas = $this->db->query("SELECT * FROM kelas");
                                                    foreach ($kelas->result() as $rk) { ?>
                                                       <option <?php if($row->id_kelas == $rk->id_kelas){ echo "selected='selected'"; } ?> value="<?=$rk->id_kelas?>"><?=$rk->nama_kelas?></option>
                                                   <?php }

                                                     ?>
                                               </select>
                                               </div><div class="fix"></div>
                                            </div>

                                            <div class="form-group">
                                              <label class="col-lg-2 control-label" for="required">Periode</label>
                                                    <div class="col-lg-8">
                                               <select class="form-control" required ="true" name="id_smt">
                                                    <option value="">Pilih Periode</option>
                                                    <?php
                                                    $smt = $this->db->query("SELECT * FROM master_data_semester");
                                                    foreach ($smt->result() as $rs) { ?>
                                                       <option <?php if($row->id_smt == $rs->id_smt){ echo "selected='selected'"; } ?> value="<?=$rs->id_smt?>"><?=$rs->nama_smt?></option>
                                                   <?php }

                                                     ?>
                                               </select>
                                               </div><div class="fix"></div>
                                            </div>

                                            <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">Jenis Pendaftaran</label>
                                                     <div class="col-lg-8">
                                                <input name="jns_daftar" class="form-control required" id="jns_daftar" value="<?=$row->jns_daftar;?>">
                                                </div><div class="fix"></div>
                                           </div>

                                           <div class="form-group">
                                                 <label class="col-lg-2 control-label" for="required">Tanggal Daftar</label>
                                                      <div class="col-lg-8">
                                                 <input name="tgl_daftar" class="form-control datepicker" id="tgl_daftar" type="text"  value="<?=$row->tgl_daftar?>"style="width:50%">
                                                 </div><div class="fix"></div>
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
