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
                    elseif ($segment == 'add_data') {
                         $nama_form = 'proses_tambah';
                    }


                    $id = $this->input->get('id');
                    $id_kls = $this->input->get('id_kls');

                    $data_kelas_matpel = $this->db->query("SELECT * FROM kelas_matpel WHERE id_kelas_matpel = '$id' ");

                    $data_kelas = $this->db->query("SELECT * FROM kelas where id_kelas = '$id_kls'");



                    $arr_idmt = array();
                    foreach ($data_kelas_matpel->result() as $row) {
                         $arr_idmt[] = $row->id_matpel;
                    }
                    foreach ($data_kelas->result() as $r_kls){

                    }

                    $data_jadwal = $this->db->query("SELECT * FROM kelas_matpel where id_kelas NOT IN('$id_kls') AND jam_ke ='$row->jam_ke' ");

                    foreach ($data_jadwal->result() as $r_jadwal){

                         $seleksi_senin[] = $r_jadwal->id_guru_senin;
                         $seleksi_selasa[] = $r_jadwal->id_guru_selasa;
                         $seleksi_rabu[] = $r_jadwal->id_guru_rabu;
                         $seleksi_kamis[] = $r_jadwal->id_guru_kamis;
                         $seleksi_jumat[] = $r_jadwal->id_guru_jumat;
                         $seleksi_sabtu[] = $r_jadwal->id_guru_sabtu;
                    }

                   $imp_s_senin = implode(',',$seleksi_senin);
                   $imp_s_selasa = implode(',',$seleksi_selasa);
                   $imp_s_rabu = implode(',',$seleksi_rabu);
                   $imp_s_kamis = implode(',',$seleksi_kamis);
                   $imp_s_jumat = implode(',',$seleksi_jumat);
                   $imp_s_sabtu = implode(',',$seleksi_sabtu);


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

                                        <form class="form-horizontal" action="<?=base_url()?>admin/jadwal_guru/<?=$nama_form?>" role="form" method="post" enctype="multipart/form-data" >

                                             <input type="hidden" name="id" value="<?=$row->id_kelas_matpel?>">
                                             <input type="hidden" name="id_link" value="<?=$id_kls?>">

                                             <div class="form-group">
                                                <label class="col-lg-2 control-label" style="text-align:left" for="required">Nama Kelas</label>
                                                      <div class="col-lg-8">
                                                 <input maxlength="60" name="nm_kelas" disabled required="true" class="form-control required" id="nama_kelas" type="text"  value="<?=$r_kls->nama_kelas;?>" size="50">
                                                 <input name="id_kelas"  class="form-control required" id="id_kelas" type="hidden"  value="<?=$r_kls->id_kelas;?>">
                                                 </div><div class="fix"></div>
                                            </div>

                                            <div class="form-group">
                                               <label class="col-lg-2 control-label"  style="text-align:left" for="required">Jam Ke-</label>
                                                     <div class="col-lg-3">
                                                <input name="jam_ke" required="true" disabled class="form-control number" id="jam_ke" type="text"   value="<?=$row->jam_ke;?>" size="50">
                                                </div><div class="fix"></div>
                                           </div>

                                            <div class="form-group">
                                               <label class="col-lg-2 control-label"  style="text-align:left" for="required">Jam Mulai Pelajaran</label>
                                                     <div class="col-lg-3">
                                                <input name="jam_mulai" required="true" class="form-control timepicker" id="jam_mulai" type="text" disabled   value="<?=$row->jam_mulai;?>" size="50">

                                                </div><div class="fix"></div>
                                           </div>

                                           <div class="form-group">
                                              <label class="col-lg-2 control-label" style="text-align:left" for="required">Jam Selesai Pelajaran</label>
                                                   <div class="col-lg-3">
                                              <input name="jam_selesai" required="true" class="form-control timepicker" id="jam_selesai" type="text" disabled  value="<?=$row->jam_selesai;?>" size="50">

                                              </div><div class="fix"></div>
                                         </div>

                                            <div class="form-group">
                                               <label class="col-lg-2 control-label"  style="text-align:left" for="required">Senin</label>
                                                     <div class="col-lg-4">
                                                          <select name="id_guru_senin" class="form-control" id="id_guru_senin">
                                                               <option value="-">-</option>
                                                                 <?php
                                                                      $qguru = $this->db->query("SELECT * FROM users WHERE id_level = '3' AND id_user NOT IN ($imp_s_senin)");
                                                                      foreach ($qguru->result()as $rguru) { ?>
                                                                           <option <?php if ($row->id_guru_senin == $rguru->id_user): ?>
                                                                                 selected="selected"
                                                                           <?php endif; ?> value="<?=$rguru->id_user?>"> <?=$rguru->nama?> </option>
                                                                      <?php }
                                                                 ?>
                                                          </select>
                                                </div><div class="fix"></div>
                                             </div>



                                             <div class="form-group">
                                               <label class="col-lg-2 control-label" style="text-align:left" for="required">Selasa</label>
                                                     <div class="col-lg-4">
                                                          <select name="id_guru_selasa" class="form-control" id="id_guru_selasa">
                                                               <option value="-">-</option>
                                                                 <?php
                                                                 $qguru = $this->db->query("SELECT * FROM users WHERE id_level = '3' AND id_user NOT IN ($imp_s_selasa)");
                                                                 foreach ($qguru->result()as $rguru) { ?>
                                                                      <option <?php if ($row->id_guru_selasa == $rguru->id_user): ?>
                                                                           selected="selected"
                                                                      <?php endif; ?> value="<?=$rguru->id_user?>"> <?=$rguru->nama?> </option>
                                                                 <?php }
                                                                 ?>
                                                          </select>
                                                </div><div class="fix"></div>
                                             </div>

                                             <div class="form-group">
                                               <label class="col-lg-2 control-label" style="text-align:left" for="required">Rabu</label>
                                                     <div class="col-lg-4">
                                                          <select name="id_guru_rabu" class="form-control" id="id_guru_rabu">
                                                               <option value="-">-</option>
                                                                 <?php

                                                                      $qguru = $this->db->query("SELECT * FROM users WHERE id_level = '3' AND id_user NOT IN ($imp_s_rabu)");
                                                                     foreach ($qguru->result()as $rguru) { ?>
                                                                          <option <?php if ($row->id_guru_rabu == $rguru->id_user): ?>
                                                                               selected="selected"
                                                                          <?php endif; ?> value="<?=$rguru->id_user?>"> <?=$rguru->nama?> </option>
                                                                     <?php }
                                                                 ?>
                                                          </select>
                                                </div><div class="fix"></div>
                                             </div>

                                             <div class="form-group">
                                               <label class="col-lg-2 control-label" style="text-align:left" for="required">Kamis</label>
                                                     <div class="col-lg-4">
                                                          <select name="id_guru_kamis" class="form-control" id="id_guru_kamis">
                                                               <option value="-">-</option>
                                                                 <?php

                                                                           $qguru = $this->db->query("SELECT * FROM users WHERE id_level = '3' AND id_user NOT IN ($imp_s_kamis)");
                                                                           foreach ($qguru->result()as $rguru) { ?>
                                                                                <option <?php if ($row->id_guru_kamis == $rguru->id_user): ?>
                                                                                     selected="selected"
                                                                                <?php endif; ?> value="<?=$rguru->id_user?>"> <?=$rguru->nama?> </option>
                                                                           <?php }
                                                                 ?>
                                                          </select>
                                                </div><div class="fix"></div>
                                             </div>

                                             <div class="form-group">
                                               <label class="col-lg-2 control-label" style="text-align:left" for="required">Jumat</label>
                                                     <div class="col-lg-4">
                                                          <select name="id_guru_jumat" class="form-control" id="id_guru_jumat">
                                                               <option value="-">-</option>
                                                                 <?php

                                                                      $qguru = $this->db->query("SELECT * FROM users WHERE id_level = '3' AND id_user NOT IN ($imp_s_jumat)");
                                                                     foreach ($qguru->result()as $rguru) { ?>
                                                                          <option <?php if ($row->id_guru_jumat == $rguru->id_user): ?>
                                                                               selected="selected"
                                                                          <?php endif; ?> value="<?=$rguru->id_user?>"> <?=$rguru->nama?> </option>
                                                                     <?php }
                                                                 ?>
                                                          </select>
                                                </div><div class="fix"></div>
                                             </div>

                                             <div class="form-group">
                                               <label class="col-lg-2 control-label" style="text-align:left" for="required">Sabtu</label>
                                                     <div class="col-lg-4">
                                                          <select name="id_guru_sabtu" class="form-control" id="id_guru_sabtu">
                                                               <option value="-">-</option>
                                                                 <?php

                                                                      $qguru = $this->db->query("SELECT * FROM users WHERE id_level = '3' AND id_user NOT IN ($imp_s_sabtu)");
                                                                     foreach ($qguru->result()as $rguru) { ?>
                                                                          <option <?php if ($row->id_guru_sabtu == $rguru->id_user): ?>
                                                                               selected="selected"
                                                                          <?php endif; ?> value="<?=$rguru->id_user?>"> <?=$rguru->nama?> </option>
                                                                     <?php }
                                                                 ?>
                                                          </select>
                                                </div><div class="fix"></div>
                                             </div>


                                           <br clear="all" />

                                             <div class="form-group">
                                               <div class="col-md-offset-1">
                                                   <button type="submit" id="submit" class="btn btn-default marginR10">Proses</button>
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
