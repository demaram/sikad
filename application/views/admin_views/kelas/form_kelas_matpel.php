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

                    if ($segment == 'edit_kelas_matpel') {
                         $nama_form = 'proses_edit_kmp';
                    }
                    elseif ($segment == 'add_kelas_matpel') {
                         $nama_form = 'proses_tambah_kmp';
                    }


                    $id = $this->input->get('id');
                    $id_kls = $this->input->get('id_kls');

                    $data_kelas_matpel = $this->db->query("SELECT * FROM kelas_matpel WHERE id_kelas_matpel = '$id' ");
                    $data_kelas = $this->db->query("SELECT * FROM kelas where id_kelas = '$id_kls'");

                    $arr_idmt = array();
                    foreach ($data_kelas_matpel->result() as $row) {
                         $arr_idmt[] = $row->id_matpel;
                    }
                    foreach ($data_kelas->result() as $r_kls){}
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

                                        <form class="form-horizontal" action="<?=base_url()?>admin/kelas/<?=$nama_form?>" role="form" method="post" enctype="multipart/form-data" >

                                             <input type="hidden" name="id" value="<?=$row->id_kelas_matpel?>">
                                             <input type="hidden" name="id_link" value="<?=$id_kls?>">

                                             <div class="form-group">
                                                <label class="col-lg-2 control-label" for="required">Nama Kelas</label>
                                                      <div class="col-lg-8">
                                                 <input maxlength="60" name="nm_kelas" disabled required="true" class="form-control required" id="nama_kelas" type="text"  value="<?=$r_kls->nama_kelas;?>" size="50">
                                                 <input name="id_kelas"  class="form-control required" id="id_kelas" type="hidden"  value="<?=$r_kls->id_kelas;?>">
                                                 </div><div class="fix"></div>
                                            </div>


                                           <?php
                                                  $qfilter = $this->db->query("SELECT * FROM kelas_matpel where id_kelas='$id_kls'");
                                                  $jamke = array();
                                                  foreach ($qfilter->result() as $filter) {
                                                        $jamke[] = $filter->jam_ke; // jam_ke yang tersedia dijadikan array
                                                  }

                                                  $diff  =array($row->jam_ke);// array di bagian edit

                                                  $final = array_diff($jamke, $diff);// remove array


                                            ?>


                                            <div class="form-group">
                                               <label class="col-lg-2 control-label"   for="required">Jam Ke-</label>
                                                     <div class="col-lg-3">
                                                          <select name="jam_ke" class="form-control" id="jam_ke" required="true">
                                                               <option value=""></option>
                                                                 <?php
                                                                 if ($segment == 'add_kelas_matpel') {

                                                                      for ($i = 1; $i <=10; $i++) {

                                                                           if (!in_array($i,$final)) { // menampilkan $i yang tidak didalam array
                                                                           ?>
                                                                           <option <?php if ($row->jam_ke == $i): ?>
                                                                                 selected="selected"
                                                                           <?php endif; ?> value="<?=$i;?>"> <?=$i;?> </option>
                                                                      <?php }
                                                                      }
                                                                 }else {
                                                                      for ($i = 1; $i <=10; $i++) {
                                                                           ?>
                                                                           <option <?php if ($row->jam_ke == $i): ?>
                                                                                 selected="selected"
                                                                           <?php endif; ?> value="<?=$i;?>"> <?=$i;?> </option>
                                                                           <?php
                                                                      }
                                                                 }
                                                                 ?>
                                                          </select>
                                                </div><div class="fix"></div>
                                           </div>

                                            <div class="form-group">
                                               <label class="col-lg-2 control-label"   for="required">Jam Mulai Pelajaran</label>
                                                     <div class="col-lg-3">
                                                <input name="jam_mulai" required="true" class="form-control timepicker" id="jam_mulai" type="text"   value="<?=$row->jam_mulai;?>" size="50">

                                                </div><div class="fix"></div>
                                           </div>

                                           <div class="form-group">
                                              <label class="col-lg-2 control-label"  for="required">Jam Selesai Pelajaran</label>
                                                   <div class="col-lg-3">
                                              <input name="jam_selesai" required="true" class="form-control timepicker" id="jam_selesai" type="text"   value="<?=$row->jam_selesai;?>" size="50">

                                              </div><div class="fix"></div>
                                         </div>

                                            <div class="form-group">
                                               <label class="col-lg-2 control-label"  for="required">Senin</label>
                                                     <div class="col-lg-4">
                                                          <select name="id_matpel_senin" class="form-control" id="id_matpel_senin">

                                                                 <?php

                                                                      $qpel = $this->db->query("SELECT * FROM mata_pelajaran WHERE 1=1");
                                                                      foreach ($qpel->result()as $rpel) { ?>
                                                                           <option <?php if ($row->id_matpel_senin == $rpel->id_matpel): ?>
                                                                                 selected="selected"
                                                                           <?php endif; ?> value="<?=$rpel->id_matpel?>"> <?=$rpel->nama_matpel?> </option>
                                                                      <?php }
                                                                 ?>
                                                          </select>
                                                </div><div class="fix"></div>
                                             </div>



                                             <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">Selasa</label>
                                                     <div class="col-lg-4">
                                                          <select name="id_matpel_selasa" class="form-control" id="id_matpel_selasa">
                                                                 <?php

                                                                      $qpel = $this->db->query("SELECT * FROM mata_pelajaran WHERE 1=1");
                                                                      foreach ($qpel->result()as $rpel) { ?>
                                                                           <option <?php if ($row->id_matpel_selasa == $rpel->id_matpel): ?>
                                                                                 selected="selected"
                                                                           <?php endif; ?> value="<?=$rpel->id_matpel?>"> <?=$rpel->nama_matpel?> </option>
                                                                      <?php }
                                                                 ?>
                                                          </select>
                                                </div><div class="fix"></div>
                                             </div>

                                             <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">Rabu</label>
                                                     <div class="col-lg-4">
                                                          <select name="id_matpel_rabu" class="form-control" id="id_matpel_rabu">

                                                                 <?php

                                                                      $qpel = $this->db->query("SELECT * FROM mata_pelajaran WHERE 1=1");
                                                                      foreach ($qpel->result()as $rpel) { ?>
                                                                           <option <?php if ($row->id_matpel_rabu == $rpel->id_matpel): ?>
                                                                                 selected="selected"
                                                                           <?php endif; ?> value="<?=$rpel->id_matpel?>"> <?=$rpel->nama_matpel?> </option>
                                                                      <?php }
                                                                 ?>
                                                          </select>
                                                </div><div class="fix"></div>
                                             </div>

                                             <div class="form-group">
                                               <label class="col-lg-2 control-label"  for="required">Kamis</label>
                                                     <div class="col-lg-4">
                                                          <select name="id_matpel_kamis" class="form-control" id="id_matpel_kamis">

                                                                 <?php

                                                                      $qpel = $this->db->query("SELECT * FROM mata_pelajaran WHERE 1=1");
                                                                      foreach ($qpel->result()as $rpel) { ?>
                                                                           <option <?php if ($row->id_matpel_kamis == $rpel->id_matpel): ?>
                                                                                 selected="selected"
                                                                           <?php endif; ?> value="<?=$rpel->id_matpel?>"> <?=$rpel->nama_matpel?> </option>
                                                                      <?php }
                                                                 ?>
                                                          </select>
                                                </div><div class="fix"></div>
                                             </div>

                                             <div class="form-group">
                                               <label class="col-lg-2 control-label"  for="required">Jumat</label>
                                                     <div class="col-lg-4">
                                                          <select name="id_matpel_jumat" class="form-control" id="id_matpel_jumat">

                                                                 <?php

                                                                      $qpel = $this->db->query("SELECT * FROM mata_pelajaran WHERE 1=1");
                                                                      foreach ($qpel->result()as $rpel) { ?>
                                                                           <option <?php if ($row->id_matpel_jumat == $rpel->id_matpel): ?>
                                                                                 selected="selected"
                                                                           <?php endif; ?> value="<?=$rpel->id_matpel?>"> <?=$rpel->nama_matpel?> </option>
                                                                      <?php }
                                                                 ?>
                                                          </select>
                                                </div><div class="fix"></div>
                                             </div>

                                             <div class="form-group">
                                               <label class="col-lg-2 control-label" for="required">Sabtu</label>
                                                     <div class="col-lg-4">
                                                          <select name="id_matpel_sabtu" class="form-control" id="id_matpel_sabtu">

                                                                 <?php

                                                                      $qpel = $this->db->query("SELECT * FROM mata_pelajaran WHERE 1=1");
                                                                      foreach ($qpel->result()as $rpel) { ?>
                                                                           <option <?php if ($row->id_matpel_sabtu == $rpel->id_matpel): ?>
                                                                                 selected="selected"
                                                                           <?php endif; ?> value="<?=$rpel->id_matpel?>"> <?=$rpel->nama_matpel?> </option>
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
