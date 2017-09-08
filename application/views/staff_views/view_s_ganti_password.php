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
                    }elseif ($segment == 'ganti_password') {
                         $nama_form = 'proses_password';
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

                                        <form class="form-horizontal" action="<?=base_url()?>staff/home/proses_password" role="form" method="post" enctype="multipart/form-data" >




<script type="text/javascript">
     $(document).ready(function(){
          $("#re_password").keyup(function(){
               var pwd = $("#password").val();
               var confirm_pwd = $("#re_password").val();

               if (pwd != confirm_pwd ) {
                    $("#pesan_password").html("<span class='label label-danger'>Password Not Match</span>");
               }else {
                    $("#pesan_password").html("<span class='label label-success'>Password Match</span>");
               }

          });
     });
</script>

<script type="text/javascript">
     $(document).ready(function(){
          $("#old_pass").change(function(){
               var old_pass = $("#old_pass").val();
               var id_user = $("#id_guru").val();
               $.ajax({
                    type : "POST",
                    url : "<?=base_url();?>staff/home/ajax_password",
                    data : {old_pass:old_pass, id_user:id_user},
                    success : function(data){
                         $("#pesan_password_ajax").html(data);
                    }

               })
          });
     });
</script>

<script type="text/javascript">
     $(document).ready(function(){
          $("#submit").click(function(){
               var pwd = $("#password").val();
               var confirm_pwd = $("#re_password").val();
               var old_pass =  $("#old_pass").val();
               var tidak_match = $("#tidak_match").val();
               if (pwd != confirm_pwd ) {
                    alert("Password tidak sama silahkan isi password dan ulangi password dengan benar");
                    return false;
               }else if (old_pass == '') {
                    alert("Password Lama Masih Kosong");
                    return false;
               }else if (tidak_match =='tidak_match') {
                    alert("Password Tidak Match");
                    return false;
               }
               else {
                    $("#pesan_password").html("<span class='label label-success'>Password Match</span>");
               }

          });
     });
</script>

                                             <div class="form-group">
                                                 <label class="col-lg-2 control-label" for="required">Password Lama</label>
                                                      <div class="col-lg-8">
                                                 <input name="old_pass"  required="true" class="form-control required" id="old_pass" type="password">

                                                 <input type="hidden" name="id_guru" id="id_guru" value="<?=$id_guru?>">
                                                 <span id="pesan_password_ajax"></span>
                                                 </div><div class="fix"></div>
                                             </div>

                                             <div class="form-group">
                                                 <label class="col-lg-2 control-label" for="required">Password Baru</label>
                                                      <div class="col-lg-8">
                                                 <input name="password"  required="true" class="form-control required" id="password" type="password" >
                                                 </div><div class="fix"></div>
                                             </div>

                                             <div class="form-group">
                                                <label class="col-lg-2 control-label" for="required">Ulangi Password</label>
                                                     <div class="col-lg-8">
                                                <input name="re_password"  required="true" class="form-control required" id="re_password" type="password">
                                                <span id="pesan_password"></span>
                                                </div><div class="fix"></div>
                                            </div>



                                           <br clear="all" />

                                             <div class="form-group">
                                               <div class="col-md-offset-1">
                                                   <button type="submit" class="btn btn-default marginR10" id="submit">Proses</button>

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
