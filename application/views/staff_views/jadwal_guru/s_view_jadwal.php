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
                         <?php

                         $pesan = sha1('pesan');
                         $pesan=$_GET[$pesan];
               			switch ($pesan) {
 //                  alert tambah
               				case 'add_sukses':
               				?>
                                   <div class="alert alert-success">
                                               <button type="button" class="close" data-dismiss="alert">×</button>
                                               <strong>Success!</strong> Berhasil Tambah Data
                                           </div>
               				<?php
               				break;
               				case 'add_gagal':
               				?>
                                  <div class="alert alert-danger">
                                               <button type="button" class="close" data-dismiss="alert">×</button>
                                               <strong>Failed!</strong>Gagal Tambah Data
                                           </div>
               				<?php
               				break;
//                  alert edit
                                   case 'edit_sukses':
                                   ?>
                                   <div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <strong>Success!</strong>Sukses Edit Data
                                            </div>
                                   <?php
                                   break;

                                   case 'edit_gagal':
                                   ?>
                                   <div class="alert alert-danger">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <strong>Failed!</strong>Gagal Edit Data
                                           </div>
                                   <?php
                                   break;
//                  alert hapus
                                   case 'hapus_sukses':
                                   ?>
                                   <div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <strong>Success!</strong>Sukses Hapus Data
                                            </div>
                                   <?php
                                   break;

                                   case 'hapus_gagal':
                                   ?>
                                   <div class="alert alert-danger">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <strong>Failed!</strong>Gagal Hapus Data
                                           </div>
                                   <?php
                                   break;
               			}
                              ?>

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
                                      <form class="form-horizontal" action="" role="form" method="post" enctype="multipart/form-data" id="form_cari">

                                           <div class="form-group">
                                            <label class="col-lg-2 control-label"  for="required">Pilih Kelas</label>
                                                 <div class="col-lg-4">
                                                      <select name="id_kelas" class="form-control" id="id_kelas">
                                                           <option value="0">-- Pilih Kelas --</option>
                                                             <?php
                                                                    if (!empty($this->input->post('id_kelas'))) {
                                                                        $id_kelas = $this->input->post('id_kelas');
                                                                   }else {
                                                                        $id_kelas = $this->input->get('id_kelas');
                                                                   }

                                                                    $qkel = $this->db->query("SELECT * FROM kelas WHERE 1=1");
                                                                    foreach ($qkel->result()as $rkel) { ?>
                                                                         <option <?php if ($id_kelas == $rkel->id_kelas): ?>
                                                                              selected="selected"
                                                                         <?php endif; ?> value="<?=$rkel->id_kelas?>"> <?=$rkel->nama_kelas?> </option>
                                                                    <?php }
                                                             ?>
                                                      </select>
                                            </div><div class="fix"></div>
                                         </div>



                                         <div class="form-group">
                                           <div class="col-md-offset-1">
                                              <button type="submit" id="submit" class="btn btn-default marginR10">Cari</button>
                                           </div>
                                         </div><!-- End .form-group  -->

                                      </form>

                                   </div>

                              </div>
					</div>
                         <?php if (!empty($id_kelas)): ?>


                         <div class="panel panel-headline">
                              <div class="panel">
                                   <div class="panel-heading">
                                        <?php $rjudul = $this->db->query("SELECT * FROM kelas where id_kelas= '$id_kelas'");
                                             foreach ($rjudul->result() as $kelas) {}
                                         ?>
                                       <h3 class="panel-title"><?=$judul2.' kelas '. $kelas->nama_kelas?></h3>
                                       <div class="right">
                                             <a class="btn btn-primary" href="<?=base_url()?>admin/kelas/kelas_matpel?id=<?=$id_kelas?>">Lihat Jadwal Pelajaran</a>
                                             <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                                       </div>
                                   </div>
                                   <div class="panel-body no-padding">
                                        <table class="table table-striped">
                                             <thead>
                                                  <tr style="font-size:20px">
                                                       <th style="width:1%">Jam Ke</th>
                                                       <th style="width:2%">Mulai</th>
                                                       <th style="width:2%">Selesai</th>
                                                       <th style="width:10%" >Senin</th>
                                                       <th style="width:10%">Selasa</th>
                                                       <th style="width:10%">Rabu</th>
                                                       <th style="width:10%">Kamis</th>
                                                       <th style="width:10%">Jumat</th>
                                                       <th style="width:10%">Sabtu</th>

                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <?php
                                                  $data_kelas_matpel = $this->db->query("SELECT * FROM kelas_matpel where id_kelas='$id_kelas' order by jam_mulai asc");
                                                  $no = 1;



                                                  foreach ($data_kelas_matpel->result() as $row){

                                                       $data_matpel1 = $this->db->query("SELECT * FROM mata_pelajaran where id_matpel = '$row->id_matpel_senin'");
                                                       $data_matpel2 = $this->db->query("SELECT * FROM mata_pelajaran where id_matpel = '$row->id_matpel_selasa'");
                                                       $data_matpel3 = $this->db->query("SELECT * FROM mata_pelajaran where id_matpel= '$row->id_matpel_rabu'");
                                                       $data_matpel4 = $this->db->query("SELECT * FROM mata_pelajaran where id_matpel = '$row->id_matpel_kamis'");
                                                       $data_matpel5 = $this->db->query("SELECT * FROM mata_pelajaran where id_matpel = '$row->id_matpel_jumat'");
                                                       $data_matpel6 = $this->db->query("SELECT * FROM mata_pelajaran where id_matpel = '$row->id_matpel_sabtu'");

                                                       $data_guru1 = $this->db->query("SELECT * FROM users where id_user = '$row->id_guru_senin'");
                                                       $data_guru2 = $this->db->query("SELECT * FROM users where id_user = '$row->id_guru_selasa'");
                                                       $data_guru3 = $this->db->query("SELECT * FROM users where id_user= '$row->id_guru_rabu'");
                                                       $data_guru4 = $this->db->query("SELECT * FROM users where id_user = '$row->id_guru_kamis'");
                                                       $data_guru5 = $this->db->query("SELECT * FROM users where id_user = '$row->id_guru_jumat'");
                                                       $data_guru6 = $this->db->query("SELECT * FROM users where id_user = '$row->id_guru_sabtu'");


                                                       ?>
                                                  <tr>
                                                       <td><?=$row->jam_ke?></td>
                                                       <td style="font:16px solid;color:rgb(20, 122, 15)"><?=date('H:i',strtotime($row->jam_mulai))?></td>
                                                       <td style="font:16px solid;color:rgb(254, 52, 8)"><?=date('H:i',strtotime($row->jam_selesai))?></td>


                                                       <td>
                                                            <?php if ($data_matpel1->result() == NULL) {
                                                                 echo "-";
                                                            }else {
                                                                 echo '<b style="font-size:16px">'.$data_matpel1->result()[0]->nama_matpel.'</b>';
                                                            }
                                                            ?><br>
                                                           <?php if ($data_guru1->result() == NULL) {
                                                                echo "-";
                                                           }else {
                                                                echo $data_guru1->result()[0]->nama;
                                                           }
                                                           ?>

                                                      </td>


                                                      <td>
                                                           <?php if ($data_matpel2->result() == NULL) {
                                                                echo "-";
                                                           }else {
                                                                echo '<b style="font-size:16px">'.$data_matpel2->result()[0]->nama_matpel.'</b>';
                                                           }
                                                           ?><br>
                                                           <?php if ($data_guru2->result() == NULL) {
                                                                echo "-";
                                                           }else {
                                                                echo $data_guru2->result()[0]->nama;
                                                           }
                                                           ?>
                                                      </td>


                                                      <td>
                                                           <?php if ($data_matpel3->result() == NULL) {
                                                                echo "-";
                                                           }else {
                                                                echo '<b style="font-size:16px">'.$data_matpel3->result()[0]->nama_matpel.'</b>';
                                                           }
                                                           ?><br>
                                                           <?php if ($data_guru3->result() == NULL) {
                                                                echo "-";
                                                           }else {
                                                                echo $data_guru3->result()[0]->nama;
                                                           }
                                                           ?>
                                                      </td>


                                                      <td>
                                                           <?php if ($data_matpel4->result() == NULL) {
                                                                echo "-";
                                                           }else {
                                                                echo '<b style="font-size:16px">'.$data_matpel4->result()[0]->nama_matpel.'</b>';
                                                           }
                                                           ?><br>
                                                           <?php if ($data_guru4->result() == NULL) {
                                                                echo "-";
                                                           }else {
                                                                echo $data_guru4->result()[0]->nama;
                                                           }
                                                           ?>
                                                      </td>


                                                       <td>
                                                            <?php if ($data_matpel5->result() == NULL) {
                                                                 echo "-";
                                                            }else {
                                                                 echo '<b style="font-size:16px">'.$data_matpel5->result()[0]->nama_matpel.'</b>';
                                                            }
                                                            ?><br>
                                                            <?php if ($data_guru5->result() == NULL) {
                                                                echo "-";
                                                           }else {
                                                                echo $data_guru5->result()[0]->nama;
                                                           }
                                                           ?>
                                                       </td>


                                                       <td>
                                                            <?php if ($data_matpel6->result() == NULL) {
                                                                 echo "-";
                                                            }else {
                                                                 echo '<b style="font-size:16px">'.$data_matpel6->result()[0]->nama_matpel.'</b>';
                                                            }
                                                            ?><br>
                                                            <?php if ($data_guru6->result() == NULL) {
                                                                echo "-";
                                                           }else {
                                                                echo $data_guru6->result()[0]->nama;
                                                           }
                                                           ?>
                                                       </td>



                                                  </tr>
                                                  <?php $no++;
                                                  } ?>
                                             </tbody>
                                       </table>
                                   </div>

                              </div>
					</div>
					<!-- END OVERVIEW --> <?php endif; ?>
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
