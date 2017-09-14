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
                    $data_guru = $this->db->query("SELECT * FROM users WHERE id_user = '$id' AND id_level='3'");
                    $row = $data_guru->result();
                    foreach ($data_guru->result() as $row) {

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

                                        <form class="form-horizontal" action="<?=base_url()?>admin/data_guru/<?=$nama_form?>" role="form" method="post" enctype="multipart/form-data" >

                                             <input type="hidden" name="id" value="<?=$row->id_user?>">

                                             <div class="form-group">
                                                <label class="col-lg-2 control-label" for="required">Nama Guru</label>
                                                      <div class="col-lg-8">
                                                 <input maxlength="60" name="nama" required="true" class="form-control required" id="nama" type="text"  value="<?=$row->nama;?>" >
                                                 </div><div class="fix"></div>
                                            </div>

                                            <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">Gelar</label>
                                                     <div class="col-lg-8">
                                                <input maxlength="60" name="gelar" class="form-control required" id="gelar" type="text"  placeholder="" value="<?=$row->gelar;?>" >
                                                </div><div class="fix"></div>
                                           </div>

                                           <div class="form-group">
                                              <label class="col-lg-2 control-label" for="required">Pendidikan</label>
                                                   <div class="col-lg-8">
                                              <select name="id_pendidikan" class="form-control" id="id_pendidikan">
                                                               <option value="">Pilih Pendidikan</option>
                                                     <?php
                                                          $qpen = $this->db->query("SELECT * FROM jenjang_pendidikan where id_pendidikan > 9");

                                                          foreach ($qpen->result()as $rpen) { ?>
                                                               <option <?php if ($row->id_pendidikan == $rpen->id_pendidikan): ?>
                                                                     selected="selected"
                                                               <?php endif; ?> value="<?=$rpen->id_pendidikan?>"> <?=$rpen->nama_pendidikan?> </option>
                                                          <?php }
                                                     ?>
                                              </select>
                                              </div><div class="fix"></div>
                                         </div>

                                             <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">NIK / No KTP</label>
                                                     <div class="col-lg-8">
                                                <input maxlength="16" name="nik"  required="true" class="form-control required number" id="nik" type="text"  value="<?=$row->nik?>" >
                                                </div><div class="fix"></div>
                                           </div>

                                           <div class="form-group">
                                             <label class="col-lg-2 control-label" for="required">Nomor Induk Pegawai</label>
                                                   <div class="col-lg-8">
                                              <input maxlength="18" name="nip"  required="true" class="form-control required number" id="nip" type="text"  value="<?=$row->nip?>">
                                              </div><div class="fix"></div>
                                         </div>

                                             <div class="form-group">
                                                 <label class="col-lg-2 control-label" for="required">Username</label>
                                                      <div class="col-lg-8">
                                                 <input maxlength="20" name="username"  required="true" class="form-control required" id="username" type="text"  value="<?=$row->username?>" size="50">
                                                 </div><div class="fix"></div>
                                             </div>
<!--
    Jquey Password
-->
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
          $("#submit").click(function(){
               var pwd = $("#password").val();
               var confirm_pwd = $("#re_password").val();

               if (pwd != confirm_pwd ) {
                    alert("Password tidak sama silahkan isi password dan ulangi password dengan benar");
                    return false;
               }else {
                    $("#pesan_password").html("<span class='label label-success'>Password Match</span>");
               }

          });
     });
</script>                               <?php if ($segment == 'tambah_data'): ?>

                                             <div class="form-group">
                                                 <label class="col-lg-2 control-label" for="required">Password</label>
                                                      <div class="col-lg-8">
                                                 <input name="password"  required="true" class="form-control required" id="password" type="password"  value="<?=$row->password?>">
                                                 </div><div class="fix"></div>
                                             </div>

                                             <div class="form-group">
                                                <label class="col-lg-2 control-label" for="required">Ulangi Password</label>
                                                     <div class="col-lg-8">
                                                <input name="re_password"  required="true" class="form-control required" id="re_password" type="password"  value="<?=$row->re_password?>">
                                                <span id="pesan_password"></span>
                                                </div><div class="fix"></div>
                                            </div>

                                            <?php endif; ?>

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
                                               <label class="col-lg-2 control-label" for="required">Jenis Kelamin</label>
                                                     <div class="col-lg-8">
                                                <select class="form-control" required ="true" name="jk">
                                                     <option value="">Pilih Jenis Kelamin</option>
                                                     <option <?php if($row->jk == 'L') echo "selected='selected'"; ?> value="L">Laki Laki</option>
                                                     <option <?php if($row->jk == 'P') echo "selected='selected'"; ?> value="P">Perempuan</option>
                                                </select>
                                                </div><div class="fix"></div>
                                             </div>

                                             <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">Tempat Lahir</label>
                                                    <div class="col-lg-8">
                                               <input name="tmpt_lahir" class="form-control required" id="tmpt_lahir" type="text"  value="<?=$row->tmpt_lahir?>"style="width:50%">
                                               </div><div class="fix"></div>
                                           </div>

                                           <div class="form-group">
                                                 <label class="col-lg-2 control-label" for="required">Tanggal Lahir</label>
                                                      <div class="col-lg-8">
                                                 <input name="tgl_lahir" class="form-control datepicker" id="tgl_lahir" type="text"  value="<?=$row->tgl_lahir?>"style="width:50%">
                                                 </div><div class="fix"></div>
                                          </div>

                                          <div class="form-group">
                                                <label class="col-lg-2 control-label" for="required">Agama</label>
                                                     <div class="col-lg-8">
                                                <select name="id_agama" class="form-control" id="id_agama">
                                                                <option value="">Pilih Agama</option>
                                                      <?php
                                                            $q_agm = $this->db->query("SELECT * FROM jenis_agama");

                                                            foreach ($q_agm->result()as $r_agm) { ?>
                                                                 <option <?php if ($row->id_agama == $r_agm->id_agama): ?>
                                                                      selected="selected"
                                                                 <?php endif; ?> value="<?=$r_agm->id_agama?>"> <?=$r_agm->nama_agama?> </option>
                                                           <?php }
                                                       ?>
                                                </select>
                                                </div><div class="fix"></div>
                                         </div>
