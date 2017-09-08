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

                                   <h3>Berita Akademik</h3>
						</div>
						<div class="panel-body">

                                   <?php
                                       $berita =  $this->db->query("SELECT * FROM berita WHERE 1=1");
                                   foreach ($berita->result() as $row ) {

                                    ?>
							<div class="row">
                                        <div class="col-md-12">
          							<div class="panel panel-headline">
          								<div class="panel-heading">
          									<h3 class="panel-title"><?=$row->judul?></h3>
          									<p class="panel-subtitle"><?=date('d-m-Y',strtotime($row->tanggal))?></p>
          								</div>
          								<div class="panel-body">
          									<?=$row->isi?>
          								</div>
          							</div>
          							<!-- END PANEL HEADLINE -->
          						</div>
							</div>
                                   <?php } ?>
                    </div>   </div>

			</div>
			<!-- END MAIN CONTENT -->
			<footer>

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
