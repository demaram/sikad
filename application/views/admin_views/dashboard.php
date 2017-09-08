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


			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Weekly Overview</h3>
							<p class="panel-subtitle"></p>
						</div>
						<div class="panel-body">
							<div class="row">

								<div class="col-md-3">
                                             <a href="<?=base_url()?>admin/data_siswa">
									<div class="metric">
										<span class="icon"><i class="fa fa-download"></i></span>
										<p>
											<span class="number"><?=$jumlah_siswa?></span>
											<span class="title">Siswa</span>
										</p>
									</div> </a>
								</div>
								<div class="col-md-3">
									<a href="<?=base_url()?>admin/data_guru">
                                                  <div class="metric">
										<span class="icon"><i class="fa fa-shopping-bag"></i></span>
										<p>
											<span class="number"><?=$jumlah_guru?></span>
											<span class="title">Guru</span>
										</p>
								       	</div>
                                             </a>
								</div>
								<div class="col-md-3">
                                             <a href="<?=base_url()?>admin/kelas">
									<div class="metric">
										<span class="icon"><i class="fa fa-eye"></i></span>
										<p>
											<span class="number"><?=$jumlah_kelas?></span>
											<span class="title">Kelas</span>
										</p>
									</div>
                                             </a>
								</div>
								<div class="col-md-3">
                                             <a href="<?=base_url()?>admin/mata_pelajaran">
									<div class="metric">
										<span class="icon"><i class="fa fa-bar-chart"></i></span>
										<p>
											<span class="number"><?=$jumlah_matpel?></span>
											<span class="title">Mata Pelajaran</span>
										</p>
									</div>
                                             </a>
								</div>
							</div>
                    </div>   </div>

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
