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
                    $data_berita = $this->db->query("SELECT * FROM berita WHERE id_berita = '$id'");
                    $row = $data_berita->result();
                    foreach ($data_berita->result() as $row) {

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

                                        <form class="form-horizontal" action="<?=base_url()?>admin/berita/<?=$nama_form?>" role="form" method="post" enctype="multipart/form-data" >

                                             <input type="hidden" name="id" value="<?=$row->id_berita?>">

                                             <div class="form-group">
                                                <label class="col-lg-2 control-label" for="required">Judul Berita</label>
                                                      <div class="col-lg-8">
                                                 <textarea name="judul" class="form-control tinymce" rows="2" cols="30" maxlength="50"><?=$row->judul?></textarea>
                                                 </div><div class="fix"></div>
                                            </div>

                                              <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">Publisher</label>
                                                     <div class="col-lg-3">
                                                <input disabled class="form-control required "type="text"  value="<?=$username;?>">
                                                <input type="hidden"  name="publisher" value="<?=$username;?>" id="publisher">
                                                </div><div class="fix"></div>
                                             </div>

                                              <div class="form-group">
                                                   <label class="col-lg-2 control-label" for="required">Tanggal Publish</label>
                                                        <div class="col-lg-3">
                                                   <input name="tanggal" disabled class="form-control required" id="tanggal" type="text"  value="<?=date('Y/m/d')?>">
                                                   </div><div class="fix"></div>
                                              </div>

                                              <div class="form-group">
                                                   <label class="col-lg-2 control-label" for="required">Isi</label>
                                                        <div class="col-lg-8">
                                                           <textarea name="isi" class="form-control tinymce" rows="8" cols="80"><?=$row->isi?></textarea>
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
