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
                         ?><script type="text/javascript">
                              $(document).ready(function(){
                                   $("#id_smt").keyup(function(){
                                     var id_smt = $("#id_smt").val();
                                      $.ajax({
                                             type : "POST",
                                             url : "<?=base_url();?>admin/master_data_semester/cek_smt",
                                             data : "id_smt=" + id_smt,
                                             success : function(data){
                                                  $("#pesan").html(data);
                                             }
                                      });
                                   });
                              });
                         </script>
                   <?php }


                    $id = $this->input->get('id');
                    $data = $this->db->query("SELECT * FROM master_data_semester WHERE id_smt = '$id'");
                    foreach ($data->result() as $row) {

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

                                        <form class="form-horizontal" action="<?=base_url()?>admin/master_data_semester/<?=$nama_form?>" role="form" method="post" enctype="multipart/form-data" >


                                             <input type="hidden" name="id" value="<?=$row->id_smt?>">
                                             <div class="form-group">
                                                <label class="col-lg-2 control-label" for="required">ID Semester</label>
                                                      <div class="col-lg-8">
                                                 <input maxlength="5" name="id_smt" required="true" class="form-control required number" id="id_smt" type="text"  value="<?=$row->id_smt;?>" size="50">
                                                 <div id="pesan"></div>
                                                 </div><div class="fix"></div>
                                            </div>

                                             <div class="form-group">
                                                <label class="col-lg-2 control-label" for="required">Nama Semester</label>
                                                      <div class="col-lg-8">
                                                 <input maxlength="60" name="nama_smt" required="true" class="form-control required" id="nama_smt" type="text"  value="<?=$row->nama_smt;?>" size="50">
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
