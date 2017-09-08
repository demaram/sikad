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

                    $imp_id_kelas = implode(',',$all_id_kelas);
                ?>

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

                                        <form class="form-horizontal" action="<?=base_url()?>staff/s_pr_siswa/proses_tambah" role="form" method="post" enctype="multipart/form-data" >

                                             <input type="hidden" name="id" value="<?=$row->id_pr?>">

                                             <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">Kelas Yg Diajar</label>
                                                     <div class="col-lg-8">
                                                          <select name="id_kelas" class="form-control" id="id_kelas" required="true">
                                                               <option value="">Pilih Kelas</option>
                                                                 <?php
                                                                      $qpr = $this->db->query("SELECT * FROM kelas WHERE id_kelas IN($imp_id_kelas)");
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

    <script type="text/javascript">
         $(document).ready(function(){
              $("#id_kelas").change(function(){
                var id_kelas = $("#id_kelas").val();
                 $.ajax({
                        type : "POST",
                        url : "<?=base_url();?>staff/s_pr_siswa/ajax_matpel",
                        data : "id_kelas=" + id_kelas,
                        success : function(data){
                             $("#id_matpel").html(data);
                        }
                 });
              });
         });
    </script>
                                             <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">Mata Pelajaran Yg Diajar</label>
                                                     <div class="col-lg-8"><div id="coba" > </div>
                                                          <select name="id_matpel" class="form-control" id="id_matpel" required="true">
                                                               <option value="">Pilih Kelas Terlebih Dahulu</option>
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

                                           <script type="text/javascript">
                                                 $(document).ready(function(){
                                                      $("#submit").click(function(){
                                                           var yakin = alert('Apa Anda Yakin ingin menambahkan PR?');
                                                           if(!yakin){
                                                                return true;
                                                           }else {
                                                                return false;
                                                           }
                                                      });
                                                 })
                                           </script>

                                             <div class="form-group">
                                               <div class="col-md-offset-1">
                                                   <button type="submit" id="submit" class="btn btn-default marginR10">Proses</button>
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
