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
                    $data_kelas = $this->db->query("SELECT * FROM mata_pelajaran WHERE id_matpel = '$id'");
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

                                        <form class="form-horizontal" action="<?=base_url()?>admin/mata_pelajaran/<?=$nama_form?>" role="form" method="post" enctype="multipart/form-data" >

                                             <input type="hidden" name="id" value="<?=$row->id_matpel?>">

                                             <div class="form-group">
                                                <label class="col-lg-2 control-label" for="required">Nama Mata Pelajaran</label>
                                                      <div class="col-lg-8">
                                                 <input maxlength="60" name="nama_matpel" required="true" class="form-control" id="nama_matpel" type="text"  value="<?=$row->nama_matpel;?>" size="50">
                                                 </div><div class="fix"></div>
                                             </div>

                                             <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">Kode Mata Pelajaran</label>
                                                     <div class="col-lg-8">
                                                <input maxlength="10" name="kode_matpel" required="true" class="form-control required" id="kode_matpel" type="text"  value="<?=$row->kode_matpel?>" size="50">
                                                </div><div class="fix"></div>
                                             </div>

                                             <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">Kriteria Ketuntasan Minimal(Nilai)</label>
                                                     <div class="col-lg-8">
                                                <input maxlength="3" name="nilai_kkm" required="true" class="form-control required number" id="nilai_kkm" type="text"  value="<?=$row->nilai_kkm?>" size="50">
                                                </div><div class="fix"></div>
                                             </div>

                                             <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">Kelompok</label>
                                                     <div class="col-lg-8">
                                                          <select name="kelompok" class="form-control" id="kelompok">
                                                               <option <?php if($row->kelompok =='-'){echo "selected='selected'";} ?> value="-">-</option>
                                                                <option <?php if($row->kelompok =='A'){echo "selected='selected'";} ?> value="A">A</option>
                                                                <option <?php if($row->kelompok =='B'){echo "selected='selected'";} ?>  value="B">B</option>
                                                         </select>
                                                </div><div class="fix"></div>
                                             </div>



                                             <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">Keterangan</label>
                                                     <div class="col-lg-8">
                                                <textarea name="keterangan" class="form-control" id="keterangan" type="text" rows='6'><?=$row->keterangan?></textarea>
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
