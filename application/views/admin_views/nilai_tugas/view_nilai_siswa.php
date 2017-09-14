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
                    $id_kelas = $this->input->get('id_kelas');
                    $id_matpel = $this->input->get('id_matpel');
                    $id_smt = $this->input->get('smt');
                    $data = $this->db->query("SELECT * FROM `nilai_tugas` a JOIN tbl_pd_siswa b
                                              ON a.id_pd_siswa = b.id_pd_siswa
                                              WHERE b.id_kelas ='$id_kelas' AND a.id_matpel ='$id_matpel' AND b.id_smt = '$id_smt'");
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
                                            <?php

                                                  $nama_controller = 'nilai_tugas';
                                                  $matpel  = $this->db->query("SELECT * FROM mata_pelajaran where id_matpel = '$id_matpel'");
                                                  foreach ($matpel->result() as $matpel){}

                                                  $kelas  = $this->db->query("SELECT * FROM kelas where id_kelas = '$id_kelas'");
                                                  foreach ($kelas->result() as $kelas){}

                                                  $smt  = $this->db->query("SELECT * FROM master_data_semester where id_smt = '$id_smt'");
                                                  foreach ($smt->result() as $smt){}
                                             ?>
                                            <a href="<?=base_url()?>admin/<?=$nama_controller?>/tambah_data?id_matpel=<?=$id_matpel?>&id_kelas=<?=$id_kelas?>&smt=<?=$id_smt?>"><i class="fa fa-plus fa-2x"></i></a>
                                             <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                                       </div>
                                   </div>
                                   <div class="alert alert-info alert-dismissible" role="alert">
                                        <table>
                                                  <h3>Data Nilai Siswa</h3>
                                                  <tr>
                                                       <td><b>Kelas </b> </td> <td> : </td> <td style="padding-left:10px;"><?=$kelas->nama_kelas?></td>
                                                  </tr>
                                                  <tr>
                                                       <td> <b>Mata Pelajaran</b></td> <td> : </td> <td style="padding-left:10px;"><?=$matpel->nama_matpel?></td>
                                                  </tr>
                                                  <tr>
                                                      <td> <b>Semester</b></td> <td> : </td> <td style="padding-left:10px;"><?=$smt->nama_smt?></td>
                                                  </tr>

                                        </table>
                                   </div>
                                   <div class="panel-body no-padding">
                                       <table class="table table-striped data_table">
                                             <thead>
                                                  <tr>
                                                       <th>No</th>
                                                       <th>Nama Siswa</th>
                                                       <th>Mata Pelajaran</th>
                                                       <th>Nilai Tugas</th>
                                                       <th>Tanggal Input</th>
                                                       <th style="text-align:center">Aksi</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <?php
                                                  $no = 1;
                                                  foreach ($data->result() as $row):
                                                       $siswa = $this->db->query("SELECT * FROM tbl_siswa where id_siswa = '$row->id_siswa'");
                                                       foreach($siswa->result() as $siswa){}
                                                       ?>
                                                  <tr>
                                                       <td><?=$no?></td>
                                                       <td><?=$siswa->nm_siswa?></td>
                                                       <td><?=$matpel->nama_matpel?></td>
                                                       <td><?=$row->nilai_angka?></td>
                                                       <td><?=$row->tgl_nilai?></td>
                                                       <td style="text-align:center"><a href="<?=base_url()?>admin/<?=$nama_controller?>/edit_data?conid=<?=$row->id_nilai?>&id_matpel=<?=$id_matpel?>&id_kelas=<?=$id_kelas?>&smt=<?=$id_smt?>" class="btn btn-success"><span class="fa fa-edit"></span></a>
                                                            <a href="<?=base_url()?>admin/<?=$nama_controller?>/proses_hapus?conid=<?=$row->id_nilai?>&id_matpel=<?=$id_matpel?>&id_kelas=<?=$id_kelas?>&smt=<?=$id_smt?>" class="btn btn-danger"><span class="fa fa-trash"></span></a>
                                                       </td>
                                                  </tr>
                                                  <?php $no++; endforeach; ?>
                                             </tbody>
                                       </table>
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
