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
                    $data_kelas = $this->db->query("SELECT * FROM users WHERE id_user = '$id'");
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

                                        <form class="form-horizontal" action="<?=base_url()?>staff/profil/proses_edit" role="form" method="post" enctype="multipart/form-data" >

                                             <input type="hidden" name="id" value="<?=$row->id_user?>">


                                             <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">Nama</label>
                                                     <div class="col-lg-8">
                                                <input maxlength="60" name="nama" required="true" class="form-control" id="nama" type="text"  value="<?=$row->nama;?>" size="50">
                                                </div><div class="fix"></div>
                                            </div>

                                            <div class="form-group">
                                              <label class="col-lg-2 control-label" for="required">Username</label>
                                                    <div class="col-lg-8">
                                               <input maxlength="60" name="username" required="true" class="form-control" id="username" type="text"  value="<?=$row->username;?>" size="50">
                                               </div><div class="fix"></div>
                                           </div>

                                           <div class="form-group">
                                                <label class="col-lg-2 control-label" for="required">Pas Foto</label>
                                                     <div class="col-lg-8">
                                                          <img style="width:100px; height:100px"
                                                               <?php
                                                                     if ($row->photo == '') { ?>
                                                                          src="<?=base_url()?>assets/foto/no_img.png">
                                                               <?php } else {
                                                                ?>
                                                               src="<?=base_url()?>assets/foto/<?=$row->photo?>">

                                                               <?php } ?>
                                                          <input name="photo" class="file" id="photo" type="file">
                                                </div><div class="fix"></div>
                                                <input type="text" name="photo_asli" value="<?=$row->photo?>" hidden="hidden">
                                           </div>

                                           <div class="form-group">
                                                <label class="col-lg-2 control-label" for="required">Tanggal Lahir</label>
                                                     <div class="col-lg-8">
                                                <input name="tgl_lahir" class="form-control datepicker" id="tgl_lahir" type="text"  value="<?=$row->tgl_lahir?>"style="width:50%">
                                                </div><div class="fix"></div>
                                          </div>

                                          <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">Email</label>
                                                    <div class="col-lg-8">
                                               <input name="email" class="form-control" id="email" type="email"  value="<?=$row->email?>">
                                               </div><div class="fix"></div>
                                         </div>

                                         <div class="form-group">
                                              <label class="col-lg-2 control-label" for="required">Nomor Telepon Aktif</label>
                                                   <div class="col-lg-8">
                                              <input name="no_hp" class="form-control number" id="no_hp" type="text"  value="<?=$row->no_hp?>"style="width:30%" maxlength="14">
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
