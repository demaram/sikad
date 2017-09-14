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
                    $data_skala = $this->db->query("SELECT * FROM skala_nilai WHERE id_skala_nilai = '$id'");
                    $row = $data_skala->result();
                    foreach ($data_skala->result() as $row) {

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

                                        <form class="form-horizontal" action="<?=base_url()?>admin/master_skala_nilai/<?=$nama_form?>" role="form" method="post" enctype="multipart/form-data" >

                                             <input type="hidden" name="id" value="<?=$row->id_skala_nilai?>">

                                             <div class="form-group">
                                                <label class="col-lg-2 control-label" for="required">Nilai Huruf</label>
                                                      <div class="col-lg-3">
                                                 <input maxlength="3" name="nilai_huruf" required="true" class="form-control required" id="nilai_huruf" type="text"  value="<?=$row->nilai_huruf;?>" size="50">
                                                 </div><div class="fix"></div>
                                            </div>

                                            <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">Nilai Index</label>
                                                     <div class="col-lg-3">
                                                <input maxlength="3" name="nilai_index" required="true" class="form-control required number" id="nilai_index" type="text"  value="<?=$row->nilai_index;?>" placeholder="0-100">
                                                </div><div class="fix"></div>
                                           </div>

                                                <div class="form-group">
                                                   <label class="col-lg-2 control-label" for="required">Nilai Minimum</label>
                                                        <div class="col-lg-3">
                                                   <input maxlength="3" name="nilai_minimum" required="true" class="form-control required number" id="nilai_minimum" type="text"  value="<?=$row->nilai_minimum;?>"placeholder="0-100" >
                                                   </div><div class="fix"></div>
                                              </div>

                                              <div class="form-group">
                                                <label class="col-lg-2 control-label" for="required">Nilai Maksimum</label>
                                                     <div class="col-lg-3">
                                                <input maxlength="3" name="nilai_maksimum" required="true" class="form-control required number" id="nilai_maksimum" type="text"  value="<?=$row->nilai_maksimum;?>" placeholder="0-100">
                                                </div><div class="fix"></div>
                                           </div>


 <script type="text/javascript">
      $(document).ready(function(){

          $("#nilai_maksimum").change(function(){
               var nilai = $("#nilai_maksimum").val();
               if (nilai >= 100) {
                    $("#nilai_maksimum").val("100");
               }

          })

          $("#nilai_minimum").change(function(){
               var nilai = $("#nilai_minimum").val();
               if (nilai >= 100) {
                    $("#nilai_minimum").val("100");
               }

          })

          $("#nilai_index").change(function(){
               var nilai = $("#nilai_index").val();
               if (nilai >= 100) {
                    $("#nilai_index").val("100");
               }

          })

      });
 </script>


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
