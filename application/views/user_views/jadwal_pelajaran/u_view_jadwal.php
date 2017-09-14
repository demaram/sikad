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
                                        <?php

                                        $pd_siswa = $this->db->query("SELECT * FROM tbl_pd_siswa where id_siswa ='$id_siswa' AND id_smt= '$id_smt'");
                                        foreach ($pd_siswa->result() as $pd_siswa) {

                                        }

                                        $rjudul = $this->db->query("SELECT * FROM kelas where id_kelas= '$pd_siswa->id_kelas'");
                                             foreach ($rjudul->result() as $kelas) {}
                                         ?>
                                       <h3 class="panel-title"><?=$judul2.' kelas '. $kelas->nama_kelas?></h3>
                                       <div class="right">
                                             <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                                       </div>
                                   </div>
                                   <div class="panel-body no-padding">
                                        <table class="table table-striped">
                                             <thead>
                                                  <tr style="font-size:20px">
                                                       <th style="width:3%">Jam Ke</th>
                                                       <th style="width:5%">Mulai</th>
                                                       <th style="width:5%">Selesai</th>
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
                                                  $data_kelas_matpel = $this->db->query("SELECT * FROM kelas_matpel where id_kelas='$pd_siswa->id_kelas' order by jam_mulai asc");
                                                  $no = 1;



                                                  foreach ($data_kelas_matpel->result() as $row){

                                                       $data_matpel1 = $this->db->query("SELECT * FROM mata_pelajaran where id_matpel = '$row->id_matpel_senin'");
                                                       $data_matpel2 = $this->db->query("SELECT * FROM mata_pelajaran where id_matpel = '$row->id_matpel_selasa'");
                                                       $data_matpel3 = $this->db->query("SELECT * FROM mata_pelajaran where id_matpel= '$row->id_matpel_rabu'");
                                                       $data_matpel4 = $this->db->query("SELECT * FROM mata_pelajaran where id_matpel = '$row->id_matpel_kamis'");
                                                       $data_matpel5 = $this->db->query("SELECT * FROM mata_pelajaran where id_matpel = '$row->id_matpel_jumat'");
                                                       $data_matpel6 = $this->db->query("SELECT * FROM mata_pelajaran where id_matpel = '$row->id_matpel_sabtu'");


                                                       ?>
                                                  <tr>
                                                       <td><?=$row->jam_ke?></td>
                                                       <td style="font:16px solid;color:rgb(20, 122, 15)"><?=date('H:i',strtotime($row->jam_mulai))?></td>
                                                       <td style="font:16px solid;color:rgb(254, 52, 8)"><?=date('H:i',strtotime($row->jam_selesai))?></td>


                                                       <td>
                                                            <?php if ($data_matpel1->result() == NULL) {
                                                                 echo "-";
                                                            }else {
                                                                 echo $data_matpel1->result()[0]->nama_matpel.'</b>';
                                                            }
                                                            ?>

                                                      </td>


                                                      <td>
                                                           <?php if ($data_matpel2->result() == NULL) {
                                                                echo "-";
                                                           }else {
                                                                echo $data_matpel2->result()[0]->nama_matpel.'</b>';
                                                           }
                                                           ?>
                                                      </td>


                                                      <td>
                                                           <?php if ($data_matpel3->result() == NULL) {
                                                                echo "-";
                                                           }else {
                                                                echo $data_matpel3->result()[0]->nama_matpel.'</b>';
                                                           }
                                                           ?>
                                                      </td>


                                                      <td>
                                                           <?php if ($data_matpel4->result() == NULL) {
                                                                echo "-";
                                                           }else {
                                                                echo $data_matpel4->result()[0]->nama_matpel.'</b>';
                                                           }
                                                           ?>
                                                      </td>


                                                       <td>
                                                            <?php if ($data_matpel5->result() == NULL) {
                                                                 echo "-";
                                                            }else {
                                                                 echo $data_matpel5->result()[0]->nama_matpel.'</b>';
                                                            }
                                                            ?>
                                                       </td>


                                                       <td>
                                                            <?php if ($data_matpel6->result() == NULL) {
                                                                 echo "-";
                                                            }else {
                                                                 echo $data_matpel6->result()[0]->nama_matpel.'</b>';
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
