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
                    $data_kelas = $this->db->query("SELECT * FROM kelas");
                ?>

			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
				<!-- OVERVIEW -->

                         <div class="panel panel-headline">
                              <div class="panel">
                                   <div class="panel-heading">
                                       <h2 class="panel-title"><?=$judul?></h2>
                                       <div class="right">
                                             <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                                       </div>
                                   </div>
                                   <div class="panel-body no-padding">
                                        <ul class="list-unstyled todo-list">

                                                  <?php
                                                       $pr_siswa = $this->db->query("SELECT * FROM tbl_pr WHERE DATE(NOW()) between tgl_awal and tgl_akhir AND id_kelas='$id_kelas' AND id_smt='$id_smt' ");
                                                       $no = 1;
                                                       foreach ($pr_siswa->result() as $row) {
                                                            $matpel = $this->db->query("SELECT nama_matpel from mata_pelajaran where id_matpel = '$row->id_matpel'");
                                                            foreach ($matpel->result() as $matpel) {

                                                            }
                                                   ?>
										<li style="padding-left:30px;">
											<p>
												<h4><?=$no?>. <?=$matpel->nama_matpel?></h4>
												<span style="margin-left:15px;"><?=$row->detail?></span><br>
												<span style="margin-left:15px;">Tanggal Dikumpulkan :</span><span class="date" style="padding-left:10px"><?=date('d M Y',strtotime($row->tgl_akhir))?></span>
											</p>
											<div class="controls">
												<a href="#"><i class="icon-software icon-software-pencil"></i></a> <a href="#"><i class="icon-arrows icon-arrows-circle-remove"></i></a>
											</div>
										</li>

                                                  <?php $no++;} ?>
                                         </ul>
                                   </div>

                              </div>
					</div>
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
