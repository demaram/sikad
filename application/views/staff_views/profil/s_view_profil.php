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
               <?php
                    $data = $this->db->query("SELECT * FROM users where username='$username' ");
                    foreach ($data->result() as $row) {
                    }
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
                                        <div class="profile-header">

										<img src="<?=base_url()?>assets/foto/<?=$row->photo?>" class="img-circle" alt="Avatar" style="width:200px;height:200px">
										<h3 class="name"><?=$row->username?></h3>

								</div>
                                        <div class="profile-detail">
 									<div class="profile-info">
 										<h4 class="heading">Basic Info</h4>
 										<ul class="list-unstyled list-justify">
                                                  	<li>Username<span><?=$row->username?></span></li>
                                                       <li>Nama<span><?=$row->nama?></span></li>
 											<li>Tanggal Lahir<span><?=date('d F Y',strtotime($row->tgl_lahir))?></span></li>
 											<li>No Tel <span><?=$row->no_hp?></span></li>
 											<li>Email <span><?=$row->email?></span></li>

 										</ul>
 									</div>
 									<div class="text-center"><a href="<?=base_url()?>staff/profil/edit_data?id=<?=$row->id_user?>" class="btn btn-primary">Edit Profile</a></div>
 								</div>

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
