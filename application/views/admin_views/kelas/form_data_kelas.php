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
                    $data_kelas = $this->db->query("SELECT * FROM kelas WHERE id_kelas = '$id'");
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

                                        <form class="form-horizontal" action="<?=base_url()?>admin/kelas/<?=$nama_form?>" role="form" method="post" enctype="multipart/form-data" >

                                             <input type="hidden" name="id" value="<?=$row->id_kelas?>">

                                             <div class="form-group">
                                                <label class="col-lg-2 control-label" for="required">Nama Kelas</label>
                                                      <div class="col-lg-8">
                                                 <input maxlength="60" name="nama_kelas" required="true" class="form-control required" id="nama_kelas" type="text"  value="<?=$row->nama_kelas;?>" size="50">
                                                 </div><div class="fix"></div>
                                            </div>

                                             <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">Kode Kelas</label>
                                                     <div class="col-lg-8">
                                                <input maxlength="10" name="kode_kelas"  required="true" class="form-control required" id="kode_kelas" type="text"  value="<?=$row->kode_kelas?>" size="50">
                                                </div><div class="fix"></div>
                                           </div>


                                             <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">Keterangan</label>
                                                     <div class="col-lg-8">
                                                <textarea name="keterangan" class="form-control" id="keterangan" type="text" rows='6'><?=$row->keterangan?></textarea>
                                                </div><div class="fix"></div>
                                            </div>


                                            <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">Guru Wali</label>
                                                    <div class="col-lg-8">
                                               <select name="id_guru_wali" class="form-control" id="id_guru_wali">
                                                                <option value="">Pilih Guru</option>
                                                      <?php
                                                           $qguru = $this->db->query("SELECT * FROM users where id_level = '3'");

                                                           foreach ($qguru->result()as $rguru) { ?>
                                                                <option <?php if ($row->id_guru_wali == $rguru->id_user): ?>
                                                                      selected="selected"
                                                                <?php endif; ?> value="<?=$rguru->id_user?>"> <?=$rguru->nama?> </option>
                                                           <?php }
                                                      ?>
                                               </select>
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