<!--
    Ajax provinsi
-->
<script type="text/javascript">
     $(document).ready(function(){
          $("#kode_provinsi").change(function(){
            var kode_provinsi = $("#kode_provinsi").val();
             $.ajax({
                    type : "POST",
                    url : "<?=base_url();?>admin/data_guru/ajax_kabkot",
                    data : "kode_provinsi=" + kode_provinsi,
                    success : function(data){
                         $("#kode_kabkot").html(data);
                    }
             });
          });
     });
</script>

                                                   <div class="form-group">
                                                        <label class="col-lg-2 control-label" for="required">Provinsi</label>
                                                             <div class="col-lg-8">
                                                        <select name="kode_provinsi" class="form-control" id="kode_provinsi">
                                                                         <option value="">Pilih Provinsi</option>
                                                               <?php
                                                                    $q_prov = $this->db->query("SELECT * FROM tbl_wilayah where kode_kabkot ='00' order by nama_lokasi asc");

                                                                    foreach ($q_prov->result()as $r_prov) { ?>
                                                                         <option <?php if ($row->kode_provinsi == $r_prov->kode_provinsi): ?>
                                                                              selected="selected"
                                                                         <?php endif; ?> value="<?=$r_prov->kode_provinsi?>"> <?=$r_prov->nama_lokasi?> </option>
                                                                    <?php }
                                                               ?>
                                                        </select>
                                                        </div><div class="fix"></div>
                                                 </div>

                                                 <div class="form-group">
                                                      <label class="col-lg-2 control-label" for="required">Kabupaten/Kota</label>
                                                           <div class="col-lg-8"  id="tampil_kabkot">
                                                      <select name="kode_kabkot" class="form-control" id="kode_kabkot">
                                                                 <?php $qkab = $this->db->query("SELECT * FROM tbl_wilayah where kode_provinsi = '$row->kode_provinsi' and kode_kabkot = '$row->kode_kabkot' AND kode_kecamatan='00'");

                                                                      foreach ($qkab->result() as $rkab) {
                                                                           ?>
                                                                                <option value="<?=$rkab->kode_kabkot?>"> <?=$rkab->nama_lokasi?> </option>
                                                                   <?php   }
                                                                 ?>

                                                      </select>
                                                      </div><div class="fix"></div>
                                                 </div>


                                                 <div class="form-group">
                                                      <label class="col-lg-2 control-label" for="required">Alamat</label>
                                                           <div class="col-lg-8"  id="tampil_kabkot">
                                                               <textarea name="alamat" class="form-control" rows="8" cols="80"><?=$row->alamat?></textarea>
                                                      </div><div class="fix"></div>
                                                 </div>

                                                 <div class="form-group">
                                                       <label class="col-lg-2 control-label" for="required">Kode Pos</label>
                                                            <div class="col-lg-8">
                                                       <input name="kode_pos" class="form-control number" id="kode_pos" type="text"  value="<?=$row->kode_pos?>"style="width:30%" maxlength="5">
                                                       </div><div class="fix"></div>
                                                </div>

                                                <div class="form-group">
                                                     <label class="col-lg-2 control-label" for="required">Nomor Telepon Aktif</label>
                                                          <div class="col-lg-8">
                                                     <input name="no_hp" class="form-control number" id="no_hp" type="text"  value="<?=$row->no_hp?>"style="width:30%" maxlength="14">
                                                     </div><div class="fix"></div>
                                               </div>

                                               <div class="form-group">
                                                    <label class="col-lg-2 control-label" for="required">Email</label>
                                                         <div class="col-lg-8">
                                                    <input name="email" class="form-control" id="email" type="email"  value="<?=$row->email?>">
                                                    </div><div class="fix"></div>
                                              </div>

                                              <div class="form-group">
                                                   <label class="col-lg-2 control-label" for="required">Kewarganegaraan</label>
                                                        <div class="col-lg-8"  id="tampil_kabkot">
                                                   <select name="kode_negara" class="form-control" id="kode_negara">
                                                             <?php $data_negara = $this->db->query("SELECT * FROM tbl_negara where 1=1");

                                                                   foreach ($data_negara->result() as $rngr) {
                                                                        ?>
                                                                             <option <?php if ($row->kode_negara == $rngr->kode_negara): ?>
                                                                                  selected="selected"
                                                                             <?php endif; ?> value="<?=$rngr->kode_negara?>"> <?=$rngr->nama_negara?> </option>
                                                               <?php   }
                                                             ?>

                                                   </select>
                                                   </div><div class="fix"></div>
                                              </div>

                                              <hr>



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
