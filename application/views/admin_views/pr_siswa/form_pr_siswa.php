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


                    $id = $this->input->get('id');
                    $data_kelas = $this->db->query("SELECT * FROM tbl_pr WHERE id_pr = '$id'");
                    $row = $data_kelas->result();
                    foreach ($data_kelas->result() as $row) {

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

                                        <form class="form-horizontal" action="<?=base_url()?>admin/pr_siswa/<?=$nama_form?>" role="form" method="post" enctype="multipart/form-data" >

                                             <input type="hidden" name="id" value="<?=$row->id_pr?>">

                                             <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">Kelas</label>
                                                     <div class="col-lg-8">
                                                          <select name="id_kelas" class="form-control" id="id_kelas" required="true">
                                                               <option value="">Pilih Kelas</option>
                                                                 <?php
                                                                      $qpr = $this->db->query("SELECT * FROM kelas WHERE 1=1");
                                                                      foreach ($qpr->result() as $rpr) { ?>
                                                                           <option <?php if ($row->id_kelas == $rpr->id_kelas): ?>
                                                                                 selected="selected"
                                                                           <?php endif; ?> value="<?=$rpr->id_kelas?>"> <?=$rpr->nama_kelas?> </option>
                                                                      <?php }
                                                                 ?>
                                                          </select>
                                                </div><div class="fix"></div>
                                             </div>

                                             <div class="form-group">
                                                   <label class="col-lg-2 control-label" for="required">Periode Aktif</label>
                                                        <div class="col-lg-8">

                                                            <?php $semester = $this->db->query("SELECT * FROM master_data_semester where status_active = '1'");
                                                                  $smt = $semester->row()->nama_smt;
                                                                  $id_smt = $semester->row()->id_smt;

                                                            ?>
                                                   <input disabled class="form-control" type="text"  value="<?=$smt?>"style="width:30%">
                                                   <input style="display:none" class="form-control" name="id_smt" type="text"  value="<?=$id_smt?>">
                                                   </div><div class="fix"></div>
                                            </div>

                                             <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">Mata Pelajaran</label>
                                                     <div class="col-lg-8">
                                                          <select name="id_matpel" class="form-control" id="id_matpel">
                                                               <option value="">Pilih Mata Pelajaran</option>
                                                                 <?php
                                                                      $qmp = $this->db->query("SELECT * FROM mata_pelajaran WHERE 1=1");
                                                                      foreach ($qmp->result() as $rmp) { ?>
                                                                           <option <?php if ($row->id_matpel == $rmp->id_matpel): ?>
                                                                                 selected="selected"
                                                                           <?php endif; ?> value="<?=$rmp->id_matpel?>"> <?=$rmp->nama_matpel?> </option>
                                                                      <?php }
                                                                 ?>
                                                          </select>
                                                </div><div class="fix"></div>
                                             </div>


                                             <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">Detail PR</label>
                                                     <div class="col-lg-8">
                                                <textarea name="detail" class="form-control" id="detail" type="text" rows='6'><?=$row->detail?></textarea>
                                                </div><div class="fix"></div>
                                           </div>

                                           <div class="form-group">
                                                 <label class="col-lg-2 control-label" for="required">Tanggal Penugasan</label>
                                                      <div class="col-lg-8">
                                                 <input name="tgl_awal" class="form-control datepicker" id="tgl_awal" type="text"  value="<?=$row->tgl_awal?>"style="width:30%">
                                                 </div><div class="fix"></div>
                                          </div>

                                          <div class="form-group">
                                                <label class="col-lg-2 control-label" for="required">Tanggal Dikumpulkan</label>
                                                     <div class="col-lg-8">
                                                <input name="tgl_akhir" class="form-control datepicker" id="tgl_akhir" type="text"  value="<?=$row->tgl_akhir?>"style="width:30%">
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
			<footer>
				<div class="container-fluid">
					<p class="copyright">&copy; 2016. Designed &amp; Crafted by <a href="https://themeineed.com">The Develovers</a></p>
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
